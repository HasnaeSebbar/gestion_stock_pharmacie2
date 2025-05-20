<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieInterne;

class SortieInterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieInterne::all();
        return view('sortieinternes.index', compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('sortieinternes.create');
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
            'id_depot' => 'required|exists:depots,id',
            'date_sortie' => 'required|date',
            'destinataire' => 'required|string',
            'type' => 'required|string',
            'nom' => 'nullable|string',
        ]);
        SortieInterne::create($validated);
        return redirect()->route('sortieinternes.index')->with('success', 'Sortie enregistrée.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = SortieInterne::findOrFail($id);
        return view('sortieinternes.show', compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sortie = SortieInterne::findOrFail($id);
        return view('sortieinternes.edit', compact('sortie'));
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
            'id_depot' => 'required|exists:depots,id',
            'date_sortie' => 'required|date',
            'destinataire' => 'required|string',
            'type' => 'required|string',
            'nom' => 'nullable|string',
        ]);
        $sortie = SortieInterne::findOrFail($id);
        $sortie->update($validated);
        return redirect()->route('sortieinternes.index')->with('success', 'Sortie mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SortieInterne::destroy($id);
        return redirect()->route('sortieinternes.index')->with('success', 'Sortie supprimée.');
    }
}
