<?php

namespace App\Livewire\Warehouse\Reports;

use Livewire\Component;
use App\Models\Warehouse\MonthlyRecipients;

class MonthlyRecipientForm extends Component
{
    public $recipientId;
    public $first_name;
    public $last_name;
    public $email;

    public function mount($id = null)
    {
        if ($id) {
            $this->recipientId = $id;
            $this->loadRecipient();
        }
    }

    public function loadRecipient()
    {
        $recipient = MonthlyRecipients::find($this->recipientId);

        if ($recipient) {
            $this->first_name = $recipient->first_name;
            $this->last_name = $recipient->last_name;
            $this->email = $recipient->email;
        }
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:rrjva.org|max:255',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->recipientId) {
            $recipient = MonthlyRecipients::find($this->recipientId);
            session()->flash('create-edit-delete-message', 'Recipient updated successfully!');
        } else {
            // Create new recipient
            $recipient = new MonthlyRecipients;
            session()->flash('create-edit-delete-message', 'Recipient created successfully!');
        }

        $recipient->first_name = $this->first_name;
        $recipient->last_name = $this->last_name;
        $recipient->email = $this->email;

        $recipient->save();

        return redirect()->route('warehouse.warehouse-supervisor.reports.monthly.dashboard');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.form');
    }
}
