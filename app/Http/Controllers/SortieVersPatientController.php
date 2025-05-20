<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieVersPatient;
use App\Models\Produit;
use App\Models\DetailSortiePatient;
use App\Models\Depot;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SortieVersPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieVersPatient::with('patient')->get();
        return view('sortieverspatients.index', compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $produits = Produit::all(); // <-- c’est cette ligne qui importe
         $depots = Depot::all();

    return view('chef.sortie.patient', compact('produits', 'depots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 

public function store(Request $request)
{
    $request->validate([
        'id_patient' => 'required|exists:patients,id_patient',
        'id_depot' => 'required|exists:depots,id_depot',
        'produits' => 'required|array|min:1',
        'produits.*.id_produit' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        // 1. Créer la sortie vers patient
        $sortie = SortieVersPatient::create([
            'id_patient' => $request->id_patient,
            'date_sortie' => now(),
            'id_depot' => $request->id_depot,
        ]);

        // 2. Créer les détails de sortie
        foreach ($request->produits as $produit) {
            DetailSortiePatient::create([
                'id_sortie_vers_patient' => $sortie->id_sortie_vers_patient,
                'id_produit' => $produit['id_produit'],
                'quantite' => $produit['quantite'],
            ]);
        }

        DB::commit();
        return redirect()->route('sortie_vers_patients.create')->with('success', 'Sortie enregistrée avec succès.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Erreur : ' . $e->getMessage());
    }
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = SortieVersPatient::with('patient')->findOrFail($id);
        return view('sortieverspatients.show', compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $sortie = SortieVersPatient::findOrFail($id);
        return view('sortieverspatients.edit', compact('sortie'));
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
            'id_patient' => 'required|exists:patients,id',
            'date_sortie' => 'required|date',
            'type_depot' => 'required|string',
        ]);
        $sortie = SortieVersPatient::findOrFail($id);
        $sortie->update($validated);
        return redirect()->route('sortieverspatients.index')->with('success', 'Sortie mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       SortieVersPatient::destroy($id);
        return redirect()->route('sortieverspatients.index')->with('success', 'Sortie supprimée.');
    }
}
