<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateMainCategory extends Component
{
    public function render()
    {
        return view('livewire.create-main-category')->layout('app.back.layouts.base');
    }
}
