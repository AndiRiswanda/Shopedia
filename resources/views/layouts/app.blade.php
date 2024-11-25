<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">

        <!-- Tailwind CSS for additional styling -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-purple: #6b21a8;
                --secondary-purple: #7e22ce;
            }
            body {
                background-color: #f5f3ff;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-purple-50">
        <div class="min-h-screen">
            <!-- Navigation with Purple Theme -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-md border-b border-purple-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-gray-800 text-xl font-bold text-purple-800">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-purple-100">
                        <div class="p-6 text-gray-900">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-purple-800 text-white py-4 mt-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p>&copy; {{ date('Y') }} Shopedia. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <!-- Optional: Subtle Interaction Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const links = document.querySelectorAll('a');
                links.forEach(link => {
                    link.classList.add('text-purple-600', 'hover:text-purple-800', 'transition', 'duration-300');
                });
            });
        </script>
    </body>
</html>