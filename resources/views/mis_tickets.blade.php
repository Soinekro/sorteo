<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Tickets') }}
        </h2>
    </x-slot>
    <div class="py-4">
            @livewire('admin.show-my-tickets-livewire')
        <div class="w-full mt-6 grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 px-10">
            @foreach ($ofertas_rand as $ofert)
                <img src="{{ asset($ofert) }}" alt="Next Logo" class="w-full h-full rounded-2xl ring ring-next-500">
            @endforeach
        </div>
    </div>
</x-app-layout>
