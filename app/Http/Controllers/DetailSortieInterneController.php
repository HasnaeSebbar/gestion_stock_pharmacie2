<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSortieInterne;

class DetailSortieInterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = DetailSortieInterne::with(['sortie', 'produit'])->get();
        return view('detailsortieinternes.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('detailsortieinternes.create');
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
            'id_sortie_interne' => 'required|exists:sortie_internes,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        DetailSortieInterne::create($validated);
        return redirect()->route('detailsortieinternes.index')->with('success', 'Détail ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $detail = DetailSortieInterne::with(['sortie', 'produit'])->findOrFail($id);
        return view('detailsortieinternes.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = DetailSortieInterne::findOrFail($id);
        return view('detailsortieinternes.edit', compact('detail'));
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
            'id_sortie_interne' => 'required|exists:sortie_internes,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        $detail = DetailSortieInterne::findOrFail($id);
        $detail->update($validated);
        return redirect()->route('detailsortieinternes.index')->with('success', 'Détail mis à jour.');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DetailSortieInterne::destroy($id);
        return redirect()->route('detailsortieinternes.index')->with('success', 'Détail supprimé.');
    }
}
