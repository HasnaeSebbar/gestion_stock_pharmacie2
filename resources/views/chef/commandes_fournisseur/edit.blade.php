@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Modifier la commande</h2>

    <form action="{{ route('commande_fournisseurs.update', $commande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date_commande">Date de commande :</label>
            <input type="date" name="date_commande" class="form-control" value="{{ $commande->date_commande }}" required>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité commandée <span class="text-muted">(mettre 0 pour supprimer)</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    @php
                        $quantite = $commande->details->firstWhere('produit_id', $produit->id)->quantite ?? 0;
                    @endphp
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>
                            <input type="number" name="quantites[{{ $produit->id }}]" value="{{ $quantite }}" min="0" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
    </form>
</div>
@endsection