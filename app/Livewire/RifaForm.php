<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Number;

class RifaForm extends Component
{
    public $price;
    public $quantity;

    private $unitPrice = 0.25;

    public function mount()
    {
        $this->price = $this->unitPrice;
        $this->quantity = 20;
        $this->updatePrice();
    }

    public function updatePrice()
    {
        $this->price = $this->unitPrice * (int) $this->quantity;
    }

    public function render()
    {
        return view('livewire.rifa-form');
    }

    public function increment()
    {
        if($this->quantity == 1 && $this->quantity >= 5000)
            return;

        $this->quantity += 1;
        $this->updatePrice();
    }

    public function decrement()
    {
        if($this->quantity == 20)
            return;

        $this->quantity -= 1;
        $this->updatePrice();
    }

    public function finalize()
    {
        $this->dispatch('showModal', $this->quantity);
    }
}
