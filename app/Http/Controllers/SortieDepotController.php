<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieDepot;

class SortieDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieDepot::all();
        return view('sortiedepots.index', compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sortiedepots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id',
            'id_depot_destinataire' => 'required|exists:depots,id',
        ]);
        SortieDepot::create($validated);
        return redirect()->route('sortiedepots.index')->with('success', 'Sortie ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = SortieDepot::findOrFail($id);
        return view('sortiedepots.show', compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sortie = SortieDepot::findOrFail($id);
        return view('sortiedepots.edit', compact('sortie'));
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
        $validated = $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id',
            'id_depot_destinataire' => 'required|exists:depots,id',
        ]);
        $sortie = SortieDepot::findOrFail($id);
        $sortie->update($validated);
        return redirect()->route('sortiedepots.index')->with('success', 'Sortie mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SortieDepot::destroy($id);
        return redirect()->route('sortiedepots.index')->with('success', 'Sortie supprimée.');
    }
}
