<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleEvaluation;
use App\Models\Training\TrainingModuleCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EvaluationForm extends Component
{
    public ?int $evaluationId = null;

    public string $title = '';

    public string $description = '';

    public int $days = 1;

    public array $fields = [];

    public array $selectedCategories = [];

    public $categories;


    public function mount(?int $evaluationId = null): void
    {
        $this->categories = TrainingModuleCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $this->evaluationId = $evaluationId;

        if ($this->evaluationId) {
            $this->loadEvaluation();
        } else {
            $this->addDefaultFields();
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

            'days' => [
                'required',
                'integer',
                'min:1',
                'max:365',
            ],

            'fields' => [
                'required',
                'array',
                'min:1',
            ],

            'fields.*.label' => [
                'required',
                'string',
                'max:255',
            ],

            'fields.*.type' => [
                'required',
                'in:text,textarea',
            ],

            'selectedCategories' => [
                'array',
            ],

            'selectedCategories.*' => [
                'integer',
                'distinct',
                'exists:training_module_categories,id',
            ],
        ];
    }


    protected function messages(): array
    {
        return [
            'title.required' =>
                'An evaluation title is required.',

            'days.required' =>
                'The number of evaluation days is required.',

            'days.integer' =>
                'The number of evaluation days must be a whole number.',

            'days.min' =>
                'The evaluation must have at least one day.',

            'days.max' =>
                'The evaluation cannot have more than 365 days.',

            'fields.required' =>
                'At least one evaluation field is required.',

            'fields.min' =>
                'At least one evaluation field is required.',

            'fields.*.label.required' =>
                'Each evaluation field must have a label.',

            'fields.*.type.required' =>
                'Each evaluation field must have a type.',

            'fields.*.type.in' =>
                'The selected evaluation field type is invalid.',
        ];
    }


    public function loadEvaluation(): void
    {
        $evaluation = TrainingBookPartModuleEvaluation::with([
            'fields' => fn ($query) =>
                $query->orderBy('sort_order'),
        ])->findOrFail($this->evaluationId);


        $this->title = $evaluation->title;

        $this->description =
            $evaluation->description ?? '';

        $this->days = $evaluation->days ?? 1;


        $this->fields = $evaluation->fields
            ->map(function ($field) {
                return [
                    'id' => $field->id,
                    'label' => $field->label,
                    'type' => $field->type,
                ];
            })
            ->values()
            ->toArray();


        if (empty($this->fields)) {
            $this->addDefaultFields();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Default Fields
    |--------------------------------------------------------------------------
    */

    public function addDefaultFields(): void
    {
        $this->fields = [
            [
                'id' => null,
                'label' => 'Strengths',
                'type' => 'textarea',
            ],
            [
                'id' => null,
                'label' => 'Weaknesses',
                'type' => 'textarea',
            ],
            [
                'id' => null,
                'label' => 'Areas of Improvement',
                'type' => 'textarea',
            ],
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Fields
    |--------------------------------------------------------------------------
    */

    public function addField(): void
    {
        $this->fields[] = [
            'id' => null,
            'label' => '',
            'type' => 'textarea',
        ];
    }


    public function insertField(int $index): void
    {
        $newField = [
            'id' => null,
            'label' => '',
            'type' => 'textarea',
        ];

        array_splice(
            $this->fields,
            $index + 1,
            0,
            [$newField]
        );

        $this->resetValidation();
    }


    public function removeField(int $index): void
    {
        if (!array_key_exists($index, $this->fields)) {
            return;
        }

        unset($this->fields[$index]);

        $this->fields = array_values($this->fields);

        if (empty($this->fields)) {
            $this->addField();
        }

        $this->resetValidation();
    }


    public function moveFieldUp(int $index): void
    {
        if (
            $index <= 0 ||
            !array_key_exists($index, $this->fields)
        ) {
            return;
        }

        $temporaryField = $this->fields[$index - 1];

        $this->fields[$index - 1] =
            $this->fields[$index];

        $this->fields[$index] =
            $temporaryField;
    }


    public function moveFieldDown(int $index): void
    {
        if (
            $index < 0 ||
            $index >= count($this->fields) - 1
        ) {
            return;
        }

        $temporaryField = $this->fields[$index + 1];

        $this->fields[$index + 1] =
            $this->fields[$index];

        $this->fields[$index] =
            $temporaryField;
    }


    /*
    |--------------------------------------------------------------------------
    | Save
    |--------------------------------------------------------------------------
    */

    public function save()
    {
        $validated = $this->validate();

        $isEditing =
            $this->evaluationId !== null;


        DB::transaction(function () use ($validated) {

            $evaluation =
                TrainingBookPartModuleEvaluation::updateOrCreate(
                    [
                        'id' => $this->evaluationId,
                    ],
                    [
                        'title' =>
                            $validated['title'],

                        'description' =>
                            $validated['description']
                                ?: null,

                        'days' =>
                            $validated['days'],
                    ]
                );


            $savedFieldIds = [];


            foreach (
                $validated['fields'] as
                $fieldIndex => $fieldData
            ) {

                $fieldId =
                    $this->fields[$fieldIndex]['id']
                    ?? null;


                $field =
                    $evaluation->fields()->updateOrCreate(
                        [
                            'id' => $fieldId,
                        ],
                        [
                            'label' =>
                                $fieldData['label'],

                            'type' =>
                                $fieldData['type'],

                            'sort_order' =>
                                $fieldIndex,
                        ]
                    );


                $savedFieldIds[] =
                    $field->id;
            }


            $evaluation->fields()
                ->whereNotIn(
                    'id',
                    $savedFieldIds
                )
                ->delete();


            $this->evaluationId =
                $evaluation->id;
        });


        session()->flash(
            'flashMessage',
            $isEditing
                ? 'Evaluation updated successfully.'
                : 'Evaluation created successfully.'
        );


        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }


    public function render()
    {
        return view(
            'Training.Admin.Modules.Evaluations.livewire.evaluation-form'
        );
    }
}
