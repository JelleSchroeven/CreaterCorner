<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Veelgestelde vragen</h1>

        <!-- Filter & Search -->
        <div class="flex space-x-2 mb-4">
            <select id="category-filter" class="border rounded px-2 py-1">
                <option value="">Alle categorieën</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="text" id="search" placeholder="Zoek FAQ..." class="border rounded px-2 py-1 flex-1">
        </div>

        <!-- FAQ Lijst -->
        <div id="faq-list" class="space-y-2">
            @foreach($faqs as $faq)
                <div class="bg-white shadow rounded-lg">
                    <button class="w-full text-left px-4 py-3 font-semibold focus:outline-none toggle-answer flex justify-between items-center">
                        {{ $faq->question }}
                        <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-4 py-2 hidden answer text-gray-700">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const faqList = document.getElementById('faq-list');
        const searchInput = document.getElementById('search');
        const categoryFilter = document.getElementById('category-filter');

        // Toggle functie voor antwoorden
        function bindToggle(button){
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.classList.toggle('hidden');
                const svg = button.querySelector('svg');
                svg.classList.toggle('rotate-180');
            });
        }

        // Bind bestaande FAQ’s
        document.querySelectorAll('.toggle-answer').forEach(bindToggle);

        // AJAX functie om gefilterde FAQ's op te halen
        async function fetchFilteredFaqs(){
            const search = encodeURIComponent(searchInput.value);
            const category = categoryFilter.value;

            const res = await fetch(`{{ route('faqs.filter.public') }}?search=${search}&category_id=${category}`);
            if(!res.ok) return;
            const data = await res.json();

            faqList.innerHTML = '';
            data.forEach(faq => {
                const div = document.createElement('div');
                div.className = 'bg-white shadow rounded-lg';
                div.innerHTML = `
                    <button class="w-full text-left px-4 py-3 font-semibold focus:outline-none toggle-answer flex justify-between items-center">
                        ${faq.question}
                        <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-4 py-2 hidden answer text-gray-700">
                        ${faq.answer}
                    </div>
                `;
                faqList.appendChild(div);
                bindToggle(div.querySelector('.toggle-answer'));
            });
        }

        // Event listeners
        searchInput.addEventListener('input', fetchFilteredFaqs);
        categoryFilter.addEventListener('change', fetchFilteredFaqs);
    </script>
</x-app-layout>
