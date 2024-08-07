<div wire:init="loadItems" class="m-3">
    <!-- button to create event -->
    <div class="flex justify-end">
        <button wire:click="resetSorteos"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-3 mx-1">Reiniciar
            Sorteos</button>
        <button wire:click="create"
            class="bg-next-500 hover:bg-next-700 text-white font-bold py-2 px-4 rounded mb-3 mx-1">Crear Premio</button>
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
                            Ganador</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $item)
                        <tr wire:key="{{ $item->id }}">
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
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                @if ($item->sorteado() != null && $item->sorteado() != null)
                                    {{ $item->sorteado()->ticket->ticket}} -
                                    {{ $item->sorteado()->ticket->user->name}}
                                @else
                                    <span class="ml-3 font-bold text-gray-900"> Sin Ganador</span>
                                @endif
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
                                        <div wire:click="edit('{{ $item->id }}')" @click="open = false"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:bg-gray-500 text-blueGray-700 cursor-pointer">
                                            Editar
                                        </div>
                                        @if ($item->image != null && $item->active && $item->sorteado() == null)
                                            <div wire:click="sorteo('{{ $item->id }}')" @click="open = false"
                                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-next-500 hover:bg-next-700 text-blueGray-700 cursor-pointer">
                                                Sortear
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div
                                class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                                {{ $events->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
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
            <x-next.next-loader />
        @endif
        <div class="hidden" wire:loading wire:target="resetSorteos,changeStatus" wire:loading.class="block">
            <x-next.next-loader />
        </div>
    </div>
    @if ($open)
        <!-- modal -->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">
                {{ __('Premio') }}
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
                            <img src="{{ $url }}" class="p-2 mx-auto" alt=""
                                style="max-height: 400px; max-width: 400px;">
                        @endif
                        <x-jet-input-error for="image" class="mt-2" />
                    </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="closeModal">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
    @if ($showSorteo)
        <!-- modal -->
        <x-jet-dialog-modal wire:model="showSorteo">
            <x-slot name="title">
                {{ __('Sorteo de ') . $premio->name }}
            </x-slot>
            <x-slot name="content">
                @php
                    $url = asset('storage/events/' . $premio->image);
                @endphp
                <div class="relative flex flex-col">
                    <img src="{{ $url }}" class="p-2 mx-auto" alt=""
                        style="max-height: 400px; max-width: 400px;">
                    @if ($ganador != null)
                        {{-- darle clase de texto borroso --}}
                        <div id="winner" class="blur-sm">
                            <h1 class="text-center text-2xl font-bold">Ganador</h1>
                            <div class="flex justify-center">
                                <div class="flex flex-col items-center">
                                    <span id="winner-ticket" class="ml-3 font-bold text-gray-900">
                                        @if ($premio->active == false && $ganador != null)
                                            {{ $ganador->ticket }}
                                        @endif
                                    </span>
                                    <span id="winner-name" class="ml-3 font-bold text-gray-900">
                                        @if ($premio->active == false && $ganador != null)
                                            {{ $ganador->user->name }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="rulet" class="hidden absolute top-0 right-0 h-full w-full bg-white opacity-75">
                        <img src="{{ asset('gifs/RULETA.gif') }}" alt="" class="h-full w-full">
                    </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="cerrarSorteo">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>
                @if ($premio->active)
                    <x-jet-button class="ml-2" onclick="ruleta()" wire:click="sortear"
                        wire:loading.attr="disabled">
                        {{ __('Sortear') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('ruleta', (response) => {
                divruleta = document.getElementById('rulet');
                divruleta.classList.remove('hidden');
                setTimeout(() => {
                    divwinner = document.getElementById('winner');
                    // console.log(divwinner);
                    divwinner.classList.remove('blur-sm');
                    divruleta.classList.add('hidden');
                    document.getElementById('winner-ticket').innerText = response.ticket;
                    document.getElementById('winner-name').innerText = response.user.name;
                    poof(true);
                }, 5000);
            })
        });
    </script>
</div>
