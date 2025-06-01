<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieInterne;
use App\Models\DetailSortieInterne;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class SortieInterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieInterne::all();
        return view('sortieinternes.index', compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('majeur.stock_sortie', compact('depots', 'produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot' => 'required|exists:depots,id_depot',
            'destinataire_nom' => 'required|string',
            'destinataire_type' => 'required|string',
            'id_produit' => 'required|array|min:1',
            'id_produit.*' => 'required|exists:produits,id',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $sortie = SortieInterne::create([
                'id_depot' => $request->id_depot,
                'date_sortie' => $request->date_sortie,
                'destinataire_nom' => $request->destinataire_nom,
                'destinataire_type' => $request->destinataire_type,
            ]);

            foreach ($request->id_produit as $i => $produitId) {
                DetailSortieInterne::create([
                    'id_sortie_interne' => $sortie->id_sortie_interne,
                    'id_produit' => $produitId,
                    'quantite' => $request->quantite[$i],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Sortie enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = SortieInterne::findOrFail($id);
        return view('sortieinternes.show', compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sortie = SortieInterne::findOrFail($id);
        return view('sortieinternes.edit', compact('sortie'));
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
            'id_depot' => 'required|exists:depots,id',
            'date_sortie' => 'required|date',
            'destinataire' => 'required|string',
            'type' => 'required|string',
            'nom' => 'nullable|string',
        ]);
        $sortie = SortieInterne::findOrFail($id);
        $sortie->update($validated);
        return redirect()->route('sortieinternes.index')->with('success', 'Sortie mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SortieInterne::destroy($id);
        return redirect()->route('sortieinternes.index')->with('success', 'Sortie supprimée.');
    }

    /**
     * Display the sortie interne history.
     *
     * @return \Illuminate\Http\Response
     */
    public function historique(Request $request)
    {
        $query = \App\Models\SortieInterne::with(['depot', 'details.produit'])->orderByDesc('date_sortie');

        if ($request->filled('date_sortie')) {
            $query->whereDate('date_sortie', $request->date_sortie);
        }

        $sorties = $query->get();

        return view('majeur.historique_sorties', compact('sorties'));
    }
}
