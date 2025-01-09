<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{

    /**
     * Récupérer toutes les stations essences de Nantes depuis l'API (Nantes -> par défaut).
     *
     * @param  
     * @return $stations
     */
    public static function getStations()
    {
        // On requête l'API en GET et en mettant des paramètres

        $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records', [
            'where' => 'ville="Nantes"',
        ]);
        

        // Variables qui servent lorsque l'utilisateur tente de trier par prix 

        $filterCarbu = null;
        $filterSearch = null;
        try {
            if ($response->successful()) {

                // On renvoie un tableau avec les données JSON

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
     * Récupérer les stations essences depuis l'API en récupérant la ville dans laquelle se trouve l'utilisateur pour géolocaliser les stations proches de lui.
     *
     * @param  
     * @return $stations
     */
    public static function getStationsByGeolocalisation($ville)
    {

        // On requête l'API en GET et en mettant des paramètres

        $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records', [
            'where' => 'ville="'. $ville .'"',
        ]);

        // Variables qui servent lorsque l'utilisateur tente de trier par prix

        $filterCarbu = null;
        $filterSearch = null;

        try {
            if ($response->successful()) {
                // On renvoie un tableau avec les données JSON
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
     * Récupérer les stations essences filtrées avec une recherche de ville ou de type de carburant ou les 2 depuis l'API.
     *
     * @param  
     * @return $stations
     */

    public static function getStationsDependsFilter($filterCarbu, $filterSearch){
        $apiUrl = null;

        // Stations essences filtrées par recherche de ville et type de carburant

        if($filterSearch != null && $filterSearch != ""  && $filterCarbu !=""){
            $apiUrl = 'https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records';
            
            $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0'
            ]);
        }

        // Stations essences filtrées par recherche de ville 

        if($filterSearch != null && $filterCarbu == ""){
            $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' => 'ville="'. $filterSearch .'"'
            ]);    
        }

        // Stations essences filtrées par type de carburant

        else if($filterSearch == null || $filterSearch ==""){
            $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
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
     * Récupérer les stations d'essences précedemment filtrées pour les trier par prix (asc ou desc) depuis l'API.
     *
     * @param  string $sort, string $apiUrl, string $filterCarbu, string $filterSearch
     * @return $stations
     */

    public static function getStationsSortBy($sort, $apiUrl, $filterCarbu, $filterSearch){

        // Tri par prix ascendant

        if($sort != null && $sort =='asc'){
            $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0',
                'order_by' => strtolower($filterCarbu).'_prix ASC'
            ]);
        }

        // Tri par prix descendant
        
        else if($sort != null && $sort =='desc'){
            $response = Http::withOptions(['verify' => false,])->get('https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records',[
                'where' =>'ville="'. $filterSearch .'" AND '. strtolower($filterCarbu) . '_prix > 0',
                'order_by' => strtolower($filterCarbu).'_prix DESC'
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
