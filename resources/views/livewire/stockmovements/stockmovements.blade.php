<div>
    @if ($showFilters)
        @include('stockmovements.filter')
    @endif

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Quantity Change</th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Reference Type</th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Notes</th>
                                <th class="py-2.5 px-4 text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($stockMovements as $movement)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ $movement->menuItem?->item_name ?? 'N/A' }}
                                    </td>
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ $movement->quantity_change }}
                                        {{ $movement->measurement?->name }}
                                    </td>
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ ucfirst($movement->type) }}
                                    </td>
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ ucfirst($movement->reference_type) }}
                                    </td>
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ $movement->notes ?? '-' }}
                                    </td>
                                    <td class="py-2.5 px-4 text-gray-900 dark:text-white">
                                        {{ $movement->created_at->format('jS M, Y h:i a') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-2.5 px-4 text-gray-500 text-center">
                                        No stock movements found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $stockMovements->links() }}
    </div>
</div>
