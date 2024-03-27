
    <div id="default-carousel" x-data="{
        currentIndex: 0,
        images: [
            'https://flowbite.com/docs/images/carousel/carousel-1.svg',
            'https://flowbite.com/docs/images/carousel/carousel-2.svg',
            'https://flowbite.com/docs/images/carousel/carousel-3.svg',
            'https://flowbite.com/docs/images/carousel/carousel-4.svg',
            'https://flowbite.com/docs/images/carousel/carousel-5.svg',
        ],
        startTimer() {
            this.timer = setInterval(() => {
                this.next();
            }, 2000); // Cambia cada 2 segundos
        },
        stopTimer() {
            clearInterval(this.timer);
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        }
    }" x-init="startTimer()" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
            <!-- Carousel items -->
            <template x-for="(image, index) in images" :key="index">
                <div x-show="currentIndex === index" class="duration-700 ease-in-out">
                    <span
                        class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First
                        Slide</span>
                    <img :src="image" :alt="'Slide ' + (index + 1)"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                </div>
            </template>
            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                <template x-for="(image, index) in images" :key="index">
                    <!-- recorrer los slides y hacer un boton por cada uno -->
                    <button type="button"
                        :class="{ 'bg-gray-500': currentIndex === index, 'bg-white': currentIndex !== index }"
                        class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                        @click="stopTimer(); currentIndex = index" :data-carousel-slide-to="index"></button>
                </template>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                @click="stopTimer(); prev()" data-carousel-prev>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
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
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="hidden">Next</span>
                </span>
            </button>
        </div>
    </div>
