<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleParagraph;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ParagraphForm extends Component
{
    public ?int $paragraphId = null;

    public string $title = '';

    public string $content = '';

    public array $bullets = [];

    public function mount(?int $paragraphId = null): void
    {
        $this->paragraphId = $paragraphId;

        if ($this->paragraphId !== null) {
            $this->loadParagraph();
        }
    }

    protected function loadParagraph(): void
    {
        $paragraph = TrainingBookPartModuleParagraph::with('bullets')
            ->findOrFail($this->paragraphId);

        $this->title = $paragraph->title;
        $this->content = $paragraph->content;

        $this->bullets = $paragraph->bullets
            ->map(function ($bullet) {
                return [
                    'id' => $bullet->id,
                    'type' => $bullet->type,
                    'text' => $bullet->list['text'] ?? '',
                ];
            })
            ->values()
            ->toArray();
    }

    public function addBullet(): void
    {
        $this->bullets[] = [
            'id' => null,
            'type' => 'bullet',
            'text' => '',
        ];
    }

    public function removeBullet(int $index): void
    {
        if (!array_key_exists($index, $this->bullets)) {
            return;
        }

        unset($this->bullets[$index]);

        $this->bullets = array_values($this->bullets);
    }

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'bullets' => [
                'array',
            ],

            'bullets.*.type' => [
                'required',
                'in:bullet,ordered',
            ],

            'bullets.*.text' => [
                'required',
                'string',
                'max:2000',
            ],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $wasEditing = $this->paragraphId !== null;

        DB::transaction(function () use ($validated) {
            $paragraph = TrainingBookPartModuleParagraph::updateOrCreate(
                [
                    'id' => $this->paragraphId,
                ],
                [
                    'title' => $validated['title'],
                    'content' => $validated['content'],
                ]
            );

            $savedBulletIds = [];

            foreach ($validated['bullets'] as $index => $bulletData) {
                $bullet = $paragraph->bullets()->updateOrCreate(
                    [
                        'id' => $bulletData['id'] ?? null,
                    ],
                    [
                        'type' => $bulletData['type'],
                        'list' => [
                            'text' => $bulletData['text'],
                        ],
                        'sort_order' => $index,
                    ]
                );

                $savedBulletIds[] = $bullet->id;
            }

            if (empty($savedBulletIds)) {
                $paragraph->bullets()->delete();
            } else {
                $paragraph->bullets()
                    ->whereNotIn('id', $savedBulletIds)
                    ->delete();
            }

            $this->paragraphId = $paragraph->id;
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
