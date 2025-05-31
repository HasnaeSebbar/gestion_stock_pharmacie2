<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntreeDepot;
use App\Models\DetailEntreeDepot;
use App\Models\CmdDepotEntree;
use App\Models\Depot;
use App\Models\Produit;
use App\Models\CmdDepot;
use Illuminate\Support\Facades\DB;

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
        $depots = Depot::all();
        $produits = Produit::all();
        $commandes = CmdDepot::all();
        return view('majeur.stock_entrer', compact('depots', 'produits', 'commandes'));
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
            'date_entree' => 'required|date',
            'depot_id' => 'required|exists:depots,id',
            'produit_id' => 'required|array|min:1',
            'produit_id.*' => 'required|exists:produits,id',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // 1. Créer l'entrée
            $entree = \App\Models\EntreeDepot::create([
                'date_entree' => $request->date_entree,
                'id_depot' => $request->depot_id, // attention au nom de la colonne !
            ]);

            // 2. Créer les détails et MAJ stock_produits
            // Récupérer le stock du dépôt
            $stock = \App\Models\Stock::where('id_depot', $request->depot_id)->first();

            foreach ($request->produit_id as $i => $produitId) {
                $quantite = $request->quantite[$i];

                // Détail entrée
                \App\Models\DetailEntreeDepot::create([
                    'entree_depot_id' => $entree->id,
                    'produit_id' => $produitId,
                    'quantite_recue' => $quantite,
                ]);

                // MAJ ou création du stock_produits
                if ($stock) {
                    $stockProduit = \App\Models\StockProduit::where('id_stock', $stock->id_stock)
                        ->where('id_produit', $produitId)
                        ->first();

                    if ($stockProduit) {
                        $stockProduit->quantite_initial += $quantite;
                        $stockProduit->save();
                    } else {
                        \App\Models\StockProduit::create([
                            'id_stock' => $stock->id_stock,
                            'id_produit' => $produitId,
                            'quantite_initial' => $quantite,
                            'seuil_alerte' => 0,
                            'seuil_alerte_reactif' => 0,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Entrée enregistrée avec succès.');
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
