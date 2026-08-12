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

    public array $categories = [];

    public array $policies = [];

    public function mount(?int $checklistId = null): void
    {
        $this->checklistId = $checklistId;

        if ($this->checklistId) {
            $this->loadChecklist();
        } else {
            $this->addCategory();
            $this->addPolicy();
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

            'categories' => [
                'required',
                'array',
                'min:1',
            ],

            'categories.*.name' => [
                'required',
                'string',
                'max:255',
                'distinct',
            ],

            'policies' => [
                'required',
                'array',
                'min:1',
            ],

            'policies.*.category' => [
                'required',
                'string',
            ],

            'policies.*.policy_number' => [
                'required',
                'string',
                'max:255',
            ],

            'policies.*.title' => [
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

            'policies.required' =>
                'At least one policy is required.',

            'policies.min' =>
                'At least one policy is required.',

            'policies.*.category.required' =>
                'Each policy must have a category.',

            'policies.*.policy_number.required' =>
                'Each policy must have a policy number.',

            'policies.*.title.required' =>
                'Each policy must have a title.',
        ];
    }

    public function addCategory(): void
    {
        $this->categories[] = [
            'name' => '',
        ];
    }

    public function removeCategory(int $index): void
    {
        if (!array_key_exists($index, $this->categories)) {
            return;
        }

        $categoryName = $this->categories[$index]['name'] ?? '';

        unset($this->categories[$index]);

        $this->categories = array_values($this->categories);

        if (empty($this->categories)) {
            $this->addCategory();
        }

        if ($categoryName !== '') {
            foreach ($this->policies as $policyIndex => $policy) {
                if (($policy['category'] ?? '') === $categoryName) {
                    $this->policies[$policyIndex]['category'] = '';
                }
            }
        }

        $this->resetValidation();
    }

    public function loadChecklist(): void
    {
        $checklist = TrainingBookPartModuleSOPChecklist::with([
            'policies' => fn ($query) => $query->orderBy('sort_order'),
        ])->findOrFail($this->checklistId);

        $this->title = $checklist->title;
        $this->description = $checklist->description ?? '';

        $this->policies = $checklist->policies
            ->map(function ($policy) {
                return [
                    'id' => $policy->id,
                    'category' => $policy->category,
                    'policy_number' => $policy->policy_number,
                    'title' => $policy->title,
                ];
            })
            ->values()
            ->toArray();

        $this->categories = $checklist->policies
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->map(function ($category) {
                return [
                    'name' => $category,
                ];
            })
            ->toArray();

        if (empty($this->categories)) {
            $this->addCategory();
        }

        if (empty($this->policies)) {
            $this->addPolicy();
        }
    }

    public function addPolicy(): void
    {
        $this->policies[] = [
            'id' => null,
            'category' => '',
            'policy_number' => '',
            'title' => '',
        ];
    }

    public function insertPolicy(int $index): void
    {
        $newPolicy = [
            'id' => null,
            'category' => '',
            'policy_number' => '',
            'title' => '',
        ];

        array_splice(
            $this->policies,
            $index + 1,
            0,
            [$newPolicy]
        );
    }

    public function removePolicy(int $index): void
    {
        if (!array_key_exists($index, $this->policies)) {
            return;
        }

        unset($this->policies[$index]);

        $this->policies = array_values($this->policies);

        if (empty($this->policies)) {
            $this->addPolicy();
        }

        $this->resetValidation();
    }

    public function movePolicyUp(int $index): void
    {
        if (
            $index <= 0 ||
            !array_key_exists($index, $this->policies)
        ) {
            return;
        }

        $temporaryPolicy = $this->policies[$index - 1];

        $this->policies[$index - 1] = $this->policies[$index];
        $this->policies[$index] = $temporaryPolicy;
    }

    public function movePolicyDown(int $index): void
    {
        if (
            $index < 0 ||
            $index >= count($this->policies) - 1
        ) {
            return;
        }

        $temporaryPolicy = $this->policies[$index + 1];

        $this->policies[$index + 1] = $this->policies[$index];
        $this->policies[$index] = $temporaryPolicy;
    }

    public function save()
    {
        $validated = $this->validate();

        $isEditing = $this->checklistId !== null;

        DB::transaction(function () use ($validated) {
            $checklist = TrainingBookPartModuleSOPChecklist::updateOrCreate(
                [
                    'id' => $this->checklistId,
                ],
                [
                    'title' => $validated['title'],
                    'description' =>
                        $validated['description'] ?: null,
                ]
            );

            $savedPolicyIds = [];

            foreach ($validated['policies'] as $index => $policyData) {
                $policyId = $this->policies[$index]['id'] ?? null;

                $policy = $checklist->policies()->updateOrCreate(
                    [
                        'id' => $policyId,
                    ],
                    [
                        'category' =>
                            $policyData['category'],

                        'policy_number' =>
                            $policyData['policy_number'],

                        'title' =>
                            $policyData['title'],

                        'sort_order' =>
                            $index,
                    ]
                );

                $savedPolicyIds[] = $policy->id;
            }

            $checklist->policies()
                ->whereNotIn('id', $savedPolicyIds)
                ->delete();

            $this->checklistId = $checklist->id;
        });

        session()->flash(
            'success',
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
