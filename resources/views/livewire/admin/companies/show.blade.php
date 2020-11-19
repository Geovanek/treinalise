<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="datables" class="table table-hover" style="border-collapse: collapse !important">
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-sm-block">Logo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">Treinadores</th>
                        <th scope="col">Atletas</th>
                        <th scope="col">Plano</th>
                        <th scope="col">Extensões</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td class="d-none d-sm-block">
                                <img class="rounded-circle m-0 avatar-sm-table" src="{{ asset('img/companies/logo/'.$company->logo) }}" alt="">
                            </td>
                            <td scope="row">{{ $company->name }}</td>
                            <td>
                                {{ $company->company_type == 'cpf' ? 'Pessoa Fìsica' : 'Pessoa Jurídica' }}
                            </td>
                            <td>{{ $company->user->name }}</td>
                            <td class="text-center">
                                <i class="nav-icon i-Business-ManWoman font-weight-bold"></i>
                                {{ $company->coaches->count() }}</td>
                            <td class="text-center">
                                <i class="nav-icon i-MaleFemale font-weight-bold"></i>
                                {{ $company->athletes->count() }}</td>
                            <td class="font-weight-bold">
                                <span class="badge badge-pill badge-outline-{{ $company->plan->state_color }} p-2 m-0">
                                    {{ $company->plan->name }}
                                </span>
                            </td>      
                            <td>
                                @foreach($company->extensions as $extension)
                                    <i class="nav-icon font-weight-bold text-22 {{ $extension->icon }} text-{{ $extension->state_color }}" data-toggle="tooltip" data-trigger="hover" data-original-title="{{ $extension->name }}" title="{{ $extension->name }}"></i>
                                @endforeach
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>