<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSortiePatient;

class DetailSortiePatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $details = DetailSortiePatient::with(['sortie', 'produit'])->get();
        return view('detailsortiepatients.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('detailsortiepatients.create');
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
            'id_sortie_vers_patient' => 'required|exists:sortie_vers_patients,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        DetailSortiePatient::create($validated);
        return redirect()->route('detailsortiepatients.index')->with('success', 'Détail ajouté.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $detail = DetailSortiePatient::with(['sortie', 'produit'])->findOrFail($id);
        return view('detailsortiepatients.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $detail = DetailSortiePatient::findOrFail($id);
        return view('detailsortiepatients.edit', compact('detail'));
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
            'id_sortie_vers_patient' => 'required|exists:sortie_vers_patients,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:1',
        ]);
        $detail = DetailSortiePatient::findOrFail($id);
        $detail->update($validated);
        return redirect()->route('detailsortiepatients.index')->with('success', 'Détail mis à jour.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DetailSortiePatient::destroy($id);
        return redirect()->route('detailsortiepatients.index')->with('success', 'Détail supprimé.');
   
    }
}
