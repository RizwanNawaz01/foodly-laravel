  <!-- Hero Section  -->
        <section id="home" class="pt-20 md:pt-20 pb-0 px-4 sm:px-6 lg:px-8 bg-white scroll-mt-20">
        <div class="app-container">
            <div class="mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 items-center">
            <div class="flex flex-col">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-primary mb-3"> Finer, Healthier, Cheaper <br class="hidden sm:block">
                <span class="block"> Pizza, kebabs &amp; more. </span>
                </h2>
                <p class="text-base md:text-lg text-primary/90 max-w-prose"> Where Italian classics and oriental specialties are at home. </p>
                <div class="relative rounded-2xl overflow-hidden shadow-lg mt-6 sm:mt-8 w-full max-w-xl">
                <div class="bg-gradient-to-r from-orange-500 to-yellow-400 p-4 sm:p-5">
                    <div class="text-center text-white transition-opacity duration-500 ease-in-out">
                    <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-1"> 🚚 −10% on delivery </h3>
                    <p class="text-xs sm:text-sm mb-2"> Permanently valid – automatically at checkout. </p>
                    <a href="#menu" class="inline-block bg-white text-primary px-4 py-1.5 rounded-full text-sm font-semibold shadow hover:bg-gray-100 transition"> Order now </a>
                    </div>
                </div>
                </div>
            </div>
            <div class="hidden md:block relative w-full h-[360px] lg:h-[420px]">
                <img alt="Food 1"  id="heroImage" loading="lazy" class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 w-[70%] max-w-[420px] h-auto rounded-2xl object-cover shadow-xl transition-opacity duration-700" src="/images/hero/image-1.png">
            </div>
            </div>
        </div>
        </section>
    <!-- Hero Section  -->


    <script>
        // Hero Image Slider
  document.addEventListener("DOMContentLoaded", () => {
      const heroImage = document.getElementById("heroImage");

      // Add your image paths here
      const images = [
        "/images/hero/image-1.png",
        "/images/hero/image-2.png",
        "/images/hero/image-3.png",
      ];

      let currentIndex = 0;

      setInterval(() => {
        // Fade out
        heroImage.style.opacity = "0";

        setTimeout(() => {
          // Change image
          currentIndex = (currentIndex + 1) % images.length;
          heroImage.src = images[currentIndex];

          // Fade in
          heroImage.style.opacity = "1";
        }, 600); // matches fade duration (1000ms total)
      }, 4000); // change every 4 seconds
    });

    </script>