<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleEvaluation;
use Livewire\Component;

class EvaluationForm extends Component
{
    public ?int $evaluationId = null;

    public string $title = '';

    public string $description = '';

    public function mount(?int $evaluationId = null): void
    {
        $this->evaluationId = $evaluationId;

        if ($this->evaluationId) {
            $this->loadEvaluation();
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
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'An evaluation title is required.',
        ];
    }

    public function loadEvaluation(): void
    {
        $evaluation = TrainingBookPartModuleEvaluation::findOrFail(
            $this->evaluationId
        );

        $this->title = $evaluation->title;

        $this->description = $evaluation->description ?? '';
    }

    public function save()
    {
        $validated = $this->validate();

        $isEditing = $this->evaluationId !== null;

        $evaluation = TrainingBookPartModuleEvaluation::updateOrCreate(
            [
                'id' => $this->evaluationId,
            ],
            [
                'title' => $validated['title'],
                'description' => $validated['description'] ?: null,
            ]
        );

        $this->evaluationId = $evaluation->id;

        session()->flash(
            'success',
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