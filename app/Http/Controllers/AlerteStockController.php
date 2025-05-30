<?php

namespace App\Http\Controllers;

use App\Models\AlerteStock;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AlerteStockController extends Controller
{
    public function index()
    {
        $produitsAlerte = DB::table('stocks')
            ->join('depots', 'stocks.id_depot', '=', 'depots.id_depot')
            ->join('stock_produits', 'stocks.id_stock_produit', '=', 'stock_produits.id_stock_produit')
            ->join('produits', 'stock_produits.id_produit', '=', 'produits.id')
            ->select(
                'depots.nom as depot_nom',
                'produits.nom as produit_nom',
                'stock_produits.quantite',
                'stock_produits.stock_alerte'
            )
            ->whereColumn('stock_produits.quantite', '<', 'stock_produits.stock_alerte')
            ->get();

        return view('chef.alerteStocks.produits_en_alerte', compact('produitsAlerte'));
    }

    public function create()
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('alerteStocks.create', compact('depots', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'id_produit' => 'required|exists:produits,id',
            'type_alerte' => 'required|string|max:255',
            'date_alerte' => 'required|date',
        ]);

        AlerteStock::create($validated);

        return redirect()->route('alerteStocks.index')->with('success', 'Alerte créée avec succès.');
    }

    public function show(AlerteStock $alerteStock)
    {
        $alerteStock->load('depot', 'produit');
        return view('alerteStocks.show', compact('alerteStock'));
    }

    public function edit(AlerteStock $alerteStock)
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('alerteStocks.edit', compact('alerteStock', 'depots', 'produits'));
    }

    public function update(Request $request, AlerteStock $alerteStock)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'id_produit' => 'required|exists:produits,id',
            'type_alerte' => 'required|string|max:255',
            'date_alerte' => 'required|date',
        ]);

        $alerteStock->update($validated);

        return redirect()->route('alerteStocks.index')->with('success', 'Alerte mise à jour avec succès.');
    }

    public function destroy(AlerteStock $alerteStock)
    {
        $alerteStock->delete();
        return redirect()->route('alerteStocks.index')->with('success', 'Alerte supprimée avec succès.');
    }

    public function produitsEnAlerte()
    {
        $produitsAlerte = DB::table('stock_produits')
            ->join('produits', 'stock_produits.id_produit', '=', 'produits.id')
            ->select(
                'produits.nom as nom',
                'stock_produits.quantite_initial',
                'stock_produits.seuil_alerte'
            )
            ->whereColumn('stock_produits.quantite_initial', '<', 'stock_produits.seuil_alerte')
            ->get();

        return view('chef.alerteStocks.produits_en_alerte', compact('produitsAlerte'));
    }
}