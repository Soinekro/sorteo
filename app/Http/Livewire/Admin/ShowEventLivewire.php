<?php

namespace App\Http\Livewire\Admin;

use App\Models\Event;
use App\Models\Premio;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ShowEventLivewire extends Component
{
    use WithFileUploads;

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

    public function render()
    {
        if ($this->readyToLoad) {
            // sleep(1); // Simulando una carga lenta (4 segundos)
            $events = Premio::all();
        } else {
            $events = [];
        }
        return view('livewire.admin.show-event-livewire', compact('events'));
    }

    public function loadItems()
    {
        $this->readyToLoad = true;
    }

    public function create()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
    }

    public function save()
    {
        // dd($this->image);
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ],
        [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'date.required' => 'La fecha es requerida',
            'time.required' => 'La hora es requerida',
            'location.required' => 'La ubicación es requerida',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'La imagen debe ser un archivo de imagen',
            'image.max' => 'La imagen no debe pesar más de 2MB',
        ]
    );
        //crear carpeta en storage/app/public/events
        $imageName = $this->image->store('events', 'public');
        //obtener el nombre de la imagen
        $n = explode('/', $imageName)[1];
        // $imageName = $this->image->store('events');

        Premio::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'image' => $n
        ]);

        $this->resetValues();
        $this->open = false;
    }

    public function resetValues()
    {
        $this->reset(['name', 'slug', 'description', 'date', 'time', 'location', 'price', 'image']);
    }

    public function edit(Premio $event)
    {
        $this->event_id = $event->id;
        $this->name = $event->name;
        $this->slug = $event->slug;
        $this->description = $event->description;
        $this->date = $event->date;
        $this->time = $event->time;
        $this->location = $event->location;
        $this->price = $event->price;
        $this->image = $event->image;

        $this->open = true;
    }
}
