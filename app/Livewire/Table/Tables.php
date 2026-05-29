<?php

namespace App\Livewire\Table;

use App\Models\Area;
use App\Models\Table;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Tables extends Component
{

    use LivewireAlert;

    public $activeTable;
    public $areaID = null;
    public $showAddTableModal = false;
    public $showEditTableModal = false;
    public $confirmDeleteTableModal = false;
    public $filterAvailable = null;
    public $viewType = 'list';

    public function mount()
    {
        // Get the saved view type from session, default to 'list' if not set
        $this->viewType = session('table_view_type', 'list');
    }

    public function updatedViewType($value)
    {
        // Save the view type preference to session whenever it changes
        session(['table_view_type' => $value]);
    }

    #[On('refreshTables')]
    public function refreshTables()
    {
        $this->render();
    }

    #[On('hideAddTable')]
    public function hideAddTable()
    {
        $this->showAddTableModal = false;
    }

    #[On('hideEditTable')]
    public function hideEditTable()
    {
        $this->showEditTableModal = false;
    }

    public function showEditTable($id)
    {
        $this->activeTable = Table::findOrFail($id);
        $this->showEditTableModal = true;
    }

    public function showTableOrder($id)
    {
        return $this->redirect(route('pos.show', $id), navigate: true);
    }

    public function showTableOrderDetail($id)
    {
        return $this->redirect(route('pos.order', [$id]), navigate: true);
    }

    public function render()
    {
        $query = Area::query()->select('id', 'area_name')->with(['tables' => function ($query) {
            $query->select('id', 'area_id', 'table_code', 'available_status', 'status', 'seating_capacity')
                ->when(!is_null($this->filterAvailable), function ($tableQuery) {
                    $tableQuery->where('available_status', $this->filterAvailable);
                })
                ->with([
                    'activeOrder:id,table_id,status',
                    'activeOrder.kot:id,order_id',
                ]);
        }]);

        if (!is_null($this->areaID)) {
            $query = $query->where('id', $this->areaID);
        }

        $tables = $query->get();
        $areas = Area::query()->select('id', 'area_name')->orderBy('area_name')->get();


        return view('livewire.table.tables', [
            'tables' => $tables,
            'areas' => $areas
        ]);
    }

}
