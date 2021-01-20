<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Show extends TableComponent
{
    use HtmlComponents;

    public $sortField = 'name';
    public $sortDefaultIcon = '<i class="text-muted i-Up---Down"></i>';
    public $ascSortIcon = '<i class="text-muted i-Up1"></i>';
    public $descSortIcon = '<i class="text-muted i-Down1"></i>';
    public $perPage = 15;
    public $perPageOptions = [15, 30, 50, 100, 250];
    public $clearSearchButton = true;
    public $exportFileName = 'companies';
    public $exports = ['csv', 'xls', 'xlsx', 'pdf'];

    protected $options = [
        // The class set on the table when using bootstrap
        'bootstrap.classes.table' => 'table table-hover',
        // Aditional style on the table when using bootstrap
        'bootstrap.styles.table' => 'border-collapse: collapse !important',
        // The class set on the table's thead when using bootstrap
        'bootstrap.classes.thead' => null,
        // The class set on the table's export dropdown button
        'bootstrap.classes.buttons.export' => '', 
        // Whether or not the table is wrapped in a `.container-fluid` or not
        'bootstrap.container' => true,    
        // Whether or not the table is wrapped in a `.table-responsive` or not
        'bootstrap.responsive' => true,
    ];

    public function setTableHeadClass($attribute): ?string
    {
        switch ($attribute) {
            case 'logo':
            case 'subscription';
                return 'd-none d-md-table-cell';
            case 'company_type':
            case 'coaches':
            case 'athletes':
                return 'text-center d-none d-md-table-cell';
            case 'plan.name':
                return 'text-center d-table-cell';
            case 'extensions':
            case 'active':
                return 'text-center d-table-cell';
            case 'name':
            case 'user.name':
                return 'd-table-cell';
            default:
                return null;
        }
    }

    public function setTableDataClass($attribute, $value): ?string
    {
        switch ($attribute) {
            case 'logo':
            case 'subscription';
                return 'd-none d-md-table-cell';
            case 'company_type':
            case 'coaches':
            case 'athletes':
                return 'text-center d-none d-md-table-cell';
            case 'plan.name':
                return 'text-center d-table-cell';
            case 'extensions':
            case 'active':
                return 'text-center d-table-cell';
            case 'name':
            case 'user.name':
                return 'd-table-cell';
            default:
                return null;
        }
    }

    public function query() : Builder
    {
        return Company::with(['user', 'coaches', 'athletes', 'plan', 'extensions']);
    }

    public function columns() : array
    {
        return [
            Column::make('Logo', 'logo')
                ->format(function(Company $model) {
                    return $this->html('<img class="rounded-circle m-0 avatar-sm-table" src="'. asset("images/companies/{$model->uuid}/{$model->logo}") .'" alt="logo">');
                })
                ->excludeFromExport(),
            Column::make('Nome', 'name')
                ->searchable()
                ->sortable()
                ->format(function(Company $model) {
                    return $this->linkRoute('companies.profile', $model->name, ['slug' => $model->slug]);
                }),
            Column::make('Tipo', 'company_type')
                ->searchable()
                ->sortable()
                ->format(function(Company $model) {
                    return $this->html(($model->company_type == 'cpf' ? 'Pessoa Física' : 'Pessoa Jurídica'));
                }),
            Column::make('Responsável', 'user.name')
                ->searchable()
                ->format(function(Company $model) {
                    return $this->linkRoute('users.profile', $model->user->name, ['id' => $model->user->id]);
                }),
            Column::make('Treinadores', 'coaches')
                ->format(function(Company $model) {
                    return $this->html('<i class="nav-icon fas fa-user-tie"></i> '. $model->coaches->count());
                }),
            Column::make('Atletas', 'athletes')
                ->format(function(Company $model) {
                    return $this->html('<i class="nav-icon fas fa-user"></i> '. $model->athletes->count());
                }),
            Column::make('Plano', 'plan.name')
                ->searchable()
                ->format(function(Company $model) {
                    return $this->html('<span class="badge badge-pill badge-outline-'. $model->plan->state_color .' p-2 m-0">'. $model->plan->name .'</span>');
                }),
            Column::make('Extensões', 'extensions')
                ->format(function(Company $model) {
                    $dataExtension = '';
                    foreach($model->extensions as $extension) {
                        $dataExtension .= '<i class="nav-icon text-22 '. $extension->icon .' text-'. $extension->state_color .'" data-toggle="tooltip" data-trigger="hover" data-original-title="'. $extension->name .'" title="'. $extension->name .'"></i> ';
                    };
                    return $this->html($dataExtension);
                })
                ->exportFormat(function(Company $model) {
                    $dataExtensions = '';
                    foreach($model->extensions as $extension) {
                        $dataExtensions = $dataExtensions .','. $extension->name;
                    }
                    return $dataExtensions;
                }),
            Column::make('Status', 'active')
                ->sortable()
                ->format(function(Company $model) {
                    if ($model->active == 'Y') {
                        $status = '<i class="nav-icon text-22 i-Yes text-success" data-toggle="tooltip" data-trigger="hover" data-original-title="Assinatura Ativa" title="Assinatura Ativa"></i>';
                    } else if ($model->active == 'N') {
                        $status = '<i class="nav-icon text-22 i-Close text-danger" data-toggle="tooltip" data-trigger="hover" data-original-title="Empresa Inativada" title="Empresa Inativada"></i>';
                    }

                    return $this->html($status);
                })
                ->exportFormat(function(Company $model) {
                    return $model->active;
                }),
            Column::make('Subscrição', 'subscription')
                ->searchable()
                ->sortable()
                ->format(function(Company $model) {
                    return $this->html(Carbon::parse($model->subscription)->format('d-m-Y'));
                }),
        ];
    }
}
