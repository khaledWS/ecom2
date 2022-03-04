<?php

namespace App\Http\Livewire\Back;

use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {

        return view('livewire.back.dashboard-component')->layout('app.back.layouts.base');
    }
}
