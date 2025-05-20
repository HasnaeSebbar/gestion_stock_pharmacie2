<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSortieDepot;

class DetailSortieDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = DetailSortieDepot::with(['sortie', 'produit'])->get();
        return view('detailsortiedepots.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('detailsortiedepots.create');
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
            'id_sortie_depot' => 'required|exists:sortie_depots,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        DetailSortieDepot::create($validated);
        return redirect()->route('detailsortiedepots.index')->with('success', 'Détail ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = DetailSortieDepot::with(['sortie', 'produit'])->findOrFail($id);
        return view('detailsortiedepots.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = DetailSortieDepot::findOrFail($id);
        return view('detailsortiedepots.edit', compact('detail'));
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
            'id_sortie_depot' => 'required|exists:sortie_depots,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        $detail = DetailSortieDepot::findOrFail($id);
        $detail->update($validated);
        return redirect()->route('detailsortiedepots.index')->with('success', 'Détail mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DetailSortieDepot::destroy($id);
        return redirect()->route('detailsortiedepots.index')->with('success', 'Détail supprimé.');
    }
}
