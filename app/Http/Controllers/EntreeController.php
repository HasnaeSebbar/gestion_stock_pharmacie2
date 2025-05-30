<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
use App\Models\EntreeFournisseur;
use App\Models\Depot;
use App\Models\DetailEntree;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntreeController extends Controller
{
    public function index()
    {
        $depotsSecondaires = \App\Models\Depot::where('type', 'secondaire')->get();
        $produits = \App\Models\Produit::all();
        return view('chef.entrees.create_entree', [
            'depotsSecondaires' => $depotsSecondaires,
            'produits' => $produits
        ]);
    }
    
    
public function createEntreeService()
{
    $depotsSecondaires = Depot::where('type', 'secondaire')->get();
    $produits = Produit::all();
    return view('chef.entrees.create_entree', [
    'depotsSecondaires' => $depotsSecondaires,
    'produits' => $produits
]);

}

public function storeEntreeService(Request $request)
{
    $request->validate([
        'date_entree' => 'required|date',
        'id_depot' => 'required|exists:depots,id_depot',
        'quantite_recue' => 'required|array',
    ]);

    DB::beginTransaction();

    try {
        $entree = EntreeFournisseur::create([
             'commande_id' => null,
            // 'commande_id' => 'nullable|exists:commandes,id',
            'date_entree' => $request->date_entree,
            'id_depot' => $request->id_depot,
            'fournisseur_id' => null,
        ]);

        // $request->quantite_recue est un tableau associatif [id_produit => quantite]
        foreach ($request->quantite_recue as $produitId => $quantite) {
            if ($quantite > 0) {
                DetailEntree::create([
                    'id_entree' => $entree->id_entree,
                    'id_produit' => $produitId,
                    'quantite_recue' => $quantite,
                ]);
                
                // Met à jour ou crée le stock du produit
                $stockProduit = \App\Models\StockProduit::where('id_produit', $produitId)->first();
                if ($stockProduit) {
                    $stockProduit->quantite += $quantite;
                    $stockProduit->save();
                } else {
                    \App\Models\StockProduit::create([
                        'id_produit' => $produitId,
                        'quantite' => $quantite,
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()->route('entrees.service.create')->with('success', 'Entrée enregistrée avec succès.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
    }
}


// public function create()
// {
//     $services = Depot::where('type', 'secondaire')->get(); // les services hospitaliers
//     $produits = Produit::all();

//     return view('chef.commandes_fournisseur.create_entree', compact('services', 'produits'));
// }



    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commande_fournisseurs,id',
            'date_entree' => 'required|date',
            'produit_id' => 'required|array',
            'quantite_recue' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // 1. Créer l'entrée dans la table entrees
            $entree = \App\Models\EntreeFournisseur::create([
                'commande_id' => $request->commande_id,
                'date_entree' => $request->date_entree,
                'id_depot' => 1, // adapte selon ta logique
                'fournisseur_id' => \App\Models\CommandeFournisseur::find($request->commande_id)->fournisseur_id,
            ]);

            // 2. Pour chaque produit livré
            foreach ($request->produit_id as $i => $produitId) {
                $quantite = $request->quantite_recue[$i];

                // a. Créer le détail d'entrée
                \App\Models\DetailEntree::create([
                    'id_entree' => $entree->id_entree,
                    'id_produit' => $produitId,
                    'quantite_recue' => $quantite,
                ]);

                // b. Mettre à jour ou créer la ligne dans stock_produits
                // Récupère l'id_stock du dépôt concerné
                $idDepot = 1; // adapte selon ta logique
                $stock = \App\Models\Stock::where('id_depot', $idDepot)->first();
                if (!$stock) {
                    $stock = \App\Models\Stock::create(['id_depot' => $idDepot]);
                }

                $stockProduit = \App\Models\StockProduit::where([
                    ['id_stock', $stock->id_stock],
                    ['id_produit', $produitId]
                ])->first();

                if ($stockProduit) {
                    $stockProduit->quantite_initial += $quantite;
                    $stockProduit->save();
                } else {
                    \App\Models\StockProduit::create([
                        'id_stock' => $stock->id_stock,
                        'id_produit' => $produitId,
                        'quantite_initial' => $quantite,
                        'seuil_alerte' => 0, // adapte si besoin
                        'seuil_alerte_reactif' => 0, // adapte si besoin
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Livraison enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }




    //     public function create($commande_id)
    // {
    //     $commande = CommandeFournisseur::findOrFail($commande_id);

  

    public function show($id)
    {
        $entree = EntreeFournisseur::with('details.produit')->findOrFail($id);

        return view('chef.entrees.show', compact('entree'));
    }



    public function edit($id)
    {
        $entree = EntreeFournisseur::findOrFail($id);
        $depots = Depot::all();
        $fournisseurs = Fournisseur::all();
        return view('entrees.edit', compact('entree', 'depots', 'fournisseurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_depot' => 'required|exists:depots,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_entree' => 'required|date',
        ]);

        $entree = EntreeFournisseur::findOrFail($id);
        $entree->update($request->all());
        return redirect()->route('entrees.index')->with('success', 'Entrée mise à jour avec succès.');
    }

    public function destroy($id)
    {
        EntreeFournisseur::destroy($id);
        return redirect()->route('entrees.index')->with('success', 'Entrée supprimée avec succès.');
    }


public function searchByDate(Request $request)
{
    $date = $request->input('date');
    $entrees = [];

    if ($date) {
        $entrees = EntreeFournisseur::whereDate('date_entree', $date)
            ->with(['depot', 'fournisseur', 'details.produit'])
            ->get();
    }

    return view('chef.entrees.recherche_par_date', compact('entrees', 'date'));
}
}