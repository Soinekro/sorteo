<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Tickets') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-center lg:grid-cols-3 px-10">
            @foreach ($tickets as $item)
                <div class="bg-white relative drop-shadow-2xl  rounded-3xl p-4 m-0.5">
                    <div class="block sm:flex sm:items-center justify-between">
                        <div class="flex items-center  my-1">
                            <span class="mr-3 rounded-full  bg-gray-700 w-8 h-8">
                                <img src="{{ asset('img/imagotipo.png') }}" class="h-8 p-1">
                            </span>
                            <h2 class="font-medium">Sorteo NEXT</h2>
                        </div>
                        <div class="ml-auto text-blue-800">{{ $item->ticket }}</div>
                    </div>
                    <div class="border-b border-dashed border-b-2 mt-1 mb-3 pt-3">
                    </div>
                    <div class="block md:flex md:items-center mb-5 px-5 text-sm">
                        <div class="flex flex-col">
                            <span class="text-sm">Cliente</span>
                            <div class="font-semibold">{{ $item->user->name }}</div>
                        </div>
                        <div class="flex flex-col ml-auto">
                            <span class="text-sm">Celular</span>
                            <div class="font-semibold">
                                {{ $item->user->phone }}
                            </div>

                        </div>
                    </div>
                    <!--datos del evento del sorteo-->
                    <div class="block md:flex md:items-center mb-4 px-5">
                        <div class="flex flex-col text-sm">
                            <span class="">Fecha</span>
                            <div class="font-semibold">11/05/2024</div>

                        </div>
                        <div class="flex flex-col mx-auto text-sm">
                            <span class="">Hora</span>
                            <div class="font-semibold">08:30 PM</div>

                        </div>
                        <div class="flex flex-col text-sm">
                            <span class="">Lugar</span>
                            <div class="font-semibold">Live Facebook</div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full px-10">
            <div class="mt-5 bg-next-300  border-next-900 rounded-xl">
                {{ $tickets->links() }}
            </div>
        </div>
        {{-- paginate --}}
        <div class="w-full mt-6 grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 px-10">
            @foreach ($ofertas_rand as $ofert)
                <img src="{{ asset($ofert) }}" alt="Next Logo" class="w-full h-full rounded-2xl ring ring-next-500">
            @endforeach
        </div>
    </div>
</x-app-layout>
