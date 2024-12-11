<?php

namespace App\Livewire;

use Livewire\Component;

class FormModal extends Component
{
    public $isVisible = false;
    public int $quantity;

    protected $listeners = ['showModal'];

    public function showModal($quantity)
    {
        $this->quantity = $quantity;
        $this->toggle();
    }

    public function toggle()
    {
        $this->isVisible = !$this->isVisible;
    }

    public function render()
    {
        return view('livewire.detail-form');
    }
}
