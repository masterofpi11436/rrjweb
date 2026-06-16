<?php

namespace App\Livewire\Policy\Builder;

use App\Models\Policy\Chapter;
use App\Models\Policy\ChapterParagraph;
use App\Models\Policy\ChapterParagraphBullet;
use App\Models\Policy\ChapterParagraphBulletBullet;
use App\Models\Policy\ChapterSection;
use App\Models\Policy\PolicyBuilder;
use App\Models\Policy\Reference;
use App\Models\Policy\ReferenceParagraph;
use App\Models\Policy\ReferenceParagraphBullet;
use Livewire\Component;

class PolicyBuilderForm extends Component
{
    public string $title = '';
    public string $policy_statement = '';
    public string $policy_purpose = '';
    public ?string $standards = null;
    public ?string $american_correctional_association = null;
    public ?string $va_board_of_local_and_regional_jails = null;
    public ?string $prison_rape_and_elimination_act = null;
    public ?string $ncchc = null;
    public ?string $policy_cross_reference = null;
    public ?string $forms = null;
    public ?string $policy_effective_date = null;

    public array $policy_revision_dates = [];

    public string $policy_owner_signature = '';
    public string $policy_owner_date = '';
    public string $policy_reviewer_signature = '';
    public string $policy_reviewer_date = '';
    public string $superintendent_approval_signature = '';
    public string $superintendent_approval_date = '';

    public string $table_of_contents = '';
    public array $chapters = [];
    public array $references = [];
    public array $definitions = [];

    public $policyBuilderId = null;

    public function mount($policyBuilderId = null)
    {
        $this->policyBuilderId = $policyBuilderId;

        if (! $policyBuilderId) {
            return;
        }

        $policy = PolicyBuilder::with([
            'chapters.sections.paragraphs.bullets.bulletBullets',
            'references.paragraphs.bullets',
            'policyDefinitions',
        ])->findOrFail($policyBuilderId);

        $this->title = $policy->title ?? '';
        $this->policy_statement = $policy->policy_statement ?? '';
        $this->policy_purpose = $policy->policy_purpose ?? '';
        $this->standards = $policy->standards;
        $this->american_correctional_association = $policy->american_correctional_association;
        $this->va_board_of_local_and_regional_jails = $policy->va_board_of_local_and_regional_jails;
        $this->prison_rape_and_elimination_act = $policy->prison_rape_and_elimination_act;
        $this->ncchc = $policy->ncchc;
        $this->policy_cross_reference = $policy->policy_cross_reference;
        $this->forms = $policy->forms;
        $this->policy_effective_date = $policy->policy_effective_date;
        $this->policy_revision_dates = $policy->policy_revision_dates ?? [];
        $this->table_of_contents = $policy->table_of_contents ?? '';

        $this->chapters = $policy->chapters->map(function ($chapter) {
            return [
                'chapter_title' => $chapter->chapter_title ?? '',

                'sections' => $chapter->sections->map(function ($section) {

                    return [
                        'section_title' => $section->section_title ?? '',

                        'paragraphs' => $section->paragraphs->map(function ($paragraph) {

                            return [
                                'paragraph' => $paragraph->paragraph ?? '',

                                'bullets' => $paragraph->bullets->map(function ($bullet) {

                                    return [
                                        'type' => $bullet->type ?? 'bullet',

                                        'list' => is_array($bullet->list)
                                            ? ($bullet->list['text'] ?? '')
                                            : ($bullet->list ?? ''),

                                        'bullet_bullets' => $bullet->bulletBullets->map(function ($childBullet) {
                                            return [
                                                'type' => $childBullet->type ?? 'bullet',

                                                'list' => is_array($childBullet->list)
                                                    ? ($childBullet->list['text'] ?? '')
                                                    : ($childBullet->list ?? ''),
                                            ];
                                        })->toArray(),
                                    ];
                                })->toArray(),

                            ];

                        })->toArray(),

                    ];

                })->toArray(),

            ];
        })->toArray();

        $this->references = $policy->references->map(function ($reference) {
            return [
                'reference_title' => $reference->reference_title ?? '',

                'paragraphs' => $reference->paragraphs->map(function ($paragraph) {

                    return [
                        'paragraph' => $paragraph->paragraph ?? '',

                        'aca_reference' => $paragraph->aca_reference ?? '',

                        'bullets' => $paragraph->bullets->map(function ($bullet) {

                            return [
                                'type' => $bullet->type ?? 'bullet',

                                'list' => is_array($bullet->list)
                                    ? ($bullet->list['text'] ?? '')
                                    : ($bullet->list ?? ''),
                            ];

                        })->toArray(),

                    ];

                })->toArray(),

            ];
        })->toArray();

        $this->definitions = $policy->policyDefinitions
            ->map(fn ($definition) => [
                'word' => $definition->word,
                'definition' => $definition->definition,
            ])->toArray();
    }

