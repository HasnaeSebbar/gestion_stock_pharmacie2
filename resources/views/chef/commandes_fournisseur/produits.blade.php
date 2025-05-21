@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">Nouvelle commande - Choix des produits</h2>

    <form action="{{ route('commande_fournisseurs.store') }}" method="POST" id="formCommande">
        @csrf
        <input type="hidden" name="id_fournisseur" value="{{ $fournisseur_id }}">
        <input type="hidden" name="date_commande" value="{{ $date_commande }}">

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Unité</th>
                        <th>Prix</th>
                        <th>Quantité à commander</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->unite ?? '—' }}</td>
                            <td>{{ $produit->prix ?? '—' }}</td>
                            <td>
                                <input type="number" name="quantites[{{ $produit->id }}]" min="0" class="form-control" placeholder="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('commandes_fournisseur.create') }}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Valider la commande</button>
        </div>
    </form>
</div>
@endsection