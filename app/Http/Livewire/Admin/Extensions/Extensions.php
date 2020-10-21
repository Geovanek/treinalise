<?php

namespace App\Http\Livewire\Admin\Extensions;

use Livewire\Component;
use App\Models\Extension;

class Extensions extends Component
{
    public $extensions, $name, $url, $price, $icon, $state_color, $active, $uuid;
    public $modalMode;

    protected $listeners = ['destroy'];

    protected $rules = [
        'name' => "required|min:3|max:255|unique:extensions,name",
        'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
    ];

    protected $messages = [
        'price.required' => 'Preço é obrigatório',
    ];

    public function render()
    {
        $this->extensions = Extension::all();
        return view('livewire.admin.extensions.extensions');
    }

    public function store()
    {
        $validate = $this->validate();

        Extension::create($validate);

        $this->emit('message', [
            'type' => 'success', 
            'message' => 'Extensão criada.'
        ]);

        $this->resetInputFields();

        $this->emit('closeModalStoreUpdate'); // Close model to using to jquery
    }

    public function action($modalMode, $uuid = null)
    {
        if ($modalMode == 'create') {
            $this->modalMode = 'store';
        }
        if ($modalMode == 'update') {
            $extension = Extension::where('uuid',$uuid)->first();
            $this->uuid = $uuid;
            $this->name = $extension->name;
            $this->price = $extension->price;
            $this->icon = $extension->icon;
            $this->state_color = $extension->state_color;
            $this->active = $extension->active;
            $this->modalMode = 'update';
        }
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => "required|min:3|max:255|unique:extensions,name,{$this->uuid},uuid",
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ]);

        if ($this->uuid) {
            $extension = Extension::where('uuid',$this->uuid)->first();
 
            $extension->update($validate);

            $this->emit('message', [
                'type' => 'success', 
                'message' => 'Extensão atualizada.'
            ]);

            $this->resetInputFields();

            $this->emit('closeModalStoreUpdate'); // Close model to using to jquery
        } else {
            $this->emit('message', [
                'type' => 'warning', 
                'message' => 'Não foi possível executar a tarefa. Tente novamente ou contate o administrador.'
            ]);
        }
    }

    public function destroy($key)
    {
        $extension = Extension::where('uuid', $key)->first();

        if ($extension) {
            $extension->delete();

            $this->emit('message', [
                'type' => 'success', 
                'message' => 'Extensão deletada.'
            ]);
        } else {
            $this->emit('message', [
                'type' => 'warning', 
                'message' => 'Não foi possível executar a tarefa. Tente novamente ou contate o administrador.'
            ]);
        }
    }

    public function activating($uuid, $active)
    {
        
        $this->validate([
            'active' => 'required|boolean',
        ]);

        $this->active = ($active === 0) ? 1 : 0;
        $message = ($active === 0) ? 'Extensão ativada.' : 'Extensão desativada.';

        $extension = Extension::where('uuid', $uuid)->first();

        if ($extension) {
            $extension->update(['active' => $this->active]);

            $this->emit('message', [
                'type' => 'success', 
                'message' => $message
            ]);
        } else {
            $this->emit('message', [
                'type' => 'warning', 
                'message' => 'Não foi possível executar a tarefa. Tente novamente ou contate o administrador.'
            ]);
        }
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    private function resetInputFields(){
        $this->reset([
            'name', 'price', 'icon', 'state_color'
        ]);
    }

    public function showConfirmation($uuid)
    { 
        $this->dispatchBrowserEvent('swalConfirm', ['key' => $uuid]);
    }
}
