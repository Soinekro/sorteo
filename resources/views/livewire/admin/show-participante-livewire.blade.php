<div wire:init="loadItems" class="m-3">
    <div class="block w-full">
        @if (count($participantes))
            <table class="items-center w-full bg-white">
                <thead>
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            Participante</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            DNI</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                            tickets</th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0
                                    whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participantes as $item)
                        <tr wire:key="participantes-{{ $item->id }}">
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4
                                        text-left flex items-center">
                                <img src="{{ $item->profile_photo_url }}" class="h-12 w-12 rounded-full border"
                                    alt="{{ $item->name }}">
                                <span class="ml-3 font-bold text-gray-900"> {{ $item->name }}</span>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $item->dni }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $item->tickets->count() }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap
                                        p-4 text-left flex items-center">
                                <!-- Contenido de la celda -->
                                <div class="relative min-w-32" x-data="{ open: false }">
                                    <!-- Botón de acción -->
                                    <button type="button" @click="open = ! open"
                                        class="bg-transparent text-gray-700 shadow-md font-bold uppercase px-6
                                                py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear
                                                transition-all duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M6 6H6.00634M6 12H6.00634M6 18H6.00634M11.9968 6H12.0032M11.9968 12H12.0032M11.9968 18H12.0032M17.9937 6H18M17.9937 12H18M17.9937 18H18"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown -->
                                    <div x-show="open" @click.outside="open = false"
                                        class="absolute bg-white text-base z-50 top-full left-0 w-full
                                                whitespace-nowrap rounded shadow-lg"
                                        id="table-dark-1-dropdown-{{ $item->id }}">
                                        <!-- Opciones del dropdown -->
                                        <div wire:click="tickets('{{ $item->id }}')" @click="open = false"
                                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
                                                    bg-transparent hover:bg-gray-500 text-blueGray-700 cursor-pointer">
                                            Ver Tickets
                                        </div>
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
                                {{ $participantes->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        @elseif ($participantes != [])
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
</div>
