<?php

namespace App\Http\Controllers;

use App\Crag;
use Illuminate\Http\Request;

class CragController extends Controller
{
    function cragPage($crag_id, $crag_title){

        $crag = Crag::where('id', $crag_id)
            ->with('rock')
            ->with('orientation')
            ->with('season')
            ->withCount('routes')
            ->withCount('links')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('topos')
            ->with('photos')
            ->with('topos.topo')
            ->with('massives.massive')
            ->with('topoWebs.user')
            ->with('topoPdfs.user')
            ->with('gapGrade')
            ->with('descriptions.user')
            ->first();

        //on ajoute une vue à la falaise
        $crag->views++;
        $crag->save();

        $data = [
            'crag' => $crag,
            'meta_title' => $crag['label'],
            'meta_description' => 'description de ' . $crag['label']
        ];

        return view('pages.crag.crag', $data);
    }
}
