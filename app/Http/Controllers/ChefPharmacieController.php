<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CommandeInterne;

class ChefPharmacieController extends Controller
{
    public function index()
    {
        $nbrProduits = Produit::count(); // Nombre exact de produits
        $nbrCommandes = \App\Models\CommandeServiceGood evening, Which? Controller. I. Win. Liquid. Formula. I'm kissing his little fishy little deer man, which was high on little and it's for. Ocean Philippines GCC to play. Kabul.::count();
        $nbrAlertes = \App\Models\Produit::whereColumn('stock', '<', 'seuil_alerte')->count();
        $nbrActivites = 0; // Mets ici la logique pour les activités si tu as un modèle

        return view('chef.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrAlertes' => $nbrAlertes,
            'nbrActivites' => $nbrActivites,
        ]);
    }
}
