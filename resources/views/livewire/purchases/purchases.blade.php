<div>

    @if ($showFilters)
    @include('purchases.filter')
    @endif
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.purchases.purchaseTitle')
                                </th>

                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.purchases.quantity')
                                </th>
                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.purchases.price')
                                </th>
                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.purchases.purchase_date')
                                </th>

                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.purchases.notes')
                                </th>

                                <th
                                    class="py-2.5 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('app.action')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if ($purchases->count() > 0)
                            @foreach ($purchases as $purchase)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              

                                <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                    {{ Str::title($purchase->menuItem->item_name)}}
                                </td>
                                <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                    {{ $purchase->formatted_quantity  }}
                                </td>
                                <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                    {{ currency_format($purchase->price, restaurant()->currency_id) }}
                                </td>
                                <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('jS M, Y h:i a') }}
                                </td>

                                <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                    {{ $purchase->notes  }}
                                </td>




                                <td class="py-2.5 px-4 space-x-2 text-right">
                                   

                                    @if (user_can('Delete Expense'))
                                    <x-danger-button-table
                                        wire:click="showDeleteMenupurchase({{ $purchase->id }})"
                                        wire:key="delete-purchase-button-{{ $purchase->id }}">
                                        {{-- {{$purchase->id }} --}}

                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>

                                    </x-danger-button-table>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="py-2.5 px-4 text-gray-500 dark:text-gray-400" colspan="10">
                                    No Purchases Found
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:key='customer-table-paginate-{{ microtime() }}'
        class="sticky bottom-0 right-0 items-center w-full py-2.5 px-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center mb-4 sm:mb-0 w-full">

        </div>
    </div>



    <x-right-modal wire:model.live="showEditPurchaseModal">
        <x-slot name="title">
            Edit Purchase
        </x-slot>

        <x-slot name="content">
            @if ($selectedPurchases)
            @livewire('forms.edit-purchase', ['purchaseId' => $selectedPurchases], key('edit-purchase-'.$selectedPurchases))
            @endif
        </x-slot>

        <x-slot name="footer">
            {{-- optional footer actions --}}
        </x-slot>
    </x-right-modal>



    <x-confirmation-modal wire:model.live="confirmDeletePurchase">
        <x-slot name="title">
            Delete Purchase?
        </x-slot>

        <x-slot name="content">
            Delete this purchase? Product quantity will be reverted.
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