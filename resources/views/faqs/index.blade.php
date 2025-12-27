<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Veelgestelde vragen</h1>

        <div class="space-y-2">
            @foreach($faqs as $faq)
                <div class="bg-white shadow rounded-lg">
                    <!-- Vraag knop -->
                    <button class="w-full text-left px-4 py-3 font-semibold focus:outline-none toggle-answer flex justify-between items-center">
                        {{ $faq->question }}
                        <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Antwoord -->
                    <div class="px-4 py-2 hidden answer text-gray-700">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-answer').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.classList.toggle('hidden');

                // Draai het pijltje
                const svg = button.querySelector('svg');
                svg.classList.toggle('rotate-180');
            });
        });
    </script>
</x-app-layout>
