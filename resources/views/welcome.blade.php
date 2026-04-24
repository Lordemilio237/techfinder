@extends('Template')
@section('main')
    <main class="flex-grow">
        <section class="bg-blue-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold mb-4">Bienvenue sur TechFinder</h1>
                <p class="text-xl mb-8">Trouvez les meilleurs techniciens et compétences en un clic.</p>
                <a href="/api/competences" class="bg-white text-blue-600 hover:bg-gray-200 font-bold py-2 px-4 rounded">Explorer les compétences</a>
            </div>
        </section>

        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Comment ça marche ?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">1</div>
                        <h3 class="text-xl font-bold mb-2">Inscrivez-vous</h3>
                        <p class="text-gray-600">Créez votre compte et ajoutez vos compétences.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">2</div>
                        <h3 class="text-xl font-bold mb-2">Recherchez des techniciens</h3>
                        <p class="text-gray-600">Utilisez notre moteur de recherche pour trouver les meilleurs candidats.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb=4">3</div>
                        <h3 class="text-xl font-bold mb=2">Contactez les candidats</h3>
                        <p class="text-gray=600">Communiquez directement avec les techniciens sélectionnés.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection