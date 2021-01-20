<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Athlete;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProfileAthletes extends TableComponent
{
    use HtmlComponents;

    public $companyId;

    //public $sortField = 'name';
    public $sortDefaultIcon = '<i class="text-muted i-Up---Down"></i>';
    public $ascSortIcon = '<i class="text-muted i-Up1"></i>';
    public $descSortIcon = '<i class="text-muted i-Down1"></i>';
    public $perPage = 15;
    public $perPageOptions = [15, 30, 50, 100, 250];
    public $clearSearchButton = true;
    public $exportFileName = 'Atletas da Empresa';
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

    public function mount($id)
    {
        $this->companyId = $id;
    }

    public function setTableHeadClass($attribute): ?string
    {
        switch ($attribute) {
            case 'avatar':
            case 'users.name';
            case 'coach.users.name';
            case 'actions';
                return 'd-table-cell';
            default:
                return null;
        }
    }

    public function setTableDataClass($attribute, $value): ?string
    {
        switch ($attribute) {
            case 'avatar':
            case 'users.name';
            case 'coach.users.name';
            case 'actions';
                return 'd-table-cell';
            default:
                return null;
        }
    }

    public function query() : Builder
    {
        return Athlete::with(['coach.users:id,name', 'users:id,name'])->where('company_id', $this->companyId);
    }

    public function columns() : array
    {
        return [
            Column::make('Avatar', 'avatar')
                ->format(function(Athlete $model) {
                    return $this->html('<img class="rounded-circle m-0 avatar-sm-table" src="'. asset("images/users/{$model->user->id}/{$model->user->avatar}") .'" alt="avatar">');
                })
                ->excludeFromExport(),
            Column::make('Nome', 'users.name')
                ->searchable()
                ->sortable(function ($builder, $direction) {
                   return $builder->join('userables', 'userables.userable_id', '=', 'athletes.id')
                                ->join('users', 'users.id', '=', 'userables.user_id')
                                ->where('userables.userable_type', '=', Athlete::class)
                                ->orderBy('users.name', $direction);
                })
                ->format(function(Athlete $model) {
                    return $this->html($model->user->name);
                }),
            Column::make('Treinador', 'coach.users.name')
                ->searchable()
                ->sortable()
                ->format(function(Athlete $model) {
                    return $this->html($model->coach->user->name);
                }),
                Column::make('Ações', 'actions')
                ->format(function(Athlete $model) {
                    return $this->html(
                        '<a href="'. route('athletes.profile', ['uuid' => $model->uuid]) .'" class="btn btn-outline-info btn-icon m-0 m-0" data-toggle="tooltip" data-trigger="hover" data-original-title="Ver atleta" title="Ver atleta" target="_blank">
                            <i class="nav-icon fas fa-eye font-weight-bold"></i>
                        </a>
                        <a href="#" wire:click.prevent="showConfirmation('. $model->uuid .')" class="btn btn-outline-danger btn-icon m-0 m-0 alert-confirm" data-toggle="tooltip" data-trigger="hover" data-original-title="Desvincular atleta da empresa" title="Desvincular atleta da empresa">
                            <i class="nav-icon fas fa-user-times font-weight-bold"></i>
                        </a>'
                    );
                })
                ->excludeFromExport(),
        ];
    }
}
