{{-- filepath: e:\Projet_PFE\gestion_stock_pharmacie2\resources\views\chef\commandes_fournisseur\edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h2 class="fw-bold mb-0 text-center">
                        <i class="bi bi-pencil-square"></i> Modifier la commande
                    </h2>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('commande_fournisseurs.update', $commande->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="date_commande" class="form-label fw-semibold">Date de commande</label>
                            <input type="date" name="date_commande" class="form-control" value="{{ $commande->date_commande }}" required>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle shadow-sm">
                                <thead class="table-light">
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
                                            <td class="fw-semibold">{{ $produit->nom }}</td>
                                            <td>
                                                <input type="number" name="quantites[{{ $produit->id }}]" value="{{ $quantite }}" min="0" class="form-control">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('commandes_fournisseur.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Bootstrap Icons CDN (si pas déjà inclus dans le layout) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush