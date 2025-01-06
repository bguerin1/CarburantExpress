<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Liste des stations de carburant</h1>

        <!-- Tableau des stations de carburant -->
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Ville</th>
                    <th class="border border-gray-300 px-4 py-2">Adresse</th>
                    <th class="border border-gray-300 px-4 py-2">Carburant</th>
                    <th class="border border-gray-300 px-4 py-2">Prix (€)</th>
                    <th class="border border-gray-300 px-4 py-2">Horaires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $station)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['__id'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['ville'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['adresse'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['Carburant'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['Prix'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {!! formatSchedule($station['horaires']) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $stations->withPath(url()->current())->links() }}
    </div>
</x-app-layout>

<?php

// Fonction pour formater les horaires (utilisée dans la vue)
function formatSchedule($horaires)
{
    if (!$horaires || !isset($horaires['jour'])) return 'N/A';
    
    $formatted = '';
    
    foreach ($horaires['jour'] as $day) {
        $ouvert = $day['horaire']['@ouverture'] ?? 'Fermé';
        $fermeture = $day['horaire']['@fermeture'] ?? '';
        $formatted .= $day['@nom'] . ": " . $ouvert . " - " . $fermeture . "<br>";
    }
    
    return $formatted;
}
?>
