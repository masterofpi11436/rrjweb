<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleSOPChecklist;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SOPChecklistForm extends Component
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

            'groups.*.section_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'groups.*.description' => [
                'nullable',
                'string',
            ],

            'groups.*.policies' => [
                'required',
                'array',
                'min:1',
            ],

            'groups.*.policies.*.policy_number' => [
                'required',
                'string',
                'max:255',
            ],

            'groups.*.policies.*.title' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }


    protected function messages(): array
    {
        return [
            'title.required' =>
                'A checklist title is required.',

            'groups.required' =>
                'At least one group is required.',

            'groups.min' =>
                'At least one group is required.',

            'groups.*.title.required' =>
                'Each group must have a title.',

            'groups.*.policies.required' =>
                'Each group must contain at least one policy.',

            'groups.*.policies.min' =>
                'Each group must contain at least one policy.',

            'groups.*.policies.*.policy_number.required' =>
                'Each policy must have a policy number.',

            'groups.*.policies.*.title.required' =>
                'Each policy must have a title.',
        ];
    }


    public function loadChecklist(): void
    {
        $checklist = TrainingBookPartModuleSOPChecklist::with([
            'groups' => fn ($query) =>
                $query->orderBy('sort_order'),

            'groups.policies' => fn ($query) =>
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

                    'section_number' =>
                        $group->section_number ?? '',

                    'description' =>
                        $group->description ?? '',

                    'policies' => $group->policies
                        ->map(function ($policy) {
                            return [
                                'id' => $policy->id,

                                'policy_number' =>
                                    $policy->policy_number,

                                'title' =>
                                    $policy->title,
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
            'section_number' => '',
            'description' => '',
            'policies' => [
                [
                    'id' => null,
                    'policy_number' => '',
                    'title' => '',
                ],
            ],
        ];
    }


    public function insertGroup(int $index): void
    {
        $newGroup = [
            'id' => null,
            'title' => '',
            'section_number' => '',
            'description' => '',
            'policies' => [
                [
                    'id' => null,
                    'policy_number' => '',
                    'title' => '',
                ],
            ],
        ];

        array_splice(
            $this->groups,
            $index + 1,
            0,
            [$newGroup]
        );

        $this->resetValidation();
    }


    public function removeGroup(int $index): void
    {
        if (!array_key_exists($index, $this->groups)) {
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
            !array_key_exists($index, $this->groups)
        ) {
            return;
        }

        $temporaryGroup = $this->groups[$index - 1];

        $this->groups[$index - 1] =
            $this->groups[$index];

        $this->groups[$index] =
            $temporaryGroup;
    }


    public function moveGroupDown(int $index): void
    {
        if (
            $index < 0 ||
            $index >= count($this->groups) - 1
        ) {
            return;
        }

        $temporaryGroup = $this->groups[$index + 1];

        $this->groups[$index + 1] =
            $this->groups[$index];

        $this->groups[$index] =
            $temporaryGroup;
    }

    public function addPolicy(int $groupIndex): void
    {
        if (!isset($this->groups[$groupIndex])) {
            return;
        }

        $this->groups[$groupIndex]['policies'][] = [
            'id' => null,
            'policy_number' => '',
            'title' => '',
        ];
    }


    public function insertPolicy(
        int $groupIndex,
        int $policyIndex
    ): void {
        if (!isset($this->groups[$groupIndex])) {
            return;
        }

        $newPolicy = [
            'id' => null,
            'policy_number' => '',
            'title' => '',
        ];

        array_splice(
            $this->groups[$groupIndex]['policies'],
            $policyIndex + 1,
            0,
            [$newPolicy]
        );

        $this->resetValidation();
    }


    public function removePolicy(
        int $groupIndex,
        int $policyIndex
    ): void {
        if (
            !isset(
                $this->groups[$groupIndex]
                    ['policies'][$policyIndex]
            )
        ) {
            return;
        }

        unset(
            $this->groups[$groupIndex]
                ['policies'][$policyIndex]
        );

        $this->groups[$groupIndex]['policies'] =
            array_values(
                $this->groups[$groupIndex]['policies']
            );


        if (
            empty(
                $this->groups[$groupIndex]['policies']
            )
        ) {
            $this->addPolicy($groupIndex);
        }

        $this->resetValidation();
    }


    public function movePolicyUp(
        int $groupIndex,
        int $policyIndex
    ): void {
        if (
            $policyIndex <= 0 ||
            !isset(
                $this->groups[$groupIndex]
                    ['policies'][$policyIndex]
            )
        ) {
            return;
        }

        $temporaryPolicy =
            $this->groups[$groupIndex]
                ['policies'][$policyIndex - 1];

        $this->groups[$groupIndex]
            ['policies'][$policyIndex - 1] =
                $this->groups[$groupIndex]
                    ['policies'][$policyIndex];

        $this->groups[$groupIndex]
            ['policies'][$policyIndex] =
                $temporaryPolicy;
    }


    public function movePolicyDown(
        int $groupIndex,
        int $policyIndex
    ): void {
        if (
            !isset($this->groups[$groupIndex]) ||
            $policyIndex < 0 ||
            $policyIndex >=
                count(
                    $this->groups[$groupIndex]['policies']
                ) - 1
        ) {
            return;
        }

        $temporaryPolicy =
            $this->groups[$groupIndex]
                ['policies'][$policyIndex + 1];

        $this->groups[$groupIndex]
            ['policies'][$policyIndex + 1] =
                $this->groups[$groupIndex]
                    ['policies'][$policyIndex];

        $this->groups[$groupIndex]
            ['policies'][$policyIndex] =
                $temporaryPolicy;
    }

    public function save()
    {
        $validated = $this->validate();

        $isEditing =
            $this->checklistId !== null;


        DB::transaction(function () use ($validated) {

            $checklist =
                TrainingBookPartModuleSOPChecklist::updateOrCreate(
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
                $validated['groups'] as
                $groupIndex => $groupData
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

                            'section_number' =>
                                $groupData['section_number']
                                    ?: null,

                            'description' =>
                                $groupData['description']
                                    ?: null,

                            'sort_order' =>
                                $groupIndex,
                        ]
                    );


                $savedGroupIds[] = $group->id;

                $savedPolicyIds = [];

                foreach (
                    $groupData['policies'] as
                    $policyIndex => $policyData
                ) {

                    $policyId =
                        $this->groups[$groupIndex]
                            ['policies'][$policyIndex]
                            ['id']
                        ?? null;


                    $policy =
                        $group->policies()->updateOrCreate(
                            [
                                'id' => $policyId,
                            ],
                            [
                                'policy_number' =>
                                    $policyData[
                                        'policy_number'
                                    ],

                                'title' =>
                                    $policyData['title'],

                                'sort_order' =>
                                    $policyIndex,
                            ]
                        );


                    $savedPolicyIds[] =
                        $policy->id;
                }


                $group->policies()
                    ->whereNotIn(
                        'id',
                        $savedPolicyIds
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
            'flashMessage',
            $isEditing
                ? 'SOP Checklist updated successfully.'
                : 'SOP Checklist created successfully.'
        );


        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }


    public function render()
    {
        return view(
            'Training.Admin.Modules.SOPChecklists.livewire.sop-checklist-form'
        );
    }
}
