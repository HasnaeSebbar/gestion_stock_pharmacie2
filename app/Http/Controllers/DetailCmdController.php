<?php

// DetailCommandeController
namespace App\Http\Controllers;

use App\Models\DetailCommande;
use App\Models\CommandeFournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class DetailCommandeController extends Controller {
    public function index() {
        $details = DetailCommande::with(['commande', 'produit'])->get();
        return view('detail_commandes.index', compact('details'));
    }

    public function create() {
        $commandes = CommandeFournisseur::all();
        $produits = Produit::all();
        return view('detail_commandes.create', compact('commandes', 'produits'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_commande_fournisseur' => 'required|exists:commande_fournisseurs,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite_cmd' => 'required|integer|min:1',
        ]);

        DetailCommande::create($request->all());
        return redirect()->route('detail-commandes.index')->with('success', 'Détail ajouté avec succès.');
    }

    public function show($id) {
        $detail = DetailCommande::with(['commande', 'produit'])->findOrFail($id);
        return view('detail_commandes.show', compact('detail'));
    }

    public function edit($id) {
        $detail = DetailCommande::findOrFail($id);
        $commandes = CommandeFournisseur::all();
        $produits = Produit::all();
        return view('detail_commandes.edit', compact('detail', 'commandes', 'produits'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_commande_fournisseur' => 'required|exists:commande_fournisseurs,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite_cmd' => 'required|integer|min:1',
        ]);

        $detail = DetailCommande::findOrFail($id);
        $detail->update($request->all());
        return redirect()->route('detail-commandes.index')->with('success', 'Détail mis à jour avec succès.');
    }
    

    public function destroy($id) {
        DetailCommande::destroy($id);
        return redirect()->route('detail-commandes.index')->with('success', 'Détail supprimé avec succès.');
    }
}