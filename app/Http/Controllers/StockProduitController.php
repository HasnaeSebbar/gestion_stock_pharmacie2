<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockProduit;
use App\Models\Stock;
use App\Models\Produit;

class StockProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockProduits = StockProduit::with(['stock.depot', 'produit'])->get();
        return view('stock_produits.index', compact('stockProduits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stocks = Stock::with('depot')->get();
        $produits = Produit::all();
        return view('stock_produits.create', compact('stocks', 'produits'));
   
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
            'id_stock' => 'required|exists:stocks,id_stock',
            'id_produit' => 'required|exists:produits,id',
            'quantite_initial' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'seuil_alerte_reactif' => 'required|integer|min:0',
        ]);

        StockProduit::create([
            'id_stock' => $request->id_stock,
            'id_produit' => $request->id_produit,
            'quantite_initial' => $request->quantite_initial,
            'seuil_alerte' => $request->seuil_alerte,
            'seuil_alerte_reactif' => $request->seuil_alerte_reactif,
        ]);

        return redirect()->route('stock_produits.index')->with('success', 'Produit ajouté au stock avec succès.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Assuming $id is the primary key of StockProduit
        $stockProduit = StockProduit::with(['stock.depot', 'produit'])->findOrFail($id);

        return view('stock_produits.show', compact('stockProduit'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Assuming $id is the primary key of StockProduit
        $stockProduit = StockProduit::findOrFail($id);

        return view('stock_produits.edit', compact('stockProduit'));
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
        $request->validate([
            'quantite_initial' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'seuil_alerte_reactif' => 'required|integer|min:0',
        ]);

        $stockProduit = StockProduit::findOrFail($id);

        $stockProduit->update([
            'quantite_initial' => $request->quantite_initial,
            'seuil_alerte' => $request->seuil_alerte,
            'seuil_alerte_reactif' => $request->seuil_alerte_reactif,
        ]);

        return redirect()->route('stock_produits.index')->with('success', 'Stock mis à jour avec succès.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_stock
     * @param  int  $id_produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_stock, $id_produit)
    {
        $stockProduit = StockProduit::where('id_stock', $id_stock)
            ->where('id_produit', $id_produit)
            ->firstOrFail();

        $stockProduit->delete();

        return redirect()->route('stock_produits.index')->with('success', 'Produit supprimé du stock.');
   
    }
}
