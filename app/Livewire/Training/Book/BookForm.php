<?php

namespace App\Livewire\Training\Book;

use App\Models\Training\TrainingBook;
use App\Models\Training\TrainingBookPart;
use App\Models\Training\TrainingBookPartModule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BookForm extends Component
{
    public string $title = '';

    public array $parts = [];

    public ?int $trainingBookId = null;

    public function mount(?int $trainingBookId = null): void
    {
        $this->trainingBookId = $trainingBookId;

        if (! $trainingBookId) {
            return;
        }

        $book = TrainingBook::with([
            'parts' => fn ($query) => $query->orderBy('sort_order'),
            'parts.modules' => fn ($query) => $query->orderBy('sort_order'),
        ])->findOrFail($trainingBookId);

        $this->title = $book->title ?? '';

        $this->parts = $book->parts
            ->map(fn (TrainingBookPart $part) => [
                'title' => $part->title ?? '',
                'modules' => $part->modules
                    ->map(fn (TrainingBookPartModule $module) => [
                        'title' => $module->title ?? '',
                    ])
                    ->toArray(),
            ])
            ->toArray();
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
        array_splice($this->parts, $partIndex + 1, 0, [[
            'title' => '',
            'modules' => [],
        ]]);
    }

    public function removePart(int $partIndex): void
    {
        unset($this->parts[$partIndex]);
        $this->parts = array_values($this->parts);
    }

    public function addModule(int $partIndex): void
    {
        $this->parts[$partIndex]['modules'][] = [
            'title' => '',
        ];
    }

    public function insertModuleAfter(int $partIndex, int $moduleIndex): void
    {
        array_splice(
            $this->parts[$partIndex]['modules'],
            $moduleIndex + 1,
            0,
            [['title' => '']]
        );
    }

    public function removeModule(int $partIndex, int $moduleIndex): void
    {
        unset($this->parts[$partIndex]['modules'][$moduleIndex]);

        $this->parts[$partIndex]['modules'] = array_values(
            $this->parts[$partIndex]['modules']
        );
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'parts' => ['array'],
            'parts.*.title' => ['required', 'string', 'max:255'],
            'parts.*.modules' => ['array'],
            'parts.*.modules.*.title' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
            $book = TrainingBook::updateOrCreate(
                ['id' => $this->trainingBookId],
                ['title' => $validated['title']]
            );

            $this->trainingBookId = $book->id;

            // This form replaces the complete part/module structure each time it saves.
            foreach ($book->parts()->with('modules')->get() as $existingPart) {
                $existingPart->modules()->delete();
            }

            $book->parts()->delete();

            foreach ($validated['parts'] as $partIndex => $partData) {
                $part = TrainingBookPart::create([
                    'book_id' => $book->id,
                    'title' => $partData['title'],
                    'sort_order' => $partIndex,
                ]);

                foreach ($partData['modules'] as $moduleIndex => $moduleData) {
                    TrainingBookPartModule::create([
                        'book_part_id' => $part->id,
                        'title' => $moduleData['title'],
                        'sort_order' => $moduleIndex,
                    ]);
                }
            }
        });

        session()->flash('success', 'Training book saved successfully.');

        return redirect()->route('training.admin.books.dashboard');
    }

    public function render()
    {
        return view('Training.Admin.Books.livewire.book-form');
    }
}
