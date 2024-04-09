<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>
    <div class="py-4">
        @livewire('admin.ticket-participante-livewire', ['user' => $user])
    </div>
</x-app-layout>
