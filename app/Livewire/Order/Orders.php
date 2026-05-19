<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Models\User;
use App\Models\ReceiptSetting;
use App\Models\KotCancelReason;
use App\Models\PusherSetting;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

class Orders extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = ['refreshOrders' => '$refresh'];

    public $orderID;
    public $filterOrders;
    public $dateRangeType;
    public $startDate;
    public $endDate;
    public $receiptSettings;
    public $waiters;
    public $filterWaiter;
    public $pollingEnabled = true;
    public $pollingInterval = 10;
    public $filterOrderType = '';
    public $cancelReasons;
    public $selectedCancelReason;
    public $cancelComment;

    public $activeTab = 'local';

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function mount()
    {
        // Load date range type from cookie
        $this->dateRangeType = request()->cookie('orders_date_range_type', 'today');
        $this->startDate = now()->startOfWeek()->format('m/d/Y');
        $this->endDate = now()->endOfWeek()->format('m/d/Y');
        $this->waiters = User::role('Waiter_' . restaurant()->id)->get();

        // Load polling settings from cookies
        $this->pollingEnabled = filter_var(request()->cookie('orders_polling_enabled', 'true'), FILTER_VALIDATE_BOOLEAN);
        $this->pollingInterval = (int)request()->cookie('orders_polling_interval', 10);


        if (!is_null($this->orderID)) {
            $this->dispatch('showOrderDetail', id: $this->orderID);
        }

        $this->setDateRange();
        $this->cancelReasons = KotCancelReason::where('cancel_order', true)->get();
    }

    public function updatedDateRangeType($value)
    {
        $this->resetPage();
        cookie()->queue(cookie('orders_date_range_type', $value, 60 * 24 * 30)); // 30 days
    }

    public function updatedPollingEnabled($value)
    {
        cookie()->queue(cookie('orders_polling_enabled', $value ? 'true' : 'false', 60 * 24 * 30)); // 30 days
    }

    public function updatedPollingInterval($value)
    {
        cookie()->queue(cookie('orders_polling_interval', (int)$value, 60 * 24 * 30)); // 30 days
    }

    public function updatedFilterOrders()
    {
        $this->resetPage();
    }

    public function updatedFilterWaiter()
    {
        $this->resetPage();
    }

    public function updatedFilterOrderType()
    {
        $this->resetPage();
    }

    public function updatedActiveTab()
    {
        $this->resetPage();
    }

    public function setDateRange()
    {
        switch ($this->dateRangeType) {
            case 'today':
                $this->startDate = now()->startOfDay()->format('m/d/Y');
                $this->endDate = now()->startOfDay()->format('m/d/Y');
                break;

            case 'currentWeek':
                $this->startDate = now()->startOfWeek()->format('m/d/Y');
                $this->endDate = now()->endOfWeek()->format('m/d/Y');
                break;

            case 'lastWeek':
                $this->startDate = now()->subWeek()->startOfWeek()->format('m/d/Y');
                $this->endDate = now()->subWeek()->endOfWeek()->format('m/d/Y');
                break;

            case 'last7Days':
                $this->startDate = now()->subDays(7)->format('m/d/Y');
                $this->endDate = now()->startOfDay()->format('m/d/Y');
                break;

            case 'currentMonth':
                $this->startDate = now()->startOfMonth()->format('m/d/Y');
                $this->endDate = now()->endOfMonth()->format('m/d/Y');
                break;

            case 'lastMonth':
                $this->startDate = now()->subMonth()->startOfMonth()->format('m/d/Y');
                $this->endDate = now()->subMonth()->endOfMonth()->format('m/d/Y');
                break;

            case 'currentYear':
                $this->startDate = now()->startOfYear()->format('m/d/Y');
                $this->endDate = now()->endOfYear()->format('m/d/Y');
                break;

            case 'lastYear':
                $this->startDate = now()->subYear()->startOfYear()->format('m/d/Y');
                $this->endDate = now()->subYear()->endOfYear()->format('m/d/Y');
                break;

            default:
                $this->startDate = now()->startOfWeek()->format('m/d/Y');
                $this->endDate = now()->endOfWeek()->format('m/d/Y');
                break;
        }
    }

    #[On('setStartDate')]
    public function setStartDate($start)
    {
        $this->startDate = $start;
    }

    #[On('setEndDate')]
    public function setEndDate($end)
    {
        $this->endDate = $end;
    }

    public function showTableOrderDetail($id)
    {
        return $this->redirect(route('pos.order', [$id]), navigate: true);
    }

    public function confirmCancelOrder()
    {
        $order = Order::find($this->orderID);
        $order->status = 'cancelled';
        $order->cancel_reason_id = $this->selectedCancelReason;
        $order->cancel_comment = $this->cancelComment;
        $order->save();

        $this->dispatchBrowserEvent('orderCancelled', ['message' => __('Order cancelled successfully.')]);
    }

    public function render()
    {
        $start = Carbon::createFromFormat('m/d/Y', $this->startDate)
            ->startOfDay()
            ->toDateTimeString();

        $end = Carbon::createFromFormat('m/d/Y', $this->endDate)
            ->endOfDay()
            ->toDateTimeString();

        // Base query with DB-level filtering
        $baseQuery = Order::withCount('items')
            ->with('table', 'waiter', 'customer')
            ->where('status', '<>', 'draft')
            ->whereBetween('orders.date_time', [$start, $end])
            ->orderBy('id', 'desc');

        // Apply order type filter if selected
        if (!empty($this->filterOrderType)) {
            $baseQuery->where('order_type', $this->filterOrderType);
        }

        // Apply waiter filter at DB level
        if ($this->filterWaiter) {
            $baseQuery->where('waiter_id', $this->filterWaiter);
        }

        // Get counts for both tabs using efficient count queries
        $localCountQuery = (clone $baseQuery)->where('placed_via', 'pos');
        $onlineCountQuery = (clone $baseQuery)->where('placed_via', 'shop');
        $localCount = $localCountQuery->count();
        $onlineCount = $onlineCountQuery->count();
        $totalSalesCount = $localCount + $onlineCount;

        // Apply tab filter at DB level
        $tabQuery = (clone $baseQuery)->where('placed_via', $this->activeTab === 'local' ? 'pos' : 'shop');

        // Get status counts for the current tab (single query with groupBy)
        $statusCounts = Order::query()
            ->where('status', '<>', 'draft')
            ->whereBetween('orders.date_time', [$start, $end])
            ->where('placed_via', $this->activeTab === 'local' ? 'pos' : 'shop')
            ->when($this->filterOrderType, fn($q) => $q->where('order_type', $this->filterOrderType))
            ->when($this->filterWaiter, fn($q) => $q->where('waiter_id', $this->filterWaiter))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $kotCount = $statusCounts->get('kot', 0);
        $billedCount = $statusCounts->get('billed', 0);
        $paymentDueCount = $statusCounts->get('payment_due', 0);
        $paidOrdersCount = $statusCounts->get('paid', 0);
        $canceledOrdersCount = $statusCounts->get('canceled', 0);
        $outDeliveryOrdersCount = $statusCounts->get('out_for_delivery', 0);
        $deliveredOrdersCount = $statusCounts->get('delivered', 0);

        // Apply status filter at DB level
        if (!empty($this->filterOrders)) {
            $tabQuery->where('status', $this->filterOrders);
        }

        // Paginate instead of loading all into memory
        $orders = $tabQuery->paginate(20);

        $receiptSettings = restaurant()->receiptSetting;

        return view('livewire.order.orders', [
            'orders' => $orders,
            'kotCount' => $kotCount,
            'billedCount' => $billedCount,
            'paymentDueCount' => $paymentDueCount,
            'paidOrdersCount' => $paidOrdersCount,
            'canceledOrdersCount' => $canceledOrdersCount,
            'outDeliveryOrdersCount' => $outDeliveryOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
            'receiptSettings' => $receiptSettings,
            'orderID' => $this->orderID,
            'localCount' => $localCount,
            'onlineCount' => $onlineCount,
            'totalSalesCount' => $totalSalesCount,
        ]);
    }

}
