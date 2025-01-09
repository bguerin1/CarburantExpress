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

        // Type de carburants pour le select 

        $typeCarburants = TypeCarburant::all();
    
       

        return view('home', ['stations' => $stations, 'typeCarburants' => $typeCarburants,  'apiUrl' => $apiUrl, 'filterCarbu' => $filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations de l'API paginées.
     *
     * @return \Illuminate\View\View
     */
    public function geolocaliser(Request $request)
    {
        //On récupère toutes les stations de l'API grâce à la méthode que j'ai défini dans l'ApiController 
        
        $result = ApiController::getStationsByGeolocalisation($request->ville);

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];
        
        $filterCarbu = null;
        $filterSearch = null;

        $typeCarburants = TypeCarburant::all();

        return view('home', ['stations' => $stations, 'typeCarburants' => $typeCarburants,  'apiUrl' => $apiUrl, 'filterCarbu' => $filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations filtrés selon le type de carburant ou une ville ou les 2.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */

    public function filter(Request $request){

        // On valide les données du formulaire 

        $request->validate(
            [
                'search' => 'required|string|max:255',
                'type' => '',
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            ],
            [
                'search' => 'search',
            ]
        );


        // Filtre par recherche de ville et type de carburant 
        if($request->search != null && $request->search != ""){
            $result = ApiController::getStationsDependsFilter($request->type, $request->search);
        }
        else{
            // Filtre par type de carburant
            $result = ApiController::getStationsDependsFilter($request->type, null);
        }

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];

        // Variables qui sont transmises à la vue pour ensuite les récupérer dans la méthode sort en dessous
        $filterSearch = $result['filterSearch'];
        $filterCarbu = $result['filterCarbu'];

        // Type de carburant pour le select 

        $typeCarburants = TypeCarburant::all();

        return view('home',['stations' => $stations, 'typeCarburants' => $typeCarburants, 'apiUrl'=>$apiUrl, 'filterCarbu'=>$filterCarbu, 'filterSearch'=>$filterSearch]);
    }

    /**
     * Renvoie une vue avec l'intégralité des stations précédemment filtrées pour les trier par prix (asc) ou prix (desc).
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */

    public function sort (Request $request){


        $request->validate(
            [
                'sort' => 'string|max:255',
                'apiUrl' => 'string|max:255',
                'filterCarbu' => 'string|max:255',
                'filterSearch' => 'string|max:255'
            ],
            [
                'required' => 'Le champ :attribute est obligatoire.',
                'string' => 'Le champ :attribute doit être une chaîne de caractères.',
                'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            ],
            [
                'sort' => 'sort',
                'apiUrl' => 'apiUrl',
                'filterCarbu' => 'filterCarbu',
                'filterSearch' => 'filterSearch'
            ]
        );

        // On appelle la méthode de tri sur l'API et les variables filterSearch et filterCarbu servent à reconstruire la requête précédemment filtrée (fonctionnement en 2 étapes : filtrage puis tri en sachant que le tri ne doit pas être utilisé sans le filtre)

        $result = ApiController::getStationsSortBy($request->sort, $request->apiUrl, $request->filterCarbu, $request->filterSearch);

        $stations = $result['stations'];
        $apiUrl = $result['apiUrl'];


        $filterSearch = $result['filterSearch'];
        $filterCarbu = $result['filterCarbu'];

        // Type de carburant pour le select 

        $typeCarburants = TypeCarburant::all();

        return view('home',['stations' => $stations, 'typeCarburants' => $typeCarburants,'apiUrl'=>$apiUrl, 'filterCarbu'=>$filterCarbu,'filterSearch'=> $filterSearch]);
    }
}
