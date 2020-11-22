<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
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

    protected $options = [
        // The class set on the table when using bootstrap
        'bootstrap.classes.table' => 'table table-hover',

        // Aditional style on the table when using bootstrap
        'bootstrap.styles.table' => 'border-collapse: collapse !important',
    
        // The class set on the table's thead when using bootstrap
        'bootstrap.classes.thead' => null,
    
        // The class set on the table's export dropdown button
        'bootstrap.classes.buttons.export' => 'btn',
        
        // Whether or not the table is wrapped in a `.container-fluid` or not
        'bootstrap.container' => true,
        
        // Whether or not the table is wrapped in a `.table-responsive` or not
        'bootstrap.responsive' => true,
    ];

    public function query() : Builder
    {
        return Company::with(['user', 'coaches', 'athletes', 'plan', 'extensions']);
    }

    public function columns() : array
    {
        return [
            Column::make('Logo', 'logo')
                ->format(function(Company $company) {
                    return $this->html('<img class="rounded-circle m-0 avatar-sm-table" src="img/companies/logo/'. $company->logo .'" alt="">');
                }),
            Column::make('Nome', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Tipo', 'company_type')
                ->searchable()
                ->sortable()
                ->format(function(Company $company) {
                    return $this->html($company->company_type == 'cpf' ? 'Pessoa Fìsica' : 'Pessoa Jurídica');
                }),
        ];
    }

    /* public function mount()
    {
        $this->companies = Company::with(['user', 'coaches', 'athletes', 'plan', 'extensions'])->get();
    }

    public function render()
    {
        return view('livewire.admin.companies.show');
    } */
}
