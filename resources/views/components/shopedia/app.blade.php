<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shopedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>

<body class="bg-gradient-to-br from-purple-100 via-purple-50 to-white min-h-screen">
    {{ $slot }}

    @stack('scripts')
    <!-- Footer -->
    <footer class="mt-auto bg-gray-200 text-gray-600 w-full py-4">
        <div class="container mx-auto px-6 text-center">
            © 2024 Shopedia - All Rights Reserved.
        </div>
    </footer>
</body>

</html>
