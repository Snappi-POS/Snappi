<div>
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                @lang('modules.purchases.purchaseTitle') <span class="text-red-500">*</span>
            </label>
            <div class="mt-1" wire:ignore>
                <x-label for="item_id" />
                <select 
                    id="item_id" 
                    class="select2-livewire mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                    data-placeholder="-- Select Product --"
                    data-model="item_id"
                    data-change-method="updateMeasurementField">
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('item_id')
            <x-input-error for="item_id" class="mt-2" />
            @enderror
        </div>

        <!-- Quantity and Measurement -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    @lang('modules.purchases.quantity') <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="number" wire:model="quantity" id="quantity" min="1"
                        placeholder="Quantity purchased"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>
                @error('quantity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="measurement_select" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    @lang('modules.purchases.measure') <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <x-select id="measurement_select" class="mt-1 block w-full" wire:model="measurement_select" wire:change="updateMeasurementSelect($event.target.value)">
                        <option value="">-- Select Measurement --</option>   
                        @if(!empty($measurements))
                            @if(!empty($measurements['main']))
                            <option value="{{ $measurements['main'] }}">{{ ucfirst($measurements['main']) }}</option>
                            @endif
                            @if(!empty($measurements['sub']))
                            <option value="{{ $measurements['sub'] }}">{{ ucfirst($measurements['sub']) }}</option>
                            @endif
                        @endif
                    </x-select>
                </div>
                @error('measurement_select')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Price and Date -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    @lang('modules.purchases.price') <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="number" min="1" wire:model="price" id="price"
                        placeholder="Purchase price"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>
                @error('price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    Purchase Date
                </label>
                <div class="mt-1">
                    <input type="datetime-local" wire:model="purchase_date" id="purchase_date"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                        onclick="this.showPicker()">
                </div>
                @error('purchase_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                @lang('modules.expenses.description')
            </label>
            <div class="mt-1">
                <textarea wire:model="description" id="description" rows="3"
                    placeholder="Purchase description"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"></textarea>
            </div>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex w-full pb-4 space-x-4 mt-6 rtl:space-x-reverse">
            <x-button wire:loading.attr="disabled" wire:target="save">@lang('app.save')</x-button>
            <x-button-cancel wire:click="$dispatch('hideAddPurchases')">@lang('app.cancel')</x-button-cancel>
        </div>
    </form>

    <x-dialog-modal wire:model.live="showPurchaseItemModal" maxWidth="xl">
        <x-slot name="title">
            @lang('modules.expenses.addCategory')
        </x-slot>
        <x-slot name="content">
            @livewire('forms.AddExpenseCategory')
        </x-slot>
    </x-dialog-modal>
</div>

{{-- No @push scripts needed anymore! Everything is in main layout --}}