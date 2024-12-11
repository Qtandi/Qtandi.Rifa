<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participant;

class QueryModal extends Component
{
    public $isVisible = false;

    protected $listeners = ['showQueryModal' => 'showQueryModal'];

    public $cpf;
    public $name;
    public $numbers;

    public function mount()
    {
        $this->cpf = null;
        $this->numbers = [];
        $this->name = "";
    }

    public function updateCPF()
    {
        $participant = Participant::where('cpf', $this->cpf)->first();

        if(!$participant)
            return;

        $this->numbers = json_decode($participant->numbers);
        $this->name = $participant->name;
    }

    public function showQueryModal()
    {
        $this->toggle();
    }

    public function toggle()
    {
        $this->isVisible = !$this->isVisible;
    }

    public function render()
    {
        return view('livewire.query-form', ['numbers' => $this->numbers, 'name' => $this->name]);
    }
}
