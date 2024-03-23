<div wire:init="loadItems">
    <!-- button to create event -->
    <div class="flex justify-end">
        <button wire:click="create"
            class="bg-next-500 hover:bg-next-700 text-white font-bold py-2 px-4 rounded my-3">Crear Evento</button>
    </div>
    <div class="block w-full overflow-x-auto">
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
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                <!-- Contenido de la celda -->
                                <div class="relative">
                                    <!-- Botón de acción -->
                                    <button type="button" onclick="openDropdown({{ $item->id }})"
                                        class="bg-transparent text-gray-700 shadow-md font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M6 6H6.00634M6 12H6.00634M6 18H6.00634M11.9968 6H12.0032M11.9968 12H12.0032M11.9968 18H12.0032M17.9937 6H18M17.9937 12H18M17.9937 18H18"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown -->
                                    <div class="hidden absolute bg-white text-base z-50 top-full left-0 mt-2 w-full whitespace-nowrap rounded shadow-lg"
                                        id="table-dark-1-dropdown-{{ $item->id }}">
                                        <!-- Opciones del dropdown -->
                                        <div wire:click="edit({{ $item }})"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 cursor-pointer">
                                            Editar
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{-- <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right">
                                <div class="block">
                                    <button type="button" onclick="openDropdown({{ $item->id }})"
                                        class="bg-transparent text-gray-700 shadow-md font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M6 6H6.00634M6 12H6.00634M6 18H6.00634M11.9968 6H12.0032M11.9968 12H12.0032M11.9968 18H12.0032M17.9937 6H18M17.9937 12H18M17.9937 18H18"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                        id="table-dark-1-dropdown-{{$item->id}}">
                                        <a href="#pablo"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Action</a><a
                                            href="#pablo"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Another
                                            action</a><a href="#pablo"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Something
                                            else here</a>
                                        <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                                        <a href="#pablo"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Seprated
                                            link</a>
                                    </div>
                                </div>
                            </td> --}}
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
            <!-- pantalla de carga -->
            <div class="fixed top-0 left-0 z-50 w-screen h-screen flex items-center justify-center bg-gray-100 opacity-80"
                {{-- style="background: rgba(0, 0, 0, 0.3);" --}}>
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
                Evento
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <x-jet-label for="name" value="{{ __('Nombre del Evento') }}" />
                        <x-jet-input id="name" class="mt-1 focus:ring-next-500" type="text"
                            wire:model.defer="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    <div class="flex flex-col">
                        <x-jet-label for="description" value="{{ __('Descripción') }}" />
                        <x-jet-input id="description" class="mt-1 focus:ring-next-500" type="text"
                            wire:model.defer="description" />
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    <div class="flex flex-col">
                        <x-jet-label for="image" value="{{ __('Imagen') }}" />
                        <x-jet-input id="{{ rand() }}" class="mt-1 focus:ring-next-500" type="file"
                            wire:model.defer="image" />
                        @if ($image && $event_id == null)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-2" alt=""
                                style="max-height: 200px;">
                        @else
                            <img src="{{ asset('storage/events/' . $image) }}" class="mt-2" alt=""
                                style="max-height: 200px;">
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
    <script>
        function openDropdown(id) {
            var dropdown = document.getElementById('table-dark-1-dropdown-' + id);
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
    </script>
</div>
