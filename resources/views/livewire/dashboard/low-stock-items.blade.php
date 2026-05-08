<div>
    <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
            <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-4">
                @lang('modules.dashboard.lowStock')
            </h3>

            @if($this->stocks->count() < 1)
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            No low stock items found.
                        </p>
                    </div>
                </div>
            @else
                <div class="max-w-4xl mx-auto mt-6">
                    {{--                <h2 class="text-xl font-semibold mb-4">Low Stock Items</h2>--}}

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="dark:bg-gray-800">
                            <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                                <th class="px-4 py-3">Item Name</th>
                                <th class="px-4 py-3">Current Stock</th>
                                {{--                            <th class="px-4 py-3">Status</th>--}}
                                {{--                            <th class="px-4 py-3">Restock Needed</th>--}}
                                <th class="px-4 py-3">Last Updated</th>
                            </tr>
                            </thead>
                            <tbody class="dark:bg-gray-800">
                            @forelse($this->stocks as $stock)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-900 dark:text-white">{{$stock->menuItem->item_name}}</td>
                                    <td class="px-4 py-3 font-semibold text-red-600">{{$stock->quantity}}</td>
                                    {{--                                <td class="px-4 py-3">--}}
                                    {{--                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">Low Stock</span>--}}
                                    {{--                                </td>--}}
                                    {{--                                <td class="px-4 py-3">16 needed</td>--}}
                                    <td class="px-4 py-3 text-gray-500 ">{{$stock->updated_at->format('D jS M, Y')}}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <footer class="mt-5">{{$this->stocks()->onEachSide(0)->links()}}</footer>

                </div>
            @endif
        </div>
    </div>
</div>