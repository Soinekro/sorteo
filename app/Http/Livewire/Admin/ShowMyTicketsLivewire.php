<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ShowMyTicketsLivewire extends Component
{
    public function render()
    {
        dd(auth()->user()->tickets);
        return view('livewire.admin.show-my-tickets-livewire');
    }
}
