<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Depot;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with('depot')->get();
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depots = Depot::all();
        return view('stocks.create', compact('depots'));
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
            'id_depot' => 'required|exists:depots,id_depot',
        ]);

        $stock = Stock::create([
            'id_depot' => $request->id_depot,
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::with(['depot', 'stockProduits.produit'])->findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $depots = Depot::all();
        return view('stocks.edit', compact('stock', 'depots'));
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
            'id_depot' => 'required|exists:depots,id_depot',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update([
            'id_depot' => $request->id_depot,
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    
    }
}
