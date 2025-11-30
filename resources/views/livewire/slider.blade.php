<!-- Hero Section  -->
<section id="home" class="pt-20 md:pt-20 pb-0 px-4 sm:px-6 lg:px-8 bg-white scroll-mt-20">
    <div class="app-container">
        <div class="mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 items-center" x-data="heroSlider">

            <div class="flex flex-col">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-primary mb-3">
                    <span
                        x-html="currentSlide.title?.replace(/\n/g, '<br class=\'hidden sm:block\'><span class=\'block\'>')"></span>
                </h2>
                <p class="text-base md:text-lg text-primary/90 max-w-prose" x-text="currentSlide.sub_title"></p>

                <div class="relative rounded-2xl overflow-hidden shadow-lg mt-6 sm:mt-8 w-full max-w-xl">
                    <div class="p-4 sm:p-5 transition-all duration-700" :style="`background: ${currentSlide.gradient}`">
                        <div class="text-center text-white">
                            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-1 transition-opacity duration-500"
                                :class="{ 'opacity-0': fadeOut, 'opacity-100': !fadeOut }"
                                x-text="currentSlide.small_title">
                            </h3>
                            <p class="text-xs sm:text-sm mb-2 transition-opacity duration-500"
                                :class="{ 'opacity-0': fadeOut, 'opacity-100': !fadeOut }"
                                x-text="currentSlide.small_sub_title">
                            </p>
                            <a :href="currentSlide.link"
                                class="inline-block bg-white text-primary px-4 py-1.5 rounded-full text-sm font-semibold shadow hover:bg-gray-100 transition"
                                x-text="currentSlide.link_name">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden md:block relative w-full h-[360px] lg:h-[420px]">
                <img alt="Hero Food" loading="lazy"
                    class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 w-[70%] max-w-[420px] h-auto rounded-2xl object-cover shadow-xl transition-opacity duration-700"
                    :class="{ 'opacity-0': fadeOut, 'opacity-100': !fadeOut }" :src="getImageUrl(currentSlide.image)">
            </div>
        </div>
    </div>
</section>
<!-- Hero Section  -->

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('heroSlider', () => ({
            sliders: @json($sliders),
            currentIndex: 0,
            fadeOut: false,
            intervalId: null,

            init() {
                if (this.sliders.length > 1) {
                    this.startAutoplay();
                }
            },

            startAutoplay() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, 4000);
            },

            stopAutoplay() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            },

            nextSlide() {
                this.fadeOut = true;

                setTimeout(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.sliders.length;
                    this.fadeOut = false;
                }, 600);
            },

            get currentSlide() {
                return this.sliders[this.currentIndex] || {};
            },

            getImageUrl(image) {
                return `{{ asset('storage') }}${image}`;
            },

            destroy() {
                this.stopAutoplay();
            }
        }));
    });
</script>
