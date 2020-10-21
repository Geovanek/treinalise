<div>
    @include('livewire.admin.extensions._partials.modalExtension')

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="w-50 float-left card-title m-0">Extensões</h3>
            <div class="dropdown dropleft text-right w-50 float-right">
                <button type="button" wire:click.prevent="action('create')" class="btn btn-raised ripple btn-raised-secondary" data-toggle="modal" data-target="#modal">
                    <i class="nav-icon i-Add"></i>
                    Adicionar Nova Extensão
                </button>
            </div>
        </div>
    </div>
    <section class="ul-widget-stat-s1">
        <div class="row">
            @foreach($extensions as $extension)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-icon-bg card-icon-bg-{{ $extension->state_color }} o-hidden">
                        <div class="card-body text-center">
                            <i class="{{ $extension->icon }}"></i>
                            <div class="content" style="max-width: 100%">
                                <p class="text-muted text-16 t-font-boldest mt-2 mb-0">{{ $extension->name }}</p>
                                <p class="text-primary text-24 line-height-1 mb-2">R${{ $extension->price }}</p>
                                <small class="text-muted">por mês</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($extension->details as $detail)
                        <div class="ul-widget-notification">
                            <div class="ul-widget-notification-item-div">
                                <a href="#" class="ul-widget-notification-item">
                                    <div class="ul-widget-notification-item-icon text-{{ $detail->state_color}}">
                                        <i class="{{ $detail->icon }}"></i>
                                    </div>
                                    <div class="ul-widget-notification-item-details">
                                        <div class="ul-widget-notification-item-title">
                                            {{ $detail->name }}
                                        </div>
                                        <div class="ul-widget-notification-item-time">
                                            {{ $detail->description }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="t-font-bolder">Empresas Vinculadas</h5>
                            </div>
                            <div class="col-5 text-right">
                                <h3 class="t-font-boldest">120</h3>
                            </div>
                            <div class="col-12">
                                <div class="progress mt-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> 20%</div>
                                </div>
                            </div>
                        </div>
                        <div class="user-profile mb-3 mt-4">
                            <div class="ul-widget-app__profile-footer">
                                <div class="ul-widget-app__profile-footer-font" data-toggle="tooltip" data-trigger="hover" data-original-title="Editar" title="Editar">
                                    <a href="#" wire:click="action('update', '{{ $extension->uuid }}')" data-toggle="modal" data-target="#modal">
                                        <i class="i-Edit text-20 text-success font-weight-600 mr-1"></i>
                                    </a>
                                </div>
                                <div class="ul-widget-app__profile-footer-font" data-toggle="tooltip" data-trigger="hover" data-original-title="Detalhes" title="Detalhes">
                                    <a href="{{ route('extensions.details', $extension->url) }}">
                                        <i class="i-Check text-20 text-warning font-weight-600 mr-1"></i>
                                    </a>
                                </div>
                                <div class="ul-widget-app__profile-footer-font" data-toggle="tooltip" data-trigger="hover" data-original-title="Planos Vinculados" title="Planos Vinculados">
                                    <a href="#">
                                        <i class="i-Billing text-20 text-info font-weight-600 mr-1"></i>
                                    </a>
                                </div>
                                <div class="ul-widget-app__profile-footer-font" data-toggle="tooltip" data-trigger="hover" data-original-title="Excluir Extensão" title="Excluir Extensão">
                                    <a href="#" wire:click.prevent="showConfirmation('{{ $extension->uuid }}')">
                                        <i class="i-Close-Window text-20 text-danger font-weight-600 mr-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" wire:click="activating('{{ $extension->uuid }}', {{ $extension->active }})" class="btn {{ $extension->active ? 'btn-primary' : 'btn-outline-primary' }} btn-block m-1">
                                {{ $extension->active ? 'Ativada' : 'Desativada' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
