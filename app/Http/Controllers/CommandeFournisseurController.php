<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\DetailEntree;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\DetailLivraison;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class CommandeFournisseurController extends Controller
{
    public function index()
    {
        // return view('chef.commandes_fournisseur.index');


        $commandes = CommandeFournisseur::with('fournisseur')->orderBy('created_at', 'desc')->get();
        return view('chef.commandes_fournisseur.index', compact('commandes'));
    }


    public function step1()
    {
        $fournisseurs = Fournisseur::all();
        return view('chef.commandes_fournisseur.create', compact('fournisseurs'));
    }

    public function step2(Request $request)
    {
        $request->validate([
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
        ]);

        $fournisseur_id = $request->id_fournisseur;
        $date_commande = $request->date_commande;
        $produits = Produit::all();

        return view('chef.commandes_fournisseur.produits', compact('fournisseur_id', 'date_commande', 'produits'));
    }


    //        public function create()
    // {
    //     $fournisseurs = Fournisseur::all();
    //     $produits = Produit::all(); // tous les médicaments et dispositifs médicaux
    //         return view('chef.commandes_fournisseur.create', compact('fournisseurs', 'produits'));
    //     }


    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('chef.commandes_fournisseur.create', compact('fournisseurs'));
    }

    public function produits($id)
    {
        $commande = CommandeFournisseur::findOrFail($id);
        $produits = Produit::all();
        return view('chef.commandes_fournisseur.produits', compact('commande', 'produits'));
    }

    public function storeProduits(Request $request)
    {
        $commande = CommandeFournisseur::findOrFail($request->commande_id);
        $produits = json_decode($request->produits_json, true);

        foreach ($produits as $prod) {
            DetailCommande::create([
                'commande_id' => $commande->id,
                'produit_id' => $prod['id'],
                'quantite' => $prod['quantite'],
            ]);
        }

        return redirect()->route('commandes_fournisseur.index')->with('success', 'Commande enregistrée avec succès.');
    }
    // Dans CommandeFournisseurController.php
    public function store(Request $request)
    {
        $request->validate([
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
            'quantites' => 'required|array',
        ]);

        // Étape 1 : Créer la commande
        $commande = CommandeFournisseur::create([
            'id_fournisseur' => $request->id_fournisseur,
            'date_commande' => $request->date_commande,
            'id_depot' => 1, // à adapter si besoin
            'statut' => 'en attente', // par défaut
        ]);

        // Étape 2 : Insérer les détails de la commande
        foreach ($request->quantites as $id_produit => $quantite) {
            if ($quantite > 0) {
                DB::table('detail_commandes')->insert([
                    'commande_id' => $commande->id,
                    'produit_id' => $id_produit,
                    'quantite' => $quantite,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('commandes_fournisseur.index')->with('success', 'Commande enregistrée avec succès');
    }

    public function bonCommande($id)
    {
        $commande = CommandeFournisseur::with(['fournisseur', 'produits'])->findOrFail($id);
        return view('chef.commandes_fournisseur.bon_commande', compact('commande'));
    }

    public function show($id)
    {
        $commande = CommandeFournisseur::with(['depot', 'fournisseur'])->findOrFail($id);
        return view('commandes.show', compact('commande'));
    }

    public function edit($id)
    {
        $commande = CommandeFournisseur::with('details.produit')->findOrFail($id);
        $produits = Produit::all(); // pour afficher la liste complète si besoin
        return view('chef.commandes_fournisseur.edit', compact('commande', 'produits'));
    }

public function update(Request $request, $id)
{
    // 1. Modifier la date
    $commande = CommandeFournisseur::findOrFail($id);
    $commande->date_commande = $request->date_commande;
    $commande->save();

    // 2. Modifier les lignes
    foreach ($request->quantites as $produit_id => $quantite) {
        $detail = DetailCommande::where('commande_id', $id)
                                ->where('produit_id', $produit_id)
                                ->first();

        if ($detail) {
            if ($quantite > 0) {
                $detail->quantite = $quantite;
                $detail->save();
            } else {
                $detail->delete();
            }
        } else {
            if ($quantite > 0) {
                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit_id,
                    'quantite' => $quantite,
                ]);
            }
        }
    }

    return redirect()->route('commande_fournisseurs.index')
                     ->with('success', 'Commande modifiée avec succès.');
}

    public function destroy($id)
    {
        CommandeFournisseur::destroy($id);
        return redirect()->route('commandes_fournisseur.index')->with('success', 'Commande supprimée avec succès.');
    }

    public function afficherProduits()
    {
        $produits = Produit::all(); // Récupère tous les produits
        return view('chef.commandes_fournisseur.produits', compact('produits'));
    }

    public function showPDF($id)
    {
        $commande = CommandeFournisseur::with(['fournisseur', 'details.produit'])->findOrFail($id);
        return view('chef.commandes_fournisseur.bon_commande', compact('commande'));
    }
    
    // Pour bouton "Voir"
public function voir($id)
{
    $commande = CommandeFournisseur::with('fournisseur', 'details.produit')->findOrFail($id);
    
    return view('chef.commandes_fournisseur.bon_commande', [
        'commande' => $commande,
        'isPdf' => false, // ← On précise que ce n'est PAS une version PDF
    ]);
}
// Pour bouton "Imprimer"
public function imprimer($id)
{
    $commande = CommandeFournisseur::with('fournisseur', 'details.produit')->findOrFail($id);

    $pdf = PDF::loadView('chef.commandes_fournisseur.bon_commande', [
        'commande' => $commande,
        'isPdf' => true, // ← Ici on indique que c'est pour le PDF
    ]);
    return $pdf->stream('bon_commande.pdf');
}

// enregistrerun commande fournisseur
public function enregistrerLivraison()
{
    // Récupérer la dernière commande fournisseur (statut validé)
    $commande = CommandeFournisseur::where('statut', 'validé')->latest()->first();

    if (!$commande) {
        return redirect()->back()->with('error', 'Aucune commande fournisseur validée trouvée.');
    }

    // Charger les détails des produits de cette commande
    $details = $commande->detailsCommande()->with('produit')->get();

    return view('chef.fournisseurs.enregistrer_livraison', compact('commande', 'details'));
}


// public function sauvegarderLivraison(Request $request)
// {
//     $produits = $request->input('produit_id');
//     $quantitesRecues = $request->input('quantite_recue');
//     $commandeId = $request->input('commande_id');

    // Pour chaque produit, enregistrer la quantité reçue
//     foreach ($produits as $index => $produitId) {
//         $quantiteRecue = intval($quantitesRecues[$index]);

//         // Exemple : créer une nouvelle entrée de livraison (ajuster selon ta base)
//         DetailLivraison::create([
//             'commande_fournisseur_id' => $commandeId,
//             'produit_id' => $produitId,
//             'quantite_recue' => $quantiteRecue,
//         ]);

//         // TODO : Mettre à jour le stock ici si besoin
//     }

//     return redirect()->route('route.de.la.page.d.accueil')->with('success', 'Livraison enregistrée avec succès.');
// }
// public function formulaireLivraison($id)
// {
//     $commande = CommandeFournisseur::with('details.produit')->findOrFail($id);

//     return view('chef.commandes_fournisseur.enregistrer_livraison', [
//         'commande' => $commande,
//         'detailsCommande' => $commande->details
//     ]);
// }


public function formulaireLivraison($id)
{
    $commande = CommandeFournisseur::with('fournisseur')->findOrFail($id);
    $detailsCommande = DetailCommande::with('produit')
        ->where('commande_id', $id)
        ->get();

    return view('chef.commandes_fournisseur.enregistrer_livraison', compact('commande', 'detailsCommande'));
}

public function livraisonDerniereCommande()
{
    // On récupère la dernière commande avec ses détails
    $commande = CommandeFournisseur::with('detailsCommande.produit')->latest()->first();

    if (!$commande) {
        return redirect()->back()->with('error', 'Aucune commande trouvée.');
    }

    $detailsCommande = $commande->detailsCommande;

    return view('chef.commandes_fournisseur.enregistrer_livraison', compact('commande', 'detailsCommande'));
}

public function showFormLivraison($id)
{
    $commande = CommandeFournisseur::with(['fournisseur', 'detailsCommande.produit'])->findOrFail($id);
    return view('chef.commandes_fournisseur.enregistrer_livraison', compact('commande'));
}

}