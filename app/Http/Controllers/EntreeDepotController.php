<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntreeDepot;
use App\Models\DetailEntreeDepot;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class EntreeDepotController extends Controller
{
    public function create()
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('majeur.stock_entrer', compact('depots', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_entree' => 'required|date',
            'depot_id' => 'required|exists:depots,id_depot',
            'produit_id' => 'required|array|min:1',
            'produit_id.*' => 'required|exists:produits,id',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $entree = EntreeDepot::create([
                'id_depot' => $request->depot_id,
                'date_entree' => $request->date_entree,
            ]);

            foreach ($request->produit_id as $i => $produitId) {
                DetailEntreeDepot::create([
                    'entree_depot_id' => $entree->id,
                    'produit_id' => $produitId,
                    'quantite_recue' => $request->quantite[$i],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Entrée enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    // Historique des entrées
    public function historique(Request $request)
    {
        $query = \App\Models\EntreeDepot::with(['details.produit', 'depot'])->orderByDesc('date_entree');
        if ($request->filled('date_entree')) {
            $query->whereDate('date_entree', $request->date_entree);
        }
        $entrees = $query->get();
        return view('majeur.historique_entrees', compact('entrees'));
    }
}
