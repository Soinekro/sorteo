<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-center w-full">
                    <div
                        class="flex flex-col gap-3 items-center p-5 xl:p-8 rounded-md my-3 w-96">
                        <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo" class="sm:w-60 w-48">
                        <h1 class="text-5xl font-bold text-gray-800 uppercase">
                            ¡Gracias!
                        </h1>
                        <p class="text-sm text-gray-800 uppercase text-center">
                            En brebe nos podremos en contacto contigo para ver los detalles de tu participación.
                        </p>
                        @include('layouts.info-event')
                        <a href="https://www.next.net.pe/"
                            class="w-full px-2 py-5 text-3xl font-bold leading-none text-white transition uppercase text-center
                                duration-300 rounded-2xl hover:bg-next-600 focus:ring-4 focus:ring-next-100 bg-next-500 hover:scale-110">
                            {{ __('Visita') }} <br>
                            {{ __(' Nuestra WEB') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
