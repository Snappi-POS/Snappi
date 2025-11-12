<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    @lang('menu.measurements')
                </h1>
            </div>

            <div class="items-center justify-between block sm:flex ">
                <div class="flex items-center mb-4 sm:mb-0">
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <x-input id="measure_search" class="block mt-1 w-full"
                                 type="text"
                                 placeholder="Search measurements..."
                                 wire:model.live.debounce.500ms="search"/>
                    </div>
                </div>

                <div class="inline-flex gap-x-4 mb-4 sm:mb-0">
                    <x-button type='button' wire:click="$toggle('showMeasurementModal')">@lang('modules.menu.addMeasurement')</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600 text-center">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">
                                    Main Measure
                                </th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">
                                    Sub Measure
                                </th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">
                                    @lang('app.action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($measures as $measure)
                                <tr>
                                    <td class="py-2.5 px-4">{{ $measure->mainmeasure }}</td>
                                    <td class="py-2.5 px-4">{{ $measure->submeasure }}</td>
                                    <td class="py-2.5 px-4 space-x-2 whitespace-nowrap ">
                                        <x-secondary-button-table wire:click="edit({{ $measure->id }})">
                                            Update
                                        </x-secondary-button-table>
                                        <x-danger-button-table wire:click="delete({{ $measure->id }})">
                                            Delete
                                        </x-danger-button-table>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-2.5 px-4 text-center text-gray-400">
                                        No measurements found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="showMeasurementModal" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.menu.addMeasurement')
        </x-slot>

        <x-slot name="content">
            <form wire:submit="submitForm">
            @csrf

            <div class="space-y-4">
                <!-- Main Measure -->
                <div>
                    <x-label for="mainMeasure" :value="__('modules.measurements.mainMeasure')" />
                    <x-input id="mainMeasure" 
                            class="block mt-1 w-full" 
                            type="text" 
                            placeholder="{{ __('placeholders.mainMeasurePlaceholder') }}" 
                            wire:model.defer="mainMeasure" />
                    <x-input-error for="mainMeasure" class="mt-2" />
                </div>

                <!-- Sub Measure (optional) -->
                <div>
                    <x-label for="subMeasure" :value="__('modules.measurements.subMeasure') . ' (' . __('app.optional') . ')'" />
                    <x-input id="subMeasure" 
                            class="block mt-1 w-full" 
                            type="text" 
                            placeholder="{{ __('placeholders.subMeasurePlaceholder') }}" 
                            wire:model.defer="subMeasure" />
                    <x-input-error for="subMeasure" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end w-full space-x-4 mt-6">
                <x-button class="ml-3">@lang('app.save')</x-button>
            </div>
        </form>

        </x-slot>

        <x-slot name="footer">
            <x-button-cancel wire:click="$toggle('showMeasurementModal')" wire:loading.attr="disabled">
                {{ __('app.close') }}
                </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        {{ $measures->links() }}
    </div>
</div>
