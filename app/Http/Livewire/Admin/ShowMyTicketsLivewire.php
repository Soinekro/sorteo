<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ticket;
use App\Traits\AlertTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMyTicketsLivewire extends Component
{
    use WithPagination;
    use AlertTrait;

    public $search;

    public function render()
    {
        if ($this->readyToLoad) {
            if (auth()->user()->id > 1) {
                $tickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
                    ->when($this->search, function ($query) {
                        $query->where('ticket', 'like', '%' . $this->search . '%')
                            ->orWhere('users.name', 'like', '%' . $this->search . '%');
                    })
                    ->where('user_id', auth()->id())
                    ->orderBy('tickets.id', 'asc')
                    ->paginate(6);
            } else {
                $tickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
                    ->when($this->search, function ($query) {
                        $query->where('ticket', 'like', '%' . $this->search . '%')
                            ->orWhere('users.name', 'like', '%' . $this->search . '%');
                    })
                    ->orderBy('tickets.id', 'asc')
                    ->paginate(12);
            }
        } else {
            $tickets = [];
        }
        return view('livewire.admin.show-my-tickets-livewire', compact('tickets'));
    }
}
