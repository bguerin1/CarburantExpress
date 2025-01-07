<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Carte des stations de carburants</h1>

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

</x-app-layout>