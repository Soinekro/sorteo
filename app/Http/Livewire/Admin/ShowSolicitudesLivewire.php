<?php

namespace App\Http\Livewire\Admin;

use App\Models\RegisterUser;
use App\Models\Ticket;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSolicitudesLivewire extends Component
{
    use WithPagination;
    use AlertTrait;

    public $tickets;
    public $solicitud;

    public function render()
    {
        if ($this->readyToLoad) {
            $solicitudes = RegisterUser::with('user')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $solicitudes = [];
        }
        return view('livewire.admin.show-solicitudes-livewire', compact('solicitudes'));
    }

    public function generar(RegisterUser $solicitud)
    {
        DB::beginTransaction();
        try {
            if ($solicitud->attended == true) {
                $this->alertError('El ticket ya fue generado');
                return;
            }

            for ($i = 0; $i < $solicitud->tickets; $i++) {
                $ticket = Ticket::create([
                    'user_id' => $solicitud->user_id,
                    // completar con 0 a la izquierda,
                    'ticket' => str_pad((count(Ticket::all('id')) ?? 0) + 1, 8, '0', STR_PAD_LEFT),
                    'active' => true
                ]);
            }
            $solicitud->attended = true;
            $solicitud->save();
            DB::commit();
            $this->alertSuccess('Ticket generado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alertError('Error al generar ticket');
        }
    }
    public function edit(RegisterUser $solicitud)
    {
        $this->open = true;
        $this->solicitud = $solicitud;
        $this->tickets = $solicitud->tickets;
    }

    public function save()
    {

        $this->validate(
            [
                'tickets' => 'required|numeric|min:1'
            ],
            [
                'tickets.required' => 'El campo es requerido',
                'tickets.numeric' => 'El campo debe ser numerico',
                'tickets.min' => 'El campo debe ser mayor a 0',
                // 'tickets.max' => 'El campo debe ser menor o igual a 10'
            ]
        );
        DB::beginTransaction();
        try {
            if ($this->solicitud->attended == true) {
                $this->alertError('El ticket ya fue generado');
                return;
            }

            $this->solicitud->tickets = $this->tickets;
            $this->solicitud->save();
            DB::commit();
            $this->alertSuccess('Ticket Actualizado correctamente');
            $this->open = false;
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            $this->alertError('Error al generar solicitud');
        }
    }
}
