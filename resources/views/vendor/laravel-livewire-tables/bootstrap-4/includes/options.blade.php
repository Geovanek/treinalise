@if ($paginationEnabled || $searchEnabled)
    <div class="row mb-4">
        @if ($paginationEnabled && count($perPageOptions))
            <div class="col-4 form-inline">
                <select wire:model="perPage" class="form-control">
                    @foreach ($perPageOptions as $option)
                        <option>{{ $option }}</option>
                    @endforeach
                </select>
                &nbsp; @lang('laravel-livewire-tables::strings.per_page')
            </div><!--col-->
        @endif
        
        <div class="col-3">
            @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.loading')
        </div>

        @if ($searchEnabled)
            <div class="col-5">
                @if ($clearSearchButton)
                    <div class="input-group">
                        @endif
                        <input
                            @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                            @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                            @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                            class="form-control"
                            type="text"
                            aria-describedby="search"
                            placeholder="{{ __('laravel-livewire-tables::strings.search') }}"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text" id="search">
                                <i class="i-Magnifi-Glass1"></i>
                            </span>
                        </div>
                       
                        @if ($clearSearchButton)
                            <div class="input-group-append">
                                <button class="input-group-text" id="search" type="button" wire:click="clearSearch">@lang('laravel-livewire-tables::strings.clear')
                                </button>
                            </div>
                    </div>
                @endif
            </div>
        @endif

        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.export')
    </div><!--row-->
@endif
