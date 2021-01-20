@foreach ($company->extensions as $extension)
    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
        <div class="card">
            <div class="card-body">
                <div class="ul-product-detail__border-box">
                    <div class="ul-product-detail--icon mb-2">
                        <i class="{{ $extension->icon }} text-{{ $extension->state_color }} text-25 font-weight-500 "></i>
                    </div>
                    <h5 class="heading">{{ $extension->name }}</h5>
                </div>
            </div>
        </div>
    </div>
@endforeach