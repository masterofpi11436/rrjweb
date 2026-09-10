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

    public array $sections = [];

    public function mount(?int $paragraphId = null): void
    {
        $this->paragraphId = $paragraphId;

        if ($this->paragraphId !== null) {
            $this->loadParagraph();
        } else {
            $this->addSection();
        }
    }

    public function loadParagraph(): void
    {
        $paragraphModule = TrainingBookPartModuleParagraph::with([
            'sections.paragraphs.lists.items',
        ])->findOrFail($this->paragraphId);

        $this->title = $paragraphModule->title;

        $this->description = $paragraphModule->description ?? '';

        $this->sections = $paragraphModule->sections
            ->sortBy('sort_order')
            ->map(function ($section) {
                return [
                    'id' => $section->id,
                    'heading' => $section->heading ?? '',

                    'paragraphs' => $section->paragraphs
                        ->sortBy('sort_order')
                        ->map(function ($paragraph) {
                            return [
                                'id' => $paragraph->id,
                                'content' => $paragraph->content,

                                'lists' => $paragraph->lists
                                    ->sortBy('sort_order')
                                    ->map(function ($list) {
                                        return [
                                            'id' => $list->id,
                                            'type' => $list->type,

                                            'items' => $list->items
                                                ->sortBy('sort_order')
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
                        ->toArray(),
                ];
            })
            ->values()
            ->toArray();
    }

    public function addSection(): void
    {
        $this->sections[] = [
            'id' => null,
            'heading' => '',

            'paragraphs' => [
                [
                    'id' => null,
                    'content' => '',
                    'lists' => [],
                ],
            ],
        ];
    }

    public function removeSection(int $sectionIndex): void
    {
        if (!isset($this->sections[$sectionIndex])) {
            return;
        }

        unset($this->sections[$sectionIndex]);

        $this->sections = array_values($this->sections);
    }

    public function addParagraph(int $sectionIndex): void
    {
        if (!isset($this->sections[$sectionIndex])) {
            return;
        }

        $this->sections[$sectionIndex]['paragraphs'][] = [
            'id' => null,
            'content' => '',
            'lists' => [],
        ];
    }

    public function insertParagraphAfter(
        int $sectionIndex,
        int $paragraphIndex
    ): void {
        if (!isset($this->sections[$sectionIndex]['paragraphs'][$paragraphIndex])) {
            return;
        }

        $newParagraph = [
            'id' => null,
            'content' => '',
            'lists' => [],
        ];

        array_splice(
            $this->sections[$sectionIndex]['paragraphs'],
            $paragraphIndex + 1,
            0,
            [$newParagraph]
        );
    }

    public function removeParagraph(
        int $sectionIndex,
        int $paragraphIndex
    ): void {
        if (
            !isset(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
            )
        ) {
            return;
        }

        unset(
            $this->sections[$sectionIndex]
                ['paragraphs'][$paragraphIndex]
        );

        $this->sections[$sectionIndex]['paragraphs'] = array_values(
            $this->sections[$sectionIndex]['paragraphs']
        );
    }

    public function addList(
        int $sectionIndex,
        int $paragraphIndex
    ): void {
        if (
            !isset(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
            )
        ) {
            return;
        }

        $this->sections[$sectionIndex]
            ['paragraphs'][$paragraphIndex]
            ['lists'][] = [
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

    public function removeList(
        int $sectionIndex,
        int $paragraphIndex,
        int $listIndex
    ): void {
        if (
            !isset(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
                    ['lists'][$listIndex]
            )
        ) {
            return;
        }

        unset(
            $this->sections[$sectionIndex]
                ['paragraphs'][$paragraphIndex]
                ['lists'][$listIndex]
        );

        $this->sections[$sectionIndex]
            ['paragraphs'][$paragraphIndex]
            ['lists'] = array_values(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
                    ['lists']
            );
    }

    public function addListItem(
        int $sectionIndex,
        int $paragraphIndex,
        int $listIndex
    ): void {
        if (
            !isset(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
                    ['lists'][$listIndex]
            )
        ) {
            return;
        }

        $this->sections[$sectionIndex]
            ['paragraphs'][$paragraphIndex]
            ['lists'][$listIndex]
            ['items'][] = [
                'id' => null,
                'content' => '',
            ];
    }

    public function removeListItem(
        int $sectionIndex,
        int $paragraphIndex,
        int $listIndex,
        int $itemIndex
    ): void {
        if (
            !isset(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
                    ['lists'][$listIndex]
                    ['items'][$itemIndex]
            )
        ) {
            return;
        }

        unset(
            $this->sections[$sectionIndex]
                ['paragraphs'][$paragraphIndex]
                ['lists'][$listIndex]
                ['items'][$itemIndex]
        );

        $this->sections[$sectionIndex]
            ['paragraphs'][$paragraphIndex]
            ['lists'][$listIndex]
            ['items'] = array_values(
                $this->sections[$sectionIndex]
                    ['paragraphs'][$paragraphIndex]
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

            'sections' => [
                'required',
                'array',
                'min:1',
            ],

            'sections.*.id' => [
                'nullable',
                'integer',
            ],

            'sections.*.heading' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sections.*.paragraphs' => [
                'required',
                'array',
                'min:1',
            ],

            'sections.*.paragraphs.*.id' => [
                'nullable',
                'integer',
            ],

            'sections.*.paragraphs.*.content' => [
                'required',
                'string',
            ],

            'sections.*.paragraphs.*.lists' => [
                'array',
            ],

            'sections.*.paragraphs.*.lists.*.id' => [
                'nullable',
                'integer',
            ],

            'sections.*.paragraphs.*.lists.*.type' => [
                'required',
                'in:bullet,ordered',
            ],

            'sections.*.paragraphs.*.lists.*.items' => [
                'required',
                'array',
                'min:1',
            ],

            'sections.*.paragraphs.*.lists.*.items.*.id' => [
                'nullable',
                'integer',
            ],

            'sections.*.paragraphs.*.lists.*.items.*.content' => [
                'required',
                'string',
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' =>
                'Please enter a title for the paragraph module.',

            'title.max' =>
                'The module title cannot be longer than 255 characters.',

            'description.max' =>
                'The module description cannot be longer than 1,000 characters.',

            'sections.required' =>
                'At least one section is required.',

            'sections.min' =>
                'At least one section is required.',

            'sections.*.paragraphs.required' =>
                'At least one paragraph is required in each section.',

            'sections.*.paragraphs.min' =>
                'At least one paragraph is required in each section.',

            'sections.*.paragraphs.*.content.required' =>
                'Paragraph content is required.',

            'sections.*.paragraphs.*.lists.*.type.required' =>
                'Please select a list type.',

            'sections.*.paragraphs.*.lists.*.type.in' =>
                'Please select a valid list type.',

            'sections.*.paragraphs.*.lists.*.items.required' =>
                'At least one item is required for each list.',

            'sections.*.paragraphs.*.lists.*.items.min' =>
                'At least one item is required for each list.',

            'sections.*.paragraphs.*.lists.*.items.*.content.required' =>
                'List item content is required.',
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

                    'description' =>
                        $validated['description'] ?: null,
                ]
            );

            $savedSectionIds = [];

            foreach (
                $validated['sections'] as
                $sectionIndex => $sectionData
            ) {

                /*
                 * Save Section
                 */
                $section = $paragraphModule->sections()
                    ->updateOrCreate(
                        [
                            'id' => $sectionData['id'] ?? null,
                        ],
                        [
                            'heading' =>
                                $sectionData['heading'] ?: null,

                            'sort_order' => $sectionIndex,
                        ]
                    );

                $savedSectionIds[] = $section->id;

                $savedParagraphIds = [];

                foreach (
                    $sectionData['paragraphs'] as
                    $paragraphIndex => $paragraphData
                ) {

                    /*
                     * Save Paragraph
                     */
                    $paragraph = $section->paragraphs()
                        ->updateOrCreate(
                            [
                                'id' => $paragraphData['id'] ?? null,
                            ],
                            [
                                'content' => $paragraphData['content'],

                                'sort_order' => $paragraphIndex,
                            ]
                        );

                    $savedParagraphIds[] = $paragraph->id;

                    $savedListIds = [];

                    foreach (
                        $paragraphData['lists'] ?? [] as
                        $listIndex => $listData
                    ) {

                        /*
                         * Save List
                         */
                        $list = $paragraph->lists()
                            ->updateOrCreate(
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

                            /*
                             * Save List Item
                             */
                            $item = $list->items()
                                ->updateOrCreate(
                                    [
                                        'id' => $itemData['id'] ?? null,
                                    ],
                                    [
                                        'content' =>
                                            $itemData['content'],

                                        'sort_order' =>
                                            $itemIndex,
                                    ]
                                );

                            $savedItemIds[] = $item->id;
                        }

                        /*
                         * Remove deleted list items
                         */
                        $list->items()
                            ->whereNotIn(
                                'id',
                                $savedItemIds
                            )
                            ->delete();
                    }

                    /*
                     * Remove deleted lists
                     */
                    $paragraph->lists()
                        ->whereNotIn(
                            'id',
                            $savedListIds
                        )
                        ->delete();
                }

                /*
                 * Remove deleted paragraphs
                 */
                $section->paragraphs()
                    ->whereNotIn(
                        'id',
                        $savedParagraphIds
                    )
                    ->delete();
            }

            /*
             * Remove deleted sections
             */
            $paragraphModule->sections()
                ->whereNotIn(
                    'id',
                    $savedSectionIds
                )
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
