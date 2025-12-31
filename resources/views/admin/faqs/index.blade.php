<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-6">FAQ Management</h1>

        <!-- Control bar -->
        <div class="flex justify-between mb-4 space-x-2">
            <input type="text" id="search" placeholder="Search FAQ by question or answer..." class="border rounded px-2 py-1 w-1/2">
            
            <select id="category-filter" class="border rounded px-2 py-1">
                <option value="">Alle categorieën</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <div>
                <button id="btn-new-faq" class="bg-blue-500 text-white px-4 py-2 rounded">+ New FAQ</button>
                <button id="btn-new-category" class="bg-green-500 text-white px-4 py-2 rounded ml-2">+ New Category</button>
            </div>
        </div>


        <!-- FAQ List -->
        <div id="faq-list" class="space-y-2 max-h-[60vh] overflow-y-auto">
            @foreach($faqs as $faq)
                <div class="bg-white shadow rounded-lg flex justify-between items-center p-4">
                    <div>
                        <strong>{{ $faq->question }}</strong>
                        <p>{{ $faq->answer }}</p>
                        <p class="text-sm text-gray-500">Category: {{ $faq->category?->name ?? 'None' }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="btn-edit bg-yellow-400 text-white px-3 py-1 rounded" data-id="{{ $faq->id }}">Edit</button>
                        <button class="btn-delete bg-red-500 text-white px-3 py-1 rounded" data-id="{{ $faq->id }}">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Create / Edit FAQ Popup -->
        <div id="faq-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-1/3 relative">
                <h2 id="popup-title" class="text-xl font-bold mb-4">Create FAQ</h2>
                
                <form id="faq-form">
                    <div class="mb-4">
                        <label for="faq_category_id">Category</label>
                        <select name="faq_category_id" id="faq_category_id" class="border rounded w-full px-2 py-1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question" class="border rounded w-full px-2 py-1">
                    </div>

                    <div class="mb-4">
                        <label for="answer">Answer</label>
                        <textarea name="answer" id="answer" class="border rounded w-full px-2 py-1"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" id="btn-cancel" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Create Category Popup -->
        <div id="category-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Create New Category</h2>
                <form id="category-form">
                    <div class="mb-4">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="name" id="category_name" class="border rounded w-full px-2 py-1">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="btn-cancel-category" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        const faqPopup = document.getElementById('faq-popup');
        const btnNewFaq = document.getElementById('btn-new-faq');
        const btnCancelFaq = document.getElementById('btn-cancel');

        const categoryPopup = document.getElementById('category-popup');
        const btnNewCategory = document.getElementById('btn-new-category');
        const btnCancelCategory = document.getElementById('btn-cancel-category');

        // --- Popups open/close ---
        btnNewFaq.addEventListener('click', () => {
            document.getElementById('faq-form').reset();
            document.getElementById('popup-title').textContent = 'Create FAQ';
            delete document.getElementById('faq-form').dataset.id; // clear id
            faqPopup.classList.remove('hidden');
        });

        btnCancelFaq.addEventListener('click', () => faqPopup.classList.add('hidden'));
        faqPopup.addEventListener('click', e => { if(e.target === faqPopup) faqPopup.classList.add('hidden'); });

        btnNewCategory.addEventListener('click', () => {
            document.getElementById('category-form').reset();
            categoryPopup.classList.remove('hidden');
        });

        btnCancelCategory.addEventListener('click', () => categoryPopup.classList.add('hidden'));
        categoryPopup.addEventListener('click', e => { if(e.target === categoryPopup) categoryPopup.classList.add('hidden'); });

        // --- Nieuwe categorie ---
        document.getElementById('category-form').addEventListener('submit', function(e){
            e.preventDefault();
            const name = document.getElementById('category_name').value;

            fetch("{{ route('admin.faq-categories.store') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ name })
            })
            .then(res => res.json())
            .then(data => {
                categoryPopup.classList.add('hidden');

                // Voeg toe aan dropdown
                const select = document.getElementById('faq_category_id');
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.name;
                option.selected = true;
                select.appendChild(option);
            })
            .catch(err => { alert('Er is iets misgegaan.'); console.error(err); });
        });

        // --- Functie om Edit knop te binden ---
        function bindEditButton(button){
            button.addEventListener('click', () => {
                const faqId = button.dataset.id;

                fetch(`/admin/faqs/${faqId}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('popup-title').textContent = 'Edit FAQ';
                        document.getElementById('faq_category_id').value = data.faq_category_id;
                        document.getElementById('question').value = data.question;
                        document.getElementById('answer').value = data.answer;
                        document.getElementById('faq-form').dataset.id = faqId;
                        faqPopup.classList.remove('hidden');
                    });
            });
        }

        // Bind bestaande knoppen
        document.querySelectorAll('.btn-edit').forEach(button => bindEditButton(button));

        // --- FAQ submit (Create / Update) ---
        document.getElementById('faq-form').addEventListener('submit', function(e){
            e.preventDefault();

            const faqId = this.dataset.id;
            const faq_category_id = document.getElementById('faq_category_id').value;
            const question = document.getElementById('question').value;
            const answer = document.getElementById('answer').value;

            let url = "{{ route('admin.faqs.store') }}";
            let method = 'POST';
            if(faqId){
                url = `/admin/faqs/${faqId}`;
                method = 'PATCH';
            }

            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ faq_category_id, question, answer })
            })
            .then(res => res.json())
            .then(data => {
                faqPopup.classList.add('hidden');

                if(faqId){
                    // Update bestaande FAQ in lijst
                    const div = document.querySelector(`.btn-edit[data-id='${faqId}']`).closest('div.bg-white');
                    div.querySelector('strong').textContent = data.question;
                    div.querySelector('p').textContent = data.answer;
                    div.querySelector('.text-sm').textContent = `Category: ${data.category ? data.category.name : ''}`;
                } else {
                    // Voeg nieuwe FAQ toe aan lijst
                    const faqList = document.getElementById('faq-list');
                    const div = document.createElement('div');
                    div.className = "bg-white shadow rounded-lg flex justify-between items-center p-4";
                    div.innerHTML = `
                        <div>
                            <strong>${data.question}</strong>
                            <p>${data.answer}</p>
                            <p class="text-sm text-gray-500">Category: ${data.category ? data.category.name : ''}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="btn-edit bg-yellow-400 text-white px-3 py-1 rounded" data-id="${data.id}">Edit</button>
                            <button class="btn-delete bg-red-500 text-white px-3 py-1 rounded" data-id="${data.id}">Delete</button>
                        </div>
                    `;
                    faqList.prepend(div);

                    // Bind Edit knop van nieuwe FAQ
                    bindEditButton(div.querySelector('.btn-edit'));
                }
            })
            .catch(err => { alert('Er is iets misgegaan.'); console.error(err); });
        });

        // --- Delete FAQ ---
        function bindDeleteButton(button){
            button.addEventListener('click', () => {
                const faqId = button.dataset.id;
                if(!confirm('Weet je zeker dat je deze FAQ wilt verwijderen?')) return;

                fetch(`/admin/faqs/${faqId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => {
                    if(res.ok){
                        // Verwijder de FAQ uit de lijst
                        const div = button.closest('div.bg-white');
                        div.remove();
                    } else {
                        alert('Er is iets misgegaan bij het verwijderen.');
                    }
                })
                .catch(err => { console.error(err); alert('Er is iets misgegaan.'); });
            });
        }

        // Bind bestaande Delete knoppen
        document.querySelectorAll('.btn-delete').forEach(button => bindDeleteButton(button));

        //search / filter 
        const searchInput = document.getElementById('search');
        const categoryFilter = document.getElementById('category-filter');

        function fetchFilteredFaqs() {
            const search = searchInput.value;
            const category_id = categoryFilter.value;

            fetch(`{{ route('admin.faqs.filter') }}?search=${encodeURIComponent(search)}&category_id=${category_id}`)
                .then(res => res.json())
                .then(data => {
                    const faqList = document.getElementById('faq-list');
                    faqList.innerHTML = '';

                    data.forEach(faq => {
                        const div = document.createElement('div');
                        div.className = "bg-white shadow rounded-lg flex justify-between items-center p-4";
                        div.innerHTML = `
                            <div>
                                <strong>${faq.question}</strong>
                                <p>${faq.answer}</p>
                                <p class="text-sm text-gray-500">Category: ${faq.category ? faq.category.name : 'None'}</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="btn-edit bg-yellow-400 text-white px-3 py-1 rounded" data-id="${faq.id}">Edit</button>
                                <button class="btn-delete bg-red-500 text-white px-3 py-1 rounded" data-id="${faq.id}">Delete</button>
                            </div>
                        `;
                        faqList.appendChild(div);

                        // Bind events
                        bindEditButton(div.querySelector('.btn-edit'));
                        bindDeleteButton(div.querySelector('.btn-delete'));
                    });
                });
        }

        // Event listeners
        searchInput.addEventListener('input', fetchFilteredFaqs);
        categoryFilter.addEventListener('change', fetchFilteredFaqs);

    </script>


</x-app-layout>
