<?php

namespace App\Http\Livewire;

use App\Models\AvailableCurrency;
use Livewire\Component;

class CurrencyTable extends Component
{


    public function render()
    {
        $currencies=AvailableCurrency::all();
        return view('livewire.currency-table')->with(['currencies' => $currencies]);
    }
}
