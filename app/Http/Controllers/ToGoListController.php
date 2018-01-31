<?php

namespace App\Http\Controllers;

use App\toGoList;
use Illuminate\Http\Request;
use Response;

class ToGoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $places = toGoList::all();
//        $places= toGoList::select('placeName')->get();
        $places= toGoList::select([
            'id' => 'id',
            'placeName' => 'placeName',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'visited' => 'visited'
        ])->get();
        return response()->json($places);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = new toGoList([
            'placeName' => $request->get('placeName'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'visited' => $request->get('visited')
        ]);
        $place->save();
        return Response::json(array('success' => true, 'last_insert_id' => $place->id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = toGoList::find($id);
        $place->placeName = $request->get('placeName');
        $place->latitude = $request->get('latitude');
        $place->longitude = $request->get('longitude');
        $place->visited = $request->get('visited');
        $place->save();

        return response()->json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = toGoList::find($id);
        $place->delete();

        return response()->json('Successfully Deleted');
    }
}
