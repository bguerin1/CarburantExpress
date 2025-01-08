<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    /**
     * Récupérer les stations d'essences depuis l'API.
     *
     * @param  
     * @return $stations
     */
    public static function getStations()
    {
        // URL de l'API
        $apiUrl = 'https://tabular-api.data.gouv.fr/api/resources/336c34b5-a527-4c35-b84d-18462daa7c51/data/?ville__exact=Paris';

        try {
            $response = Http::withOptions(['verify' => false])->get($apiUrl);

            if ($response->successful()) {
                $stations = (array) $response->json()['data'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return ['stations' => $stations, 'apiUrl' => $apiUrl];
    }

    /**
     * Récupérer les stations d'essences filtrées avec une recherche de ville ou de type de carburant ou les 2 depuis l'API.
     *
     * @param  
     * @return $stations
     */

    public static function getStationsDependsFilter($filterCarbu, $filterSearch){
        // URL de l'API
        $apiUrl = 'https://tabular-api.data.gouv.fr/api/resources/336c34b5-a527-4c35-b84d-18462daa7c51/data/';

        if($filterSearch != null && $filterSearch != ""  && $filterCarbu !=""){
            $apiUrl .= '?Carburant__exact=' . $filterCarbu . '&' . 'ville__exact=' . $filterSearch;
        }
        if($filterSearch != null && $filterCarbu == ""){
            $apiUrl .= '?ville__exact=' . $filterSearch;
        }
        else if($filterSearch == null || $filterSearch ==""){
            $apiUrl .= '?Carburant__exact=' . $filterCarbu;
        }

        try {
            $response = Http::withOptions(['verify' => false])->get($apiUrl);

            if ($response->successful()) {
                $stations = (array) $response->json()['data'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return ['stations' => $stations, 'apiUrl' => $apiUrl];
    }

    /**
     * Récupérer les stations d'essences triées par prix (asc ou desc) depuis l'API.
     *
     * @param  string $sort 
     * @return $stations
     */

    public static function getStationsSortBy($sort, $apiUrl){
        if($sort != null && $sort =='asc'){
            $apiUrl .= '&Prix__sort=asc';
        }
        else if($sort != null && $sort =='desc'){
            $apiUrl .= '&Prix__sort=desc';
        }

        try {
            $response = Http::withOptions(['verify' => false])->get($apiUrl);

            if ($response->successful()) {
                $stations = (array) $response->json()['data'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return ['stations' => $stations, 'apiUrl' => $apiUrl];
    }
}
