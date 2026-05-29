<?php

namespace App\Livewire\Dashboard;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TodayPaymentMethodEarnings extends Component
{

    public function render()
    {
        $start = now()->startOfDay();
        $end = now()->endOfDay();

        $paymentMethods = Payment::where('payment_method', '<>', 'due')
            ->select('payment_method', DB::raw('SUM(amount) as total_amount'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('payment_method')
            ->orderByDesc('total_amount')
            ->get();

        return view('livewire.dashboard.today-payment-method-earnings', ['paymentMethods' => $paymentMethods]);
    }

}
