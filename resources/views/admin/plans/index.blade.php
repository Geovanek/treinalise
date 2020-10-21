@extends(\Section::get('layout'))

@section('title', "Planos")

@section('page-css')
    <link rel="stylesheet" href="{{asset('gull/assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('gull/assets/styles/vendor/toastr.css')}}">
@endsection

@section('content')
    <div class="breadcrumb">
        <h1>Planos</h1>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li>Planos</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <section class="ul-pricing-table">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="w-50 float-left card-title m-0">Planos</h3>
                        <div class="dropdown dropleft text-right w-50 float-right">
                            <a href="{{ route('plans.create') }}" class="btn btn-raised ripple btn-raised-secondary">
                                <i class="nav-icon i-Add"></i> 
                                Adicionar Plano
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body mb-4">
                        <div class="row justify-content-around">
                            @foreach ($plans as $index => $plan)
                            <div class="col-md-6 col-lg-4 col-xl-3 m-0 p-0">
                                <div class="ul-pricing__table-2 ">
                                    <div class="ul-pricing__header">
                                        <div class="ul-pricing__image text-{{ $plan->state_color }} m-0 pt-1">
                                            <i class="{{ $plan->icon }}"></i>
                                        </div>
                                        <div class="ul-pricing__main-number m-0"> 
                                            <h1 class="heading text-{{ $plan->state_color }} t-font-boldest">R$ {{ number_format($plan->price, 2, ',', '.') }} </h1>
                                        </div>
                                        <div class="ul-pricing__month">
                                            <small class="text-purple-100">{{ $plan->price_details }}</small>
                                        </div>          
                                    </div>
                                    <div class="ul-pricing__title">
                                        <h2 class="heading text-{{ $plan->state_color }}">{{ $plan->name}}</h2>
                                    </div>
                                    <div class="ul-pricing__text text-mute">{{ $plan->description }}</div>
                                    <div class="ul-pricing__table-listing mb-4">
                                        <ul>
                                            <li class="t-font-bolder">Bandwidth 250gb</li>
                                            <li class="t-font-bolder">Databases</li>
                                            <li class="text-mute">E-mail accounts NO</li>
                                            <li class="text-mute">24h support NO</li>
                                            <li class="text-mute">E-mail support NO</li>
                                        </ul>
                                    </div>

                                    <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-success btn-rounded" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Editar plano">
                                        <i class="nav-icon i-Pen-4"></i>
                                    </a>
                                    <a href="" class="btn btn-info btn-rounded" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detalhes do plano">
                                        <i class="nav-icon i-ID-Card"></i>
                                    </a>
                                    <a href="" class="btn btn-primary btn-rounded" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Empresas vinculadas ao plano">
                                        <i class="nav-icon i-Shop"></i>
                                    </a>
                                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded alert-confirm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excluir plano">
                                            <i class="nav-icon i-Close"></i>
                                        </button>
                                    </form>

                                    <div class="row justify-content-around mt-4">
                                        @livewire('admin.plans.active', ['plan' => $plan], key($plan->id))
                                    </div>
                                </div>  
                            </div>
                            @endforeach
                            <div class='loadscreen' wire:loading>
                                <div class="loader spinner-bubble spinner-bubble-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('page-js')
    <script src="{{asset('gull/assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('gull/assets/js/sweetalert.script.js')}}"></script>
    @include('admin.includes.toastr')
    
@endsection

@section('livewire-js')
    <script src="{{asset('js/livewireToastr.js')}}"></script>
@endsection