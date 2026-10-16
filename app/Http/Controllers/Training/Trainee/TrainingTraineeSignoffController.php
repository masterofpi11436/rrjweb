<?php

namespace App\Http\Controllers\Training\Trainee;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookAssignment;
use App\Models\Training\TrainingBookAssignmentModuleItem;
use App\Models\Training\TrainingBookPartModuleSignoffRequirement;
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

            abort_unless(
                $bookModule->module instanceof
                    \App\Models\Training\TrainingBookPartModuleChecklist,
                404
            );

            // Confirm this is a real checklist item in this module.
            $validItem = \App\Models\Training\TrainingBookPartModuleChecklistItem::query()
                ->whereKey($item->module_item_id)
                ->whereHas('group', function ($query) use ($bookModule) {
                    $query->where('checklist_id', $bookModule->module_id);
                })
                ->exists();

            abort_unless($validItem, 404);

            $requirement = TrainingBookPartModuleSignoffRequirement::query()
                ->where('book_part_module_id', $bookModule->id)
                ->where('signer_role', 'trainee')
                ->where('scope', 'item')
                ->firstOrFail();

            $item->signoffs()->firstOrCreate(
                [
                    'signoff_requirement_id' => $requirement->id,
                ],
                [
                    'signed_by' => Auth::id(),
                    'signed_at' => now(),
                ]
            );

            $requirements = $bookModule->signoffRequirements()
                ->where('scope', 'item')
                ->pluck('id');

            $signedRequirementIds = $item->signoffs()
                ->whereIn('signoff_requirement_id', $requirements)
                ->pluck('signoff_requirement_id');

            $itemComplete = $requirements->isNotEmpty()
                && $requirements->diff($signedRequirementIds)->isEmpty();

            $item->update([
                'status' => $itemComplete ? 'completed' : 'not_started',
                'completed_at' => $itemComplete ? now() : null,
            ]);

            // The module becomes complete only when every
            // assigned item has all required signatures.
            $items = $assignmentModule->items();

            $moduleComplete = $items->exists()
                && ! (clone $items)
                    ->where('status', '!=', 'completed')
                    ->exists();

            if ($moduleComplete) {
                $assignmentModule->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                ]);
            } elseif ($assignmentModule->status !== 'in_progress') {
                $assignmentModule->update([
                    'status' => 'in_progress',
                    'started_at' => $assignmentModule->started_at ?? now(),
                    'completed_at' => null,
                ]);
            }
        });

        return back()->with(
            'flashMessage',
            'Checklist item signed successfully.'
        );
    }
}
