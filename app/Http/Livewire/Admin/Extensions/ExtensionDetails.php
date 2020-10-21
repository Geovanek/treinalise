<?php

namespace App\Http\Livewire\Admin\Extensions;

use Livewire\Component;
use App\Models\Extension;
use App\Models\ExtensionDetail;

class ExtensionDetails extends Component
{
    public $extension, $details, $detail_id, $name, $description, $icon, $state_color;
    public $modalMode;

    protected $listeners = ['destroy'];

    protected $rules = [
        'name' => "required|min:3|max:20|unique:extension_details,name",
        'description' => "min:3|max:100",
    ];

    public function mount()
    {
        $this->extension = Extension::where('url', request()->url)->first();
        session()->put('extension.name', $this->extension->name);
    }

    public function render()
    {
        $this->details = $this->extension->details()->get();
        return view('livewire.admin.extensions.extensionDetails');
    }

    public function store()
    {
        $validate = $this->validate();

        $this->extension->details()->create($validate);

        $this->emit('message', [
            'type' => 'success', 
            'message' => 'Detalhe adicionado a extensão.'
        ]);

        $this->resetInputFields();

        $this->emit('closeModalStoreUpdate');
    }

    public function action($modalMode, $detail_id = null)
    {
        if ($modalMode == 'create') {
            $this->modalMode = 'store';
        }
        if ($modalMode == 'update') {
            $detail = ExtensionDetail::where('id',$detail_id)->first();
            $this->detail_id = $detail_id;
            $this->name = $detail->name;
            $this->description = $detail->description;
            $this->icon = $detail->icon;
            $this->state_color = $detail->state_color;
            $this->modalMode = 'update';
        }
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => "required|min:3|max:20|unique:extension_details,name,{$this->detail_id},id",
            'description' => "min:3|max:100",
        ]);

        if ($this->detail_id) {
            $detail = ExtensionDetail::find($this->detail_id);
 
            $detail->update($validate);

            $this->emit('message', [
                'type' => 'success', 
                'message' => 'Detalhe atualizada.'
            ]);

            $this->resetInputFields();

            $this->emit('closeModalStoreUpdate');
        } else {
            $this->emit('message', [
                'type' => 'warning', 
                'message' => 'Não foi possível executar a tarefa. Tente novamente ou contate o administrador.'
            ]);
        }
    }

    public function destroy($key)
    {
        $detail = ExtensionDetail::where('id', $key)->first();

        if ($detail) {
            $detail->delete();

            $this->emit('message', [
                'type' => 'success', 
                'message' => 'Detalhe deletado.'
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
            'name', 'description', 'icon', 'state_color'
        ]);
        $this->resetErrorBag();
    }

    public function showConfirmation($id)
    { 
        $this->dispatchBrowserEvent('swalConfirm', ['key' => $id]);
    }
}
