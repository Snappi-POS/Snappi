<div class="w-full p-4 flex gap-4">

    

    <div>
        <x-dropdown align="left">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        @lang('modules.expenses.filterDateRange')
                        <div class="inline-flex items-center justify-center w-5 h-5 text-xs font-medium text-white bg-red-500 rounded-md dark:border-gray-900 ml-1 {{ $filterDateRange ? '' : 'hidden' }}">1</div>
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                </span>
            </x-slot>

            <x-slot name="content">
                <div class="block px-4 py-2 text-sm font-medium text-gray-500">
                    <h6 class="text-sm font-medium text-gray-900 dark:text-white">
                        @lang('modules.expenses.expensesDateRange')
                    </h6>
                </div>

                <div class="px-4 py-2" @click.stop>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">@lang('modules.expenses.startDate')</label>
                    <input type="date" id="start_date" wire:model.live="filterStartDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                </div>

                <div class="px-4 py-2" @click.stop>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">@lang('modules.expenses.endDate')</label>
                    <input type="date" id="end_date" wire:model.live="filterEndDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                </div>


            </x-slot>
        </x-dropdown>
    </div>


    @if ($clearFilterButton)
        <div wire:key='filter-btn-{{ microtime() }}'>
            <x-danger-button wire:click='clearFilters'>
                <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                @lang('app.clearFilter')
            </x-danger-button>
        </div>
    @endif

    <div>
        <x-secondary-button wire:click="$toggle('showFilters')">@lang('app.hideFilter')</x-secondary-button>
    </div>

</div>
