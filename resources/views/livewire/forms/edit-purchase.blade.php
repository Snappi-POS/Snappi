<div>
    <form wire:submit.prevent="save" class="space-y-4">
        <!-- Product -->
        <div>
            <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                @lang('modules.purchases.purchaseTitle') <span class="text-red-500">*</span>
            </label>
            <div class="mt-1">
                <x-select id="item_id" class="mt-1 block w-full"
                    wire:model="item_id"
                    wire:change="updateMeasurementField($event.target.value)">
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->item_name }}</option>
                    @endforeach
                </x-select>
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
                    <input type="number" wire:model="quantity" id="quantity"
                        placeholder="Quantity purchased"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500
                            dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>
                @error('quantity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="measurement_select" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    @lang('modules.purchases.measure') <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex">
                    <x-select id="measurement_select" class="mt-1 block w-full"
                        wire:model="measurement_select"
                        wire:change="updateMeasurementSelect($event.target.value)">
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

                    <button type="button"
                        class="ml-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium
                            leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2
                            focus:ring-primary-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-700
                            dark:text-gray-200 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </button>
                </div>
                @error('measurement_select')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Price and Purchase Date -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    @lang('modules.purchases.price') <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="number" wire:model="price" id="price"
                        placeholder="Purchase price"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500
                            dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
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
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500
                            dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
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
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500
                        dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"></textarea>
            </div>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex w-full pb-4 space-x-4 mt-6 rtl:space-x-reverse">
            <x-button wire:loading.attr="disabled" wire:target="save">@lang('app.save')</x-button>
            <x-button-cancel wire:click="$dispatch('hideEditPurchases')">@lang('app.cancel')</x-button-cancel>
        </div>
    </form>
</div>
