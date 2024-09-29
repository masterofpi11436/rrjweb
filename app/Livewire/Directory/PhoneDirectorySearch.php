<?php

namespace App\Livewire\Directory;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Directory\PhoneDirectory;

class PhoneDirectorySearch extends Component
{
    public $search = ''; // Search term

    public function render()
    {
        // Search for matching records
        return view('Directory.livewire.phone-directory-search', [
            'suggestions' => PhoneDirectory::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('title', 'like', '%' . $this->search . '%')
                                ->orWhere('section', 'like', '%' . $this->search . '%')
                                ->orWhere('extension', 'like', '%' . $this->search . '%')
                                ->orderBy('section')
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
