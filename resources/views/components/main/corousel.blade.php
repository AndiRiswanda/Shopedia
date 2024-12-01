<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <div id="default-carousel" class="relative w-full group" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div
            class="relative h-56 md:h-[500px] overflow-hidden rounded-2xl shadow-2xl transition-all duration-300 group-hover:shadow-xl">
            <!-- BANNER FIGURE -->
            <a href="{{ route('category.show', ['category' => 3]) }}">
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/Figures Banner.png') }}"
                        class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 
                    transform transition-transform duration-1000 ease-in-out"
                        alt="Carousel Image 1">
                    <div class="absolute inset-0 bg-black opacity-20"></div>
                    <div class="absolute bottom-10 left-10 text-white p-6 bg-black/30 backdrop-blur-sm rounded-xl">
                        <h2 class="text-xl font-bold mb-2"></h2>
                        <p class="text-xl opacity-80">Explore Our Latest Collection</p>
                    </div>
                </div>
            </a>

            <!-- Item 2 -->
            <a href="{{ route('category.show', ['category' => 1]) }}">
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/BackroundForBannerSAMSUNG.jpg') }}"
                    class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 
                transform transition-transform duration-1000 ease-in-out"
                    alt="Carousel Image 2">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div
                    class="absolute bottom-10 right-10 text-white p-6 bg-black/30 backdrop-blur-sm rounded-xl text-right">
                    <h2 class="text-3xl font-bold mb-2">Exclusive Offers Await</h2>
                    <p class="text-xl opacity-80">Limited Time Promotions</p>
                </div>
            </div>
            </a>
            <!-- Item 3 -->
            <a href="{{ route('category.show', ['category' => 2]) }}">
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/BackroundForBannerNIKE.jpg') }}"
                    class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 
                            transform transition-transform duration-1000 ease-in-out"
                    alt="Carousel Image 2">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div
                    class="absolute bottom-10 right-10 text-white p-6 bg-black/30 backdrop-blur-sm rounded-xl text-right">
                    <h2 class="text-3xl font-bold mb-2">For The Stylish One</h2>
                    <p class="text-xl opacity-80">Limited Time Promotions</p>
                </div>
            </div>
        </div>
        </a>
        
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>

            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>

            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>

        </button>
    </div>
