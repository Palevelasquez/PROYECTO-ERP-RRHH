<?php

namespace App\Http\Livewire;

use Livewire\Component;


class ThemeSwitcher extends Component
{
    public $theme = 'light'; // Establecer el valor inicial según tus preferencias

    public function mount()
    {
        $this->theme = session()->get('theme', 'light');
    }

    public function updatedTheme($value)
    {
        session()->put('theme', $value);
        $this->emit('updateMode', $value);
    }

    public function render()
    {
        return view('livewire.theme-switcher');
    }
}
