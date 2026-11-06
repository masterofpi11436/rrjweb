<?php

namespace App\Http\Controllers\Training\Trainee;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookAssignment;
use App\Models\Training\TrainingBookAssignmentModuleItem;
use App\Models\Training\TrainingBookPartModuleSignoffRequirement;
use App\Models\Training\TrainingBookPartModuleChecklistItem;
use App\Models\Training\TrainingBookPartModuleSOPChecklistPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingTraineeSignoffController extends Controller
{
    public function signChecklistItem(
        TrainingBookAssignment $assignment,
        TrainingBookAssignmentModuleItem $item
    ): RedirectResponse {

        abort_unless(
            (int) $assignment->user_id === (int) Auth::id(),
            403
        );

        abort_unless($assignment->status !== 'completed', 403);

        DB::transaction(function () use ($assignment, $item) {

            $item = TrainingBookAssignmentModuleItem::query()
                ->whereKey($item->id)
                ->lockForUpdate()
                ->firstOrFail();

            $assignmentModule = $item->assignmentModule;

            abort_unless(
                (int) $assignmentModule->assignment_id === (int) $assignment->id,
                404
            );

            $bookModule = $assignmentModule->bookPartModule;

            // Determine the checklist type and validate the item.
            $validItem = match ($bookModule->module_type) {

                'checklist' => TrainingBookPartModuleChecklistItem::query()
                    ->whereKey($item->module_item_id)
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where('checklist_id', $bookModule->module_id);
                    })
                    ->exists(),

                'sop_checklist' => TrainingBookPartModuleSOPChecklistPolicy::query()
                    ->whereKey($item->module_item_id)
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where(
                            'sop_checklist_id',
                            $bookModule->module_id
                        );
                    })
                    ->exists(),

                default => false,
            };

            abort_unless($validItem, 404);

            // Find the trainee item-level signoff requirement.
            $requirement = TrainingBookPartModuleSignoffRequirement::query()
                ->where('book_part_module_id', $bookModule->id)
                ->where('signer_role', 'trainee')
                ->where('scope', 'item')
                ->firstOrFail();


            // Record the trainee's initials and timestamp.
            $user = Auth::user();

            $initials = strtoupper(
                mb_substr($user->first_name, 0, 1) .
                mb_substr($user->last_name, 0, 1)
            );

            $item->signoffs()->firstOrCreate(
                [
                    'signoff_requirement_id' => $requirement->id,
                ],
                [
                    'signed_by' => $user->id,
                    'initials' => $initials,
                    'signed_at' => now(),
                ]
            );

            // Determine whether the trainee has signed this item.
            $traineeSigned = $item->signoffs()
                ->where('signoff_requirement_id', $requirement->id)
                ->exists();

            // Mark the individual item completed for the trainee.
            if ($traineeSigned && $item->status !== 'completed') {
                $item->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                ]);
            }

            // Check whether every current item has a trainee signature.
            $moduleItems = match ($bookModule->module_type) {
                'checklist' => TrainingBookPartModuleChecklistItem::query()
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where('checklist_id', $bookModule->module_id);
                    })
                    ->pluck('id'),

                'sop_checklist' => TrainingBookPartModuleSOPChecklistPolicy::query()
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where('sop_checklist_id', $bookModule->module_id);
                    })
                    ->pluck('id'),

                default => collect(),
            };

            $traineeSignedItemIds = $assignmentModule->items()
                ->whereIn('module_item_id', $moduleItems)
                ->whereHas('signoffs', function ($query) use ($requirement) {
                    $query->where('signoff_requirement_id', $requirement->id);
                })
                ->pluck('module_item_id');

            $moduleComplete = $moduleItems->isNotEmpty()
                && $moduleItems->diff($traineeSignedItemIds)->isEmpty();

            if ($moduleComplete) {

                $assignmentModule->update([
                    'status' => 'completed',
                    'started_at' => $assignmentModule->started_at ?? now(),
                    'completed_at' => $assignmentModule->completed_at ?? now(),
                ]);

            } else {

                $assignmentModule->update([
                    'status' => 'in_progress',
                    'started_at' => $assignmentModule->started_at ?? now(),
                    'completed_at' => null,
                ]);
            }

            // Mark the assigned training book as started.
            if ($assignment->status === 'assigned') {
                $assignment->update([
                    'status' => 'in_progress',
                    'started_at' => $assignment->started_at ?? now(),
                ]);
            }

        });

        return back()->with(
            'flashMessage',
            'Checklist item signed successfully.'
        );
    }
}
