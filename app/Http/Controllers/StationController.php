<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    private function modifiedPaginate(array $items, int $perPage = 5, ?int $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = collect($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Afficher une vue avec l'intégralité des stations de l'API paginées.
     *
     * @param  \App\Http\Controllers\ApiController  $apiController
     * @return \Illuminate\View\View
     */
    public function home(ApiController $apiController)
    {
        //On récupère toutes les stations de l'API grâce à la méthode définie dans l'ApiController 

        $stations = $apiController->getStations();

        $Paginatedstations = $this->modifiedPaginate($stations);

        return view('map', ['stations' => $Paginatedstations]);
    }
}
