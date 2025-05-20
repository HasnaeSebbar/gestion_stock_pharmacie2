<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieParCommande;

class SortieParCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieParCommande::all();
        return view('sortieparcommandes.index', compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sortieparcommandes.create');
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
            'id_cmd_depot' => 'required|exists:cmd_depots,id',
            'id_depot' => 'required|exists:depots,id',
        ]);
        SortieParCommande::create($validated);
        return redirect()->route('sortieparcommandes.index')->with('success', 'Sortie ajoutée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $sortie = SortieParCommande::findOrFail($id);
        return view('sortieparcommandes.show', compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sortie = SortieParCommande::findOrFail($id);
        return view('sortieparcommandes.edit', compact('sortie'));
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
            'id_cmd_depot' => 'required|exists:cmd_depots,id',
            'id_depot' => 'required|exists:depots,id',
        ]);
        $sortie = SortieParCommande::findOrFail($id);
        $sortie->update($validated);
        return redirect()->route('sortieparcommandes.index')->with('success', 'Sortie mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SortieParCommande::destroy($id);
        return redirect()->route('sortieparcommandes.index')->with('success', 'Sortie supprimée.');
    }
}
