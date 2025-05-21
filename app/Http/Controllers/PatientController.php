<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_nais' => 'required|date',
            'numero_dossier' => 'required|string|max:255',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.create')->with('success', 'Patient ajouté avec succès.');
    }
}