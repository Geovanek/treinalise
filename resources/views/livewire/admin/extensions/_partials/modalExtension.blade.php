<div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalExtension" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalExtension">
                    {{ ($modalMode == 'store') ? 'Adicionar Nova Extensão' : 'Editar Extensão' }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome da Extensão" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Preço:</label>
                        <input type="number" name="price" min="0" value="0" step=".01" class="form-control" id="price" wire:model="price" placeholder="Preço">
                        @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="icon">Ícone representativo:</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Ícone" wire:model="icon">
                        <small class="ul-form__text ">
                            <a href="{{ route('admin.icons') }}" target="_blank">CLique para escolher o ícone</a>
                        </small>
                        @error('icon') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="state_color">Cor de estilo do detalhe:</label>
                        <input type="text" class="form-control" name="state_color" id="state_color" placeholder="Cor de estilo" wire:model="state_color">
                        <small class="ul-form__text ">
                            Copiar o nome nos badges abaixo e colar no campo
                        </small>
                        @error('state_color') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group row justify-content-center">
                        <span class="badge badge-pill badge-primary p-2 m-1">primary</span>
                        <span class="badge badge-pill badge-secondary p-2 m-1">secondary</span>
                        <span class="badge badge-pill badge-success p-2 m-1">success</span>
                        <span class="badge badge-pill badge-danger p-2 m-1">danger</span>
                        <span class="badge badge-pill badge-warning p-2 m-1">warning</span>
                        <span class="badge badge-pill badge-info p-2 m-1">info</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="{{ $modalMode }}()" class="btn btn-primary">
                    {{ ($modalMode == 'store') ? 'Cadastrar' : 'Atualizar' }}
                </button>
            </div>
        </div>
    </div>
</div>