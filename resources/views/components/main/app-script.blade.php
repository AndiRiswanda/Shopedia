<script>
    document.getElementById('cart-button').addEventListener('click', function() {
        window.location.href = '{{ route('cart.index') }}';
    });

    // subtle hover animations
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.classList.add('transform', 'transition-all', 'duration-300', 'hover:scale-[1.02]',
            'hover:shadow-lg');
    });

    // Add scroll reveal animations
    const scrollElements = document.querySelectorAll('.scroll-reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    });
    scrollElements.forEach(el => observer.observe(el));
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>