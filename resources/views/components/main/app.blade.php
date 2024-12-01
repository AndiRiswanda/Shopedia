<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopedia - Shop For Everyone</title>
    <link rel="icon" href="{!! asset('images/Shopedia Logo/1x/Layer 1.png') !!}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .skeleton {
            @apply animate-pulse bg-gray-200 rounded;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafafa;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #a78bfa, #c4b5fd);
        }

        .category-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .flash-deal-timer {
            background: rgba(79, 70, 229, 0.1);
        }

        .elegant-shadow {
            box-shadow: 0 4px 20px rgba(167, 139, 250, 0.1);
        }

        .custom-purple {
            background-color: #8b5cf6;
        }

        .custom-purple-light {
            background-color: #ddd6fe;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    {{-- nav --}}
    <x-main.app-nav />
    {{-- alert --}}
    <x-shopedia.alert />
    {{-- main --}}
    <main class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-purple-100">
                <div class="p-6 text-gray-900">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
    {{-- footer --}}
    <x-main.app-footer />
</body>

<x-main.app-script />

</html>
