<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeCarburant;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\ApiController; 

class StationController extends Controller
{
    /**
     * Méthode de pagination manuelle pour un tableau (reprise de certaines solutions trouvées sur stackoverflow ou autre)
     *
     * @return LengthAwarePaginator
     */
    private function modifiedPaginate(array $items, int $perPage = 20 , ?int $page = null, $options = []): LengthAwarePaginator
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
     * Renvoie une vue avec l'intégralité des stations de l'API paginées.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        //On récupère toutes les stations de l'API grâce à la méthode que j'ai défini dans l'ApiController 
        
        $result = ApiController::getStations();

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];
        
        $filterCarbu = null;
        $filterSearch = null;

        $typeCarburants = TypeCarburant::all();

        return view('home', ['Paginatedstations' => $stations, 'typeCarburants' => $typeCarburants, 'Mapstations'=>$stations, 'apiUrl' => $apiUrl, 'filterCarbu' => $filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations de l'API paginées.
     *
     * @return \Illuminate\View\View
     */
    public function geolocaliser(Request $request)
    {
        //On récupère toutes les stations de l'API grâce à la méthode que j'ai défini dans l'ApiController 
        dd($request->ville);
        $result = ApiController::getStationsByGeolocalisation($request->ville);

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];
        
        $filterCarbu = null;
        $filterSearch = null;

        $typeCarburants = TypeCarburant::all();

        return view('home', ['Paginatedstations' => $stations, 'typeCarburants' => $typeCarburants, 'Mapstations'=>$stations, 'apiUrl' => $apiUrl, 'filterCarbu' => $filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations filtrés selon le type de carburant ou une ville ou les 2.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */

    public function filter(Request $request){

        if($request->search != null && $request->search != ""){
            $result = ApiController::getStationsDependsFilter($request->type, $request->search);
        }
        else{
            $result = ApiController::getStationsDependsFilter($request->type, null);
        }

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];
        
        $filterSearch = $result['filterSearch'];
        $filterCarbu = $result['filterCarbu'];

        $Paginatedstations = $this->modifiedPaginate($stations);

        $typeCarburants = TypeCarburant::all();

        return view('home',['Paginatedstations' => $Paginatedstations, 'typeCarburants' => $typeCarburants,'Mapstations'=>$stations, 'apiUrl'=>$apiUrl, 'filterCarbu'=>$filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations précédemment filtrées trier par prix (asc) ou prix (desc).
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */

    public function sort (Request $request){

        $result = ApiController::getStationsSortBy($request->sort, $request->apiUrl, $request->filterCarbu, $request->filterSearch);

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];

        $filterSearch = $result['filterSearch'];
        $filterCarbu = $result['filterCarbu'];

        $Paginatedstations = $this->modifiedPaginate($stations);

        $typeCarburants = TypeCarburant::all();

        return view('home',['Paginatedstations' => $Paginatedstations, 'typeCarburants' => $typeCarburants,'Mapstations'=>$stations, 'apiUrl'=>$apiUrl, 'filterCarbu'=>$filterCarbu,'filterSearch'=> $filterSearch]);
    }
}
