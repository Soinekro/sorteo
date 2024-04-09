<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center w-full">
                <div class="flex flex-col gap-3 items-center p-5 xl:p-8 rounded-md my-3">
                    <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo" class="sm:w-60 w-48">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">

                        @if ($premios > 1)
                            {{ $premios }} Premios
                        @elseif($premios == 1)
                            1 Premio
                        @else
                            Próximamente
                        @endif
                    </h2>
                    @php
                        $class = '';
                        if ($images->count() == 1) {
                            $class = 'lg:grid-cols-1';
                        } elseif ($images->count() == 2) {
                            $class = 'md:grid-cols-2';
                        } else {
                            $class = 'lg:grid-cols-3';
                        }
                    @endphp
                    @if ($images->count() > 0)
                        <div class="grid grid-cols-1 gap-3 {{-- lg:grid-cols-1 --}}">
                            <!-- slider 1 -->
                            <div class="w-56 h-56 xl:h-80 xl:w-80 flex items-center justify-center">
                                <section class="flex flex-col items-center justify-center w-full"
                                    x-show="slides.length > 0"
                                    @keydown.arrow-right="state.usedKeyboard = true;updateCurrent(nextSlide)"
                                    @keydown.arrow-left="state.usedKeyboard = true;updateCurrent(previousSlide)"
                                    @keydown.window.tab="state.usedKeyboard = true" x-data="testimonialSlideshow(slides)"
                                    x-title="Quotes Slideshow" x-init="setup()">
                                    <div tabindex="1"
                                        class="relative w-full rounded-2xl overflow-hidden mb-6 bg-gray-300"
                                        :class="{ 'focus:outline-none': !state.usedKeyboard }">
                                        <template x-for="(slide, index) in slides" :key="slide.id">
                                            <div
                                                :aria-hidden="(state.order[state.currentSlide] != slide.id).toString()">
                                                <div x-show="state.order[state.currentSlide] == slide.id"
                                                    :x-ref="slide.id" :x-transition:enter="transitions('enter')"
                                                    :x-transition:enter-start="transitions('enter-start')"
                                                    :x-transition:enter-end="transitions('enter-end')"
                                                    :x-transition:leave="transitions('leave')"
                                                    :x-transition:leave-start="transitions('leave-start')"
                                                    :x-transition:leave-end="transitions('leave-end')">
                                                    <img :src="slide.image" :alt="'Slide ' + (index + 1)"
                                                        x-show="slides.length > 1" class="w-full rounded-2xl"
                                                        :class="{ 'animate-pulse': !state.moving }"
                                                        :style="`animation-duration:${attributes.timer}ms;`">
                                                    <img :src="slide.image" :alt="'Slide ' + (index + 1)"
                                                        x-show="slides.length == 1"
                                                        class="w-56 h-56 xl:h-80 xl:w-80 rounded-2xl">
                                                </div>
                                            </div>
                                        </template>
                                        <div x-cloak class="w-full h-full absolute top-0" x-show="slides.length > 1">
                                            <div class="bg-next-500 h-full opacity-20"
                                                :class="{ 'progress': !state.moving }"
                                                :style="`animation-duration:${attributes.timer}ms;`">
                                            </div>
                                        </div>
                                    </div>
                                    <div aria-live="polite" aria-atomic="true" class="sr-only"
                                        x-text="'Slide ' + (state.currentSlide + 1) + ' of ' + slides.length">
                                    </div>
                                    <div class="w-full flex flex-row items-center justify-center -my-4" x-show="slides.length > 1">
                                        <template x-for="(slide, index) in Array.from({ length: slides.length })"
                                            :key="index">
                                            <button
                                                class=" text-white bg-gray-600 hover:bg-next-500 w-3 h-3 m-[3px] rounded-full"
                                                style="text-indent:-9999px"
                                                :class="{
                                                    'bg-next-500': state.currentSlide == index,
                                                    'focus:outline-none': !state.usedKeyboard,
                                                }"
                                                @click="stopAutoplay();updateCurrent(index)" x-text="index + 1">
                                            </button>
                                        </template>
                                    </div>
                                </section>
                            </div>
                        </div>
                    @endif

                    @include('layouts.info-event')

                    <div class="relative w-full flex items-center justify-center mt-1 h-16">
                        {{-- hacer un boton que al --}}
                        <button
                            class="w-64 h-12 m-auto text-3xl font-bold text-white text-center
                            transition delay-100 duration-300 uppercase rounded-2xl
                         bg-next-500 hover:bg-next-600 hover:ring-next-100 hover:scale-125">
                            <a href="{{ route('register.form') }}" class="w-full">
                                {{ __('Participar') }}
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.testimonialSlideshow = function(slides) {
            return {
                state: {
                    moving: false,
                    currentSlide: 0,
                    looping: false,
                    order: [],
                    nextSlideDirection: '',
                    userInteracted: false,
                    usedKeyboard: false,
                },
                autoplayTimer: null,
                attributes: {
                    direction: 'right-left',
                    duration: 0,
                    timer: 7000,
                },
                slides: [],
                setup() {
                    this.slides = slides.map((slide, index) => {
                        slide.id = index + Date.now();
                        return slide
                    })

                    this.state.order = this.slides.map(slide => slide.id)
                    const newSlideOrder = this.slides.filter(slide => this.current.id != slide.id)
                    newSlideOrder.unshift(this.current)
                    this.slides = newSlideOrder

                    this.attributes.timer && this.autoPlay()
                },
                get current() {
                    return this.slides.find(slide => slide.id == this.state.order[this.state.currentSlide])
                },
                get previousSlide() {
                    return (this.state.currentSlide - 1) > -1 ? this.state.currentSlide - 1 : this.state
                        .currentSlide
                },
                get nextSlide() {
                    return (this.state.currentSlide + 1) < this.slides.length ? this.state.currentSlide + 1 : this
                        .state.currentSlide
                },
                updateCurrent(nextSlide) {
                    if (nextSlide == this.state.currentSlide) return
                    if (this.state.moving) return
                    this.state.moving = true

                    const next = this.slides.find(slide => slide.id == this.state.order[nextSlide])

                    const newSlideOrder = this.slides.filter(slide => {
                        return ![this.current.id, this.state.order[nextSlide]].includes(slide.id)
                    })

                    const activeSlides = [this.current, next]
                    this.state.nextSlideDirection = nextSlide > this.state.currentSlide ? 'right-to-left' :
                        'left-to-right'

                    newSlideOrder.unshift(...(this.state.nextSlideDirection == 'right-to-left' ? activeSlides :
                        activeSlides.reverse()))
                    this.slides = newSlideOrder
                    this.state.currentSlide = nextSlide
                    setTimeout(() => {
                        this.state.moving = false
                        this.attributes.timer && !this.autoplayTimer && this.autoPlay()
                    }, this.attributes.duration)

                },
                transitions(state, $dispatch) {
                    const rightToLeft = this.state.nextSlideDirection === 'right-to-left'
                    switch (state) {
                        case 'enter':
                            return `transition-all duration-${this.attributes.duration}`
                        case 'enter-start':
                            return rightToLeft ? 'transform translate-x-full' : 'transform -translate-x-full'
                        case 'enter-end':
                            return 'transform translate-x-0'
                        case 'leave':
                            return `absolute top-0 transition-all duration-${this.attributes.duration}`
                        case 'leave-start':
                            return 'transform translate-x-0'
                        case 'leave-end':
                            return rightToLeft ? 'transform -translate-x-full' : 'transform translate-x-full'
                    }
                },
                autoPlay() {
                    this.loop = () => {
                        const next = (this.state.currentSlide === (this.slides.length - 1)) ? 0 : this.state
                            .currentSlide + 1
                        this.updateCurrent(this.state.looping ? next : this.currentSlide)
                        this.autoplayTimer = setTimeout(() => {
                            requestAnimationFrame(this.loop)
                        }, this.attributes.timer - 700)

                    }
                    this.autoplayTimer = setTimeout(() => {
                        this.state.looping = true
                        requestAnimationFrame(this.loop)
                    }, this.attributes.timer - 700)
                },
                stopAutoplay() {
                    clearTimeout(this.autoplayTimer)
                    this.autoplayTimer = null
                }
            }
        }

        imagenes = {{ Illuminate\Support\Js::from($images) }};
        window.slides = imagenes;
        //dividir el array en dos
        // if (imagenes.length > 2) {
        //     let tercio = Math.ceil((imagenes.length - (imagenes.length % 3)) / 3);
        //     let tercio1 = imagenes.slice(0, tercio);
        //     let tercio2 = [];
        //     let tercio3 = [];
        //     if (imagenes.length % 3 != 0) {
        //         tercio2 = imagenes.slice(tercio, (tercio * 2) + 1);
        //         tercio3 = imagenes.slice((tercio * 2) + 1, imagenes.length);
        //     } else {
        //         tercio2 = imagenes.slice(tercio, (tercio * 2));
        //         tercio3 = imagenes.slice((tercio * 2), imagenes.length);
        //     }
        //     window.slides = tercio3;
        //     window.slides2 = tercio2;
        //     window.slides3 = tercio1;
        // } else if (imagenes.length == 2) {
        //     let mitad = Math.ceil(imagenes.length / 2);
        //     let mitad1 = imagenes.slice(0, mitad);
        //     let mitad2 = imagenes.slice(mitad, imagenes.length);
        //     window.slides = mitad1;
        //     window.slides2 = mitad2;
        // } else {
        //     window.slides = imagenes;
        // }
    </script>
</x-app-layout>
