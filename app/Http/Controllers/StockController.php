<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Depot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('depot')->paginate(15);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $depots = Depot::all();
        return view('stocks.create', compact('depots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
        ]);

        Stock::create($validated);

        return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
    }

    public function show(Stock $stock)
    {
        $stock->load('depot', 'stockProduits.produit');
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        $depots = Depot::all();
        return view('stocks.edit', compact('stock', 'depots'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
        ]);

        $stock->update($validated);

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    }

    public function visualiser()
    {
        $stocks = DB::table('stock_produits')
            ->join('produits', 'stock_produits.id_produit', '=', 'produits.id')
            ->select('produits.nom as nom_produit', 'stock_produits.quantite')
            ->get();

        return view('chef.stocks.visualiser', compact('stocks'));
    }
}