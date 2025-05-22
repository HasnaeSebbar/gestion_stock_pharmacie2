<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot; // <-- Utilise CmdDepot

class ChefPharmacieController extends Controller
{
    public function dashboard() // <-- ici, remplace "index" par "dashboard"
    {
        $nbrProduits = Produit::count();
        $nbrCommandes = CmdDepot::count(); // <-- Compte les commandes dans cmd_depot
        $nbrAlertes = 0;
        $nbrActivites = 0;

        return view('chef.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrAlertes' => $nbrAlertes,
            'nbrActivites' => $nbrActivites,
        ]);
    }
}
