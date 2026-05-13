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

            'table_of_contents' => 'string',

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

        $policyBuilder = PolicyBuilder::create([
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
        ]);

        foreach ($this->chapters as $chapterIndex => $chapterData) {
            $chapter = Chapter::create([
                'policy_builder_id' => $policyBuilder->id,
                'chapter_title' => $chapterData['chapter_title'],
                'sort_order' => $chapterIndex,
            ]);

            foreach ($chapterData['paragraphs'] as $paragraphIndex => $paragraphData) {
                $paragraph = ChapterParagraph::create([
                    'policy_chapter_id' => $chapter->id,
                    'paragraph' => $paragraphData['paragraph'],
                    'sort_order' => $paragraphIndex,
                ]);

                foreach ($paragraphData['bullets'] ?? [] as $bulletIndex => $bulletData) {
                    ChapterParagraphBullet::create([
                        'policy_chapter_paragraph_id' => $paragraph->id,
                        'type' => $bulletData['type'],
                        'list' => [
                            'text' => $bulletData['list'],
                        ],
                        'sort_order' => $bulletIndex,
                    ]);
                }
            }
        }
    }

    public function render()
    {
        return view('Policy.Builder.livewire.policy-builder-form');
    }
}
