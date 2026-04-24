<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFinder - Bienvenue</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-BJ6LSv6q.css') }}">
    <script src="{{ asset('build/assets/app-BJgssCIR.js') }}" defer></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">TechFinder</a>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('competences.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Compétences</a>
                    
                    <a href="{{ route('web.users.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Utilisateurs</a>

                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition">Interventions</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition">Affectations</a>
                    
                    <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('main')
    </main>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h5 class="text-white font-bold mb-4">À propos</h5>
                    <p class="text-sm leading-relaxed">TechFinder est la plateforme leader pour mettre en relation les entreprises avec les meilleurs techniciens qualifiés.</p>
                </div>

                <div>
                    <h5 class="text-white font-bold mb-4">Services</h5>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Interventions</a></li>
                        <li><a href="{{ route('competences.index') }}" class="hover:text-white transition">Compétences</a></li>
                        <li><a href="{{ route('web.users.index') }}" class="hover:text-white transition">Gestion Utilisateurs</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold mb-4">Support</h5>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold mb-4">Contact</h5>
                    <p class="text-sm mb-1">Email: info@techfinder.com</p>
                    <p class="text-sm">Tél: +33 1 23 45 67 89</p>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs">&copy; 2026 TechFinder. Tous droits réservés.</p>
                    <div class="flex gap-6 text-xs">
                        <a href="#" class="hover:text-white transition">Confidentialité</a>
                        <a href="#" class="hover:text-white transition">Conditions</a>
                        <a href="#" class="hover:text-white transition">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>