<?php

namespace App\Http\Controllers;

use App\Models\StockProduit;
use App\Models\Stock;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockProduitController extends Controller
{
    public function index()
    {
        $stockProduits = StockProduit::with(['stock.depot', 'produit'])->paginate(20);
        return view('stockProduits.index', compact('stockProduits'));
    }

    public function create()
    {
        $stocks = Stock::with('depot')->get();
        $produits = Produit::all();
        return view('stockProduits.create', compact('stocks', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_stock' => 'required|exists:stocks,id_stock',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:0',
            'stock_alerte' => 'nullable|integer|min:0',
            'stock_securite' => 'nullable|integer|min:0',
        ]);

        StockProduit::create($validated);

        return redirect()->route('stockProduits.index')->with('success', 'Produit en stock ajouté avec succès.');
    }

    public function show(StockProduit $stockProduit)
    {
        $stockProduit->load('stock.depot', 'produit');
        return view('stockProduits.show', compact('stockProduit'));
    }

    public function edit(StockProduit $stockProduit)
    {
        $stocks = Stock::with('depot')->get();
        $produits = Produit::all();
        return view('stockProduits.edit', compact('stockProduit', 'stocks', 'produits'));
    }

    public function update(Request $request, StockProduit $stockProduit)
    {
        $validated = $request->validate([
            'id_stock' => 'required|exists:stocks,id_stock',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:0',
            'stock_alerte' => 'nullable|integer|min:0',
            'stock_securite' => 'nullable|integer|min:0',
        ]);

        $stockProduit->update($validated);

        return redirect()->route('stockProduits.index')->with('success', 'Produit en stock mis à jour avec succès.');
    }

    public function destroy(StockProduit $stockProduit)
    {
        $stockProduit->delete();
        return redirect()->route('stockProduits.index')->with('success', 'Produit en stock supprimé avec succès.');
    }

    public function visualiser()
    {
        // Adapte l'id_stock selon le dépôt/service connecté
        $idDepot = 1; // ou Auth::user()->depot_id
        $stock = \App\Models\Stock::where('id_depot', $idDepot)->first();

        $stockProduits = [];
        if ($stock) {
            $stockProduits = \App\Models\StockProduit::with('produit')
                ->where('id_stock', $stock->id_stock)
                ->get();
        }

        return view('chef.stocks.visualiser', compact('stockProduits'));
    }
}