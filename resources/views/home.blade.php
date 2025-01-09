<x-stations-layout>
    <section class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white text-center py-16">
        <h1 class="text-4xl font-bold mb-4">Révolutionnez votre manière de trouver du carburant</h1>
        <p class="text-xl mb-6">CarburantExpress vous permet de trouver les prix les plus bas dans les stations-service proches de vous.</p>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Comment ça marche ?</h2>
            <div class="flex justify-center gap-8">
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">1. Trouvez une station-service</h3>
                    <p class="mt-1 text-gray-600">Entrez votre localisation pour voir les stations-service les plus proches.</p>
                </div>
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">2. Comparez les prix</h3>
                    <p class="mt-1 text-gray-600">Consultez les prix des carburants dans différentes stations-service.</p>
                </div>
                <div class="w-1/3">
                    <h3 class="text-2xl font-semibold text-blue-600">3. Choisissez la meilleure offre</h3>
                    <p class="mt-1 text-gray-600">Sélectionnez le carburant au prix le plus bas et économisez.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Trouvez le carburant au meilleur prix</h2>
            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-700">Stations proches</h3>
                <p class="text-gray-600 mt-2">Affichage des stations avec les prix les plus bas près de chez vous.</p>
            </div>
            <div class="mt-8">

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight left-1">
                    Carte des stations de carburants
                </h2>

                <!-- Filtrage par carburant ou recherche de ville -->
                <div class="mt-3">
                    <form action="/filter" class="max-w-4xl flex flex-wrap items-center gap-4 mb-3" method="get">
                        @csrf
                        <div class="relative flex-grow">
                            <label for="search" class="sr-only">Rechercher</label>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search" name="search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Rechercher une ville..."/>
                        </div>
                        <div class="flex-grow">
                            <select id="type" name="type" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3">
                                <option value="">Choisir un type de carburant...</option>
                                @if(Auth::user())
                                    <option value="preferences">Vos préférences</option>
                                @endif
                                @foreach ($typeCarburants as $type)
                                    <option value="{{ $type->libelle }}">{{ $type->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">Rechercher</button>
                    </form>
                </div>

                <!-- Carte des stations de carburants -->

                <div id="map" style="height: 750px;" class="mt-3"></div>

                <!-- Bouton de géolocalisation -->

                
                <button type="submit" id="geoca" name="geoca" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">Me géolocaliser</button>

                <div class="mt-8">

                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight left-1">
                        Liste des stations de carburants
                    </h2>

                    <!-- Filtrage par prix -->
                    <div class="mt-3">
                        <form action="/sort" class="max-w-4xl flex flex-wrap items-center gap-4 mb-3" method="get">
                            @csrf
                            <input type="hidden" name="apiUrl" value="{{ $apiUrl }}">
                            <input type="hidden" name="filterCarbu" value="{{$filterCarbu}}">
                            <input type="hidden" name="filterSearch" value="{{$filterSearch}}">
                            <div class="flex-grow">
                                <select id="sort" name="sort" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3">
                                    <option selected value="">Choisir un tri par...</option>
                                    <option value="asc">Prix (asc)</option>
                                    <option value="desc">Prix (desc)</option>
                                </select>
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">Rechercher</button>
                        </form>
                    </div>

                    <!-- Tableau des stations de carburant -->
                    <table class="table-auto w-full border-collapse border border-gray-300 mt-8">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Ville</th>
                                <th class="border border-gray-300 px-4 py-2">Adresse</th>
                                <th class="border border-gray-300 px-4 py-2">Gazole</th>
                                <th class="border border-gray-300 px-4 py-2">SP95</th>
                                <th class="border border-gray-300 px-4 py-2">SP98</th>
                                <th class="border border-gray-300 px-4 py-2">E85</th>
                                <th class="border border-gray-300 px-4 py-2">GPLc</th>
                                <th class="border border-gray-300 px-4 py-2">E10</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Paginatedstations as $station)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['ville'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['adresse'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['gazole_prix'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['sp95_prix'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['sp98_prix'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['e85_prix'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['gplc_prix'] ?? 'Non disponible' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station['e10_prix'] ?? 'Non disponible' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-lg">&copy; 2025 CarburantExpress - Tous droits réservés</p>
        </div>
    </footer>

    <script>
        var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation de la carte centrée sur la France par défaut
            var map = L.map('map').setView([46.603354, 1.888334], 6); // Centré sur la France avec un zoom de 6

            // Ajout d'un fond de carte
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                minZoom: 6,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Stations venant de PHP
            var stations = @json($Mapstations, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); // Assurer que les caractères spéciaux sont échappés

            // Ajouter les marqueurs pour chaque station
            stations.forEach(function(station) {
                var lat = station.geom.lat;
                var lon = station.geom.lon;

                // Ajouter un marqueur pour chaque station avec des informations supplémentaires
                L.marker([lat, lon])
                    .addTo(map)
                    .bindPopup("<b>Ville :</b> " + station.ville + "<br><b>Adresse :</b> " + station.adresse + 
                                "<br><b>Gazole :</b> " + station.gazole_prix + "€" + 
                                "<br><b>SP95 :</b> " + station.sp95_prix + "€" +
                                "<br><b>SP98 :</b> " + station.sp98_prix + "€" +
                                "<br><b>E85 :</b> " + station.e85_prix + "€" +
                                "<br><b>GLPc :</b> " + station.gplc_prix + "€" +
                                "<br><b>E10 :</b> " + station.e10_prix + "€")
                    .openPopup();
            });

            // Géolocalisation de l'utilisateur
            document.getElementById("geoca").addEventListener('click', function() {
                navigator.geolocation.getCurrentPosition(success, error, options, getCityName);
            });

            // Fonction qui s'exécute lorsque la géolocalisation réussit
            function success(pos) {
                var crd = pos.coords;

                usersPosition = getCityName(crd.latitude, crd.longitude)

                // Marqueur personnalisé pour la position actuelle de l'utilisateur
                var userIcon = L.icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',  // Icône par défaut de Leaflet
                    iconSize: [25, 41],  // Taille de l'icône
                    iconAnchor: [12, 41],  // Point d'ancrage de l'icône (au bas)
                    popupAnchor: [0, -41]  // Point où le popup sera attaché
                });

                // Centrer la carte sur la position de l'utilisateur et ajouter le marqueur
                map.setView([crd.latitude, crd.longitude], 13); // Zoom de 13 pour la position actuelle
                L.marker([crd.latitude, crd.longitude], { icon: userIcon })
                    .addTo(map)
                    .bindPopup("<b>Vous êtes ici !</b>")
                    .openPopup();
            }

            // Fonction qui s'exécute en cas d'erreur de géolocalisation
            function error(err) {
                console.warn(`ERREUR (${err.code}): ${err.message}`);
                alert("Impossible de récupérer votre position.");
            }

            // Fonction pour obtenir le nom de la ville à partir des coordonnées
            function getCityName(lat, lon) {
                // URL de l'API Nominatim pour le géocodage inversé
                var apiUrl = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`;
            
                // Faire une requête AJAX pour obtenir les informations de géolocalisation
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.address) {
                            var city = data.address.city || data.address.town || data.address.village || "Ville non trouvée";
                            console.log("Ville : " + city);
                        } else {
                            console.log("Impossible de trouver la ville");
                        }
                    })
                    .catch(error => {
                        console.error("Erreur de géocodage : ", error);
                    });
            }
        });
    </script>

</x-stations-layout>



