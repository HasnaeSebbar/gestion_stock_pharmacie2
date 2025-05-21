<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\SortieVersPatient;
use App\Models\DetailSortiePatient;
use Illuminate\Http\Request;

class SortieVersPatientController extends Controller
{
    public function create()
    {
        $depots = \App\Models\Depot::all();
        $produits = \App\Models\Produit::all();
        return view('chef.sortie.patient', compact('depots', 'produits'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_nais' => 'required|date',
            'numero_dossier' => 'required|string',
            'date_sortie' => 'required|date',
            'id_depot' => 'required|integer',
            'produits' => 'required|array',
            'produits.*.id_produit' => 'required|integer',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        // Création du patient
        $patient = Patient::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'date_nais' => $validated['date_nais'],
            'numero_dossier' => $validated['numero_dossier'],
        ]);

        // Création de la sortie vers patient
        $sortie = SortieVersPatient::create([
            'id_patient' => $patient->id_patient,
            'date_sortie' => $validated['date_sortie'],
            'id_depot' => $validated['id_depot'],
        ]);

        // Création des détails de sortie
        foreach ($validated['produits'] as $prod) {
            DetailSortiePatient::create([
                'id_sortie_vers_patient' => $sortie->id_sortie_vers_patient,
                'id_produit' => $prod['id_produit'],
                'quantite' => $prod['quantite'],
            ]);
        }

        return redirect()->route('sortie_vers_patients.create')->with('success', 'Sortie vers patient enregistrée.');
    }
}
