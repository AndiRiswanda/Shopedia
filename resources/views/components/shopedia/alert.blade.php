@if (session('success'))
    <div class="container mx-auto px-6 py-4">
        <div class="bg-purple-100 border border-purple-400 text-purple-700 px-4 py-3 rounded-lg shadow-md" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container mx-auto px-6 py-4">
        <div class="bg-purple-100 border border-purple-400 text-purple-700 px-4 py-3 rounded-lg shadow-md" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif