<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleTest;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TestForm extends Component
{
    public ?int $testId = null;

    public string $title = '';

    public string $description = '';

    public $passing_score = null;

    public array $questions = [];

    public function mount(?int $testId = null): void
    {
        $this->testId = $testId;

        if ($this->testId) {
            $this->loadTest();
        } else {
            $this->addQuestion();
        }
    }

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'passing_score' => [
                'nullable',
                'integer',
                'min:0',
                'max:100',
            ],

            'questions' => [
                'required',
                'array',
                'min:1',
            ],

            'questions.*.type' => [
                'required',
                'in:multiple_choice,true_false,free_form',
            ],

            'questions.*.question' => [
                'required',
                'string',
            ],

            'questions.*.options' => [
                'array',
            ],

            'questions.*.options.*.option' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function addQuestion(): void
    {
        $this->questions[] = [
            'id' => null,
            'type' => 'multiple_choice',
            'question' => '',
            'options' => [
                [
                    'id' => null,
                    'option' => '',
                    'is_correct' => false,
                ],
                [
                    'id' => null,
                    'option' => '',
                    'is_correct' => false,
                ],
            ],
        ];
    }

    public function removeQuestion(int $questionIndex): void
    {
        unset($this->questions[$questionIndex]);

        $this->questions = array_values($this->questions);
    }

    public function addOption(int $questionIndex): void
    {
        $this->questions[$questionIndex]['options'][] = [
            'id' => null,
            'option' => '',
            'is_correct' => false,
        ];
    }

    public function removeOption(
        int $questionIndex,
        int $optionIndex
    ): void {
        unset(
            $this->questions[$questionIndex]['options'][$optionIndex]
        );

        $this->questions[$questionIndex]['options'] = array_values(
            $this->questions[$questionIndex]['options']
        );
    }

    public function updatedQuestions($value, $key): void
    {
        /*
         * $key will look like:
         *
         * 0.type
         * 1.type
         * etc.
         */

        if (!str_ends_with($key, '.type')) {
            return;
        }

        $parts = explode('.', $key);

        $questionIndex = (int) $parts[0];

        $type = $this->questions[$questionIndex]['type'];

        if ($type === 'true_false') {
            $this->questions[$questionIndex]['options'] = [
                [
                    'id' => null,
                    'option' => 'True',
                    'is_correct' => false,
                ],
                [
                    'id' => null,
                    'option' => 'False',
                    'is_correct' => false,
                ],
            ];
        }

        if ($type === 'free_form') {
            $this->questions[$questionIndex]['options'] = [];
        }

        if (
            $type === 'multiple_choice' &&
            empty($this->questions[$questionIndex]['options'])
        ) {
            $this->questions[$questionIndex]['options'] = [
                [
                    'id' => null,
                    'option' => '',
                    'is_correct' => false,
                ],
                [
                    'id' => null,
                    'option' => '',
                    'is_correct' => false,
                ],
            ];
        }
    }

    public function selectCorrectAnswer(
        int $questionIndex,
        int $optionIndex
    ): void {
        foreach (
            $this->questions[$questionIndex]['options']
            as $index => $option
        ) {
            $this->questions[$questionIndex]['options'][$index]['is_correct']
                = $index === $optionIndex;
        }
    }

    public function save()
    {
        $this->validate();

        $this->validateQuestionOptions();

        DB::transaction(function () {
            $test = TrainingBookPartModuleTest::updateOrCreate(
                [
                    'id' => $this->testId,
                ],
                [
                    'title' => $this->title,
                    'description' => $this->description ?: null,
                    'passing_score' => $this->passing_score ?: null,
                ]
            );

            /*
             * Store IDs that still exist so deleted questions
             * can be removed from the database.
             */
            $savedQuestionIds = [];

            foreach (
                array_values($this->questions)
                as $questionSortOrder => $questionData
            ) {
                $question = $test->questions()->updateOrCreate(
                    [
                        'id' => $questionData['id'] ?? null,
                    ],
                    [
                        'type' => $questionData['type'],
                        'question' => $questionData['question'],
                        'sort_order' => $questionSortOrder,
                    ]
                );

                $savedQuestionIds[] = $question->id;

                /*
                 * Free-form questions do not have options.
                 */
                if ($questionData['type'] === 'free_form') {
                    $question->options()->delete();

                    continue;
                }

                $savedOptionIds = [];

                foreach (
                    array_values($questionData['options'])
                    as $optionSortOrder => $optionData
                ) {
                    $option = $question->options()->updateOrCreate(
                        [
                            'id' => $optionData['id'] ?? null,
                        ],
                        [
                            'option' => $optionData['option'],
                            'is_correct' =>
                                $optionData['is_correct'] ?? false,
                            'sort_order' => $optionSortOrder,
                        ]
                    );

                    $savedOptionIds[] = $option->id;
                }

                /*
                 * Delete options removed from the form.
                 */
                $question->options()
                    ->whereNotIn('id', $savedOptionIds)
                    ->delete();
            }

            /*
             * Delete questions removed from the form.
             */
            $test->questions()
                ->whereNotIn('id', $savedQuestionIds)
                ->delete();

            $this->testId = $test->id;
        });

        $this->loadTest();

        session()->flash(
            'create-edit-delete-message',
            'Test saved successfully.'
        );

        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }

    protected function validateQuestionOptions(): void
    {
        foreach ($this->questions as $questionIndex => $question) {
            if ($question['type'] === 'free_form') {
                continue;
            }

            if (count($question['options']) < 2) {
                $this->addError(
                    "questions.{$questionIndex}.options",
                    'This question must have at least two answer options.'
                );

                return;
            }

            foreach (
                $question['options']
                as $optionIndex => $option
            ) {
                if (
                    !isset($option['option']) ||
                    trim($option['option']) === ''
                ) {
                    $this->addError(
                        "questions.{$questionIndex}.options.{$optionIndex}.option",
                        'The answer option is required.'
                    );

                    return;
                }
            }

            $hasCorrectAnswer = collect(
                $question['options']
            )->contains(
                fn ($option) =>
                    ($option['is_correct'] ?? false) === true
            );

            if (!$hasCorrectAnswer) {
                $this->addError(
                    "questions.{$questionIndex}.options",
                    'Select the correct answer.'
                );

                return;
            }
        }
    }

    protected function loadTest(): void
    {
        $test = TrainingBookPartModuleTest::with(
            'questions.options'
        )->findOrFail($this->testId);

        $this->title = $test->title;

        $this->description = $test->description ?? '';

        $this->passing_score = $test->passing_score;

        $this->questions = $test->questions
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'type' => $question->type,
                    'question' => $question->question,

                    'options' => $question->options
                        ->map(function ($option) {
                            return [
                                'id' => $option->id,
                                'option' => $option->option,
                                'is_correct' => $option->is_correct,
                            ];
                        })
                        ->values()
                        ->toArray(),
                ];
            })
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view(
            'Training.Admin.Modules.Tests.livewire.test-form'
        );
    }
}
