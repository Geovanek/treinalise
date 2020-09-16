@extends(\Section::get('layout'))

@section('page-css')
{{-- --}}
@endsection

@section('content')
    <div class="breadcrumb">
        <h1>Editar Plano: {{ $plan->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('plans.index') }}">Planos</a></li>
            <li>Editar Plano</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="2-columns-form-layout">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card ul-card__margin-25">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Nome do plano:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="name" placeholder="Nome do plano" value="{{ $plan->name ?? old('name') }}">
                                    </div>

                                    <label for="price" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Preço:</label>
                                    <div class="col-lg-3">
                                        <div class="input-right-icon">
                                            <input type="text" class="form-control" id="price" placeholder="Preço" value="{{ $plan->price ?? old('price') }}">
                                            <span class="span-right-input-icon">
                                                <i class="ul-form__icon i-Dollar-Sign"></i>
                                            </span>
                                        </div>
                                        <small class="ul-form__text ">
                                            Utilizar formato decimal com ponto (0.00)
                                        </small>
                                    </div>
                                </div>

                                <div class="custom-separator"></div>

                                <div class="form-group row">
                                    <label for="price_details" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Detalhes do preço:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="price_details" placeholder="Detalhes do preço" value="{{ $plan->price_details ?? old('price_details') }}">
                                        <small class="ul-form__text form-text ">
                                            Ex: reais/mês + R$99,00 taxa de adesão
                                        </small>
                                    </div>

                                    <label for="description" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Descrição:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="description" placeholder="Descrição" value="{{ $plan->description ?? old('description') }}">
                                        <small class="ul-form__text form-text ">
                                            Descrição simples do plano
                                        </small>
                                    </div>
                                </div>

                                <div class="custom-separator"></div>
                                
                                <div class="form-group row">
                                    <label for="icon" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Ícone representativo:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="icon" placeholder="Nome do plano" value="{{ $plan->icon ?? old('icon') }}">
                                        <small class="ul-form__text ">
                                            <a href="{{ route('admin.icons') }}" target="_blank">CLique para escolher o ícone</a>
                                        </small>
                                    </div>

                                    <label for="state_color" class="ul-form__label ul-form--margin col-lg-2 col-form-label ">Cor de estilo do plano:</label>
                                    <div class="col-lg-3">
                                        <div class="input-right-icon">
                                            <input type="text" class="form-control" id="state_color" placeholder="Cor do plano" value="{{ $plan->state_color ?? old('state_color') }}">
                                            <span class="span-right-input-icon">
                                                <i class="ul-form__icon i-CMYK"></i>
                                            </span>
                                        </div>
                                        <small class="ul-form__text ">
                                            Copiar o nome nos badges abaixo e colar no campo
                                        </small>
                                    </div>
                                </div>

                                <div class="custom-separator"></div>
                                
                                <div class="form-group row justify-content-center">
                                    <span class="badge badge-pill badge-primary p-2 m-1">primary</span>
                                    <span class="badge badge-pill badge-secondary p-2 m-1">secondary</span>
                                    <span class="badge badge-pill badge-success p-2 m-1">success</span>
                                    <span class="badge badge-pill badge-danger p-2 m-1">danger</span>
                                    <span class="badge badge-pill badge-warning p-2 m-1">warning</span>
                                    <span class="badge badge-pill badge-info p-2 m-1">info</span>
                                    <span class="badge badge-pill badge-light p-2 m-1">light</span>
                                    <span class="badge badge-pill badge-dark p-2 m-1">dark</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="mc-footer">
                                    <div class="row text-right">
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-primary m-1">Salvar</button>
                                            <a href="{{ route('plans.index') }}" class="btn btn-outline-secondary m-1">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end of main row -->
        </div>
    </div>


@endsection


@section('page-js')
{{-- --}}
@endsection