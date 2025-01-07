<x-stations-layout>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarburantExpress - Trouvez le carburant au meilleur prix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white text-center py-16">
        <h1 class="text-4xl font-bold mb-4">Révolutionnez votre manière de trouver du carburant</h1>
        <p class="text-xl mb-6">CarburantExpress vous permet de trouver les prix les plus bas dans les stations-service proches de vous.</p>
        <a href="#find-fuel"
           class="bg-yellow-400 text-gray-800 py-2 px-6 rounded-lg text-lg font-semibold hover:bg-yellow-500">Trouver
            le carburant</a>
    </section>

    <!-- Comment ça marche -->
    <section id="how-it-works" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Comment ça marche ?</h2>
            <div class="flex justify-center gap-8">
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">1. Trouvez une station-service</h3>
                    <p class="mt-4 text-gray-600">Entrez votre localisation pour voir les stations-service les plus proches.</p>
                </div>
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">2. Comparez les prix</h3>
                    <p class="mt-4 text-gray-600">Consultez les prix des carburants dans différentes stations-service.</p>
                </div>
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">3. Choisissez la meilleure offre</h3>
                    <p class="mt-4 text-gray-600">Sélectionnez le carburant au prix le plus bas et économisez.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trouver le carburant -->
    <section id="find-fuel" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Trouvez le carburant au meilleur prix</h2>
            <form action="#" method="GET" class="bg-white p-6 rounded-lg shadow-lg mx-auto max-w-lg">
                <div class="flex gap-4">
                    <input type="text" name="location" placeholder="Votre localisation" class="w-full py-2 px-4 border border-gray-300 rounded-lg" required>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700">Rechercher</button>
                </div>
            </form>
            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-700">Stations proches</h3>
                <p class="text-gray-600 mt-2">Affichage des stations avec les prix les plus bas près de chez vous.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-lg">&copy; 2025 CarburantExpress - Tous droits réservés</p>
        </div>
    </footer>

</x-stations-layout>