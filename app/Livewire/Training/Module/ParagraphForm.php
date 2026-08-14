<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleParagraph;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ParagraphForm extends Component
{
    public ?int $paragraphId = null;

    public string $title = '';

    public string $description = '';

    public array $paragraphs = [];

    public function mount(?int $paragraphId = null): void
    {
        $this->paragraphId = $paragraphId;

        if ($this->paragraphId !== null) {
            $this->loadParagraph();
        }
    }

    public function loadParagraph(): void
    {
        $paragraphModule = TrainingBookPartModuleParagraph::with([
            'paragraphs.lists.items',
        ])->findOrFail($this->paragraphId);

        $this->title = $paragraphModule->title;
        $this->description = $paragraphModule->description ?? '';

        $this->paragraphs = $paragraphModule->paragraphs
            ->map(function ($paragraph) {
                return [
                    'id' => $paragraph->id,
                    'heading' => $paragraph->heading ?? '',
                    'content' => $paragraph->content,
                    'lists' => $paragraph->lists
                        ->map(function ($list) {
                            return [
                                'id' => $list->id,
                                'type' => $list->type,
                                'items' => $list->items
                                    ->map(function ($item) {
                                        return [
                                            'id' => $item->id,
                                            'content' => $item->content,
                                        ];
                                    })
                                    ->values()
                                    ->toArray(),
                            ];
                        })
                        ->values()
                        ->toArray(),
                ];
            })
            ->values()
            ->toArray();
    }

    public function addParagraph(): void
    {
        $this->paragraphs[] = [
            'id' => null,
            'heading' => '',
            'content' => '',
            'lists' => [],
        ];
    }

    public function removeParagraph(int $paragraphIndex): void
    {
        if (!isset($this->paragraphs[$paragraphIndex])) {
            return;
        }

        unset($this->paragraphs[$paragraphIndex]);

        $this->paragraphs = array_values($this->paragraphs);
    }

    public function addList(int $paragraphIndex): void
    {
        if (!isset($this->paragraphs[$paragraphIndex])) {
            return;
        }

        $this->paragraphs[$paragraphIndex]['lists'][] = [
            'id' => null,
            'type' => 'bullet',
            'items' => [
                [
                    'id' => null,
                    'content' => '',
                ],
            ],
        ];
    }

    public function removeList(int $paragraphIndex, int $listIndex): void
    {
        if (
            !isset(
                $this->paragraphs[$paragraphIndex]['lists'][$listIndex]
            )
        ) {
            return;
        }

        unset($this->paragraphs[$paragraphIndex]['lists'][$listIndex]);

        $this->paragraphs[$paragraphIndex]['lists'] = array_values(
            $this->paragraphs[$paragraphIndex]['lists']
        );
    }

    public function addListItem(
        int $paragraphIndex,
        int $listIndex
    ): void {
        if (
            !isset(
                $this->paragraphs[$paragraphIndex]['lists'][$listIndex]
            )
        ) {
            return;
        }

        $this->paragraphs[$paragraphIndex]['lists'][$listIndex]['items'][] = [
            'id' => null,
            'content' => '',
        ];
    }

    public function removeListItem(
        int $paragraphIndex,
        int $listIndex,
        int $itemIndex
    ): void {
        if (
            !isset(
                $this->paragraphs[$paragraphIndex]
                    ['lists'][$listIndex]
                    ['items'][$itemIndex]
            )
        ) {
            return;
        }

        unset(
            $this->paragraphs[$paragraphIndex]
                ['lists'][$listIndex]
                ['items'][$itemIndex]
        );

        $this->paragraphs[$paragraphIndex]
            ['lists'][$listIndex]
            ['items'] = array_values(
                $this->paragraphs[$paragraphIndex]
                    ['lists'][$listIndex]
                    ['items']
            );
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
                'max:1000',
            ],

            'paragraphs' => [
                'required',
                'array',
                'min:1',
            ],

            'paragraphs.*.id' => [
                'nullable',
                'integer',
            ],

            'paragraphs.*.heading' => [
                'nullable',
                'string',
                'max:255',
            ],

            'paragraphs.*.content' => [
                'nullable',
                'string',
            ],

            'paragraphs.*.lists' => [
                'array',
            ],

            'paragraphs.*.lists.*.id' => [
                'nullable',
                'integer',
            ],

            'paragraphs.*.lists.*.type' => [
                'required',
                'in:bullet,ordered',
            ],

            'paragraphs.*.lists.*.items' => [
                'required',
                'array',
                'min:1',
            ],

            'paragraphs.*.lists.*.items.*.id' => [
                'nullable',
                'integer',
            ],

            'paragraphs.*.lists.*.items.*.content' => [
                'required',
                'string',
            ],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $wasEditing = $this->paragraphId !== null;

        DB::transaction(function () use ($validated): void {
            $paragraphModule = TrainingBookPartModuleParagraph::updateOrCreate(
                [
                    'id' => $this->paragraphId,
                ],
                [
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?: null,
                ]
            );

            $savedParagraphIds = [];

            foreach (
                $validated['paragraphs'] as
                $paragraphIndex => $paragraphData
            ) {
                $paragraph = $paragraphModule->paragraphs()
                    ->updateOrCreate(
                        [
                            'id' => $paragraphData['id'] ?? null,
                        ],
                        [
                            'heading' => $paragraphData['heading'] ?: null,
                            'content' => $paragraphData['content'],
                            'sort_order' => $paragraphIndex,
                        ]
                    );

                $savedParagraphIds[] = $paragraph->id;

                $savedListIds = [];

                foreach (
                    $paragraphData['lists'] as
                    $listIndex => $listData
                ) {
                    $list = $paragraph->lists()->updateOrCreate(
                        [
                            'id' => $listData['id'] ?? null,
                        ],
                        [
                            'type' => $listData['type'],
                            'sort_order' => $listIndex,
                        ]
                    );

                    $savedListIds[] = $list->id;

                    $savedItemIds = [];

                    foreach (
                        $listData['items'] as
                        $itemIndex => $itemData
                    ) {
                        $item = $list->items()->updateOrCreate(
                            [
                                'id' => $itemData['id'] ?? null,
                            ],
                            [
                                'content' => $itemData['content'],
                                'sort_order' => $itemIndex,
                            ]
                        );

                        $savedItemIds[] = $item->id;
                    }

                    $list->items()
                        ->whereNotIn('id', $savedItemIds)
                        ->delete();
                }

                $paragraph->lists()
                    ->whereNotIn('id', $savedListIds)
                    ->delete();
            }

            $paragraphModule->paragraphs()
                ->whereNotIn('id', $savedParagraphIds)
                ->delete();

            $this->paragraphId = $paragraphModule->id;
        });

        session()->flash(
            'success',
            $wasEditing
                ? 'Paragraph module updated successfully.'
                : 'Paragraph module created successfully.'
        );

        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }

    public function render()
    {
        return view(
            'Training.Admin.Modules.Paragraphs.livewire.paragraph-form'
        );
    }
}
