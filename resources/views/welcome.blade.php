<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-center w-full">
                    <div class="flex flex-col gap-3 items-center p-5 xl:p-8 shadow-sm shadow-next-500 rounded-md my-3">
                        <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo"
                            class="h-full sm:w-56 md:max-w-72 w-48 sm:h-56 md:max-h-72">
                        <h2 class="text-3xl font-bold text-gray-800">
                            {{ $premios }} Premios
                        </h2>
                        <div id="default-carousel" x-data="{
                            currentIndex: 0,
                            images: {{ json_encode($images) }},
                            startTimer() {
                                this.timer = setInterval(() => {
                                    this.next();
                                }, 3000); // Cambia cada 3 segundos
                            },
                            stopTimer() {
                                clearInterval(this.timer);
                                this.startTimer(); // Reinicia el temporizador
                            },
                            next() {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                            },
                            prev() {
                                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                            }
                        }" x-init="startTimer()" class="w-full">
                            <!-- Carousel wrapper -->
                            <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-72 2xl:h-72">
                                <!-- Carousel items -->
                                <template x-for="(image, index) in images" :key="index">
                                    <div x-show="currentIndex === index" class="duration-700 ease-in-out">
                                        <span
                                            class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First
                                            Slide</span>
                                        <img :src="image" :alt="'Slide ' + (index + 1)"
                                            class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 rounded-2xl">
                                    </div>
                                </template>
                                <!-- Slider controls -->
                                <button type="button"
                                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                    @click="stopTimer(); prev()" data-carousel-prev>
                                    <span
                                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7">
                                            </path>
                                        </svg>
                                        <span class="hidden">Previous</span>
                                    </span>
                                </button>
                                <button type="button"
                                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                    @click="stopTimer(); next()" data-carousel-next>
                                    <span
                                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                        <span class="hidden">Next</span>
                                    </span>
                                </button>
                            </div>
                            <!-- Slider indicators center div -->
                            <div class="flex items-center justify-center mt-2 space-x-3">
                                <template x-if="images.length <= 3">
                                    <!-- Si hay 3 o menos imágenes, mostrar todos los botones -->
                                    <template x-for="(image, index) in images" :key="index">
                                        <button type="button"
                                            :class="{
                                                'bg-next-500': currentIndex === index,
                                                'bg-gray-700': currentIndex !== index
                                            }"
                                            class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                                            @click="stopTimer(); currentIndex = index"
                                            :data-carousel-slide-to="index"></button>
                                    </template>
                                </template>
                                <template x-if="images.length > 3">
                                    <!-- Si hay más de 3 imágenes, mostrar solo los botones cercanos -->
                                    <template x-for="(image, index) in images" :key="index">
                                        <template
                                            x-if="Math.abs(currentIndex - index) <= 1 || index === 0 || index === images.length - 1">
                                            <button type="button"
                                                :class="{
                                                    'bg-next-500': currentIndex === index,
                                                    'bg-gray-700': currentIndex !== index
                                                }"
                                                class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                                                @click="stopTimer(); currentIndex = index"
                                                :data-carousel-slide-to="index"></button>
                                        </template>
                                    </template>
                                </template>
                            </div>
                        </div>
                        @include('layouts.info-event')

                        <a href="{{ route('register.form') }}"
                            class="w-full px-2 py-5 text-3xl font-bold leading-none text-white transition uppercase text-center
                                duration-300 md:w-96 rounded-2xl hover:bg-next-600 focus:ring-4 focus:ring-next-100 bg-next-500">
                            {{ __('Participar') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
