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
    public ?string $flashMessage = null;

    // Module signoff requirements
    private const DEFAULT_SIGNOFFS = [
        'paragraph' => [
            'trainee',
        ],

        'checklist' => [
            'trainee',
            'fto',
        ],

        'evaluation' => [
            'trainee',
            'fto',
            'supervisor',
        ],

        'form' => [
            'trainee',
        ],

        'test' => [],

        'sop_checklist' => [
            'trainee',
        ],

        'media' => [],
    ];

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
                'id' => $part->id,
                'title' => $part->title ?? '',

                'modules' => $part->modules
                    ->map(fn (TrainingBookPartModule $module) => [
                        'id' => $module->id,
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
            'id' => null,
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
            'id' => null,
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


    public function updatedParts(mixed $value, string $key): void
    {
        if (
            preg_match(
                '/^(\d+)\.modules\.(\d+)\.module_type$/',
                $key,
                $matches
            )
        ) {
            $partIndex = (int) $matches[1];
            $moduleIndex = (int) $matches[2];

            // Reset the existing module ID
            $this->parts[$partIndex]['modules'][$moduleIndex]['id'] = null;

            // Reset the selected module
            $this->parts[$partIndex]['modules'][$moduleIndex]['module_id'] = null;

            // Set default sign-off requirements for the new module type
            $this->parts[$partIndex]['modules'][$moduleIndex]['signoff_requirements']
                = self::DEFAULT_SIGNOFFS[$value] ?? [];
        }
    }

    public function save()
    {
        $wasEditing = $this->trainingBookId !== null;

        $validated = $this->validate(
        [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'parts.*.id' => [
                'nullable',
                'integer',
            ],

            'parts.*.modules.*.id' => [
                'nullable',
                'integer',
            ],

            'parts' => [
                'required',
                'array',
                'min:1',
            ],

            'parts.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'parts.*.modules' => [
                'required',
                'array',
                'min:1',
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
        ],
        [
            'title.required' =>
                'Please enter a title for the training book.',

            'title.max' =>
                'The training book title cannot be longer than 255 characters.',

            'parts.required' =>
                'Please add at least one part to the training book.',

            'parts.min' =>
                'Please add at least one part to the training book.',

            'parts.*.title.required' =>
                'Please enter a title for each book part.',

            'parts.*.title.max' =>
                'A book part title cannot be longer than 255 characters.',

            'parts.*.modules.required' =>
                'Each book part must have at least one module.',

            'parts.*.modules.min' =>
                'Each book part must have at least one module.',

            'parts.*.modules.*.module_type.required' =>
                'Please select a module type.',

            'parts.*.modules.*.module_type.in' =>
                'Please select a valid module type.',

            'parts.*.modules.*.module_id.required' =>
                'Please select a module.',

            'parts.*.modules.*.module_id.integer' =>
                'Please select a valid module.',

            'parts.*.modules.*.signoff_requirements.array' =>
                'The selected signature requirements are invalid.',

            'parts.*.modules.*.signoff_requirements.*.in' =>
                'One of the selected signature requirements is invalid.',
        ]
    );

        foreach ($validated['parts'] as $partIndex => $partData) {
            foreach ($partData['modules'] ?? [] as $moduleIndex => $moduleData) {

                $type = $moduleData['module_type'];
                $moduleId = $moduleData['module_id'];

                $modelClass = self::MODULE_TYPES[$type];

                $exists = $modelClass::query()
                    ->whereKey($moduleId)
                    ->exists();

                if (! $exists) {
                    throw ValidationException::withMessages([
                        "parts.$partIndex.modules.$moduleIndex.module_id"
                            => 'The selected module is no longer available. Please select another module.',
                    ]);
                }
            }
        }


        DB::transaction(function () use ($validated): void {

            $book = $this->trainingBookId
                ? TrainingBook::query()->lockForUpdate()->findOrFail($this->trainingBookId)
                : new TrainingBook();

            $book->title = $validated['title'];
            $book->save();

            $this->trainingBookId = $book->id;

            // Check whether this book has existing assignments.
            $hasAssignments = DB::table('training_book_assignments')
                ->where('book_id', $book->id)
                ->exists();

            $existingParts = $book->parts()
                ->with('modules')
                ->get();

            $savedPartIds = [];

            foreach ($validated['parts'] as $partIndex => $partData) {

                $partId = $partData['id'] ?? null;

                // Update an existing part or create a new one.
                $part = $partId
                    ? $book->parts()->whereKey($partId)->firstOrFail()
                    : new TrainingBookPart();

                $part->book_id = $book->id;
                $part->title = $partData['title'];
                $part->sort_order = $partIndex;
                $part->save();

                $savedPartIds[] = $part->id;

                $existingModules = $partId
                    ? $existingParts->firstWhere('id', $part->id)?->modules
                    : collect();

                $existingModules = $existingModules ?? collect();

                $savedModuleIds = [];

                foreach ($partData['modules'] as $moduleIndex => $moduleData) {

                    $moduleId = $moduleData['id'] ?? null;

                    // Preserve the existing module ID.
                    $bookPartModule = $moduleId
                        ? $part->modules()->whereKey($moduleId)->firstOrFail()
                        : new TrainingBookPartModule();

                    // Do not replace a module already used by assignments.
                    if ($moduleId && $hasAssignments) {

                        $originalType = $bookPartModule->getRawOriginal('module_type');

                        if (
                            $originalType !== $moduleData['module_type'] ||
                            (int) $bookPartModule->module_id !== (int) $moduleData['module_id']
                        ) {
                            throw ValidationException::withMessages([
                                'parts' => 'An assigned module cannot be replaced. Add a new module instead.',
                            ]);
                        }
                    }

                    $bookPartModule->book_part_id = $part->id;
                    $bookPartModule->module_type = $moduleData['module_type'];
                    $bookPartModule->module_id = $moduleData['module_id'];
                    $bookPartModule->sort_order = $moduleIndex;
                    $bookPartModule->save();

                    $savedModuleIds[] = $bookPartModule->id;

                    // Determine sign-off scope.
                    $scope = match ($moduleData['module_type']) {
                        'checklist', 'sop_checklist' => 'item',
                        default => 'module',
                    };

                    $selectedRoles = array_values(array_unique(
                        $moduleData['signoff_requirements'] ?? []
                    ));

                    // Update existing requirements without changing their IDs.
                    foreach ($selectedRoles as $signoffIndex => $signerRole) {

                        $bookPartModule->signoffRequirements()->updateOrCreate(
                            [
                                'signer_role' => $signerRole,
                                'scope' => $scope,
                            ],
                            [
                                'sort_order' => $signoffIndex,
                            ]
                        );
                    }

                    // Find requirements that are no longer selected.
                    $removedRequirements = $bookPartModule
                        ->signoffRequirements()
                        ->where(function ($query) use ($scope, $selectedRoles) {

                            $query->where('scope', '!=', $scope);

                            if (!empty($selectedRoles)) {
                                $query->orWhereNotIn('signer_role', $selectedRoles);
                            } else {
                                $query->orWhereRaw('1 = 1');
                            }
                        })
                        ->get();

                    foreach ($removedRequirements as $requirement) {

                        // Never delete a requirement with existing signatures.
                        $hasSignatures = DB::table('training_book_assignment_signoffs')
                            ->where('signoff_requirement_id', $requirement->id)
                            ->exists();

                        if ($hasSignatures) {
                            throw ValidationException::withMessages([
                                'parts' => 'A sign-off requirement with existing signatures cannot be removed.',
                            ]);
                        }

                        $requirement->delete();
                    }
                }

                // Find modules removed from this part.
                $removedModules = $existingModules
                    ->whereNotIn('id', $savedModuleIds);

                if ($hasAssignments && $removedModules->isNotEmpty()) {
                    throw ValidationException::withMessages([
                        'parts' => 'Modules cannot be removed from a book that has existing assignments.',
                    ]);
                }

                foreach ($removedModules as $removedModule) {
                    $removedModule->delete();
                }
            }

            // Find parts removed from the book.
            $removedParts = $existingParts
                ->whereNotIn('id', $savedPartIds);

            if ($hasAssignments && $removedParts->isNotEmpty()) {
                throw ValidationException::withMessages([
                    'parts' => 'Parts cannot be removed from a book that has existing assignments.',
                ]);
            }

            foreach ($removedParts as $removedPart) {
                $removedPart->delete();
            }
        });


        return redirect()
            ->route('training.admin.books.dashboard')
            ->with('flashMessage', $wasEditing ? "Book updated successfully" : "Book created successfully");
    }

    public function render()
    {
        return view(
            'Training.Admin.Books.livewire.book-form'
        );
    }
}
