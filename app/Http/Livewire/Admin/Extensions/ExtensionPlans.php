<?php

namespace App\Http\Livewire\Admin\Extensions;

use App\Models\Extension;
use Livewire\Component;

class ExtensionPlans extends Component
{
    public $extension, $plans;

    public function mount()
    {
        $this->extension = Extension::where('slug', request()->slug)->first();
        session()->put('extension.name', $this->extension->name);
    }

    public function render()
    {
        $this->plans = $this->extension->plans()->get();
        return view('livewire.admin.extensions.extensionPlans');
    }
}
