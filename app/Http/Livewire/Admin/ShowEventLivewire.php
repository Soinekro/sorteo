<?php

namespace App\Http\Livewire\Admin;

use App\Models\Premio;
use App\Models\SorteoPremio;
use App\Models\Ticket;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ShowEventLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    use AlertTrait;

    public $readyToLoad = false;
    public $open = false;

    public $event_id;
    public $name;
    public $slug;
    public $description;
    public $date;
    public $time;
    public $location;
    public $price;
    public $image;

    public $showSorteo = false;
    public $premio;
    public $ganador;
    public function mount()
    {
        //verificar si el usuario es el 1
        if (auth()->user()->id != 1) {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $events = Premio::paginate(6);
            $tickets = Ticket::orderBy('id', 'asc')->paginate(6);
        } else {
            $events = [];
            $tickets = [];
        }
        return view('livewire.admin.show-event-livewire', compact('events', 'tickets'));
    }

    public function create()
    {
        $this->resetValues();
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
    }

    public function save()
    {
        $image_val = $this->event_id ? '' : '|image|max:4096';
        $this->validate(
            [
                'name' => 'required|string|max:255|unique:events,name,' . $this->event_id,
                'description' => 'required',
                'image' => 'required' . $image_val,
            ],
            [
                'name.required' => 'El nombre es requerido',
                'name.unique' => 'El nombre ya está en uso',
                'name.max' => 'El nombre no debe ser mayor a 255 caracteres',
                'description.required' => 'La descripción es requerida',
                'image.required' => 'La imagen es requerida',
                'image.image' => 'La imagen debe ser un archivo de imagen',
                'image.max' => 'La imagen no debe pesar más de 2MB',
            ]
        );
        DB::beginTransaction();
        try {
            if ($this->image) {
                if ($this->event_id) {
                    $event = Premio::find($this->event_id);
                    if ($event->image != $this->image) {
                        if ($event->image && file_exists(storage_path('app/public/events/' . $event->image))) {
                            unlink(storage_path('app/public/events/' . $event->image));
                        }
                        $imgname  = $this->image->store('events', 'public');
                        $n = explode('/', $imgname)[1];
                    }
                } else {
                    $n = $this->image->store('events', 'public') ?? $this->image;
                    $n = explode('/', $n)[1];
                }
                $n = $n ?? $this->image;
            }
            Premio::updateOrCreate(
                [
                    'id' => $this->event_id
                ],
                [
                    'name' => $this->name,
                    'slug' => Str::slug($this->name),
                    'description' => $this->description,
                    'image' => $n,
                ]
            );

            DB::commit();
            $this->resetValues();
            $this->open = false;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Ocurrió un error al intentar guardar el Premio');
        }
    }

    public function resetValues()
    {
        $this->reset(['event_id', 'name', 'slug', 'description', 'date', 'time', 'location', 'price', 'image']);
    }

    public function edit(Premio $event)
    {
        $this->event_id = $event->id;
        $this->name = $event->name;
        $this->slug = $event->slug;
        $this->description = $event->description;
        $this->image = $event->image;
        $this->open = true;
    }

    public function changeStatus(Premio $event)
    {
        if ($event->active) {
            $event->update([
                'active' => false
            ]);
        } else {
            DB::beginTransaction();
            try {
                $event->update([
                    'active' => true
                ]);
                $sorteopremio = SorteoPremio::where('premio_id', $event->id)->first() ?? null;
                if ($sorteopremio != null) {
                    $sorteopremio->ticket->user->tickets()->each(function ($ticket) {
                        $ticket->update([
                            'active' => true
                        ]);
                    });
                    $sorteopremio->update([
                        'active' => false
                    ]);
                }
                DB::commit();
                $this->alertInfo('Premio activado correctamente , se ha eliminado el sorteo anterior');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->alertError('Ocurrió un error al intentar activar el premio');
            }
        }
    }

    public function sorteo(Premio $event)
    {
        $this->emit('confeti-stop');
        $this->showSorteo = true;
        $this->event_id = $event->id;
        $this->premio = $event;
        $this->ganador = $event->sorteado->first()->ticket ?? null;
    }

    public function sortear()
    {
        DB::beginTransaction();
        try {
            $tickets = Ticket::where('active', true)->pluck('ticket')->toArray();
            //reordenar todos los tickets
            // for ($i = 1; $i <= 3; $i++) {
            shuffle($tickets);
            // }
            $rand = mt_rand(0, count($tickets) - 1);
            $ticket = $tickets[$rand];
            $this->ganador = Ticket::where('ticket', $ticket)->first();
            $this->ganador->user->tickets()->each(function ($ticket) {
                $ticket->update([
                    'active' => false
                ]);
            });
            $this->premio->update([
                'active' => false
            ]);
            SorteoPremio::create([
                'premio_id' => $this->event_id,
                'ticket_id' => $this->ganador->id,
            ]);
            DB::commit();
            $this->emit('ruleta', $this->ganador);
        } catch (\Exception $e) {
            $this->emit('confeti-stop');
            DB::rollBack();
            $this->alertError('Ocurrió un error al intentar sortear el premio');
        }
    }

    public function cerrarSorteo()
    {
        $this->showSorteo = false;
        $this->emit('confeti-stop');
    }

    public function resetSorteos()
    {
        DB::beginTransaction();
        try {
            $premios = Premio::all();
            foreach ($premios as $premio) {
                $premio->update([
                    'active' => true
                ]);
                $tickets = Ticket::all();
                $tickets->each(function ($ticket) {
                    $ticket->update([
                        'active' => true
                    ]);
                    $sorteoPremio = SorteoPremio::where('ticket_id', $ticket->id)->first() ?? null;
                    if ($sorteoPremio != null) {
                        $sorteoPremio->delete();
                    }
                });
            }
            DB::commit();
            $this->alertInfo('Se han eliminado todos los sorteos');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            $this->alertError('Ocurrió un error al intentar eliminar los sorteos');
        }
    }
}
