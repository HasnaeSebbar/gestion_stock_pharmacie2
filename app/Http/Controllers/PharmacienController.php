<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CmdDepot;
use App\Models\CommandeDepotSc;
use Illuminate\Http\Request;

class PharmacienController extends Controller
{
    public function index()
    {
        // Statistiques pour le dashboard pharmacien
        $nbrProduits = Produit::count();
        $nbrCommandes = CmdDepot::count();
        $nbrAlertes = 0; // Mets ici ta logique si tu veux compter les alertes
        $nbrActivites = 0; // Mets ici ta logique si tu veux compter les activités

        return view('pharmacien.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrAlertes' => $nbrAlertes,
            'nbrActivites' => $nbrActivites,
        ]);
    }
}