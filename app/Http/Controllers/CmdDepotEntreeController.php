<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmdDepotEntree;

class CmdDepotEntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relations = CmdDepotEntree::with(['cmdDepot', 'entreeDepot'])->get();
        return response()->json($relations);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'cmd_depot_id' => 'required|exists:cmd_depots,id',
            'entree_depot_id' => 'required|exists:entree_depots,id',
        ]);

        $relation = CmdDepotEntree::create($validated);
        return response()->json($relation,201);

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
        //
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
       $validated = $request->validate([
        'cmd_depot_id' => 'required|exists:cmd_depots,id',
        'entree_depot_id' => 'required|exists:entree_depots,id',
    ]);

    $relation = CmdDepotEntree::findOrFail($id);
    $relation->update($validated);
    return response()->json($relation);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relation = CmdDepotEntree::findOrFail($id);
        $relation->delete();
        return response()->json(['message' => 'Relation supprimée avec succès']);
    }
}
