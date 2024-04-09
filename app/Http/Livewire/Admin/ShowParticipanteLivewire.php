<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Traits\AlertTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ShowParticipanteLivewire extends Component
{
    use AlertTrait;
    use WithPagination;

    public function render()
    {
        //usuarios que tengan tickets activos
        $participantes = User::whereHas('tickets', function ($query) {
            $query->where('active', true);
        })->paginate(6);
        return view('livewire.admin.show-participante-livewire', compact('participantes'));
    }

    public function tickets(User $user)
    {
        return redirect()->route('mis-tickets', $user);
    }
}
