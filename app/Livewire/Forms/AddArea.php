<?php

namespace App\Livewire\Forms;

use App\Models\Area;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AddArea extends Component
{
    use LivewireAlert;

    public $areaName;
    public $latitude;
    public $longitude;

    public function mount()
    {
        $this->areaName = '';
    }

    public function submitForm()
    {
        $this->validate([
            'areaName' => 'required',

        ]);

        Area::create([
            'area_name' => $this->areaName,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        // Reset the value
        $this->areaName = '';
        $this->latitude = '';
        $this->longitude = '';

        $this->dispatch('hideAddArea');
        $this->dispatch('areaAdded');

        $this->alert('success', __('messages.areaAdded'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'cancelButtonText' => __('app.close')
        ]);
    }

    public function render()
    {
        return view('livewire.forms.add-area');
    }

}
