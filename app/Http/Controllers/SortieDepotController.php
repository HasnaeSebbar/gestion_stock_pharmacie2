<?php

namespace App\Http\Controllers;

use App\Models\CmdDepot;
use App\Models\SortieDepot;
use App\Models\Depot;
use App\Models\CommandeDepotSc;
use App\Models\DetailCommandeDepotSc;
use Illuminate\Http\Request;

class SortieDepotController extends Controller
{
    public function index()
    {
        $sorties = SortieDepot::with('depotSource', 'depotDestin')->get();
        return view('sortie_depots.index', compact('sorties'));
    }

    public function create()
    {
        $services = Depot::all();
        $commandes = CmdDepot::all();
        // Liste fixe des types de commande
        $types_commande = [
            'bon mensuelle',
            'bon retour',
            'bon échange',
            'bon décharge',
            'bon ordonnance',
            'bon supplémentaire'
        ];

        return view('chef.sortie.service', compact('services', 'commandes', 'types_commande'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id_depot',
            'id_depot_destin' => 'required|exists:depots,id_depot',
        ]);

        SortieDepot::create($request->all());

        // Recharge les données nécessaires pour la vue
        $services = Depot::all();
        $commandes = CmdDepot::all();

        return view('chef.sortie.service', compact('services', 'commandes'))
            ->with('success', 'Sortie dépôt créée avec succès.');
    }

    public function show(SortieDepot $sortieDepot)
    {
        return view('sortie_depots.show', compact('sortieDepot'));
    }

    public function edit(SortieDepot $sortieDepot)
    {
        return view('sortie_depots.edit', compact('sortieDepot'));
    }

    public function update(Request $request, SortieDepot $sortieDepot)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id_depot',
            'id_depot_destin' => 'required|exists:depots,id_depot',
        ]);

        $sortieDepot->update($request->all());

        return redirect()->route('sortie_depots.index')->with('success', 'Sortie dépôt mise à jour avec succès.');
    }

    public function destroy(SortieDepot $sortieDepot)
    {
        $sortieDepot->delete();

        return redirect()->route('sortie_depots.index')->with('success', 'Sortie dépôt supprimée avec succès.');
    }

    public function serviceRecherche(Request $request)
    {
        $services = Depot::all();
        $types_commande = [
            'bon mensuelle',
            'bon retour',
            'bon échange',
            'bon décharge',
            'bon ordonnance',
            'bon supplémentaire'
        ];

        $commande_id = $request->input('commande_id');
        $commandeProduits = collect();

        if ($commande_id) {
            // Charge les détails AVEC la relation produit
            $commandeProduits = \App\Models\DetailCmd::with('produit')->where('id_cmd_sc', $commande_id)->get();
        }

        return view('chef.sortie.service', compact('services', 'types_commande', 'commandeProduits', 'commande_id'));
    }

    public function commandesTraitees()
    {
        // Récupère toutes les sorties liées à une commande traitée par la pharmacie
        $sorties = \App\Models\SortieDepot::with([
            'depotSource',
            'depotDestination',
            'details.produit',
            'sortieParCommande.cmdDepot'
        ])
        ->whereHas('sortieParCommande') // n'affiche que les sorties liées à une commande
        ->get();

        return view('majeur.commandes_traitees', compact('sorties'));
    }
}