    public function addRevisionDate()
    {
        $highest = collect($this->policy_revision_dates)
            ->pluck('revision')
            ->map(fn ($r) => (int) str_replace('.', '', $r))
            ->max();

        $nextRevision = '.' . str_pad(($highest ?: 0) + 1, 3, '0', STR_PAD_LEFT);

        $this->policy_revision_dates[] = [
            'revision' => $nextRevision,
            'date' => now()->format('Y-m-d'),
        ];
    }

    public function removeRevisionDate($index)
    {
        unset($this->policy_revision_dates[$index]);
        $this->policy_revision_dates = array_values($this->policy_revision_dates);
    }

    /*
    ** Chapters
    */
    public function addChapter()
    {
        $this->chapters[] = [
            'chapter_title' => '',
            'sections' => [],
        ];
    }

    public function removeChapter($chapterIndex)
    {
        unset($this->chapters[$chapterIndex]);
        $this->chapters = array_values($this->chapters);
    }

    public function addParagraph($chapterIndex, $sectionIndex)
    {
        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][] = [
            'paragraph' => '',
            'bullets' => [],
        ];
    }

    public function removeParagraph($chapterIndex, $sectionIndex, $paragraphIndex)
    {
        unset(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]
        );

        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'] = array_values(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs']
        );
    }

    public function addSection($chapterIndex)
    {
        $this->chapters[$chapterIndex]['sections'][] = [
            'section_title' => '',
            'paragraphs' => [],
        ];
    }

    public function removeSection($chapterIndex, $sectionIndex)
    {
        unset($this->chapters[$chapterIndex]['sections'][$sectionIndex]);

        $this->chapters[$chapterIndex]['sections'] = array_values(
            $this->chapters[$chapterIndex]['sections']
        );
    }

    public function addBullet($chapterIndex, $sectionIndex, $paragraphIndex)
    {
        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][] = [
            'type' => 'bullet',
            'list' => '',
            'bullet_bullets' => [],
        ];
    }

    public function removeBullet($chapterIndex, $sectionIndex, $paragraphIndex, $bulletIndex)
    {
        unset(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]
        );

        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'] = array_values(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets']
        );
    }

    public function addBulletBullet($chapterIndex, $sectionIndex, $paragraphIndex, $bulletIndex)
    {
        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]['bullet_bullets'][] = [
            'type' => 'bullet',
            'list' => '',
        ];
    }

    public function removeBulletBullet($chapterIndex, $sectionIndex, $paragraphIndex, $bulletIndex, $childBulletIndex)
    {
        unset(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]['bullet_bullets'][$childBulletIndex]
        );

        $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]['bullet_bullets'] = array_values(
            $this->chapters[$chapterIndex]['sections'][$sectionIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]['bullet_bullets']
        );
    }
    /*
    ** Inserting chapters and revisions
    */
    public function insertChapterAfter($chapterIndex)
    {
        array_splice($this->chapters, $chapterIndex + 1, 0, [[
            'chapter_title' => '',
            'sections' => [],
        ]]);
    }

    public function insertReferenceAfter($referenceIndex)
    {
        array_splice($this->references, $referenceIndex + 1, 0, [[
            'reference_title' => '',
            'paragraphs' => [],
        ]]);
    }

    /*
    ** Revisions
    */
    public function addReference()
    {
        $this->references[] = [
            'reference_title' => '',
            'paragraphs' => [],
        ];
    }

    public function removeReference($referenceIndex)
    {
        unset($this->references[$referenceIndex]);
        $this->references = array_values($this->references);
    }

    public function addReferenceParagraph($referenceIndex)
    {
        $this->references[$referenceIndex]['paragraphs'][] = [
            'paragraph' => '',
            'aca_reference',
            'bullets' => [],
        ];
    }

    public function removeReferenceParagraph($referenceIndex, $paragraphIndex)
    {
        unset(
            $this->references[$referenceIndex]['paragraphs'][$paragraphIndex]
        );

        $this->references[$referenceIndex]['paragraphs'] = array_values(
            $this->references[$referenceIndex]['paragraphs']
        );
    }

    public function addReferenceBullet($referenceIndex, $paragraphIndex)
    {
        $this->references[$referenceIndex]['paragraphs'][$paragraphIndex]['bullets'][] = [
            'type' => 'bullet',
            'list' => '',
        ];
    }

    public function removeReferenceBullet($referenceIndex, $paragraphIndex, $bulletIndex)
    {
        unset(
            $this->references[$referenceIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]
        );

        $this->references[$referenceIndex]['paragraphs'][$paragraphIndex]['bullets'] = array_values(
            $this->references[$referenceIndex]['paragraphs'][$paragraphIndex]['bullets']
        );
    }

    public function addDefinition()
    {
        $this->definitions[] = [
            'word' => '',
            'definition' => '',
        ];
    }

    public function removeDefinition($index)
    {
        unset($this->definitions[$index]);
        $this->definitions = array_values($this->definitions);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'policy_statement' => 'required|string',
            'policy_purpose' => 'required|string',
            'policy_cross_reference' => 'nullable|string',
            'policy_effective_date' => 'nullable|date',

            'policy_revision_dates' => 'nullable|array',
            'policy_revision_dates.*.revision' => 'nullable|string',
            'policy_revision_dates.*.date' => 'nullable|string',

            'table_of_contents' => 'nullable|string',

            'chapters' => 'nullable|array',
            'chapters.*.chapter_title' => 'nullable|string|max:255',
            'chapters.*.sections' => 'nullable|array',
            'chapters.*.sections.*.section_title' => 'nullable|string|max:255',
            'chapters.*.sections.*.paragraphs' => 'nullable|array',
            'chapters.*.sections.*.paragraphs.*.paragraph' => 'nullable|string',
            'chapters.*.sections.*.paragraphs.*.bullets' => 'nullable|array',
            'chapters.*.sections.*.paragraphs.*.bullets.*.type' => 'nullable|string',
            'chapters.*.sections.*.paragraphs.*.bullets.*.list' => 'nullable|string',
            'chapters.*.sections.*.paragraphs.*.bullets.*.bullet_bullets' => 'nullable|array',
            'chapters.*.sections.*.paragraphs.*.bullets.*.bullet_bullets.*.type' => 'nullable|string',
            'chapters.*.sections.*.paragraphs.*.bullets.*.bullet_bullets.*.list' => 'nullable|string',

            'references' => 'nullable|array',
            'references.*.reference_title' => 'nullable|string|max:255',
            'references.*' => 'nullable|array',
            'references.*.paragraphs' => 'nullable|array',
            'references.*.paragraphs.*.aca_reference' => 'nullable|string|max:255',
            'references.*.paragraphs.*.paragraph' => 'nullable|string',
            'references.*.paragraphs.*.bullets' => 'nullable|array',
            'references.*.paragraphs.*.bullets.*.type' => 'nullable|string',
            'references.*.paragraphs.*.bullets.*.list' => 'nullable|string',

            'definitions' => 'nullable|array',
            'definitions.*.word' => 'nullable|string|max:255',
            'definitions.*.definition' => 'nullable|string',
        ]);

        $policy = PolicyBuilder::updateOrCreate(
            ['id' => $this->policyBuilderId],
            [
                'title' => $this->title,
                'policy_statement' => $this->policy_statement,
                'policy_purpose' => $this->policy_purpose,
                'standards' => $this->standards,
                'american_correctional_association' => $this->american_correctional_association,
                'va_board_of_local_and_regional_jails' => $this->va_board_of_local_and_regional_jails,
                'prison_rape_and_elimination_act' => $this->prison_rape_and_elimination_act,
                'ncchc' => $this->ncchc,
                'policy_cross_reference' => $this->policy_cross_reference,
                'forms' => $this->forms,
                'policy_effective_date' => $this->policy_effective_date,
                'policy_revision_dates' => $this->policy_revision_dates,
                'table_of_contents' => $this->table_of_contents,
            ]
        );

        $this->policyBuilderId = $policy->id;
        $policy->load([
            'chapters.sections.paragraphs.bullets.bulletBullets',
            'references.paragraphs.bullets',
            'policyDefinitions',
        ]);

        // Clear old nested records before saving updated chapters
        foreach ($policy->chapters as $existingChapter) {

            foreach ($existingChapter->sections as $existingSection) {

                foreach ($existingSection->paragraphs as $existingParagraph) {
                    foreach ($existingParagraph->bullets as $existingBullet) {
                        $existingBullet->bulletBullets()->delete();
                    }

                    $existingParagraph->bullets()->delete();
                }

                $existingSection->paragraphs()->delete();
            }

            $existingChapter->sections()->delete();
        }

        $policy->chapters()->delete();

        foreach ($this->chapters as $chapterIndex => $chapterData) {

            $chapter = Chapter::create([
                'policy_id' => $policy->id,
                'chapter_title' => $chapterData['chapter_title'] ?? '',
                'sort_order' => $chapterIndex,
            ]);

            foreach ($chapterData['sections'] ?? [] as $sectionIndex => $sectionData) {

                $section = ChapterSection::create([
                    'chapter_id' => $chapter->id,
                    'section_title' => $sectionData['section_title'] ?? '',
                    'sort_order' => $sectionIndex,
                ]);

                foreach ($sectionData['paragraphs'] ?? [] as $paragraphIndex => $paragraphData) {

                    $paragraph = ChapterParagraph::create([
                        'section_id' => $section->id,
                        'paragraph' => $paragraphData['paragraph'] ?? '',
                        'sort_order' => $paragraphIndex,
                    ]);

                    foreach ($paragraphData['bullets'] ?? [] as $bulletIndex => $bulletData) {

                        $bullet = ChapterParagraphBullet::create([
                            'paragraph_id' => $paragraph->id,
                            'type' => $bulletData['type'] ?? 'bullet',
                            'list' => [
                                'text' => $bulletData['list'] ?? '',
                            ],
                            'sort_order' => $bulletIndex,
                        ]);

                        foreach ($bulletData['bullet_bullets'] ?? [] as $childBulletIndex => $childBulletData) {
                            ChapterParagraphBulletBullet::create([
                                'bullet_id' => $bullet->id,
                                'type' => $childBulletData['type'] ?? 'bullet',
                                'list' => [
                                    'text' => $childBulletData['list'] ?? '',
                                ],
                                'sort_order' => $childBulletIndex,
                            ]);
                        }
                    }
                }
            }
        }

        // Clear old nested records before saving updated references
        foreach ($policy->references as $existingReference) {

            foreach ($existingReference->paragraphs as $existingParagraph) {
                $existingParagraph->bullets()->delete();
            }

            $existingReference->paragraphs()->delete();
        }

        $policy->references()->delete();

        foreach ($this->references as $referenceIndex => $referenceData) {

            $reference = Reference::create([
                'policy_id' => $policy->id,
                'reference_title' => $referenceData['reference_title'] ?? '',
                'sort_order' => $referenceIndex,
            ]);

            foreach ($referenceData['paragraphs'] ?? [] as $paragraphIndex => $paragraphData) {

                $paragraph = ReferenceParagraph::create([
                    'reference_id' => $reference->id,
                    'aca_reference' => $paragraphData['aca_reference'] ?? '',
                    'paragraph' => $paragraphData['paragraph'] ?? '',
                    'sort_order' => $paragraphIndex,
                ]);

                foreach ($paragraphData['bullets'] ?? [] as $bulletIndex => $bulletData) {

                    ReferenceParagraphBullet::create([
                        'paragraph_id' => $paragraph->id,
                        'type' => $bulletData['type'] ?? 'bullet',
                        'list' => [
                            'text' => $bulletData['list'] ?? '',
                        ],
                        'sort_order' => $bulletIndex,
                    ]);
                }
            }
        }

        $policy->policyDefinitions()->delete();

        foreach ($this->definitions as $definition) {
            if (blank($definition['word'] ?? null) && blank($definition['definition'] ?? null)) {
                continue;
            }

            $policy->policyDefinitions()->create([
                'word' => $definition['word'] ?? '',
                'definition' => $definition['definition'] ?? '',
            ]);
        }

        session()->flash('success', 'Policy saved successfully.');

        return redirect()->route('policy.builder.index');
    }

    public function render()
    {
        return view('Policy.Builder.livewire.policy-builder-form');
    }
}
