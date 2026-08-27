<?php

namespace App\Livewire\Training\Book;

use App\Models\Training\TrainingBook;
use App\Models\Training\TrainingBookPart;
use App\Models\Training\TrainingBookPartModule;
use App\Models\Training\TrainingBookPartModuleParagraph;
use App\Models\Training\TrainingBookPartModuleMedia;
use App\Models\Training\TrainingBookPartModuleForm;
use App\Models\Training\TrainingBookPartModuleChecklist;
use App\Models\Training\TrainingBookPartModuleEvaluation;
use App\Models\Training\TrainingBookPartModuleSOPChecklist;
use App\Models\Training\TrainingBookPartModuleTest;
use App\Enums\TrainingUser;
use App\Models\Training\TrainingBookPartModuleSignoffRequirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BookForm extends Component
{
    public string $title = '';
    public array $parts = [];
    public ?int $trainingBookId = null;
    public array $signerRoles = [];
    public array $availableModules = [];

    /*
     * These keys should match the morph map.
     */
    private const MODULE_TYPES = [
        'paragraph' => TrainingBookPartModuleParagraph::class,
        'media' => TrainingBookPartModuleMedia::class,
        'form' => TrainingBookPartModuleForm::class,
        'checklist' => TrainingBookPartModuleChecklist::class,
        'sop_checklist' => TrainingBookPartModuleSOPChecklist::class,
        'test' => TrainingBookPartModuleTest::class,
        'evaluation' => TrainingBookPartModuleEvaluation::class,
    ];

    public function mount(?int $trainingBookId = null): void
    {
        $this->trainingBookId = $trainingBookId;

        $this->signerRoles = [
            TrainingUser::TRAINEE->value => TrainingUser::TRAINEE->label(),
            TrainingUser::FTO->value => TrainingUser::FTO->label(),
            TrainingUser::SERGEANT->value => TrainingUser::SERGEANT->label(),
            TrainingUser::SUPERVISOR->value => TrainingUser::SUPERVISOR->label(),
            TrainingUser::UNIT->value => TrainingUser::UNIT->label(),
            TrainingUser::DIRECTOR->value => TrainingUser::DIRECTOR->label(),
        ];

        $this->loadAvailableModules();

        if (! $trainingBookId) {
            return;
        }

        $book = TrainingBook::with([
            'parts' => fn ($query) => $query->orderBy('sort_order'),

            'parts.modules' => fn ($query) => $query
                ->orderBy('sort_order')
                ->with([
                    'module',
                    'signoffRequirements',
                ]),
        ])->findOrFail($trainingBookId);

        $this->title = $book->title ?? '';

        $this->parts = $book->parts
            ->map(fn (TrainingBookPart $part) => [
                'title' => $part->title ?? '',

                'modules' => $part->modules
                    ->map(fn (TrainingBookPartModule $module) => [
                        'module_type' => $module->getRawOriginal('module_type'),
                        'module_id' => $module->module_id,

                        'signoff_requirements' => $module
                            ->signoffRequirements
                            ->pluck('signer_role')
                            ->values()
                            ->toArray(),
                    ])
                    ->toArray(),
            ])
            ->toArray();
    }

    private function loadAvailableModules(): void
    {
        foreach (self::MODULE_TYPES as $type => $modelClass) {
            $this->availableModules[$type] = $modelClass::query()
                ->orderBy('title')
                ->get([
                    'id',
                    'title',
                ])
                ->map(fn ($module) => [
                    'id' => $module->id,
                    'title' => $module->title,
                ])
                ->toArray();
        }
    }

    public function addPart(): void
    {
        $this->parts[] = [
            'title' => '',
            'modules' => [],
        ];
    }

    public function insertPartAfter(int $partIndex): void
    {
        array_splice(
            $this->parts,
            $partIndex + 1,
            0,
            [[
                'title' => '',
                'modules' => [],
            ]]
        );
    }

    public function removePart(int $partIndex): void
    {
        unset($this->parts[$partIndex]);

        $this->parts = array_values($this->parts);
    }

    public function addModule(int $partIndex): void
    {
        $this->parts[$partIndex]['modules'][] = [
            'module_type' => '',
            'module_id' => null,
            'signoff_requirements' => [],
        ];
    }

    public function insertModuleAfter(int $partIndex, int $moduleIndex): void {
        array_splice(
            $this->parts[$partIndex]['modules'],
            $moduleIndex + 1,
            0,
            [[
                'module_type' => '',
                'module_id' => null,
                'signoff_requirements' => [],
            ]]
        );
    }

    public function removeModule(
        int $partIndex,
        int $moduleIndex
    ): void {
        unset(
            $this->parts[$partIndex]['modules'][$moduleIndex]
        );

        $this->parts[$partIndex]['modules'] = array_values(
            $this->parts[$partIndex]['modules']
        );
    }

    public function updatedParts(
        mixed $value,
        string $key
    ): void {
        if (
            preg_match(
                '/^(\d+)\.modules\.(\d+)\.module_type$/',
                $key,
                $matches
            )
        ) {
            $partIndex = (int) $matches[1];
            $moduleIndex = (int) $matches[2];

            $this->parts[$partIndex]['modules'][$moduleIndex]['module_id']
                = null;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'parts' => [
                'array',
            ],

            'parts.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'parts.*.modules.*.signoff_requirements' => [
                'array',
            ],

            'parts.*.modules.*.signoff_requirements.*' => [
                'string',
                Rule::in(array_keys($this->signerRoles)),
            ],

            'parts.*.modules.*.module_type' => [
                'required',
                'string',
                Rule::in(array_keys(self::MODULE_TYPES)),
            ],

            'parts.*.modules.*.module_id' => [
                'required',
                'integer',
            ],
        ]);

        /*
         * Verify that each selected module actually exists
         * in the table belonging to its selected type.
         */
        foreach ($validated['parts'] as $partIndex => $partData) {
            foreach (
                $partData['modules'] as $moduleIndex => $moduleData
            ) {
                $type = $moduleData['module_type'];
                $moduleId = $moduleData['module_id'];

                $modelClass = self::MODULE_TYPES[$type];

                $exists = $modelClass::query()
                    ->whereKey($moduleId)
                    ->exists();

                if (! $exists) {
                    throw ValidationException::withMessages([
                        "parts.$partIndex.modules.$moduleIndex.module_id"
                            => 'The selected module does not exist.',
                    ]);
                }
            }
        }

        DB::transaction(function () use ($validated): void {
            $book = TrainingBook::updateOrCreate(
                [
                    'id' => $this->trainingBookId,
                ],
                [
                    'title' => $validated['title'],
                ]
            );

            $this->trainingBookId = $book->id;

            $book->parts()->delete();

            foreach (
                $validated['parts'] as $partIndex => $partData
            ) {
                $part = TrainingBookPart::create([
                    'book_id' => $book->id,
                    'title' => $partData['title'],
                    'sort_order' => $partIndex,
                ]);

                foreach (
                    $partData['modules'] as $moduleIndex => $moduleData
                ) {
                    $bookPartModule = TrainingBookPartModule::create([
                        'book_part_id' => $part->id,
                        'module_type' => $moduleData['module_type'],
                        'module_id' => $moduleData['module_id'],
                        'sort_order' => $moduleIndex,
                    ]);

                    foreach (
                        $moduleData['signoff_requirements'] ?? []
                        as $signoffIndex => $signerRole
                    ) {
                        TrainingBookPartModuleSignoffRequirement::create([
                            'book_part_module_id' => $bookPartModule->id,
                            'signer_role' => $signerRole,
                            'scope' => 'module',
                            'sort_order' => $signoffIndex,
                        ]);
                    }
                }
            }
        });

        session()->flash(
            'success',
            'Training book saved successfully.'
        );

        return redirect()
            ->route('training.admin.books.dashboard');
    }

    public function render()
    {
        return view(
            'Training.Admin.Books.livewire.book-form'
        );
    }
}
