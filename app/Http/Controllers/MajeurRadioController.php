<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot;
use App\Models\SortieInterne;

class MajeurRadioController extends Controller
{
    // Dashboard du majeur
    public function dashboard()
    {
        $nbrProduits = Produit::count();
        $nbrCommandes = CmdDepot::count();
        $nbrSorties = SortieInterne::count();

        return view('majeur.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrSorties' => $nbrSorties,
        ]);
    }

    // Afficher le formulaire pour passer une commande
    public function passerCommande()
    {
        $produits = Produit::all();
        return view('majeur.commande', compact('produits'));
    }

    // Afficher le formulaire pour entrer du stock
    public function entrerStock()
    {
        $produits = Produit::all();
        return view('majeur.entrer_stock', compact('produits'));
    }

    // Afficher le formulaire pour sortir du stock
    public function sortieStock()
    {
        $produits = Produit::all();
        return view('majeur.sortie_stock', compact('produits'));
    }

    // Visualiser le stock
    public function visualiserStock()
    {
        $produits = Produit::all();
        return view('majeur.visualiser_stock', compact('produits'));
    }
}