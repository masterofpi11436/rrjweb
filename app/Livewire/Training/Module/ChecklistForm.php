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

    public array $groups = [];

    public function mount(?int $checklistId = null): void
    {
        $this->checklistId = $checklistId;

        if ($this->checklistId) {
            $this->loadChecklist();
        } else {
            $this->addGroup();
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

            'groups' => [
                'required',
                'array',
                'min:1',
            ],

            'groups.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'groups.*.description' => [
                'nullable',
                'string',
            ],

            'groups.*.items' => [
                'required',
                'array',
                'min:1',
            ],

            'groups.*.items.*.item' => [
                'required',
                'string',
            ],

            'groups.*.items.*.description' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' =>
                'A checklist title is required.',

            'groups.required' =>
                'At least one checklist group is required.',

            'groups.min' =>
                'At least one checklist group is required.',

            'groups.*.title.required' =>
                'Each checklist group requires a title.',

            'groups.*.items.required' =>
                'Each checklist group requires at least one item.',

            'groups.*.items.min' =>
                'Each checklist group requires at least one item.',

            'groups.*.items.*.item.required' =>
                'Each checklist item is required.',
        ];
    }

    public function loadChecklist(): void
    {
        $checklist = TrainingBookPartModuleChecklist::with([
            'groups' => fn ($query) =>
                $query->orderBy('sort_order'),

            'groups.items' => fn ($query) =>
                $query->orderBy('sort_order'),
        ])->findOrFail($this->checklistId);

        $this->title = $checklist->title;

        $this->description =
            $checklist->description ?? '';

        $this->groups = $checklist->groups
            ->map(function ($group) {
                return [
                    'id' => $group->id,
                    'title' => $group->title,
                    'description' =>
                        $group->description ?? '',

                    'items' => $group->items
                        ->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'item' => $item->item,
                                'description' =>
                                    $item->description ?? '',
                            ];
                        })
                        ->values()
                        ->toArray(),
                ];
            })
            ->values()
            ->toArray();

        if (empty($this->groups)) {
            $this->addGroup();
        }
    }

    public function addGroup(): void
    {
        $this->groups[] = [
            'id' => null,
            'title' => '',
            'description' => '',
            'items' => [
                [
                    'id' => null,
                    'item' => '',
                    'description' => '',
                ],
            ],
        ];
    }

    public function insertGroup(int $index): void
    {
        array_splice(
            $this->groups,
            $index + 1,
            0,
            [[
                'id' => null,
                'title' => '',
                'description' => '',
                'items' => [
                    [
                        'id' => null,
                        'item' => '',
                        'description' => '',
                    ],
                ],
            ]]
        );
    }

    public function removeGroup(int $index): void
    {
        if (! array_key_exists($index, $this->groups)) {
            return;
        }

        unset($this->groups[$index]);

        $this->groups = array_values($this->groups);

        if (empty($this->groups)) {
            $this->addGroup();
        }

        $this->resetValidation();
    }

    public function moveGroupUp(int $index): void
    {
        if (
            $index <= 0 ||
            ! array_key_exists($index, $this->groups)
        ) {
            return;
        }

        [
            $this->groups[$index - 1],
            $this->groups[$index]
        ] = [
            $this->groups[$index],
            $this->groups[$index - 1]
        ];
    }

    public function moveGroupDown(int $index): void
    {
        if (
            $index < 0 ||
            $index >= count($this->groups) - 1
        ) {
            return;
        }

        [
            $this->groups[$index + 1],
            $this->groups[$index]
        ] = [
            $this->groups[$index],
            $this->groups[$index + 1]
        ];
    }

    public function addItem(int $groupIndex): void
    {
        $this->groups[$groupIndex]['items'][] = [
            'id' => null,
            'item' => '',
            'description' => '',
        ];
    }

    public function insertItem(
        int $groupIndex,
        int $itemIndex
    ): void {
        array_splice(
            $this->groups[$groupIndex]['items'],
            $itemIndex + 1,
            0,
            [[
                'id' => null,
                'item' => '',
                'description' => '',
            ]]
        );
    }

    public function removeItem(
        int $groupIndex,
        int $itemIndex
    ): void {
        if (
            ! isset(
                $this->groups[$groupIndex]['items'][$itemIndex]
            )
        ) {
            return;
        }

        unset(
            $this->groups[$groupIndex]['items'][$itemIndex]
        );

        $this->groups[$groupIndex]['items'] =
            array_values(
                $this->groups[$groupIndex]['items']
            );

        if (
            empty(
                $this->groups[$groupIndex]['items']
            )
        ) {
            $this->addItem($groupIndex);
        }

        $this->resetValidation();
    }

    public function moveItemUp(
        int $groupIndex,
        int $itemIndex
    ): void {
        if ($itemIndex <= 0) {
            return;
        }

        $items =
            &$this->groups[$groupIndex]['items'];

        [
            $items[$itemIndex - 1],
            $items[$itemIndex]
        ] = [
            $items[$itemIndex],
            $items[$itemIndex - 1]
        ];
    }

    public function moveItemDown(
        int $groupIndex,
        int $itemIndex
    ): void {
        $items =
            &$this->groups[$groupIndex]['items'];

        if (
            $itemIndex < 0 ||
            $itemIndex >= count($items) - 1
        ) {
            return;
        }

        [
            $items[$itemIndex + 1],
            $items[$itemIndex]
        ] = [
            $items[$itemIndex],
            $items[$itemIndex + 1]
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $isEditing =
            $this->checklistId !== null;

        DB::transaction(function () use ($validated) {

            $checklist =
                TrainingBookPartModuleChecklist::updateOrCreate(
                    [
                        'id' => $this->checklistId,
                    ],
                    [
                        'title' =>
                            $validated['title'],

                        'description' =>
                            $validated['description']
                                ?: null,
                    ]
                );

            $savedGroupIds = [];

            foreach (
                $validated['groups']
                as $groupIndex => $groupData
            ) {
                $groupId =
                    $this->groups[$groupIndex]['id']
                    ?? null;

                $group =
                    $checklist->groups()->updateOrCreate(
                        [
                            'id' => $groupId,
                        ],
                        [
                            'title' =>
                                $groupData['title'],

                            'description' =>
                                $groupData['description']
                                    ?: null,

                            'sort_order' =>
                                $groupIndex,
                        ]
                    );

                $savedGroupIds[] = $group->id;

                $savedItemIds = [];

                foreach (
                    $groupData['items']
                    as $itemIndex => $itemData
                ) {
                    $itemId =
                        $this->groups[$groupIndex]
                            ['items'][$itemIndex]['id']
                        ?? null;

                    $item =
                        $group->items()->updateOrCreate(
                            [
                                'id' => $itemId,
                            ],
                            [
                                'item' =>
                                    $itemData['item'],

                                'description' =>
                                    $itemData['description']
                                        ?: null,

                                'sort_order' =>
                                    $itemIndex,
                            ]
                        );

                    $savedItemIds[] = $item->id;
                }

                $group->items()
                    ->whereNotIn(
                        'id',
                        $savedItemIds
                    )
                    ->delete();
            }

            $checklist->groups()
                ->whereNotIn(
                    'id',
                    $savedGroupIds
                )
                ->delete();

            $this->checklistId =
                $checklist->id;
        });

        session()->flash(
            'success',
            $isEditing
                ? 'Checklist updated successfully.'
                : 'Checklist created successfully.'
        );

       