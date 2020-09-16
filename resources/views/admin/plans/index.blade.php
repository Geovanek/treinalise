@extends(\Section::get('layout'))

@section('page-css')
{{-- --}}
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
                            <a href="" class="btn btn-raised ripple btn-raised-secondary">
                                <i class="nav-icon i-Add"></i> 
                                Adicionar Plano
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body mb-4">
                        <div class="row justify-content-around">
                            @foreach ($plans as $plan)
                            <div class="col-md-6 col-lg-4 col-xl-3 m-0 p-0">
                                <div class="ul-pricing__table-2 ">
                                    <div class="ul-pricing__header">
                                        <div class="ul-pricing__image text-info m-0">
                                            <i class="i-Car-2"></i>
                                        </div>
                                        <div class="ul-pricing__main-number m-0"> 
                                            <h1 class="heading text-info t-font-boldest">R$ {{ number_format($plan->price, 2, ',', '.') }} </h1>
                                        </div>
                                        <div class="ul-pricing__month">
                                            <small class="text-purple-100">{{ $plan->price_description }}</small>
                                        </div>          
                                    </div>
                                    <div class="ul-pricing__title">
                                        <h2 class="heading text-info">{{ $plan->name}}</h2>
                                    </div>
                                    <div class="ul-pricing__table-listing mb-4">
                                        <ul>
                                            <li class="t-font-bolder">Disk Space 250gb</li>
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
                                    <a href="{{ route('plans.destroy', $plan->id) }}" class="btn btn-danger btn-rounded" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Excluir plano">
                                        <i class="nav-icon i-Close"></i>
                                    </a>

                                    <div class="row justify-content-around mt-4">
                                        <label class="switch switch-success mr-3">
                                            <span>Disponível no front?</span>
                                        <input type="checkbox" checked="{{ ($plan->active==1) ? 'checked' : 'false' }}">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>  
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('page-js')
{{-- --}}
@endsection