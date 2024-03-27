<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SliderLivewire extends Component
{
    /* public $timer;
    public $images = [
        'https://via.placeholder.com/600x400?text=Slide+1',
        'https://via.placeholder.com/600x400?text=Slide+2',
        'https://via.placeholder.com/600x400?text=Slide+3',
    ];

    public $currentIndex = 0;

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
    }

    public function prev()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->images)) % count($this->images);
    }

    public function mount()
    {
        $this->startTimer();
    }

    public function startTimer()
    {
        $this->stopTimer();
        $this->timer = $this->addTimer(function () {
            $this->next();
        }, 2000); // Cambia cada 2 segundos
    }

    public function stopTimer()
    {
        if ($this->timer) {
            $this->clearTimer($this->timer);
        }
    } */

    public function render()
    {
        return view('livewire.slider-livewire');
    }
}
