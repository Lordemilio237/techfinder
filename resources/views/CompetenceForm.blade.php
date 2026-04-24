@extends('Template')
@section('main')
@if ($errors->any())
    <div class="mb-4 p-4 text-red-800 rounded-lg bg-red-50 border border-red-200">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('competences.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour à la liste
            </a>

            {{-- Bouton Ajouter (visible uniquement en mode édition) --}}
            @if($competence)
                <a href="{{ route('competences.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Ajouter une compétence
                </a>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">
                {{ $competence ? 'Modifier la compétence' : 'Ajouter une compétence' }}
            </h2>
            <form method="POST" action="{{ $competence ? route('competences.update', $competence->code_comp) : route('competences.store') }}">
                @csrf
                @if($competence)
                    @method('PUT')
                @endif
                <div class="mb-4">
                    <label for="label_comp" class="block text-sm font-medium text-gray-700 mb-2">Label</label>
                    <input type="text" name="label_comp" id="label_comp" 
                           value="{{ old('label_comp', $competence->label_comp ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('label_comp') border-red-500 @enderror"
                           required>
                    @error('label_comp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description_comp" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description_comp" id="description_comp" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description_comp') border-red-500 @enderror">{{ old('description_comp', $competence->description_comp ?? '') }}</textarea>
                    @error('description_comp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('competences.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        {{ $competence ? 'Mettre à jour' : 'Ajouter' }}
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection