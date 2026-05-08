<div>

    <div class="p-4 bg-white block sm:flex items-center justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">@lang('modules.purchases.purchases')</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="sm:pr-3" action="#" method="GET">
                        <label for="products-search" class="sr-only">Search</label>
                        <div class="relative w-48 mt-1 sm:w-64 xl:w-96">

                            <x-input id="expense" class="block mt-1 w-full" type="text"
                                placeholder="{{ __('placeholders.purchase') }}"
                                wire:model.live.debounce.500ms="search" />
                        </div>
                    </form>

                    <x-secondary-button wire:click="$dispatch('showPurchasesFilters')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filter mr-1" viewBox="0 0 16 16">
                            <path
                                d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                        </svg> @lang('app.showFilter')
                    </x-secondary-button>
                </div>

                @if (user_can('Create Expense'))
                <x-button type='button' wire:click="$set('showAddPurchases', true)">
                    @lang('modules.purchases.addPurchase')
                </x-button>
                @endif

            </div>
        </div>
    </div>

    <div>

        @if ($showFilters)
        @include('expenses.filter')
        @endif
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2.5 px-4">#</th>
                                    <th class="py-2.5 px-4">Item</th>
                                    <th class="py-2.5 px-4">Quantity</th>
                                    <th class="py-2.5 px-4">Price</th>
                                    <th class="py-2.5 px-4">Reference</th>
                                    <th class="py-2.5 px-4">Notes</th>
                                    <th class="py-2.5 px-4">Date</th>
                                    <th class="py-2.5 px-4">@lang('app.action')</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700 text-center">
                                @forelse ($purchases as $purchase)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $purchase->id }}</td>
                                    <td class="px-4 py-2">{{ $purchase->menuItem->item_name ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $purchase->quantity }}</td>
                                    <td class="px-4 py-2">
                                        {{ $purchase->price ? currency_format($purchase->price, restaurant()->currency_id) : '--' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $purchase->reference ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $purchase->notes ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $purchase->purchase_date }}</td>
                                    <td class="px-4 py-2">
                                        <button wire:click="showEditPurchase({{ $purchase->id }})" class="text-blue-500">✏️</button>
                                        <button wire:click="showDeletePurchase({{ $purchase->id }})" class="text-red-500">🗑</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-3 text-center text-gray-500">
                                        @lang('messages.noPurchasesFound')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div wire:key='customer-table-paginate-{{ microtime() }}'
            class="sticky bottom-0 right-0 items-center w-full py-2.5 px-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center mb-4 sm:mb-0 w-full">
                {{ $purchases->links() }}
            </div>
        </div>

        <x-right-modal wire:model.live="showPurchaseDetailsModal">
            <x-slot name="title">
                {{ __('modules.expenses.expenseDetails') }}
            </x-slot>

            <x-slot name="content">
                @if ($viewPurchaseDetails)
                @livewire('payments.expense-details', ['expenses' => $viewPurchaseDetails], key(microtime()))
                @endif
            </x-slot>

            <x-slot name="footer">
                {{-- <x-secondary-button wire:click="$set('showEditExpense', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
                </x-secondary-button> --}}
            </x-slot>
        </x-right-modal>

        <x-right-modal wire:model.live="showEditPurchaseModal">
            <x-slot name="title">
                {{ __('modules.expenses.editExpense') }}
            </x-slot>

            <x-slot name="content">
                @if ($selectedPurchase)
                @livewire('forms.EditExpense', ['expenses' => $selectedPurchase], key(str()->random(50)))
                @endif
            </x-slot>

            <x-slot name="footer">
                {{-- <x-secondary-button wire:click="$set('showEditExpense', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
                </x-secondary-button> --}}
            </x-slot>
        </x-right-modal>


        <x-confirmation-modal wire:model.live="confirmDeletePurchase">
            <x-slot name="title">
                @lang('modules.expenses.deleteExpense')?
            </x-slot>

            <x-slot name="content">
                @lang('modules.expenses.deleteExpensesMessage')
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmDeletePurchase')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                @if ($deletePurchase)
                <x-danger-button class="ml-3" wire:click='deletePurchaseData({{ $deletePurchase }})'
                    wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
                @endif
            </x-slot>
        </x-confirmation-modal>


    </div>



    <!-- Product Drawer -->
    <x-right-modal wire:model.live="showAddPurchases">
        <x-slot name="title">
            {{ __('modules.purchases.addPurchase') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <form wire:submit.prevent="save" class="space-y-4">


                    <!-- Menu Item -->
                    <div>
                        <label for="menu_item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.menuItem') <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">





                            <x-label for="language" :value="__('modules.menu.selectLanguage')" />
                            <x-select class="mt-1 block w-full" wire:model="menu_item_id">
                                <option value="">@lang('app.selectItem')</option>
                                @foreach ($menuItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                @endforeach
                            </x-select>



                        </div>
                        @error('menu_item_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Quantity -->


                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.quantity') <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex space-x-2 rtl:space-x-reverse">
                            <!-- Quantity Input -->
                            <input type="number"  wire:model="quantity" id="quantity"
                                placeholder="{{ __('placeholders.addQuantity') }}"
                                class="block w-1/2 rounded-md border-gray-300 shadow-sm focus:border-primary-500 
                   focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">

                            <!-- Measurement Select -->


                            <x-select class="mt-1 block w-full" wire:model="selectedMeasure">
                        @foreach ($measurementOptions as $option)
                            <option value="{{ $option['type'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </x-select>

                        </div>
                        @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>


                    <!-- Price (optional) -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.price')
                        </label>
                        <div class="mt-1">
                            <input type="number" step="0.01" wire:model="price" id="price"
                                placeholder="{{ __('placeholders.addPrice') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 
                           focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        </div>
                        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Reference -->
                    <div>
                        <label for="reference" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.reference')
                        </label>
                        <div class="mt-1">
                            <input type="text" wire:model="reference" id="reference"
                                placeholder="{{ __('placeholders.addReference') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 
                           focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        </div>
                        @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.notes')
                        </label>
                        <div class="mt-1">
                            <textarea wire:model="notes" id="notes" rows="3"
                                placeholder="{{ __('placeholders.addNotes') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 
                           focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"></textarea>
                        </div>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            @lang('modules.purchases.purchaseDate') <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">
                            <input type="datetime-local" wire:model="purchase_date" id="purchase_date"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 
                                    focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                        </div>
                        @error('purchase_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex w-full pb-4 space-x-4 mt-6 rtl:space-x-reverse">
                        <x-button>@lang('app.save')</x-button>
                        <x-button-cancel wire:click="$dispatch('hideAddPurchase')">@lang('app.cancel')</x-button-cancel>
                    </div>
                </form>
            </div>

        </x-slot>
    </x-right-modal>

</div>