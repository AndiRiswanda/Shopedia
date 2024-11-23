@props(['product'])
<header class="bg-gradient-to-r from-purple-700 to-purple-900 text-white w-full py-4 shadow-lg">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-xl font-bold">{{$product}}</h1>
        <a href="{{ route('store.index') }}"
            class="px-3 py-2 bg-purple-600 hover:bg-purple-700 rounded-full text-sm">
            Back to Dashboard
        </a>
    </div>
</header>