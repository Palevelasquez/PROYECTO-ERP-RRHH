<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardUpdateMode extends Component
{
    public function render()
    {
        return view('livewire.dashboard-update-mode');
    }

    public function updatedMode($value)
    {
        $this->emit('updateMode', $value);
    }
}
