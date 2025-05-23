@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 fw-bold text-primary">Commandes Fournisseur</h2>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('commandes_fournisseur.create') }}" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle"></i> Passer une commande
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->isEmpty())
        <div class="alert alert-info text-center">
            Aucune commande enregistrée pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Fournisseur</th>
                        <th>Date de commande</th>
                        <th>Statut</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->fournisseur->nom }}</td>
                            <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                            <td>{{ ucfirst($commande->statut) }}</td>
                            <td class="text-center">
                                <a href="{{ route('commandes_fournisseur.show_pdf', $commande->id) }}" class="btn btn-info btn-sm me-1" target="_blank">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                                <a href="{{ route('commandes_fournisseur.imprimer', $commande->id) }}" class="btn btn-secondary btn-sm me-1" target="_blank">
                                    <i class="bi bi-printer"></i> Imprimer
                                </a>
                                <a href="{{ route('commande_fournisseurs.edit', $commande->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <form action="{{ route('commandes_fournisseur.destroy', $commande->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                                <a href="{{ route('livraison.formulaire', ['id' => $commande->id]) }}" class="btn btn-sm btn-success">
                                  <i class="bi bi-truck"></i> Enregistrer une livraison
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection