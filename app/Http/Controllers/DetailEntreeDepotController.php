<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailEntreeDepot;

class DetailEntreeDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = DetailEntreeDepot::with(['entreeDepot', 'produit'])->get();
        return response()->json($details);
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
            'entree_depot_id' => 'required|exists:entree_depots,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);

        $detail = DetailEntreeDepot::create($validated);
        return response()->json($detail,201);

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
        'entree_depot_id' => 'required|exists:entree_depots,id',
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|numeric|min:1',
    ]);

    $detail = DetailEntreeDepot::findOrFail($id);
    $detail->update($validated);
    return response()->json($detail);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = DetailEntreeDepot::findOrFail($id);
        $detail->delete();
        return response()->json(['message' => 'Détail d’entrée supprimé avec succès']);
    }
}
