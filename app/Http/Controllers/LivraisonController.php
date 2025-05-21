<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandeFournisseur;

class LivraisonController extends Controller
{
    // Affiche le formulaire ou la dernière livraison
    public function derniere()
    {
        // Exemple : afficher la dernière commande fournisseur à livrer
        $commande = CommandeFournisseur::latest()->first();

        return view('chef.commandes_fournisseur.enregistrer_livraison', [
            'commande' => $commande,
            // Ajoute d'autres variables si besoin
        ]);
    }
}