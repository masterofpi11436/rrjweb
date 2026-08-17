<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleEvaluation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EvaluationForm extends Component
{
    public ?int $evaluationId = null;

    public string $title = '';

    public string $description = '';

    public array $items = [];

    public function mount(?int $evaluationId = null): void
    {
        $this->evaluationId = $evaluationId;

        if ($this->evaluationId) {
            $this->loadEvaluation();
        } else {
            $this->addItem();
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

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.item' => [
                'required',
                'string',
            ],

            'items.*.description' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'An evaluation title is required.',

            'items.required' => 'At least one evaluation item is required.',
            'items.min' => 'At least one evaluation item is required.',

            'items.*.item.required' =>
                'Each evaluation item must contain instructions.',
        ];
    }

    public function loadEvaluation(): void
    {
        $evaluation = TrainingBookPartModuleEvaluation::with([
            'items' => fn ($query) => $query->orderBy('sort_order'),
        ])->findOrFail($this->evaluationId);

        $this->title = $evaluation->title;
        $this->description = $evaluation->description ?? '';

        $this->items = $evaluation->items
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'item' => $item->item,
                    'description' => $item->description ?? '',
                ];
            })
            ->values()
            ->toArray();

        if (empty($this->items)) {
            $this->addItem();
        }
    }

    public function addItem(): void
    {
        $this->items[] = [
            'id' => null,
            'item' => '',
            'description' => '',
        ];
    }

    public function insertItem(int $index): void
    {
        $newItem = [
            'id' => null,
            'item' => '',
            'description' => '',
        ];

        array_splice(
            $this->items,
            $index + 1,
            0,
            [$newItem]
        );
    }

    public function removeItem(int $index): void
    {
        if (!array_key_exists($index, $this->items)) {
            return;
        }

        unset($this->items[$index]);

        $this->items = array_values($this->items);

        if (empty($this->items)) {
            $this->addItem();
        }

        $this->resetValidation();
    }

    public function moveItemUp(int $index): void
    {
        if (
            $index <= 0 ||
            !array_key_exists($index, $this->items)
        ) {
            return;
        }

        $temporaryItem = $this->items[$index - 1];

        $this->items[$index - 1] = $this->items[$index];
        $this->items[$index] = $temporaryItem;
    }

    public function moveItemDown(int $index): void
    {
        if (
            $index < 0 ||
            $index >= count($this->items) - 1
        ) {
            return;
        }

        $temporaryItem = $this->items[$index + 1];

        $this->items[$index + 1] = $this->items[$index];
        $this->items[$index] = $temporaryItem;
    }

    public function save()
    {
        $validated = $this->validate();

        $isEditing = $this->evaluationId !== null;

        DB::transaction(function () use ($validated) {
            $evaluation = TrainingBookPartModuleEvaluation::updateOrCreate(
                [
                    'id' => $this->evaluationId,
                ],
                [
                    'title' => $validated['title'],
                    'description' =>
                        $validated['description'] ?: null,
                ]
            );

            $savedItemIds = [];

            foreach ($validated['items'] as $index => $itemData) {
                $itemId = $this->items[$index]['id'] ?? null;

                $item = $evaluation->items()->updateOrCreate(
                    [
                        'id' => $itemId,
                    ],
                    [
                        'item' => $itemData['item'],
                        'description' =>
                            $itemData['description'] ?: null,
                        'sort_order' => $index,
                    ]
                );

                $savedItemIds[] = $item->id;
            }

            $evaluation->items()
                ->whereNotIn('id', $savedItemIds)
                ->delete();

            $this->evaluationId = $evaluation->id;
        });

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
