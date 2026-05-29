<?php

namespace App\Livewire\Kot;

use Carbon\Carbon;
use App\Models\Kot;
use Livewire\Component;
use App\Models\KotSetting;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use App\Models\KotCancelReason;
use App\Models\KotPlace;
use Illuminate\Database\Eloquent\Builder;

class Kots extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $listeners = ['refreshKots' => '$refresh'];
    public $filterOrders;
    public $dateRangeType;
    public $startDate;
    public $endDate;
    public $kotSettings;
    public $confirmDeleteKotModal = false;
    public $cancelReasons;
    public $kot;
    public $cancelReasonText;
    public $cancelReason;
    public $selectedCancelKotId;
    public $kotPlace;
    public $perPage = 24;

    public function mount()
    {
        // Load date range type from cookie
        $this->kotSettings = KotSetting::first();
        $this->dateRangeType = request()->cookie('kots_date_range_type', 'today');
        $this->filterOrders = ($this->kotSettings->default_status == 'pending') ? 'pending_confirmation' : 'in_kitchen';
        $this->startDate = now()->startOfWeek()->format('m/d/Y');
        $this->endDate = now()->endOfWeek()->format('m/d/Y');
        $this->cancelReasons = KotCancelReason::where('cancel_kot', true)->get();


        if (!in_array('Kitchen', restaurant_modules())) {
            $this->kotPlace = KotPlace::with('printerSetting')->first();
        }


        $this->setDateRange();
    }

    public function setDateRange()
    {
        switch ($this->dateRangeType) {
            case 'today':
                $this->startDate = now()->startOfDay()->format('m/d/Y');
                $this->endDate = now()->startOfDay()->format('m/d/Y');
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
                $this->endDate = now()->startOfDay()->format('m/d/Y');
                break;

            case 'lastMonth':
                $this->startDate = now()->subMonth()->startOfMonth()->format('m/d/Y');
                $this->endDate = now()->subMonth()->endOfMonth()->format('m/d/Y');
                break;

            case 'currentYear':
                $this->startDate = now()->startOfYear()->format('m/d/Y');
                $this->endDate = now()->startOfDay()->format('m/d/Y');
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

    #[On('showCancelKotModal')]
    public function showCancelKotModal($id = null)
    {
        $this->confirmDeleteKotModal = true;
        $this->selectedCancelKotId = $id;
    }

    public function updatedDateRangeType($value)
    {
        cookie()->queue(cookie('kots_date_range_type', $value, 60 * 24 * 30)); // 30 days
        $this->resetPage();
    }

    public function updatedFilterOrders(): void
    {
        $this->resetPage();
    }

    public function deleteKot($id)
    {
        $kot = Kot::findOrFail($id);
        $order = $kot->order;
        $kotCounts = $order->kot()->whereNot('status', 'cancelled')->count();

        // Update cancel reason info
        $kot->cancel_reason_id = $this->cancelReason;
        $kot->cancel_reason_text = $this->cancelReasonText;
        $kot->status = 'cancelled';
        $kot->save();


        // If this is the only KOT in the order, cancel the order
        if ($kotCounts === 1) {
            $order->status = 'canceled';
            $order->order_status = 'cancelled';
            $order->save();

            if ($order->table) {
                $order->table->update(['available_status' => 'available']);
            }
        }

        // Optional: soft delete kot or destroy it
        // Kot::destroy($id); // if using force delete

        $this->confirmDeleteKotModal = false;

        $this->reset(['cancelReason', 'cancelReasonText', 'selectedCancelKotId']);

        $this->dispatch('refreshKots');
    }

    public function render()
    {
        $start = Carbon::createFromFormat('m/d/Y', $this->startDate)->startOfDay()->toDateTimeString();
        $end = Carbon::createFromFormat('m/d/Y', $this->endDate)->endOfDay()->toDateTimeString();

        $countQuery = $this->baseKotQuery($start, $end);
        $inKitchenCount = $this->kotSettings->default_status == 'pending'
            ? (clone $countQuery)->where('status', 'in_kitchen')->count()
            : (clone $countQuery)->whereIn('status', ['in_kitchen', 'pending_confirmation'])->count();
        $foodReadyCount = (clone $countQuery)->where('status', 'food_ready')->count();
        $pendingConfirmationCount = (clone $countQuery)->where('status', 'pending_confirmation')->count();
        $cancelledCount = (clone $countQuery)->where('status', 'cancelled')->count();

        $kotList = $this->kotQuery($start, $end);
        $this->applySelectedFilter($kotList);
        $kots = $kotList->paginate($this->perPage);

        $kotSettings = $this->kotSettings;
        $cancelReasons = $this->cancelReasons;

        return view('livewire.kot.kots', [
            'kots' => $kots,
            'inKitchenCount' => $inKitchenCount,
            'foodReadyCount' => $foodReadyCount,
            'pendingConfirmationCount' => $pendingConfirmationCount,
            'cancelledCount' => $cancelledCount,
            'kotSettings' => $kotSettings,
            'cancelReasons' => $cancelReasons,
        ]);
    }

    private function baseKotQuery(string $start, string $end): Builder
    {
        $query = Kot::query()
            ->whereBetween('kots.created_at', [$start, $end])
            ->whereHas('order', function (Builder $query) {
                $query->where('status', '<>', 'draft');
            });

        if (in_array('Kitchen', restaurant_modules())) {
            $query->whereHas('items.menuItem', function (Builder $query) {
                $query->where('kot_place_id', $this->kotPlace?->id);
            });
        }

        return $query;
    }

    private function kotQuery(string $start, string $end): Builder
    {
        $query = $this->baseKotQuery($start, $end)->orderByDesc('id');

        if (in_array('Kitchen', restaurant_modules())) {
            return $query->withCount(['items' => function ($query) {
                $query->whereHas('menuItem', function ($nestedQuery) {
                    $nestedQuery->where('kitchen_place_id', $this->kotPlace?->id)
                        ->orWhereNull('kitchen_place_id');
                });
            }])->with([
                'items' => function ($query) {
                    $query->whereHas('menuItem', function ($nestedQuery) {
                        $nestedQuery->where('kot_place_id', $this->kotPlace?->id);
                    })->with(['menuItem', 'menuItemVariation', 'modifierOptions']);
                },
                'order',
                'order.waiter',
                'order.table',
                'cancelReason',
            ]);
        }

        return $query->withCount('items')->with([
            'items.menuItem',
            'items.menuItemVariation',
            'items.modifierOptions',
            'order',
            'order.waiter',
            'order.table',
            'cancelReason',
        ]);
    }

    private function applySelectedFilter(Builder $query): void
    {
        switch ($this->filterOrders) {
            case 'in_kitchen':
                if ($this->kotSettings->default_status == 'pending') {
                    $query->where('status', 'in_kitchen');
                } else {
                    $query->whereIn('status', ['in_kitchen', 'pending_confirmation']);
                }
                break;

            case 'food_ready':
                $query->where('status', 'food_ready');
                break;

            case 'pending_confirmation':
                $query->where('status', 'pending_confirmation');
                break;

            case 'cancelled':
                $query->where('status', 'cancelled');
                break;
        }
    }
}
