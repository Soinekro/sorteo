<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-center w-full">
                    <div class="flex flex-col gap-3 items-center p-5 xl:p-8 shadow-sm shadow-next-500 rounded-md my-3 w-96">
                        <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo" class="sm:w-60 w-48">
                        @livewire('welcome-form-livewire')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
