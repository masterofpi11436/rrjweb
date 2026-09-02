<?php

namespace App\Livewire\Training\Assignment;

use App\Models\Login\User;
use App\Models\Training\TrainingBookAssignment;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->status = '';

        $this->resetPage();
    }

    public function deleteAssignment(int $assignmentId): void
    {
        $assignment = TrainingBookAssignment::findOrFail($assignmentId);

        $assignment->delete();

        session()->flash(
            'create-edit-delete-message',
            'Training book assignment removed successfully.'
        );
    }

    public function render()
    {
        $users = User::query()
            ->whereNotNull('training_role')

            ->with([
                'trainingBookAssignments' => function ($query) {
                    $query
                        ->with([
                            'book',
                            'modules',
                        ])
                        ->latest('assigned_at');
                },
            ])

            ->when($this->search, function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas(
                            'trainingBookAssignments.book',
                            function ($query) use ($search) {
                                $query->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );
                });
            })

            ->when($this->status, function ($query) {
                $query->whereHas(
                    'trainingBookAssignments',
                    function ($query) {
                        $query->where(
                            'status',
                            $this->status
                        );
                    }
                );
            })

            ->orderBy('last_name')
            ->orderBy('first_name')

            ->paginate(15);

        $assignmentCounts = [
            'total' => TrainingBookAssignment::count(),

            'assigned' => TrainingBookAssignment::where(
                'status',
                'assigned'
            )->count(),

            'in_progress' => TrainingBookAssignment::where(
                'status',
                'in_progress'
            )->count(),

            'completed' => TrainingBookAssignment::where(
                'status',
                'completed'
            )->count(),
        ];

        return view(
            'Training.Admin.Assignments.livewire.assignments',
            [
                'users' => $users,
                'assignmentCounts' => $assignmentCounts,
            ]
        );
    }
}
