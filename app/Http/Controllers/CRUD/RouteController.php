<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\Route;
use App\RouteSection;
use App\Search;
use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE FALAISE
    function routeModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $route = Route::where('id', $id)->with('routeSections')->first();

            //compose le tableau des longeurs
            $tabLongueur = [];
            foreach ($route->routeSections as $section){
                $temTap = [
                    $section->grade,
                    $section->sub_grade,
                    $section->anchor_id,
                    $section->point_id,
                    $section->nb_point,
                    $section->incline_id,
                    $section->section_height,
                ];
                $tabLongueur[] = implode(';', $temTap);
            }
            $route->tabLongueur = implode('||', $tabLongueur);

            if(count($route->routeSections) > 1 && ($route->climb_id == 4 || $route->climb_id == 5 || $route->climb_id == 6)){
                $route->typeCotation = true;
            }else{
                $route->typeCotation = false;
            }

            $callback = 'reloadRouteInformationTab';
        }else{

            //créer une fausse section de ligne
            $routeSections = new class{};
            $routeSections->grade = '2a';
            $routeSections->sub_grade = '';
            $routeSections->section_height = 0;
            $routeSections->nb_point = 0;
            $routeSections->point_id = 1;
            $routeSections->anchor_id = 1;
            $routeSections->incline_id = 1;
            $routeSections->reception_id = 1;
            $routeSections->start_id = 1;

            $route = new Route();
            $route->crag_id = $request->input('crag_id');
            $route->sector_id = $request->input('sector_id');
            $route->routeSections = [$routeSections];
            $route->nb_longueur = 1;
            $route->tabLongueur = '2a;;1;1;0;1;0';
            $route->typeCotation = true;
            $callback = 'prepareNewLine';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/routes' : '/routes/' . $id;

        $data = [
            'dataModal' => [
                'ligne' => $route,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.route', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //see modal controller
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|String|max:255',
            'height' => 'nullable|Integer|min:0',
            'open_year' => 'nullable|Integer|min:1800',
            'nb_longueur' => 'nullable|Integer|min:1',
        ]);

        //information sur la falaise
        $route = new Route();
        $route->label = $request->input('label');
        $route->crag_id = $request->input('crag_id');
        $route->sector_id = $request->input('sector_id');
        $route->user_id = Auth::user()->id;
        $route->climb_id = $request->input('climb_id');
        $route->height = $request->input('height');
        $route->open_year = $request->input('open_year');
        $route->opener = $request->input('opener');
        $route->note = 0;
        $route->nb_note = 0;
        $route->nb_longueur = $request->input('nb_longueur');
        $route->save();

        if($request->input('type_cotation_longeur') == 'on' && ($request->input('climb_id') == '4' || $request->input('climb_id') == '5' || $request->input('climb_id') == '6' )){
            //cas d'une grande-voie avec plusieur longueur

            $tabLongeur = explode('||', $request->input('jsonLongueur'));
            foreach ($tabLongeur as $key=>$longueur){

                $tabInfo = explode(';',$longueur);

                $myLongueur = new RouteSection();
                $myLongueur->route_id = $route->id;
                $myLongueur->grade = $tabInfo[0];
                $myLongueur->sub_grade = $tabInfo[1];
                $myLongueur->anchor_id = $tabInfo[2];
                $myLongueur->point_id = $tabInfo[3];
                $myLongueur->nb_point = $tabInfo[4];
                $myLongueur->incline_id = $tabInfo[5];
                $myLongueur->section_height = $tabInfo[6];
                $myLongueur->grade_val = Route::gradeToVal($tabInfo[0], $tabInfo[1]);
                $myLongueur->section_order = ($key + 1);
                $myLongueur->reception_id = 1;
                $myLongueur->start_id = 1;
                $myLongueur->save();
            }

        }else{

            //cas d'une voie en une seul longueur
            $myLongueur = new RouteSection();
            $myLongueur->route_id = $route->id;
            $myLongueur->grade = $request->input('grade');
            $myLongueur->sub_grade = $request->input('sub_grade');
            $myLongueur->grade_val = Route::gradeToVal($request->input('grade'), $request->input('sub_grade'));
            $myLongueur->section_height = $request->input('height');
            $myLongueur->nb_point = $request->input('nb_point');
            $myLongueur->point_id = $request->input('point_id');
            $myLongueur->anchor_id = $request->input('anchor_id');
            $myLongueur->incline_id = $request->input('incline_id');
            $myLongueur->reception_id = $request->input('reception_id');
            $myLongueur->start_id = $request->input('start_id');
            $myLongueur->section_order = 1;
            $myLongueur->save();
        }

        //mise à jour des informations de la falaise (type de voie, grande-voie,etc.)
        Crag::majInformation($route->crag_id);
        Sector::majInformation($route->sector_id);

        //Mise à jour de l'index de recherche
        Search::index('App\Route', $route->id, $route->label);

        return response()->json(json_encode($route));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //see modal controller
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|String|max:255',
            'height' => 'nullable|Integer|min:0',
            'open_year' => 'nullable|Integer|min:1800',
            'nb_longueur' => 'nullable|Integer|min:1',
        ]);

        //mise à jour des données de la falaise
        $route = Route::where('id', $request->input('id'))->with('routeSections')->first();

        $route->label = $request->input('label');
        $route->sector_id = $request->input('sector_id');
        $route->climb_id = $request->input('climb_id');
        $route->height = $request->input('height');
        $route->nb_longueur = $request->input('nb_longueur');
        $route->open_year = $request->input('open_year');
        $route->opener = $request->input('opener');
        $route->save();

        if($request->input('type_cotation_longeur') == 'on' && ($request->input('climb_id') == '4' || $request->input('climb_id') == '5' || $request->input('climb_id') == '6' )){
            //cas d'une grande-voie avec plusieur longueur

            $tabLongeur = explode('||', $request->input('jsonLongueur'));
            foreach ($tabLongeur as $key=>$longueur){

                $tabInfo = explode(';',$longueur);

                if(isset($route->routeSections[$key])){
                    $myLongueur = $route->routeSections[$key];
                }else{
                    $myLongueur = new RouteSection();
                    $myLongueur->route_id = $route->id;
                }

                $myLongueur->grade = $tabInfo[0];
                $myLongueur->sub_grade = $tabInfo[1];
                $myLongueur->anchor_id = $tabInfo[2];
                $myLongueur->point_id = $tabInfo[3];
                $myLongueur->nb_point = $tabInfo[4];
                $myLongueur->incline_id = $tabInfo[5];
                $myLongueur->section_height = $tabInfo[6];
                $myLongueur->grade_val = Route::gradeToVal($tabInfo[0], $tabInfo[1]);
                $myLongueur->section_order = ($key + 1);
                $myLongueur->reception_id = 1;
                $myLongueur->start_id = 1;
                $myLongueur->save();
            }

            //on supprime les longueurs en trop
            if(count($tabLongeur) < count($route->routeSections)){
                for($i = count($tabLongeur); $i < count($route->routeSections) - 1 ; $i++){
                    $route->routeSections[$i]->delete();
                }
            }

        }else{
            //cas d'une voie en une seul longueur
            $route->routeSections[0]->grade = $request->input('grade');
            $route->routeSections[0]->sub_grade = $request->input('sub_grade');
            $route->routeSections[0]->grade_val = Route::gradeToVal($request->input('grade'), $request->input('sub_grade'));
            $route->routeSections[0]->section_height = $request->input('height');
            $route->routeSections[0]->nb_point = $request->input('nb_point');
            $route->routeSections[0]->point_id = $request->input('point_id');
            $route->routeSections[0]->anchor_id = $request->input('anchor_id');
            $route->routeSections[0]->incline_id = $request->input('incline_id');
            $route->routeSections[0]->reception_id = $request->input('reception_id');
            $route->routeSections[0]->start_id = $request->input('start_id');
            $route->routeSections[0]->section_order = 1;
            $route->routeSections[0]->save();

            //on supprime les éventuels longueur suplémentaire
            if(count($route->routeSections) > 1){
                foreach ($route->routeSections as $key => $section){
                    if($key != 0) $section->delete();
                }
            }
        }

        //mise à jour des informations de la falaise (type de voie, grande-voie,etc.)
        Crag::majInformation($route->crag_id);
        Sector::majInformation($route->sector_id);

        //Mise à jour de l'index de recherche
        Search::index('App\Route', $route->id, $route->label);

        return response()->json(json_encode($route));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
