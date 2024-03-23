<div>
    <h1 class="text-2xl font-bold text-center text-grey-900 dark:text-grey-100">
        Datos
    </h1>
    <div class="flex items-center justify-center w-full">
        <div>
            <div class="flex items-center p-6 xl:p-10 shadow-sm shadow-next-500 rounded-md">
                <!-- formulario -->
                <form class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl gap-4"
                    wire:submit.prevent="save" wire:loading.class="opacity-50">
                    <div class="flex flex-col justify-between">
                        <input id="dni" type="numeric" placeholder="87654321" class="form-input-next"
                            wire:model="dni" autocomplete="off" />
                        <x-jet-input-error for="dni" class="mt-2 text-red-500" />
                    </div>
                    <div class="flex flex-col justify-between">
                        <input id="name" type="text" placeholder="NOMBRES Y APELLIDOS" class="form-input-next"
                            @if ($name != null) disabled @endif wire:model="name" autocomplete="off" />
                        <x-jet-input-error for="name" class="mt-2 text-red-500" />
                    </div>
                    <div class="flex flex-col justify-between">
                        <input id="phone" type="text" placeholder="CELULAR" class="form-input-next"
                            autocomplete="off" wire:model.defer="phone" />
                        <x-jet-input-error for="phone" class="mt-2 text-red-500" />
                    </div>
                    <div class="flex flex-col justify-between">
                        <input id="email" type="email" placeholder="CORREO ELECTRÓNICO" class="form-input-next"
                            wire:model.defer="email" autocomplete="off" />
                        <x-jet-input-error for="email" class="mt-2 text-red-500" />
                    </div>
                    <div class="flex flex-col justify-between">
                        <select id="cantidad" class="form-input-next" wire:model.defer="cantidad" autocomplete="off">
                            <option value="0">CANTIDAD DE TICKETS</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <x-jet-input-error for="cantidad" class="mt-2 text-red-500" />
                    </div>
                    <div class="flex flex-col justify-between">
                        <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                            <input id="terms" type="checkbox" wire:model="aceptar"
                                class="w-4 h-4 border-2 border-next-500 text-next-600 rounded focus:ring-next-500 dark:focus:ring-next-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                            <p class="ml-2 text-sm leading-relaxed text-gray-900">Aceptas nuestros <button
                                    type="button" wire:click="displayPolicies"
                                    class="font-bold text-gray-700 underline">{{ __('Terminos y condiciones') }}</button>?
                            </p>
                        </label>
                        <x-jet-input-error for="aceptar" class="mt-2 text-red-500" />
                    </div>
                    <button
                        class="w-full px-6 py-5 mb-5 text-xl font-bold leading-none text-white transition
                        duration-300 md:w-96 rounded-2xl hover:bg-next-600 focus:ring-4 focus:ring-next-100 bg-next-500">
                        {{ __('Solicitar') }}
                    </button>
                    <div class="flex items-center justify-center mt-1 text-sm text-gray-900">
                        <p>{{ __('¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}"
                                class="font-bold text-next-500 hover:text-next-600">{{ __('Inicia sesión') }}</a></p>
                    </div>

                    <div class="flex items-center justify-center mt-1 text-sm fill-next-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2" viewBox="0 0 448 512">
                            <path
                                d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                        </svg>
                        <p class="text-4xl text-center text-gray-600">
                            27
                        </p>
                        <div class="flex flex-col ml-2 text-xl text-center text-gray-600">
                            <div class="font-bold">
                                Abril
                            </div>
                            <div class="font-bold">
                                2024
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-1 text-sm fill-next-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2" viewBox="0 0 512 512">
                            <path
                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                        </svg>
                        <p class="text-4xl text-center text-gray-600">
                            08
                        </p>
                        <div class="flex flex-col ml-2 text-xl text-center text-gray-600">
                            <div class="font-bold -rotate-90">
                                P.M.
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-1 text-sm fill-next-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2" viewBox="0 0 512 512">
                            <path
                                d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                        </svg>
                        <div class="flex flex-col ml-2 text-xl text-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-6 mr-2" viewBox="0 0 576 512">
                                <path
                                    d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z" />
                            </svg>
                            <div class="font-bold">
                                streaming
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- terminos y condiciones -->
    @if ($showTerms)
        <x-jet-dialog-modal wire:model="showTerms">
            <x-slot name="title">
                <h2 class="text-lg font-bold text-gray-800">{{ __('Terminos y condiciones') }}</h2>
            </x-slot>
            <x-slot name="content">
                <p class="text-gray-700">
                    {{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec fermentum nunc. Nullam nec fermentum nunc. Nullam nec fermentum nunc.') }}
                </p>
            </x-slot>
            <x-slot name="footer">
                <button wire:click="hidePolicies"
                    class="px-4 py-2 text-sm font-bold text-white bg-next-500 rounded-md hover:bg-next-600">{{ __('Cerrar') }}</button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

    <script>
        //para el dni solo numeros y hasta 8 digitos
        document.getElementById('dni').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 8);
        });
    </script>
</div>
