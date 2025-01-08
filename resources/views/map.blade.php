<x-stations-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Carte des stations de carburants</h1>

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
                    <select id="countries" name="type" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3">
                        <option selected>Choisir un type de carburant...</option>
                        @foreach ($typeCarburants as $type)
                            <option value="{{ $type->libelle }}">{{ $type->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">Rechercher</button>
            </form>
        </div>

        <!-- Carte -->
        <div id="map" style="height: 750px;"></div>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation de la carte
            var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées centrées sur la France

            // Ajout d'un fond de carte (tile layer)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Stations venant de PHP
            var stations = @json($stations, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); // Assurer que les caractères spéciaux sont échappés

            // Ajout des marqueurs pour chaque station
            stations.forEach(function(station) {
                // Extraire les coordonnées (latitude et longitude)
                var coords = station.geom.split(','); // Exemple : '46.188, 5.245'
                var lat = parseFloat(coords[0].trim());
                var lon = parseFloat(coords[1].trim());

                // Ajouter un marqueur pour chaque station
                L.marker([lat, lon])
                    .addTo(map)
                    .bindPopup("<b>" + "Ville :" + station.ville + "</b><br>" + "Adresse :" + " " + station.adresse + "<br>Carburant: " + station.Carburant + "<br>Prix: " + station.Prix + "€")
                    .openPopup();
            });
        });
    </script>

</x-stations-layout>