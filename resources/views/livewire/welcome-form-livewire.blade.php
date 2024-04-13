<div>
    <!-- formulario -->
    <form class="flex flex-col h-full w-full pb-6 text-center rounded-3xl gap-4" wire:submit.prevent="save"
        wire:loading.class="opacity-50">
        <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo" class="m-auto sm:w-60 w-48">

        <h1 class="text-2xl font-bold text-center text-grey-900 dark:text-grey-100">
            Datos
        </h1>
        <div class="mx-2">
            <input id="dni" type="numeric" placeholder="87654321*" class="form-input-next" wire:model="dni"
                autocomplete="off" />
            <x-jet-input-error for="dni" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <input id="name" type="text" placeholder="NOMBRES Y APELLIDOS*" class="form-input-next"
                @if ($name != null) disabled @endif wire:model.defer="name" autocomplete="off" />
            <x-jet-input-error for="name" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <input id="phone" type="text" placeholder="CELULAR*" class="form-input-next" autocomplete="off"
            wire:model.defer="phone" />
            <x-jet-input-error for="phone" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <input id="email" type="email" placeholder="CORREO ELECTRÓNICO*" class="form-input-next"
            wire:model.defer="email" autocomplete="off" />
            <x-jet-input-error for="email" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <select id="cantidad" class="form-input-next" wire:model.defer="cantidad" autocomplete="off">
                <option value="0">CANTIDAD DE TICKETS*</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" class="text-center">
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <x-jet-input-error for="cantidad" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <label class="flex flex-inline justify-center cursor-pointer select-none">
                <input id="terms" type="checkbox" wire:model="aceptar"
                    class="w-4 h-4 border-2 border-next-500 text-next-600 rounded focus:ring-next-500 hover:cursor-pointer dark:focus:ring-next-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <p class="ml-2 text-sm leading-relaxed text-gray-900">Acepto <button type="button"
                        wire:click="displayPolicies"
                        class="font-bold text-gray-700 underline">{{ __('Términos y condiciones') }}</button>
                </p>
            </label>
            <x-jet-input-error for="aceptar" class="mt-2 text-red-500" />
        </div>
        <div class="mx-2">
            <div class="w-full flex items-center justify-center mt-1 h-16">
                <button
                    class="w-64 h-12 m-auto text-3xl font-bold text-white text-center
                    transition delay-100 duration-300 uppercase rounded-2xl
                 bg-next-500 hover:bg-next-600 hover:ring-next-100 hover:scale-125">
                    {{ __('Solicitar') }}
                </button>
            </div>
        </div>
        <div class="flex items-center justify-center mt-1 text-sm text-gray-900">
            <p>{{ __('¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}"
                    class="font-bold text-next-500 hover:text-next-600">{{ __('Inicia sesión') }}</a></p>
        </div>

        @include('layouts.info-event')
    </form>
    {{-- terminos y condiciones --}}
    @if ($showTerms)
        <x-jet-dialog-modal wire:model="showTerms">
            <x-slot name="title">
                <h2 class="text-lg font-bold text-gray-800">{{ __('Términos y condiciones') }}</h2>
            </x-slot>
            <x-slot name="content">
                <ul class="list-disc list-inside">
                    <li class="p-2">
                        El Sorteo se realizará mediante sera transmitido <b>en vivo</b>
                        por la plataforma de Facebook(Next Technologies).
                    </li>
                    <li class="p-2">
                        Los nombres de los participantes serán ingresados en la plataforma de sorteos de Next, el cual
                        se realizará mediante la plataforma de sorteos de Next; este premitirá seleccionar a un solo
                        ganador de manera aleatoria por premio seleccionado.
                    </li>
                    <li class="p-2">
                        Se realizará un sorteo por cada premio, el cual se realizará en el orden de los premios.
                    </li>
                    <li class="p-2">
                        El ganador será contactado mediante el correo electrónico y número de celular que proporcionó en
                        el formulario de registro para coordinar la entrega del premio.
                    </li>
                </ul>

            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row justify-center">
                    <button wire:click="hidePolicies"
                        class="px-4 py-2 text-sm font-bold text-white bg-next-500 rounded-md hover:bg-next-600">
                        {{ __('Cerrar') }}
                    </button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
    <script>
        //para el dni solo numeros y hasta 8 digitos
        document.getElementById('dni').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 8);
        });

        //para el telefono solo numeros y hasta 9 digitos
        document.getElementById('phone').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 9);
        });
    </script>
</div>
