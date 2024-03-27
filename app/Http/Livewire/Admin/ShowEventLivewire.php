<?php

namespace App\Http\Livewire\Admin;

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
        $this->resetValues();
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
    }

    public function save()
    {
        $image_val = $this->event_id ? '' : '|image|max:2048';
        $this->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required' . $image_val,
            ],
            [
                'name.required' => 'El nombre es requerido',
                'description.required' => 'La descripción es requerida',
                'image.required' => 'La imagen es requerida',
                'image.image' => 'La imagen debe ser un archivo de imagen',
                'image.max' => 'La imagen no debe pesar más de 2MB',
            ]
        );
        if ($this->image) {
            if ($this->event_id) {
                $event = Premio::find($this->event_id);
                if ($event->image != $this->image) {
                    // dd(public_path('storage/events/' . $event->image));
                    if ($event->image && file_exists(storage_path('app/public/events/' . $event->image))) {
                        unlink(storage_path('app/public/events/' . $event->image));
                    }
                    $imgname  = $this->image->store('events', 'public');
                    $n = explode('/', $imgname)[1];
                }
            } else {
                $n = $this->image;
            }
        }

        Premio::updateOrCreate(
            [
                'id' => $this->event_id
            ],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'image' => $n ?? $this->image
            ]
        );

        $this->resetValues();
        $this->open = false;
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
        $this->image = $event->image ? $event->image : null;
        $this->open = true;
    }

    public function changeStatus(Premio $event)
    {
        // dd($event->active); // Aquí se puede ver el estado actual (true o false
        $event->update([
            'active' => !$event->active
        ]);
    }
}