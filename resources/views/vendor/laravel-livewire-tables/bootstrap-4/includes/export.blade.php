@if (count($exports))
    <div class="input-group-append">
        <button class="input-group-text dropdown-toggle {{ $this->getOption('bootstrap.classes.buttons.export') }}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('laravel-livewire-tables::strings.export') &nbsp; &nbsp; &nbsp;
        </button>

        <div class="dropdown-menu" x-placement="bottom-start">
            @if (in_array('csv', $exports, true))
                <a class="dropdown-item" href="#" wire:click.prevent="export('csv')">CSV</a>
            @endif

            @if (in_array('xls', $exports, true))
                <a class="dropdown-item" href="#" wire:click.prevent="export('xls')">XLS</a>
            @endif

            @if (in_array('xlsx', $exports, true))
                <a class="dropdown-item" href="#" wire:click.prevent="export('xlsx')">XLSX</a>
            @endif

            @if (in_array('pdf', $exports, true))
                <a class="dropdown-item" href="#" wire:click.prevent="export('pdf')">PDF</a>
            @endif
        </div>
    </div><!--export-dropdown-->
@endif
