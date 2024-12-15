@props(['store'])
<div class="relative">
    <div class="bg-gradient-to-r from-purple-100 to-purple-700 h-40 md:h-48 flex items-center justify-center text-white">
        <div class="absolute inset-0 bg-cover bg-center opacity-30"
            style="background-position: center; background-image: url('{{ asset('storage/' . $store->banner_url) }}');" >
        </div>
        <div>
            <h1 class="relative text-3xl md:text-4xl font-bold">{{ Str::ucfirst($store->store_name) }}</h1>
            <h3 class="text-center">{{ Str::ucfirst($store->catch) }}</h3>
        </div>
    </div>
</div>