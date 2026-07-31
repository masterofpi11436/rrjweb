<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleChecklist;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChecklistForm extends Component
{
    public ?int $checklistId = null;

    public string $title = '';

    public string $description = '';

    public array $items = [];

    public function mount(?int $checklistId = null): void
    {
        $this->checklistId = $checklistId;

        if ($this->checklistId) {
            $this->loadChecklist();
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
            'title.required' => 'A checklist title is required.',

            'items.required' => 'At least one checklist item is required.',
            'items.min' => 'At least one checklist item is required.',

            'items.*.item.required' =>
                'Each checklist item must contain instructions.',
        ];
    }

    public function loadChecklist(): void
    {
        $checklist = TrainingBookPartModuleChecklist::with([
            'items' => fn ($query) => $query->orderBy('sort_order'),
        ])->findOrFail($this->checklistId);

        $this->title = $checklist->title;
        $this->description = $checklist->description ?? '';

        $this->items = $checklist->items
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

        $isEditing = $this->checklistId !== null;

        DB::transaction(function () use ($validated) {
            $checklist = TrainingBookPartModuleChecklist::updateOrCreate(
                [
                    'id' => $this->checklistId,
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

                $item = $checklist->items()->updateOrCreate(
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

            $checklist->items()
                ->whereNotIn('id', $savedItemIds)
                ->delete();

            $this->checklistId = $checklist->id;
        });

        session()->flash(
            'success',
            $isEditing
                ? 'Checklist updated successfully.'
                : 'Checklist created successfully.'
        );

        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }

    public function render()
    {
        return view(
            'Training.Admin.Modules.Checklists.livewire.checklist-form'
        );
    }
}
