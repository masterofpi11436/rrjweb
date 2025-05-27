<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;

// Required Models
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionTimeLogForm extends Component
{
    public $jurisdictions;
    public $logId;

    public $jurisdiction_id;
    public $date_of_visit;
    public $arrival_time;
    public $departure_time;
    public $booking_start;
    public $booking_end;
    public $magistrate_start;
    public $magistrate_end;
    public $nurse_start;
    public $nurse_end;
    public $inmate_count;
    public $did_not_get_committed = false;
    public $note;

    protected $rules = [
        'jurisdiction_id' => 'required|exists:jurisdictions,id',
        'date_of_visit' => 'required|date',
        'arrival_time' => 'required',
        'departure_time' => 'required',
        'booking_start' => 'nullable',
        'booking_end' => 'nullable',
        'magistrate_start' => 'nullable',
        'magistrate_end' => 'nullable',
        'nurse_start' => 'nullable',
        'nurse_end' => 'nullable',
        'inmate_count' => 'integer|nullable',
        'did_not_get_committed' => 'boolean',
        'note' => 'nullable|string',
    ];

    public function mount($id = null)
    {
        $this->jurisdictions = Jurisdiction::orderBy('name')->get();

        if ($id) {
            $log = JurisdictionTimeLog::findOrFail($id);
            $this->logId = $log->id;
            $this->fill($log->toArray());
            $this->did_not_get_committed = (bool) $log->did_not_get_committed;
        }
    }

    public function submitForm()
    {
        $data = $this->validate();

        if ($this->logId) {
            JurisdictionTimeLog::findOrFail($this->logId)->update($data);
            session()->flash('create-edit-delete-message', 'Time log updated successfully.');
        } else {
            JurisdictionTimeLog::create($data);
            session()->flash('create-edit-delete-message', 'Time log created successfully.');
        }

        return redirect()->route('jurisdiction.time-logs');
    }

    public function render()
    {
        return view('Jurisdiction.livewire.jurisdiction-time-log-form');
    }
}
