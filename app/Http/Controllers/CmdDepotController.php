<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmdDepot;
use App\Models\Depot;

class CmdDepotController extends Controller
{
    // Afficher la liste des commandes de service
    public function index()
    {
        $commandes = CmdDepot::with(['depotSource', 'depotDest'])->orderByDesc('date_cmd')->get();
        return view('cmd_depot.index', compact('commandes'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $depots = Depot::all();
        return view('cmd_depot.create', compact('depots'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'depot_source_id' => 'required|exists:depots,id_depot',
            'depot_dest_id'   => 'required|exists:depots,id_depot',
            'date_cmd'        => 'required|date',
            'statut'          => 'required|string',
        ]);

        CmdDepot::create($request->all());

        return redirect()->route('cmd_depot.index')->with('success', 'Commande créée avec succès.');
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $commande = CmdDepot::with(['depotSource', 'depotDest', 'details'])->findOrFail($id);
        return view('cmd_depot.show', compact('commande'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $commande = CmdDepot::findOrFail($id);
        $depots = Depot::all();
        return view('cmd_depot.edit', compact('commande', 'depots'));
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $request->validate([
            'depot_source_id' => 'required|exists:depots,id_depot',
            'depot_dest_id'   => 'required|exists:depots,id_depot',
            'date_cmd'        => 'required|date',
            'statut'          => 'required|string',
        ]);

        $commande = CmdDepot::findOrFail($id);
        $commande->update($request->all());

        return redirect()->route('cmd_depot.index')->with('success', 'Commande mise à jour avec succès.');
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $commande = CmdDepot::findOrFail($id);
        $commande->delete();

        return redirect()->route('cmd_depot.index')->with('success', 'Commande supprimée avec succès.');
    }
}
