<?php

namespace App\Livewire\Camera;

use Livewire\Component;

// Required Models
use App\Models\Camera\CameraFutureIPAddress;

class CameraFutureIPSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'camera_number'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction
    public $confirmingDelete = false;
    public $deleteId;

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
        return view('Camera.livewire.camera-future-ip-search', [
            'suggestions' => CameraFutureIPAddress::where('camera_number', 'like', '%' . $this->search . '%')
                                            ->orWhere('future_ip_address', 'like', '%' . $this->search . '%')
                                            ->orWhere('is_used', 'like', '%' . $this->search . '%')
                                            ->orderBy($this->sortColumn, $this->sortDirection)
                                            ->get(),
        ]);
    }
}
