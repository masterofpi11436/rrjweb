<?php

namespace App\Livewire\Training\Assignment;

use App\Models\Login\User;
use App\Models\Training\TrainingBook;
use App\Models\Training\TrainingBookAssignment;
use App\Models\Training\TrainingBookAssignmentModule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignmentForm extends Component
{
    public $user_id = '';
    public $book_id = '';
    public $assigned_at;

    public function mount()
    {
        $this->assigned_at = now()->format('Y-m-d');

        if (request()->has('user')) {
            $user = User::whereNotNull('training_role')
                ->find(request()->query('user'));

            if ($user) {
                $this->user_id = $user->id;
            }
        }
    }

    protected function rules()
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'book_id' => [
                'required',
                'exists:training_books,id',
            ],

            'assigned_at' => [
                'required',
                'date',
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::whereNotNull('training_role')
            ->findOrFail($this->user_id);

        $alreadyAssigned = TrainingBookAssignment::where(
            'user_id',
            $this->user_id
        )
            ->where(
                'book_id',
                $this->book_id
            )
            ->whereNot(
                'status',
                'completed'
            )
            ->exists();

        if ($alreadyAssigned) {

            $this->addError(
                'book_id',
                'This user already has this training book assigned.'
            );

            return;
        }

        DB::transaction(function () {

            $assignment = TrainingBookAssignment::create([
                'user_id' => $this->user_id,
                'book_id' => $this->book_id,
                'status' => 'assigned',
                'assigned_at' => $this->assigned_at,
            ]);

            $book = TrainingBook::with([
                'parts.modules',
            ])->findOrFail(
                $this->book_id
            );

            foreach ($book->parts as $part) {

                foreach ($part->modules as $bookPartModule) {

                    TrainingBookAssignmentModule::create([
                        'assignment_id' => $assignment->id,
                        'book_part_module_id' => $bookPartModule->id,
                        'status' => 'not_started',
                        'started_at' => null,
                        'completed_at' => null,
                    ]);
                }
            }
        });

        session()->flash(
            'create-edit-delete-message',
            'Training book assigned successfully!'
        );

        return redirect()->route(
            'training.admin.assignments.dashboard'
        );
    }


    public function render()
    {
        $users = User::query()
            ->whereNotNull('training_role')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();


        $books = TrainingBook::query()
            ->orderBy('title')
            ->get();


        return view(
            'Training.Admin.Assignments.livewire.assignment-form',
            [
                'users' => $users,
                'books' => $books,
            ]
        );
    }
}
