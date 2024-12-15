<!-- resources/views/about.blade.php -->
<x-main.app>
    <!-- Hero Section -->
    <div class="relative h-[30vh] rounded-3xl bg-gradient-to-br from-purple-600 to-purple-800">
        <div class="absolute inset-0 bg-black rounded-3xl opacity-50"></div>
        <div class="relative rounded-3xl container mx-auto px-4 h-full flex items-center">
            <div class="text-white max-w-2xl">
                <h1 class="text-5xl font-bold mb-4">About Shopedia</h1>
                <p class="text-xl opacity-90">Transforming online shopping with innovation and trust</p>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        At Shopedia, we're committed to creating a seamless shopping experience that connects people
                        with quality products. Our platform is built on trust, innovation, and customer satisfaction.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-purple-50 rounded-xl">
                            <div class="text-4xl font-bold text-purple-600 mb-2">{{ $users->count() }}+</div>
                            <div class="text-gray-600">Happy Customers</div>
                        </div>
                        <div class="text-center p-6 bg-purple-50 rounded-xl">
                            <div class="text-4xl font-bold text-purple-600 mb-2">{{ $products->count() }}+</div>
                            <div class="text-gray-600">Products</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/BackroundForBanner2.jpg') }}" alt="Our Mission"
                        class="rounded-2xl shadow-xl">
                    <div class="absolute -bottom-6 -left-6 w-48 h-48 bg-purple-200 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="py-20 bg-gradient-to-br from-purple-50 to-purple-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-heart text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Customer First</h3>
                    <p class="text-gray-600">Your satisfaction is our top priority. We're dedicated to providing
                        exceptional service.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Trust & Security</h3>
                    <p class="text-gray-600">We ensure safe transactions and protect your data with industry-leading
                        security.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-rocket text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Innovation</h3>
                    <p class="text-gray-600">Continuously improving our platform to provide the best shopping
                        experience.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Get in Touch</h2>
                <p class="text-gray-600 mb-8">Have questions? We'd love to hear from you.</p>
                <div class="flex justify-center space-x-6">
                    <a href="mailto:andiriswandalah@gmail.com"
                        class="flex items-center text-purple-600 hover:text-purple-700">
                        <i class="fas fa-envelope mr-2"></i>
                        andiriswandalah@gmail.com
                    </a>

                    <a href="https://github.com/AndiRiswanda/Shopedia" class="hover:underline flex items-center">
                        <i class="fab fa-github mr-2"></i>
                        Git Hub
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-main.app>
