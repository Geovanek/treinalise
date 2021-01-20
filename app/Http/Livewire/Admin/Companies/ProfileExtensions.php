<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Component;

class ProfileExtensions extends Component
{
    public $company;

    public function mount($id)
    {
        $this->company = Company::with('extensions')->find($id);
    }

    public function render()
    {
        return view('livewire.admin.companies.profileExtensions');
    }
}
