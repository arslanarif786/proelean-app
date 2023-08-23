<?php

namespace App\Http\Livewire;

use App\Models\AvailableLanguage;
use Livewire\Component;

class LanguageTable extends Component
{


    public function render()
    {
        $languages=AvailableLanguage::all();
        return view('livewire.language-table')->with(['languages' => $languages]);
    }
}
