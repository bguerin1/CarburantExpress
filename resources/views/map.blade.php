<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carte des stations-services') }}
        </h2>
    </x-slot>

    <div>
        <!-- Carte Leaflet -->
        <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Créez la carte avec un centre et un zoom de base
            var map = L.map('map').setView([46.603354, 1.888334], 6);

            // Ajoutez une couche de tuiles (par exemple OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Ajoutez un marqueur à une position donnée
            /*L.marker([51.5, -0.09]).addTo(map)
                .bindPopup("Un marqueur sur la carte.")
                .openPopup();*/
        });
    </script>
    <!--<div data-udata-dataset="6615d83d7d7c66d5ec00c511"></div><script data-udata="https://www.data.gouv.fr/" src="https://static.data.gouv.fr/static/oembed.js" async defer></script>-->
</x-app-layout>
