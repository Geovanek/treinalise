<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Component;

class Show extends Component
{
    public $companies;

    public function mount()
    {
        $this->companies = Company::with(['user', 'coaches', 'athletes', 'plan', 'extensions'])->get();
    }

    public function render()
    {
        return view('livewire.admin.companies.show');
    }
}
