<div wire:init="loadItems">
    <!-- button to create event -->
    {{-- <div class="flex justify-end">
        <button wire:click="create"
            class="bg-next-500 hover:bg-next-700 text-white font-bold py-2 px-4 rounded my-3">Crear Premio</button>
    </div> --}}
    <div class="block w-full {{-- overflow-x-auto --}}">
        @if (count($solicitudes))
            <table class="items-center w-full bg-white {{-- border-collapse --}}">
                <thead>
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            DNI</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Nombre</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Celular</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Cantidad</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Aceptacion de Terminos</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Registrado en</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Estado</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $item)
                        <tr>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i class="fas fa-circle text-orange-500 mr-2"></i>{{ $item->user->dni }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i class="fas fa-circle text-orange-500 mr-2"></i>{{ $item->user->name }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i class="fas fa-circle text-orange-500 mr-2"></i>{{ $item->user->phone }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i class="fas fa-circle text-orange-500 mr-2"></i>{{ $item->tickets }}
                            </td>
                            <td class="td-table-main">
                                <div class="ml-2">
                                    <button type="button"
                                        class="relative inline-flex items-center cursor-none @if ($item->accepted_terms) fill-next-500 @else fill-red-500 @endif">
                                        @if ($item->accepted_terms)
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
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                a las {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                            </td>
                            <td class="td-table-main">
                                <div class="ml-2">
                                    @if ($item->attended == true)
                                        <span
                                            class="bg-next-100 text-next-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-next-900 dark:text-next-300">
                                            Atendido
                                        </span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                            Pendiente
                                        </span>
                                    @endif
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
                                    @if ($item->attended == false)
                                        <div x-show="open" @click.outside="open = false"
                                            class="{{-- absolute --}} bg-white text-base z-50 top-full
                                                left-0 w-full whitespace-nowrap rounded shadow-lg"
                                            id="table-dark-1-dropdown-{{ $item->id }}">
                                            <!-- Opciones del dropdown -->
                                            <div wire:click="edit({{ $item }})"
                                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-white
                                                        cursor-pointer">
                                                Editar Tickets
                                            </div>
                                        </div>
                                        <div x-show="open" @click.outside="open = false"
                                            class="{{-- absolute --}} bg-white text-base z-50 top-full
                                                left-0 w-full whitespace-nowrap rounded shadow-lg"
                                            id="table-dark-1-dropdown-{{ $item->id }}">
                                            <!-- Opciones del dropdown -->
                                            <div wire:click="generar({{ $item }})"
                                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-white
                                                        cursor-pointer">
                                                Generar Tickets
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if ($solicitudes->hasPages())
                        <tr>
                            <td class="px-6 py-3" colspan="7">
                                {{ $solicitudes->links() }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @elseif ($solicitudes != [])
            <tr>
                <div class="alert-warning" role="alert">
                    <p class="font-bold">No hay Registros</p>
                    <p>Por favor, crea un registro para empezar.</p>
                </div>
            </tr>
        @else
            <x-next.next-loader />
        @endif
    </div>
    @if ($open)
        <!-- modal -->
        <x-jet-dialog-modal wire:model="open">
            <x-slot name="title">
                {{ __('Solicitud') }}
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <x-jet-label for="tickets" value="{{ __('Cantidad') }}" />
                        <x-jet-input id="tickets" class="mt-1 focus:ring-next-500" type="text"
                            wire:model.defer="tickets" />
                        <x-jet-input-error for="tickets" class="mt-2" />
                    </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('open', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
