<div>
    <div class="card">
        <div class="card-header">
            <h3 class="w-50 float-left card-title m-0">
                Empresas utilizando a extensão {{ $extension->name }}
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datables" class="table table-hover" style="border-collapse: collapse !important">
                    <thead>
                        <tr>
                            <th scope="col" style="width:10px">#</th>
                            <th scope="col" class="d-none d-sm-block">Logo</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Via plano?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($extension->plans as $plan)
                            @foreach($plan->companies as $company)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td class="d-none d-sm-block">
                                    <img class="rounded-circle m-0 avatar-sm-table" src="{{ asset('img/companies/logo/'.$company->logo) }}" alt="">
                                </td>
                                <td>{{ $company->name }}</td>
                                <td class="font-weight-bold">
                                    <span class="badge badge-pill badge-outline-{{ $plan->state_color }} p-2 m-0">
                                        {{ $plan->name }}
                                    </span>
                                </td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach
                        @endforeach
                        @foreach($extension->companies as $company)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td class="d-none d-sm-block">
                                    <img class="rounded-circle m-0 avatar-sm-table" src="{{ asset('img/companies/logo/'.$company->logo) }}" alt="">
                                </td>
                                <td>{{ $company->name }}</td>
                                <td> - </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
