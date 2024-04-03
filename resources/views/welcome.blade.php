<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center w-full">
                <div class="flex flex-col gap-3 items-center p-5 xl:p-8 shadow-sm shadow-next-500 rounded-md my-3 w-96">
                    <img src="{{ asset('img/LOGO_SORTEO_NEXT_RGB_WEB.png') }}" alt="Logo" class="sm:w-60 w-48">
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ $premios }} Premios
                    </h2>
                    <div class="w-full md:w-80 flex items-center justify-center">
                        <section class="flex flex-col items-center justify-center w-full"
                            @keydown.arrow-right="state.usedKeyboard = true;updateCurrent(nextSlide)"
                            @keydown.arrow-left="state.usedKeyboard = true;updateCurrent(previousSlide)"
                            @keydown.window.tab="state.usedKeyboard = true" x-data="testimonialSlideshow(slides)"
                            x-title="Quotes Slideshow" x-init="setup()">
                            <div tabindex="1" class="relative w-full rounded-2xl overflow-hidden mb-6 bg-gray-300"
                                :class="{ 'focus:outline-none': !state.usedKeyboard }">
                                <template x-for="(slide, index) in slides" :key="slide.id">
                                    <div :aria-hidden="(state.order[state.currentSlide] != slide.id).toString()">
                                        <div x-show="state.order[state.currentSlide] == slide.id" :x-ref="slide.id"
                                            :x-transition:enter="transitions('enter')"
                                            :x-transition:enter-start="transitions('enter-start')"
                                            :x-transition:enter-end="transitions('enter-end')"
                                            :x-transition:leave="transitions('leave')"
                                            :x-transition:leave-start="transitions('leave-start')"
                                            :x-transition:leave-end="transitions('leave-end')">
                                            <img :src="slide.image" :alt="'Slide ' + (index + 1)"
                                                class="w-full rounded-2xl" :class="{ 'animate-pulse': !state.moving }"
                                                :style="`animation-duration:${attributes.timer}ms;`">
                                        </div>
                                    </div>
                                </template>
                                <div x-cloak class="w-full h-full absolute top-0 ">
                                    <div class="bg-next-500 h-full opacity-20" :class="{ 'progress': !state.moving }"
                                        :style="`animation-duration:${attributes.timer}ms;`">
                                    </div>
                                </div>
                            </div>
                            <div aria-live="polite" aria-atomic="true" class="sr-only"
                                x-text="'Slide ' + (state.currentSlide + 1) + ' of ' + slides.length">
                            </div>
                            <div class="-my-4">
                                <template x-for="(slide, index) in Array.from({ length: slides.length })"
                                    :key="index">
                                    <button
                                        class=" text-white inline-flex items-center justify-center bg-gray-600 hover:bg-next-500 w-3 h-3 m-[1px] rounded-full"
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
                    @include('layouts.info-event')

                    <div class="w-full flex items-center justify-center mt-1 h-16">
                        <a href="{{ route('register.form') }}"
                            class="m-auto w-64 h-12 py-2 text-3xl font-bold leading-none text-white transition uppercase text-center
                        hover:w-full hover:h-full hover:py-4
                                duration-300 rounded-2xl hover:bg-next-600 focus:ring-4 focus:ring-next-100 bg-next-500">
                            {{ __('Participar') }}
                        </a>
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
                    timer: 4000,
                },
                slides: [],
                setup() {
                    this.slides = slides.map((slide, index) => {
                        slide.id = index + Date.now();
                        return slide
                    })

                    // Cache the original order so that we can reorder on transition (to skip inbetween slides)
                    this.state.order = this.slides.map(slide => slide.id)
                    const newSlideOrder = this.slides.filter(slide => this.current.id != slide.id)
                    newSlideOrder.unshift(this.current)
                    this.slides = newSlideOrder

                    // Start the autoslide
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

                    // Reorder the slides for a smoother transition
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
                        }, this.attributes.timer - 300)

                    }
                    this.autoplayTimer = setTimeout(() => {
                        this.state.looping = true
                        requestAnimationFrame(this.loop)
                    }, this.attributes.timer -300)
                },
                stopAutoplay() {
                    clearTimeout(this.autoplayTimer)
                    this.autoplayTimer = null
                }
            }
        }
        window.slides = {{ Illuminate\Support\Js::from($images) }};
    </script>
</x-app-layout>
