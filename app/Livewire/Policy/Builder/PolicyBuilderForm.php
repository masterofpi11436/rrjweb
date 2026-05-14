<?php

namespace App\Livewire\Policy\Builder;

use Livewire\Component;
use App\Models\Policy\PolicyBuilder;
use App\Models\Policy\Chapter;
use App\Models\Policy\ChapterParagraph;
use App\Models\Policy\ChapterParagraphBullet;

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
    public string $references = '';
    public string $definitions = '';

    public $policyBuilderId = null;

    public function mount($policyBuilderId = null)
    {
        $this->policyBuilderId = $policyBuilderId;

        if (! $policyBuilderId) {
            return;
        }

        $policy = PolicyBuilder::with([
            'chapters.chapterParagraph.bullets'
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
        $this->references = $policy->references ?? '';
        $this->definitions = $policy->definitions ?? '';

        $this->chapters = $policy->chapters->map(function ($chapter) {
            return [
                'chapter_title' => $chapter->chapter_title ?? '',
                'paragraphs' => $chapter->chapterParagraph->map(function ($paragraph) {
                    return [
                        'paragraph' => $paragraph->paragraph ?? '',
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
    }

    public function addRevisionDate()
    {
        $this->policy_revision_dates[] = [
            'revision' => '',
            'date' => '',
        ];
    }

    public function removeRevisionDate($index)
    {
        unset($this->policy_revision_dates[$index]);
        $this->policy_revision_dates = array_values($this->policy_revision_dates);
    }

    public function addChapter()
    {
        $this->chapters[] = [
            'chapter_title' => '',
            'paragraphs' => [],
        ];
    }

    public function removeChapter($chapterIndex)
    {
        unset($this->chapters[$chapterIndex]);
        $this->chapters = array_values($this->chapters);
    }

    public function addParagraph($chapterIndex)
    {
        $this->chapters[$chapterIndex]['paragraphs'][] = [
            'paragraph' => '',
            'bullets' => [],
        ];
    }

    public function removeParagraph($chapterIndex, $paragraphIndex)
    {
        unset($this->chapters[$chapterIndex]['paragraphs'][$paragraphIndex]);
        $this->chapters[$chapterIndex]['paragraphs'] = array_values($this->chapters[$chapterIndex]['paragraphs']);
    }

    public function addBullet($chapterIndex, $paragraphIndex)
    {
        $this->chapters[$chapterIndex]['paragraphs'][$paragraphIndex]['bullets'][] = [
            'type' => 'bullet',
            'list' => '',
        ];
    }

    public function removeBullet($chapterIndex, $paragraphIndex, $bulletIndex)
    {
        unset($this->chapters[$chapterIndex]['paragraphs'][$paragraphIndex]['bullets'][$bulletIndex]);
        $this->chapters[$chapterIndex]['paragraphs'][$paragraphIndex]['bullets'] =
            array_values($this->chapters[$chapterIndex]['paragraphs'][$paragraphIndex]['bullets']);
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
            'chapters.*.paragraphs' => 'nullable|array',
            'chapters.*.paragraphs.*.paragraph' => 'nullable|string',
            'chapters.*.paragraphs.*.bullets' => 'nullable|array',
            'chapters.*.paragraphs.*.bullets.*.type' => 'nullable|string',
            'chapters.*.paragraphs.*.bullets.*.list' => 'nullable|string',

            'references' => 'nullable|string',
            'definitions' => 'nullable|string',
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
                'references' => $this->references,
                'definitions' => $this->definitions,
            ]
        );

        $this->policyBuilderId = $policy->id;

        // Clear old nested records before saving updated chapters
        foreach ($policy->chapters as $existingChapter) {
            foreach ($existingChapter->chapterParagraph as $existingParagraph) {
                $existingParagraph->bullets()->delete();
            }

            $existingChapter->chapterParagraph()->delete();
        }

        $policy->chapters()->delete();

        foreach ($this->chapters as $chapterIndex => $chapterData) {
            $chapter = Chapter::create([
                'policy_id' => $policy->id,
                'chapter_title' => $chapterData['chapter_title'] ?? '',
                'sort_order' => $chapterIndex,
            ]);

            foreach ($chapterData['paragraphs'] ?? [] as $paragraphIndex => $paragraphData) {
                $paragraph = ChapterParagraph::create([
                    'chapter_id' => $chapter->id,
                    'paragraph' => $paragraphData['paragraph'] ?? '',
                    'sort_order' => $paragraphIndex,
                ]);

                foreach ($paragraphData['bullets'] ?? [] as $bulletIndex => $bulletData) {
                    ChapterParagraphBullet::create([
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

        session()->flash('success', 'Policy saved successfully.');

        return redirect()->route('policy.builder.index');
    }

    public function render()
    {
        return view('Policy.Builder.livewire.policy-builder-form');
    }
}
