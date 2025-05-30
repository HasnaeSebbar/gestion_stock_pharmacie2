<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot; // <-- Utilise CmdDepot
use App\Models\CommandeDepotSc;
use Illuminate\Support\Facades\DB;

class ChefPharmacieController extends Controller
{
    public function dashboard() // <-- ici, remplace "index" par "dashboard"
    {
        $nbrProduits = Produit::count();
        $nbrCommandes = CmdDepot::count(); // <-- Compte les commandes dans cmd_depot
        $nbrAlertes = 0;
        $nbrActivites = 0;

        // Nombre de produits en alerte (quantité < stock_alerte)
        $nbrAlertes = DB::table('stock_produits')
            ->whereColumn('quantite_initial', '<', 'seuil_alerte')
            ->count();

        return view('chef.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrAlertes' => $nbrAlertes,
            'nbrActivites' => $nbrActivites,
        ]);
    }
}