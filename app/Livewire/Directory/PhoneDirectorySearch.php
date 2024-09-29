<?php

namespace App\Livewire\Directory;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Directory\PhoneDirectory;

class PhoneDirectorySearch extends Component
{
    public $search = ''; // Search term
    public $sortColumn = 'section'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            // If the column is already being sorted, reverse the direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Otherwise, set the new column and reset direction to ascending
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // Search for matching records
        return view('Directory.livewire.phone-directory-search', [
            'suggestions' => PhoneDirectory::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('title', 'like', '%' . $this->search . '%')
                                ->orWhere('section', 'like', '%' . $this->search . '%')
                                ->orWhere('extension', 'like', '%' . $this->search . '%')
                                ->orderBy($this->sortColumn, $this->sortDirection)
                                ->get(),
        ]);
    }

        // Method to delete a record
    public function delete($id)
    {
        $phoneDirectory = PhoneDirectory::findOrFail($id);
        $phoneDirectory->delete();

        session()->flash('message', 'Record deleted successfully!');
    }
}
