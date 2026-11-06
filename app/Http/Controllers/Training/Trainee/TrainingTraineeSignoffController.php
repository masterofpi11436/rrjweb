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

        DB::transaction(function () use ($assignment, $item) {

            $assignment = TrainingBookAssignment::query()
                ->whereKey($assignment->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless($assignment->status !== 'completed', 403);

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

            // Validate the item belongs to the selected module.
            $validItem = match ($bookModule->getRawOriginal('module_type')) {

                'checklist' => TrainingBookPartModuleChecklistItem::query()
                    ->whereKey($item->module_item_id)
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where('checklist_id', $bookModule->module_id);
                    })
                    ->exists(),

                'sop_checklist' => TrainingBookPartModuleSOPChecklistPolicy::query()
                    ->whereKey($item->module_item_id)
                    ->whereHas('group', function ($query) use ($bookModule) {
                        $query->where('sop_checklist_id', $bookModule->module_id);
                    })
                    ->exists(),

                default => false,
            };

            abort_unless($validItem, 404);

            // Find the trainee sign-off requirement.
            $requirement = TrainingBookPartModuleSignoffRequirement::query()
                ->where('book_part_module_id', $bookModule->id)
                ->where('signer_role', 'trainee')
                ->where('scope', 'item')
                ->firstOrFail();

            $user = Auth::user();

            $initials = strtoupper(
                mb_substr($user->first_name, 0, 1) .
                mb_substr($user->last_name, 0, 1)
            );

            // Record trainee signature.
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

            // Retrieve all required item-level signatures.
            $requiredSignoffIds = $bookModule->signoffRequirements()
                ->where('scope', 'item')
                ->pluck('id');

            // Retrieve signatures recorded for this item.
            $signedRequirementIds = $item->signoffs()
                ->whereIn('signoff_requirement_id', $requiredSignoffIds)
                ->pluck('signoff_requirement_id');

            // Item is complete only when every required role has signed.
            $itemComplete = $requiredSignoffIds->isNotEmpty()
                && $requiredSignoffIds->diff($signedRequirementIds)->isEmpty();

            $item->update([
                'status' => $itemComplete ? 'completed' : 'in_progress',
                'started_at' => $item->started_at ?? now(),
                'completed_at' => $itemComplete
                    ? ($item->completed_at ?? now())
                    : null,
            ]);

            // Retrieve the current checklist/SOP item IDs.
            $moduleItemIds = match ($bookModule->getRawOriginal('module_type')) {

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

            // Count completed current items.
            $completedItemIds = $assignmentModule->items()
                ->whereIn('module_item_id', $moduleItemIds)
                ->where('status', 'completed')
                ->pluck('module_item_id');

            $moduleComplete = $moduleItemIds->isNotEmpty()
                && $moduleItemIds->diff($completedItemIds)->isEmpty();

            $assignmentModule->update([
                'status' => $moduleComplete ? 'completed' : 'in_progress',
                'started_at' => $assignmentModule->started_at ?? now(),
                'completed_at' => $moduleComplete
                    ? ($assignmentModule->completed_at ?? now())
                    : null,
            ]);

            // Mark the assignment as started.
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
