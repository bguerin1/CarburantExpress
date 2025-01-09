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
        $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records', [
            'where' => 'ville="Nantes"',
        ]);

        $filterCarbu = null;
        $filterSearch = null;

        try {
            if ($response->successful()) {
                $stations = (array) $response->json()['results'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }
        return ['stations' => $stations, 'apiUrl' => $response, 'filterCarbu'=>$filterCarbu, 'filterSearch'=>$filterSearch];
    }

    /**
     * Récupérer les stations d'essences filtrées avec une recherche de ville ou de type de carburant ou les 2 depuis l'API.
     *
     * @param  
     * @return $stations
     */

    public static function getStationsDependsFilter($filterCarbu, $filterSearch){
        
        $apiUrl = null;

        // URL de l'API

        if($filterSearch != null && $filterSearch != ""  && $filterCarbu !=""){
            $apiUrl = 'https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records';
            //$paramsUrl = ['where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0'];
            
            $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0'
            ]);
        }
        if($filterSearch != null && $filterCarbu == ""){
            $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' => 'ville="'. $filterSearch .'"'
            ]);    
        }
        else if($filterSearch == null || $filterSearch ==""){
            $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' => strtolower($filterCarbu) . '_prix > 0'
            ]);
        }
        try {
            if ($response->successful()) {
                $stations = (array) $response->json()['results'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }

        return ['stations' => $stations, 'apiUrl' => $apiUrl, 'filterSearch'=> $filterSearch, 'filterCarbu'=>$filterCarbu];
    }

    /**
     * Récupérer les stations d'essences triées par prix (asc ou desc) depuis l'API.
     *
     * @param  string $sort 
     * @return $stations
     */

    public static function getStationsSortBy($sort, $apiUrl, $filterCarbu, $filterSearch){
        if($sort != null && $sort =='asc'){
            $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0',
                'order_by' => strtolower($filterCarbu).'_prix ASC'
            ]);
        }
        else if($sort != null && $sort =='desc'){
            $response = Http::get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0',
                'order_by' => strtolower($filterCarbu).'_prix' . 'DESC'
            ]);
        }

        try {
            if ($response->successful()) {
                $stations = (array) $response->json()['results'];
            } else {
                $stations = []; // En cas d'erreur, on renvoie une collection vide
            }
        } catch (\Exception $e) {
            $stations = [];
        }

        return ['stations' => $stations, 'apiUrl' => $apiUrl, 'filterCarbu'=>$filterCarbu, 'filterSearch'=>$filterSearch];
    }
}
