<x-stations-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Liste des stations de carburant</h1>

        <select name="carburant" id="carburant" class="mb-3">
            @foreach ($typeCarburants as $type)
                <option value="{{$type->libelle}}">
                    {{ $type->libelle }} 
                </option>
            @endforeach
        </select>


        <!-- Tableau des stations de carburant -->
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Ville</th>
                    <th class="border border-gray-300 px-4 py-2">Adresse</th>
                    <th class="border border-gray-300 px-4 py-2">Carburant</th>
                    <th class="border border-gray-300 px-4 py-2">Prix (€)</th>
                    <th class="border border-gray-300 px-4 py-2">Horaires</th>
                    <th class="border border-gray-300 px-4 py-2">Services Complémentaires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $station)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['ville'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['adresse'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['Carburant'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['Prix'] ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {!! $station['formatted_horaires'] !!}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $station['Services proposés'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5">
            {{ $stations->withPath(url()->current())->links() }}
        </div>
    </div>
</x-stations-layout>

<?php

?>