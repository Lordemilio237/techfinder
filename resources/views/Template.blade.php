<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFinder - Bienvenue</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
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
        /* Style pour adoucir les transitions de Tailwind */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 500ms;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight italic">TechFinder</h1>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('competences.index') }}" class="text-gray-600 hover:text-blue-600 font-bold transition">Compétences</a>
                    <a href="{{ route('web.users.index') }}" class="text-gray-600 hover:text-blue-600 font-bold transition">Utilisateurs</a>
                    <a href="/interventions" class="text-gray-600 hover:text-blue-600 font-bold transition">Interventions</a>
                    <a href="/user-competences" class="text-gray-600 hover:text-blue-600 font-bold transition">User Compétences</a>
                    
                    <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition active:scale-95">
                        Connexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('main')
    </main>

    <footer class="bg-gray-900 text-gray-400 py-12 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                <div>
                    <h5 class="text-white font-bold text-lg mb-4">À propos</h5>
                    <p class="text-sm leading-relaxed">TechFinder est la plateforme leader pour connecter les besoins techniques avec les meilleures compétences certifiées en 2026.</p>
                </div>

                <div>
                    <h5 class="text-white font-bold text-lg mb-4">Services</h5>
                    <ul class="text-sm space-y-3">
                        <li><a href="#" class="hover:text-white transition">Interventions</a></li>
                        <li><a href="#" class="hover:text-white transition">Compétences</a></li>
                        <li><a href="#" class="hover:text-white transition">Techniciens</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold text-lg mb-4">Support</h5>
                    <ul class="text-sm space-y-3">
                        <li><a href="#" class="hover:text-white transition">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold text-lg mb-4">Contact</h5>
                    <div class="text-sm space-y-2">
                        <p class="flex items-center"><span class="mr-2">📧</span> info@techfinder.com</p>
                        <p class="flex items-center"><span class="mr-2">📞</span> +33 1 23 45 67 89</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm">&copy; 2026 TechFinder. Tous droits réservés.</p>
                    <div class="flex gap-6 text-sm mt-4 md:mt-0 font-medium">
                        <a href="#" class="hover:text-white">Confidentialité</a>
                        <a href="#" class="hover:text-white">Conditions</a>
                        <a href="#" class="hover:text-white">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Ce script peut servir à fermer les alertes globalement
        function closeFlash() {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }
    </script>
</body>
</html>