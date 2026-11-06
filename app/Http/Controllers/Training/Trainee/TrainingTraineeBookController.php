<?php

namespace App\Http\Controllers\Training\Trainee;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookAssignment;
use App\Models\Training\TrainingBookPartModule;
use Illuminate\Support\Facades\Auth;

class TrainingTraineeBookController extends Controller
{
    public function index()
    {
        $assignments = TrainingBookAssignment::with('book')
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->orderByDesc('assigned_at')
            ->get();

        return view(
            'Training.Trainee.Book.index',
            compact('assignments')
        );
    }

    public function show(TrainingBookAssignment $assignment)
    {
        abort_unless(
            $assignment->user_id === Auth::id(),
            403
        );

        $assignment->load([
            'book.parts.modules.module',
            'modules',
        ]);

        return view('Training.Trainee.Book.show', [
            'assignment' => $assignment,
            'book' => $assignment->book,
        ]);
    }

    public function showModule(
        TrainingBookAssignment $assignment,
        TrainingBookPartModule $bookModule
    ) {
        // Verify the assignment belongs to the logged-in trainee.
        abort_unless(
            (int) $assignment->user_id === (int) Auth::id(),
            403
        );

        // Verify the module belongs to the assigned book.
        abort_unless(
            (int) $bookModule->bookPart->book_id === (int) $assignment->book_id,
            404
        );

        // Load the actual module model.
        $bookModule->load('module');

        $module = $bookModule->module;

        abort_unless($module !== null, 404);

        // Define relationships for each module type.
        $relationships = match ($bookModule->module_type) {
            'paragraph' => [
                'sections',
            ],

            'checklist' => [
                'groups.items',
            ],

           'sop_checklist' => [
                'groups.policies',
            ],

            'form' => [
                'documents',
            ],

            'media' => [
                'files',
            ],

            'test' => [
                'questions',
            ],

            'evaluation' => [
                'items',
            ],

            default => abort(404, 'Unsupported training module type.'),
        };

        // Load only relationships that exist on this module model.
        foreach ($relationships as $relationship) {
            $rootRelationship = explode('.', $relationship)[0];

            if (method_exists($module, $rootRelationship)) {
                $module->load($relationship);
            }
        }

        // Load the trainee's assigned module and signatures.
        $assignmentModule = $assignment->modules()
            ->where('book_part_module_id', $bookModule->id)
            ->with([
                'items.signoffs.requirement',
            ])
            ->firstOrFail();

        // Synchronize checklist and SOP checklist assignment items.
        if (in_array($bookModule->module_type, [
            'checklist',
            'sop_checklist',
        ], true)) {

            $moduleItemIds = match ($bookModule->module_type) {

                'checklist' => $module->groups
                    ->flatMap(fn ($group) => $group->items)
                    ->pluck('id'),

                'sop_checklist' => $module->groups
                    ->flatMap(fn ($group) => $group->policies)
                    ->pluck('id'),

            };

            foreach ($moduleItemIds as $moduleItemId) {

                $assignmentModule->items()->firstOrCreate(
                    [
                        'module_item_id' => $moduleItemId,
                    ],
                    [
                        'status' => 'not_started',
                    ]
                );
            }

            // Reload items and their existing signatures.
            $assignmentModule->load('items.signoffs.requirement');
        }

        // Automatically complete modules that only require viewing.
        if (in_array($bookModule->module_type, [
            'paragraph',
            'form',
            'media',
        ], true)) {

            if ($assignmentModule->status !== 'completed') {

                $now = now();

                $assignmentModule->update([
                    'status' => 'completed',
                    'started_at' => $assignmentModule->started_at ?? $now,
                    'completed_at' => $now,
                ]);

                // Mark the training book as in progress.
                if ($assignment->status === 'assigned') {
                    $assignment->update([
                        'status' => 'in_progress',
                        'started_at' => $assignment->started_at ?? $now,
                    ]);
                }
            }
        }

        return view('Training.Trainee.Book.show-module', [
            'assignment' => $assignment,
            'bookModule' => $bookModule,
            'module' => $module,
            'assignmentModule' => $assignmentModule,
        ]);
    }

    public function completed()
    {
        $assignments = TrainingBookAssignment::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->orderByDesc('updated_at')
            ->get();

        return view(
            'Training.Trainee.Book.completed',
            compact('assignments')
        );
    }
}
