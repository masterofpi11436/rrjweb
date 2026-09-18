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
    public $userId = '';
    public $bookId = '';
    public $assigned_at;

    public function mount()
    {
        $this->assigned_at = now()->format('Y-m-d');

        if (request()->has('user')) {
            $user = User::whereNotNull('training_role')
                ->find(request()->query('user'));

            if ($user) {
                $this->userId = $user->id;
            }
        }
    }

    protected function rules()
    {
        return [
            'userId' => [
                'required',
                'exists:users,id',
            ],

            'bookId' => [
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

        $alreadyAssigned = TrainingBookAssignment::where(
            'user_id',
            $this->userId
        )
            ->where(
                'book_id',
                $this->bookId
            )
            ->whereNot(
                'status',
                'completed'
            )
            ->exists();

        if ($alreadyAssigned) {
            $this->addError(
                'bookId',
                'This user already has this training book assigned.'
            );

            return;
        }

        DB::transaction(function () {

            $assignment = TrainingBookAssignment::create([
                'user_id' => $this->userId,
                'book_id' => $this->bookId,
                'status' => 'assigned',
                'assigned_at' => $this->assigned_at,
            ]);

            $book = TrainingBook::with([
                'parts.modules',
            ])->findOrFail(
                $this->bookId
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

        return redirect()
            ->route('training.admin.assignments.dashboard')
            ->with(
                'flashMessage',
                'Training book successfully assigned.'
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
