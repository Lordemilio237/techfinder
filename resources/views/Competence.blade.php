@extends('Template')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- ✅ Notification Toast --}}
    <div id="toast" 
         style="display: none; min-width: 350px; border-left: 8px solid #facc15;" 
         class="fixed top-10 right-10 z-[9999] bg-gray-900 px-8 py-5 rounded-r-xl shadow-[0_25px_60px_rgba(0,0,0,0.5)] transition-all duration-500 transform translate-x-10 opacity-0">
        <div class="flex items-center gap-4">
            <div id="toast-icon" class="text-2xl"></div>
            <div id="toast-message" class="text-yellow-400 font-black uppercase tracking-wider text-sm"></div>
        </div>
    </div>

    {{-- Entête --}}
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion des Compétences</h1>
        <p class="text-gray-500 text-sm">Consultez et gérez le référentiel technique.</p>
    </div>

    {{-- ✅ Formulaire AJOUTER --}}
    <div id="form-ajouter" class="bg-white shadow-sm rounded-xl p-6 mb-8 border border-gray-200">
        <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Nouvelle entrée</h2>
        <form id="add-form">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-4">
                    <label class="block text-[10px] font-bold text-gray-500 mb-1 uppercase">Code</label>
                    <input id="add-code" type="text" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-blue-500 outline-none transition-all">
                </div>
                <div class="md:col-span-8">
                    <label class="block text-[10px] font-bold text-gray-500 mb-1 uppercase">Libellé</label>
                    <input id="add-label" type="text" required class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-blue-500 outline-none transition-all">
                </div>
                <div class="md:col-span-12">
                    <label class="block text-[10px] font-bold text-gray-500 mb-1 uppercase">Description</label>
                    <textarea id="add-desc" rows="3" class="w-full border-2 border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-blue-500 outline-none transition-all"></textarea>
                </div>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-[10px] text-gray-400 italic">* Tous les champs sont obligatoires</p>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
                    <span>+</span> Nouvelle Compétence
                </button>
            </div>
        </form>
    </div>

    {{-- ✅ Formulaire MODIFIER --}}
    <div id="form-edit-wrap" class="hidden bg-yellow-50 border-2 border-yellow-200 shadow-md rounded-xl p-6 mb-8">
        <h2 class="text-[10px] font-bold text-yellow-700 uppercase tracking-widest mb-4">Modification en cours</h2>
        <form id="form-edit" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
            <input type="hidden" id="edit-code">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-bold text-yellow-600 mb-1 uppercase">Code</label>
                <input id="edit-code-display" type="text" disabled class="w-full border border-yellow-200 bg-yellow-100/50 rounded-lg px-3 py-2 text-sm text-yellow-800">
            </div>
            <div class="md:col-span-3">
                <label class="block text-[10px] font-bold text-yellow-600 mb-1 uppercase">Libellé</label>
                <input id="edit-label" type="text" required class="w-full border-2 border-yellow-300 rounded-lg px-3 py-2 text-sm focus:border-yellow-500 outline-none">
            </div>
            <div class="md:col-span-4">
                <label class="block text-[10px] font-bold text-yellow-600 mb-1 uppercase">Description</label>
                <input id="edit-desc" type="text" class="w-full border-2 border-yellow-300 rounded-lg px-3 py-2 text-sm focus:border-yellow-500 outline-none">
            </div>
            <div class="md:col-span-3 flex gap-2">
                <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg font-bold text-xs">Enregistrer</button>
                <button type="button" id="btn-annuler-edit" class="px-4 py-2 bg-white border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 text-xs font-bold">Annuler</button>
            </div>
        </form>
    </div>

    {{-- ✅ Liste des Compétences --}}
    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Code</th>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Compétence</th>
                    <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Description</th>
                    <th class="px-6 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody id="competences-tbody" class="divide-y divide-gray-100">
                @foreach ($competence_list as $competence)
                <tr id="row-{{ $competence->code_comp }}" class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ $competence->code_comp }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800 cell-label">{{ $competence->label_comp }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 cell-desc">{{ $competence->description_comp }}</td>
                    <td class="px-6 py-4">
                        {{-- ✅ Groupe d'actions mieux organisé --}}
                        <div class="flex items-center justify-end gap-3">
                            <button class="btn-modifier text-blue-600 hover:text-white hover:bg-blue-600 border border-blue-600 px-3 py-1 rounded-md font-bold text-[10px] uppercase transition-all" 
                                data-code="{{ $competence->code_comp }}" 
                                data-label="{{ $competence->label_comp }}" 
                                data-description="{{ $competence->description_comp }}">
                                Modifier
                            </button>
                            <button class="btn-supprimer text-red-500 hover:text-white hover:bg-red-500 border border-red-500 px-3 py-1 rounded-md font-bold text-[10px] uppercase transition-all" 
                                data-code="{{ $competence->code_comp }}">
                                Supprimer
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($competence_list->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total: {{ $competence_list->total() }}</span>
            <div class="text-xs">{{ $competence_list->links() }}</div>
        </div>
        @endif
    </div>
</main>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    function toast(msg, ok = true) {
        const el = document.getElementById('toast');
        const msgEl = document.getElementById('toast-message');
        const iconEl = document.getElementById('toast-icon');
        msgEl.textContent = msg;
        iconEl.textContent = ok ? '⚠️' : '🚫';
        el.style.borderLeftColor = ok ? '#facc15' : '#ef4444'; 
        msgEl.style.color = ok ? '#facc15' : '#f87171';
        el.style.display = 'block';
        setTimeout(() => {
            el.classList.remove('opacity-0', 'translate-x-10');
            el.classList.add('opacity-100', 'translate-x-0');
        }, 10);
        setTimeout(() => {
            el.classList.replace('opacity-100', 'opacity-0');
            el.classList.replace('translate-x-0', 'translate-x-10');
            setTimeout(() => { el.style.display = 'none'; }, 500);
        }, 4000);
    }

    // FORMULAIRE AJOUTER
    document.getElementById('add-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const body = {
            code_comp: document.getElementById('add-code').value.trim(),
            label_comp: document.getElementById('add-label').value.trim(),
            description_comp: document.getElementById('add-desc').value.trim()
        };
        try {
            const res = await fetch('/api/competences', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify(body)
            });
            if (res.ok) {
                toast("COMPÉTENCE ENREGISTRÉE !");
                setTimeout(() => { location.reload(); }, 1200);
            } else {
                const err = await res.json();
                toast(err.message || "DONNÉES INVALIDES", false);
            }
        } catch (e) { toast("ERREUR DE CONNEXION", false); }
    });

    // ACTIONS TABLE
    document.getElementById('competences-tbody').addEventListener('click', (e) => {
        const btnEdit = e.target.closest('.btn-modifier');
        const btnSuppr = e.target.closest('.btn-supprimer');

        if (btnEdit) {
            const d = btnEdit.dataset;
            document.getElementById('edit-code').value = d.code;
            document.getElementById('edit-code-display').value = d.code;
            document.getElementById('edit-label').value = d.label;
            document.getElementById('edit-desc').value = d.description;
            document.getElementById('form-edit-wrap').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        if (btnSuppr) {
            const code = btnSuppr.dataset.code;
            if (confirm("Voulez-vous vraiment supprimer la compétence " + code + " ?")) {
                fetch(`/api/competences/${code}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                }).then(res => {
                    if (res.ok) {
                        document.getElementById(`row-${code}`).style.opacity = '0';
                        setTimeout(() => {
                            document.getElementById(`row-${code}`).remove();
                            toast("ÉLÉMENT SUPPRIMÉ !");
                        }, 300);
                    }
                });
            }
        }
    });

    // ENREGISTRER MODIF
    document.getElementById('form-edit').addEventListener('submit', async (e) => {
        e.preventDefault();
        const code = document.getElementById('edit-code').value;
        const label = document.getElementById('edit-label').value.trim();
        const desc = document.getElementById('edit-desc').value.trim();

        try {
            const res = await fetch(`/api/competences/${code}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: JSON.stringify({ label_comp: label, description_comp: desc })
            });

            if (res.ok) {
                const row = document.getElementById(`row-${code}`);
                row.querySelector('.cell-label').textContent = label;
                row.querySelector('.cell-desc').textContent = desc;
                const btn = row.querySelector('.btn-modifier');
                btn.dataset.label = label;
                btn.dataset.description = desc;
                document.getElementById('form-edit-wrap').classList.add('hidden');
                toast("MODIFICATION RÉUSSIE !");
            } else {
                toast("ERREUR DE MODIFICATION", false);
            }
        } catch (e) { toast("ERREUR RÉSEAU", false); }
    });

    document.getElementById('btn-annuler-edit').addEventListener('click', () => {
        document.getElementById('form-edit-wrap').classList.add('hidden');
    });
</script>
@endsection