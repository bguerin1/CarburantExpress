<x-stations-layout>
    <div class="container mx-auto mt-8">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des stations de carburants
        </h2>
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


        <!-- Tableau des stations de carburant -->

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Ville</th>
                    <th class="border border-gray-300 px-4 py-2">Adresse</th>
                    <th class="border border-gray-300 px-4 py-2">Carburant</th>
                    <th class="border border-gray-300 px-4 py-2">Prix (€)</th>
                    <th class="border border-gray-300 px-4 py-2">Horaires</th>
                    <!--<th class="border border-gray-300 px-4 py-2">Services Complémentaires</th>-->
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
                        <!--<td class="border border-gray-300 px-4 py-2">{{ $station['Services proposés'] ?? 'N/A' }}</td>-->
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