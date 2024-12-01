

<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{route('Home')}}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images\Shopedia Logo\4x\Layer 1@4x.png') }}" class="h-8" alt="Shopedia" />
                <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo"
                            class="h-12 transition-transform duration-300 hover:scale-115">
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                    <a href="https://www.instagram.com/andiriswandaa/" class="hover:underline">Instagram</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="{{route('Home')}}" class="hover:underline">Shopedia™</a>. All Rights Reserved.</span>
    
    </div>
</footer>

