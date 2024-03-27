<div wire:init="loadItems">
    <!-- button to create event -->
    <div class="flex justify-end">
        <button wire:click="create"
            class="bg-next-500 hover:bg-next-700 text-white font-bold py-2 px-4 rounded my-3">Crear Premio</button>
    </div>
    <div class="block w-full {{-- overflow-x-auto --}}">
        @if (count($events))
            <table class="items-center w-full bg-white {{-- border-collapse --}}">
                <thead>
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Premio</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Descripcion</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Estado</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $item)
                        <tr>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                <img src="{{ asset('storage/events/' . $item->image) }}"
                                    class="h-12 w-12 rounded-full border" alt="{{ $item->name }}">
                                <span class="ml-3 font-bold text-gray-900"> {{ $item->name }}</span>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i class="fas fa-circle text-orange-500 mr-2"></i>{{ $item->description }}
                            </td>
                            <td class="td-table-main">
                                <div class="head-to-td-table-main font-bold">
                                    {{ __('Status') }}:
                                </div>
                                <div class="ml-2">
                                    <button type="button"
                                        class="relative inline-flex items-center @if ($item->active) fill-next-500 @else fill-red-500 @endif"
                                        wire:click="changeStatus('{{ $item->id }}')">
                                        @if ($item->active)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-6 svg-dark"
                                                height="1em" viewBox="0 0 576 512">
                                                <path cursor-default
                                                    d="M192 64C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192s-86-192-192-192H192zm192 96a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-6 svg-dark"
                                                height="1em" viewBox="0 0 576 512">
                                                <path
                                                    d="M384 128c70.7 0 128 57.3 128 128s-57.3 128-128 128H192c-70.7 0-128-57.3-128-128s57.3-128 128-128H384zM576 256c0-106-86-192-192-192H192C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192zM192 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z" />
                                            </svg>
                                        @endif
                                    </button>
                                </div>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                <!-- Contenido de la celda -->
                                <div class="relative" x-data="{ open: false }">
                                    <!-- Botón de acción -->
                                    <button type="button" @click="open = ! open"
                                        class="bg-transparent text-gray-700 shadow-md font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M6 6H6.00634M6 12H6.00634M6 18H6.00634M11.9968 6H12.0032M11.9968 12H12.0032M11.9968 18H12.0032M17.9937 6H18M17.9937 12H18M17.9937 18H18"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    {{-- <!-- Dropdown --> --}}
                                    <div x-show="open" @click.outside="open = false"
                                    class="absolute bg-white text-base z-50 top-full left-0 w-full whitespace-nowrap rounded shadow-lg"
                                        id="table-dark-1-dropdown-{{ $item->id }}">
                                        <!-- Opciones del dropdown -->
                                        <div wire:click="edit({{ $item }})"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 cursor-pointer">
                                            Editar
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif ($events != [])
            <tr>
                <div class="alert-warning" role="alert">
                    <p class="font-bold">No hay Registros</p>
                    <p>Por favor, crea un registro para empezar.</p>
                </div>
            </tr>
        @else
            {{-- <!-- pantalla de carga --> --}}
            <div
                class="fixed top-0 left-0 z-50 w-screen h-screen flex items-center justify-center bg-gray-100 opacity-80">
                <div class="rounded-2xl items-center">
                    <div class="loader-dots block relative w-40 px-7">
                        <img src="{{ url('gifs/LOGO-SORTEO-NEXT.gif') }}" class="w-full">
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if ($open)
        <!-- modal -->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">
                {{__('Premio')}}
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <x-jet-label for="name" value="{{ __('Premio a Sortear') }}" />
                        <x-jet-input id="name" class="mt-1 focus:ring-next-500" type="text"
                            wire:model.defer="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    <div class="flex flex-col">
                        <x-jet-label for="description" value="{{ __('Descripción del Premio') }}" />
                        <x-jet-input id="description" class="mt-1 focus:ring-next-500" type="text"
                            wire:model.defer="description" />
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    <div class="flex flex-col">
                        <x-jet-label for="image" value="{{ __('Imagen') }}" />
                        <x-jet-input id="{{ rand() }}" class="mt-1 focus:ring-next-500" type="file"
                            wire:model.defer="image" />
                        <!--verificar la imagen que se esta subiendo, en caso de tener un valor de imagen se muestra la imagen -->
                        @if ($image)
                            @php
                                if ($event_id != null && file_exists('storage/events/' . $image)) {
                                    $url = asset('storage/events/' . $image);
                                } else {
                                    $url = $image->temporaryUrl();
                                }
                            @endphp
                            <img src="{{ $url }}" class="p-2 mx-auto" alt="" style="max-height: 400px; max-width: 400px;">
                        @endif
                        <x-jet-input-error for="image" class="mt-2" />
                    </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
