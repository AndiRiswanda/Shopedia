@props(['user', 'store'])

<header class="bg-white">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="h-12 w-12 md:h-16 md:w-16 rounded-full bg-gray-200 overflow-hidden shadow block">
                <img src="{{asset('storage/' . $store->profile_url)}}" alt="Profile" class="h-full w-full object-cover">
            </a>
            <div>
                <h1 class="text-lg md:text-xl font-semibold text-gray-800">Welcome, {{ $user->name }}</h1>
                <h2 class="text-sm md:text-base text-gray-500">{{ $store->store_name }}</h2>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                Logout
            </button>
        </form>
    </div>
</header>