<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntreeDepot;

class EntreeDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrees = EntreeDepot::with(['depot', 'details', 'cmdDepots'])->get();
        return response()->json($entrees);
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
            'date_entree' => 'required|date',
            'depot_id' => 'required|exists:depots,id',
        ]);

        $entreeDepot = EntreeDepot::create($validated);
        return response()->json($entreeDepot,201);

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
            'date_entree' => 'required|date',
            'depot_id' => 'required|exists:depots,id',
        ]);

        $entreeDepot = EntreeDepot::findOrFail($id);
        $entreeDepot->update($validated);
        return response()->json($entreeDepot);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entreeDepot = EntreeDepot::findOrFail($id);
        $entreeDepot->delete();
        return response()->json(['message' => 'Entrée supprimée avec succès']);
    }
}
