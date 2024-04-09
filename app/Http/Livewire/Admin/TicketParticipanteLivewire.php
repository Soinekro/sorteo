<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ticket;
use App\Traits\AlertTrait;
use Livewire\Component;
use Livewire\WithPagination;

class TicketParticipanteLivewire extends Component
{
    use AlertTrait;
    use WithPagination;
    public $user;
    public $search;
    public function render()
    {
        if ($this->readyToLoad) {
            $tickets = Ticket::when($this->search, function ($query) {
                $query->where('ticket', 'like', '%' . $this->search . '%');
            })
                ->where('user_id', $this->user->id)
                ->orderBy('tickets.id', 'asc')
                ->paginate(9);
        } else {
            $tickets = [];
        }
        return view('livewire.admin.ticket-participante-livewire', compact('tickets'));
    }
}
