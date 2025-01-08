<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    /**
     * Récupérer l'intégralité des stations de l'API
     */
    public function getStations()
    {
        // URL de l'API
        $apiUrl = 'https://tabular-api.data.gouv.fr/api/resources/336c34b5-a527-4c35-b84d-18462daa7c51/data/';

        try {
            $response = Http::withOptions(['verify' => false])->get($apiUrl);

            if ($response->successful()) {
                $stations = $response->json()['data'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return $stations;
    }

    public function getStationsDependsFilter($filterCarbu, $filterSearch){
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
                $stations = $response->json()['data'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return $stations;
    }
}
