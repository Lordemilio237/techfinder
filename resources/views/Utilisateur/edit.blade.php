@extends('Template')

@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('web.users.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour à la liste
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- En-tête Orange pour la modification --}}
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
            <h3 class="text-white font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Modifier l'utilisateur : {{ $user->nom_user }} {{ $user->prenom_user }}
            </h3>
        </div>

        <form action="{{ route('web.users.update', $user->code_user) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6">
                
                {{-- Section : Identité --}}
                <div class="space-y-4">
                    <h4 class="text-amber-600 font-bold uppercase text-xs tracking-wider border-b pb-2">Informations Personnelles</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
                            <input type="text" name="nom_user" value="{{ old('nom_user', $user->nom_user) }}" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
                            <input type="text" name="prenom_user" value="{{ old('prenom_user', $user->prenom_user) }}" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Sexe</label>
                            <select name="sexe_user" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm">
                                <option value="M" {{ $user->sexe_user == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ $user->sexe_user == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
                            <input type="text" name="tel_user" value="{{ old('tel_user', $user->tel_user) }}" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm">
                        </div>
                    </div>
                </div>

                {{-- Section : Sécurité & Rôle --}}
                <div class="space-y-4">
                    <h4 class="text-amber-600 font-bold uppercase text-xs tracking-wider border-b pb-2">Paramètres du Compte</h4>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email / Login</label>
                        <input type="email" name="login_user" value="{{ old('login_user', $user->login_user) }}" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1 text-amber-700">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" name="password_user" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm" placeholder="••••••••">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Rôle</label>
                            <select name="role_user" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm">
                                <option value="client" {{ $user->role_user == 'client' ? 'selected' : '' }}>Client</option>
                                <option value="technicien" {{ $user->role_user == 'technicien' ? 'selected' : '' }}>Technicien</option>
                                <option value="admin" {{ $user->role_user == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">État</label>
                            <select name="etat_user" class="w-full rounded-lg border-gray-300 focus:ring-amber-500 focus:border-amber-500 shadow-sm">
                                <option value="1" {{ $user->etat_user == 1 ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ $user->etat_user == 0 ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end gap-4">
                <a href="{{ route('web.users.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition">
                    Annuler
                </a>
                <button type="submit" class="bg-amber-500 text-white px-10 py-3 rounded-xl font-bold hover:bg-amber-600 shadow-lg shadow-amber-100 transition transform active:scale-95 flex items-center gap-2">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection