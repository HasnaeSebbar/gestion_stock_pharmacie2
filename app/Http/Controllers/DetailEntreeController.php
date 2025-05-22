<?php

namespace App\Http\Controllers;

// DetailEntreeController


use App\Models\DetailEntree;
use App\Models\EntreeFournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailEntreeController extends Controller {
    public function index() {
        $details = DetailEntree::with(['entree', 'produit'])->get();
        return view('detail_entrees.index', compact('details'));
    
    }

    public function create() {
        $entrees = EntreeFournisseur::all();
        $produits = Produit::all();
        return view('detail_entrees.create', compact('entrees', 'produits'));
    }

    public function store(Request $request) {
     dd($request->all());
        $request->validate([
    'id_entree' => 'required|exists:entree_fournisseurs,id_entree',
    'id_produit' => 'required|exists:produits,id',
    'quantite_recue' => 'required|integer|min:1',
]);


        DetailEntree::create($request->all());
        return redirect()->route('detail-entrees.index')->with('success', 'Détail d’entrée ajouté avec succès.');
   

    }

    public function show($id) {
        $detail = DetailEntree::with(['entree', 'produit'])->findOrFail($id);
        return view('detail_entrees.show', compact('detail'));
    }

    public function edit($id) {
        $detail = DetailEntree::findOrFail($id);
        $entrees = EntreeFournisseur::all();
        $produits = Produit::all();
        return view('detail_entrees.edit', compact('detail', 'entrees', 'produits'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_entree' => 'required|exists:entree_fournisseurs,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite_recue' => 'required|integer|min:1',
        ]);

        $detail = DetailEntree::findOrFail($id);
        $detail->update($request->all());
        return redirect()->route('detail-entrees.index')->with('success', 'Détail d’entrée mis à jour avec succès.');
    }

    public function destroy($id) {
        DetailEntree::destroy($id);
        return redirect()->route('detail-entrees.index')->with('success', 'Détail d’entrée supprimé avec succès.');
    }
}