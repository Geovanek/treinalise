<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Component;

class ProfileCoaches extends Component
{
    public $company;

    public function mount($id)
    {
        $this->company = Company::with('coaches.users')->find($id);
    }

    public function render()
    {
        return view('livewire.admin.companies.profileCoaches');
    }
}
