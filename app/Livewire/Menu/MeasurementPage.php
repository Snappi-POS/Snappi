<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Measurement;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MeasurementPage extends Component
{
    use WithPagination;

    public $search = '';

    public $showMeasurementModal = false;

    protected $queryString = ['search'];

    use LivewireAlert;

    public $mainMeasure = '';
    public $subMeasure = '';
    public $measurementList = [];
    public $measureId = null;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function submitForm()
    {

        $this->mainMeasure = Str::title(Str::singular(trim($this->mainMeasure)));
        $this->subMeasure  = $this->subMeasure ? Str::title(Str::singular(trim($this->subMeasure))) : null;


        $this->validate([
            'mainMeasure' => [
                'required',
                Rule::unique('measurements', 'mainmeasure')
                    ->where(
                        fn($query) => $query
                            ->where('branch_id', branch()->id)
                            ->where('submeasure', $this->subMeasure)
                    ),
            ],
            'subMeasure' => 'nullable|string',
        ], [
            'mainMeasure.required' => __('validation.required', ['attribute' => 'main measure']),
            'mainMeasure.unique'   => __('validation.unique', ['attribute' => 'main measure & sub measure']),
        ]);




        if ($this->measureId) {
            $measure = Measurement::findOrFail($this->measureId);

            $measure->update([
                'mainmeasure' => $this->mainMeasure,
                'submeasure'  => $this->subMeasure,
            ]);
            $this->alert('success', __('messages.measurementUpdated'), [
                'toast' => true,
                'position' => 'top-end',
                'showCancelButton' => false,
                'cancelButtonText' => __('app.close'),
            ]);
        } else {
            Measurement::create([
                'mainmeasure' => $this->mainMeasure,
                'submeasure'  => $this->subMeasure,
                'branch_id'    => branch()->id,
            ]);
            $this->alert('success', __('messages.measurementAdded'), [
                'toast' => true,
                'position' => 'top-end',
                'showCancelButton' => false,
                'cancelButtonText' => __('app.close'),
            ]);
        }



        // Reset form
        $this->reset(['mainMeasure', 'subMeasure']);

        // Notify parent/listeners
        $this->dispatch('refreshMeasurements');
        $this->dispatch('hideMeasurementModal');
    }

    public function edit($id)
    {
        $measure = Measurement::findOrFail($id);

        $this->measureId = $measure->id;
        $this->mainMeasure = $measure->mainmeasure;
        $this->subMeasure = $measure->submeasure;
        $this->showMenuCategoryModal();
    }
    
    public function render()
    {
        $measures = Measurement::query()
            ->where('branch_id', branch()->id)
            ->where(function ($query) {
                $query->where('mainmeasure', 'like', '%' . $this->search . '%')
                    ->orWhere('submeasure', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.measurement-page', [
            'measures' => $measures,
        ]);
    }


    #[On('showMenuCategoryModal')]
    public function showMenuCategoryModal()
    {
        $this->showMeasurementModal = true;
    }

    #[On('hideMeasurementModal')]
    public function hideMeasurementModal()
    {
        $this->showMeasurementModal = false;
    }



    public function delete($id)
    {
        Measurement::find($id)?->delete();
    }
}
