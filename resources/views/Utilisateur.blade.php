@extends('Template')

@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h2>
    </div>

    {{-- Notifications Flash --}}
    @if(session('success'))
        <div id="flash-message" class="fixed top-5 right-5 z-50 min-w-[350px] transform transition-all duration-500">
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center justify-between border-2 border-white">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="font-bold">Succès !</p>
                        <p class="text-sm opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="closeFlash()" class="ml-4 p-1 hover:bg-green-700 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Formulaire d'ajout (inchangé mais présent pour la structure) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-10 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <h3 class="text-white font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Ajouter un nouveau collaborateur
            </h3>
        </div>

        <form action="{{ route('web.users.store') }}" method="POST" class="p-8">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6">
                {{-- Section : Identité --}}
                <div class="space-y-4">
                    <h4 class="text-blue-600 font-bold uppercase text-xs tracking-wider border-b pb-2">Informations Personnelles</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
                            <input type="text" name="nom_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
                            <input type="text" name="prenom_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Sexe</label>
                            <select name="sexe_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
                            <input type="text" name="tel_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="06 12 34 56 78">
                        </div>
                    </div>
                </div>

                {{-- Section : Sécurité & Rôle --}}
                <div class="space-y-4">
                    <h4 class="text-blue-600 font-bold uppercase text-xs tracking-wider border-b pb-2">Paramètres du Compte</h4>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email / Login</label>
                        <input type="email" name="login_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" name="password_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Rôle</label>
                            <select name="role_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <option value="client">Client</option>
                                <option value="technicien">Technicien</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">État</label>
                            <select name="etat_user" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <option value="1">Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg transition transform active:scale-95 flex items-center gap-2">
                    Créer l'utilisateur
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </form>
    </div>

    {{-- TABLEAU RÉVISÉ (Division Nom/Prenom et Sexe) --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nom & Prénom</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sexe</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rôle / État</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600 font-mono">
                            #{{ $user->code_user }}
                        </td>
                        
                        {{-- Colonne Nom & Prénom --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">
                                    {{ strtoupper(substr($user->nom_user, 0, 1)) }}
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ strtoupper($user->nom_user) }} {{ $user->prenom_user }}</span>
                            </div>
                        </td>

                        {{-- Colonne Sexe --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($user->sexe_user == 'M')
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1.323l.395-.23a1 1 0 011 1.734l-.396.23.23.396a1 1 0 01-1.734 1l-.23-.395-.23.395a1 1 0 01-1.734-1l.23-.396-.396-.23a1 1 0 011-1.734l.395.23V3a1 1 0 011-1z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 102 0V5z" clip-rule="evenodd"></path></svg>
                                    Homme
                                </span>
                            @else
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a5 5 0 11-2 0V3a1 1 0 011-1zm0 10a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path><path d="M7 16a1 1 0 011-1h1v-1a1 1 0 112 0v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1H8a1 1 0 01-1-1z"></path></svg>
                                    Femme
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs font-bold rounded-md bg-gray-100 text-gray-600 uppercase">{{ $user->role_user }}</span>
                            <span class="ml-1 {{ $user->etat_user ? 'text-green-600' : 'text-red-600' }} font-bold text-[10px]">●</span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $user->login_user }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $user->tel_user ?? '—' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('web.users.edit', $user->code_user) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('web.users.destroy', $user->code_user) }}" method="POST" onsubmit="return confirm('Supprimer ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

<script>
    function closeFlash() {
        const flash = document.getElementById('flash-message');
        if (flash) {
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-20px)';
            setTimeout(() => { flash.remove(); }, 500);
        }
    }
</script>
@endsection