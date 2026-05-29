<?php

namespace App\Livewire\Dashboard;

use App\Models\Reservation;
use Livewire\Component;

class TodayReservations extends Component
{

    public function render()
    {
        $start = now(timezone())->startOfDay();
        $end = now(timezone())->endOfDay();

        $count = Reservation::whereBetween('reservation_date_time', [$start, $end])
            ->where('reservation_status', 'Confirmed')
            ->whereNull('table_id')
            ->count();

        return view('livewire.dashboard.today-reservations', ['count' => $count]);
    }

    public function refreshReservations()
    {
        $this->dispatch('$refresh');
    }
}
