<?php

namespace App\Livewire\Policy\Builder;

use Livewire\Component;
use App\Models\Policy\Policy;

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
    public string $policy_cross_reference = '';
    public ?string $forms = null;
    public string $policy_effective_date = '';

    public array $policy_revision_dates = [];

    public string $policy_owner_signature = '';
    public string $policy_owner_date = '';
    public string $policy_reviewer_signature = '';
    public string $policy_reviewer_date = '';
    public string $superintendent_approval_signature = '';
    public string $superintendent_approval_date = '';

    public string $table_of_contents = '';
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

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'policy_statement' => 'required|string',
            'policy_purpose' => 'required|string',
            'policy_cross_reference' => 'required|string',
            'policy_effective_date' => 'required|date',

            'policy_revision_dates' => 'required|array',

            'policy_owner_signature' => 'required|string',
            'policy_owner_date' => 'required|date',

            'policy_reviewer_signature' => 'required|string',
            'policy_reviewer_date' => 'required|date',

            'superintendent_approval_signature' => 'required|string',
            'superintendent_approval_date' => 'required|date',

            'table_of_contents' => 'required|string',
            'references' => 'required|string',
            'definitions' => 'required|string',
        ]);

        Policy::create([
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

            'policy_owner_signature' => base64_decode($this->policy_owner_signature),
            'policy_owner_date' => $this->policy_owner_date,

            'policy_reviewer_signature' => base64_decode($this->policy_reviewer_signature),
            'policy_reviewer_date' => $this->policy_reviewer_date,

            'superintendent_approval_signature' => base64_decode($this->superintendent_approval_signature),
            'superintendent_approval_date' => $this->superintendent_approval_date,

            'table_of_contents' => $this->table_of_contents,
            'references' => $this->references,
            'definitions' => $this->definitions,
        ]);

        session()->flash('success', 'Policy saved successfully.');
    }

    public function render()
    {
        return view('Policy.Builder.livewire.policy-builder-form');
    }
}
