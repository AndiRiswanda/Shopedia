<x-main.app>

        <x-main.corousel />

        <x-main.flashdeal :products="$products" />

        <script>
            document.getElementById('cart-button').addEventListener('click', function() {
                window.location.href = '{{ route('cart.index') }}';
            });
        </script>

</x-main.app>
