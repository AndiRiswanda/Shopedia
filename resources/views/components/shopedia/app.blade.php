<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shopedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @stack('styles')
</head>

<body class="font-sans antialiased bg-purple-50">
    {{ $slot }}
    @stack('scripts')
    
    <!-- Footer -->
    <footer class="mt-auto bg-gray-200 text-gray-600 w-full py-4">
        <div class="container mx-auto px-6 text-center">
            © 2024 Shopedia - All Rights Reserved.
        </div>
    </footer>
    </div>
</body>

</html>
