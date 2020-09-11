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
                    <div class="card-header bg-transparent">
                        <h5>Planos</h5>
                    </div>
                    <div class="card-body mb-4">
                        <div class="row">

                            <div class="col-lg-3 col-xl-3 m-0 p-0">
                                <div class="ul-pricing__table-2 ">
                                    <div class="ul-pricing__header">
                                        <div class="ul-pricing__image text-info m-0">
                                            <i class="i-Car-2"></i>
                                        </div>
                                        <div class="ul-pricing__main-number m-0"> 
                                            <h1 class="heading text-info t-font-boldest">$0.00 </h1>
                                        </div>
                                        <div class="ul-pricing__month">
                                            <small class="text-purple-100">per month</small>
                                        </div>          
                                    </div>
                                    <div class="ul-pricing__title">
                                        <h2 class="heading text-info">Free</h2>
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

                                    <button type="button" class="btn btn-lg btn-info btn-rounded m-1">Purchase</button>
                                </div>  
                            </div>
                                
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