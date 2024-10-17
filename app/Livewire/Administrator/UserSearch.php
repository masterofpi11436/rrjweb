<?php

namespace App\Livewire\Administrator;

use Livewire\Component;

// Required Models
use App\Models\Login\User;
use Illuminate\Database\Eloquent\Builder;

class UserSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'last_name'; // Default sort column
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
        $users = User::with(['applications', 'roles'])
            ->where(function (Builder $query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        // Apply sorting for related Role and Application models
        if ($this->sortColumn === 'applications') {
            $users->join('user_application_role', 'users.id', '=', 'user_application_role.user_id')
                  ->join('applications', 'user_application_role.application_id', '=', 'applications.id')
                  ->orderBy('applications.name', $this->sortDirection);
        } elseif ($this->sortColumn === 'roles') {
            $users->join('user_application_role', 'users.id', '=', 'user_application_role.user_id')
                  ->join('roles', 'user_application_role.role_id', '=', 'roles.id')
                  ->orderBy('roles.name', $this->sortDirection);
        } else {
            $users->orderBy($this->sortColumn, $this->sortDirection);
        }

        return view('Administrator.livewire.user-search', [
            'suggestions' => $users->get(),
        ]);
    }
}
