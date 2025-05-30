<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot;
use App\Models\DetailCmd;

class MajeurRadioController extends Controller
{
    // Affiche le formulaire de passage de commande
    public function passerCommande()
    {
        $produits = Produit::all();
        return view('majeur.commande_passer', compact('produits'));
    }

    // Enregistre la commande
    public function storeCommande(Request $request)
    {
        $request->validate([
            'date_cmd' => 'required|date',
            'depot_source_id' => 'required|exists:depots,id_depot',
            'depot_dest_id' => 'required|exists:depots,id_depot',
            'type_commande' => 'required|in:bon mensuelle,bon retour,bon échange,bon décharge,bon ordonnance,bon supplémentaire',
            'produit_id' => 'required|array|min:1',
            'produit_id.*' => 'required|exists:produits,id',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|integer|min:1',
        ]);

        // Création de la commande
        $commande = CmdDepot::create([
            'depot_source_id' => $request->depot_source_id,
            'depot_dest_id'   => $request->depot_dest_id,
            'date_cmd'        => $request->date_cmd,
            'statut'          => 'en attente',
            'type_commande'   => $request->type_commande,
        ]);

        // Ajout des produits à la commande
        foreach ($request->produit_id as $i => $produitId) {
            $quantite = $request->quantite[$i];
            DetailCmd::create([
                'cmd_depot_id' => $commande->id,
                'produit_id'   => $produitId,
                'quantite_cmd' => $quantite,
            ]);
        }

        return redirect()->back()->with('success', 'Commande enregistrée avec succès.');
    }
}