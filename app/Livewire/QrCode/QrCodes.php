<?php

namespace App\Livewire\QrCode;

use App\Helper\Files;
use App\Models\Area;
use Livewire\Component;
use App\Models\Table;
use App\Models\FileStorage;

class QrCodes extends Component
{

    public $areaID = null;

    public function downloadQrCode($tableCode, $branchId)
    {
        $filename = 'qrcode-' . $branchId . '-' . str()->slug($tableCode, '-', (auth()->user() ? auth()->user()->locale : 'en')) . '.png';

        $file = FileStorage::where('filename', $filename)->first();

        return download_local_s3($file, 'qrcodes/' . $filename);
    }

    public function downloadBranchQrCode()
    {
        $branch = branch();

        $filename = 'qrcode-branch-' . $branch->id . '-' . $branch->restaurant->id . '.png';

        $file = FileStorage::where('filename', $filename)->first();

        return download_local_s3($file, 'qrcodes/' . $filename);
    }

    public function generateQrCode($tableId = null)
    {
        if ($tableId) {
            $table = Table::find($tableId);
        } else {
            $table = branch();
        }

        $table->generateQrCode();

        $this->redirect(route('qrcodes.index'));
    }

    public function render()
    {
        $query = Area::query()->select('id', 'area_name')->with(['tables' => function ($query) {
            $query->select('id', 'area_id', 'branch_id', 'table_code', 'available_status', 'status', 'seating_capacity', 'hash');
        }]);

        if (!is_null($this->areaID)) {
            $query = $query->where('id', $this->areaID);
        }

        $tables = $query->get();
        $areas = Area::query()->select('id', 'area_name')->orderBy('area_name')->get();

        return view('livewire.qr-code.qr-codes', [
            'tables' => $tables,
            'areas' => $areas
        ]);
    }
}
