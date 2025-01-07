<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeCarburant;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class StationController extends Controller
{
    /**
     * Méthode de pagination manuelle pour un tableau
     *
     * @return LengthAwarePaginator
     */
    private function modifiedPaginate(array $items, int $perPage = 10 , ?int $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = collect($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    
     /**
     * Permet le formatage des données horaires des stations de l'API
     *
     * @param  $horaires
     * @return $formatted
     */

    public function formatSchedule($horaires)
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

    /**
     * Afficher une vue avec l'intégralité des stations de l'API paginées.
     *
     * @param  \App\Http\Controllers\ApiController  $apiController
     * @return \Illuminate\View\View
     */
    public function home(ApiController $apiController)
    {
        //On récupère toutes les stations de l'API grâce à la méthode que j'ai défini dans l'ApiController 
        $stations = $apiController->getStations();

        // On applique le formatage des horaires à chaque station

        foreach ($stations as &$station) {
            $station['formatted_horaires'] = $this->formatSchedule($station['horaires']);
        }


        $Paginatedstations = $this->modifiedPaginate($stations);

        $typeCarburants = TypeCarburant::all();

        return view('home', ['stations' => $Paginatedstations, 'typeCarburants' => $typeCarburants]);
    }

    /**
     * On récupère toutes les stations pour afficher la carte.
     *
     * @param  \App\Http\Controllers\ApiController  $apiController
     * @return \Illuminate\View\View
     */

    public function map(ApiController $apiController)
    {
        //On récupère toutes les stations de l'API grâce à la méthode que j'ai défini dans l'ApiController 

        $stations = $apiController->getStations();

        return view('map', ['stations' => $stations]);
    }

    public function home1(){
        return view('home1');
    }

    public function filter(ApiController $apiController, Request $request){
        // Faire la validation

        $stations = $apiController->getStationsDependsCarbu($request->type);

        // On applique le formatage des horaires à chaque station

        foreach ($stations as &$station) {
            $station['formatted_horaires'] = $this->formatSchedule($station['horaires']);
        }

        $Paginatedstations = $this->modifiedPaginate($stations);

        $typeCarburants = TypeCarburant::all();


        return view('home',['stations' => $Paginatedstations, 'typeCarburants' => $typeCarburants]);
    }
}
