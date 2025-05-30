@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0 fw-bold text-center">Nouvelle commande - Choix des produits</h2>
                </div>
                <div class="card-body bg-light">
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
                                            <td class="fw-semibold">{{ $produit->nom }}</td>
                                            <td>{{ $produit->unite ?? '—' }}</td>
                                            <td>
                                                <span class="badge bg-info text-dark">
                                                    {{ $produit->prix ?? '—' }}
                                                </span>
                                            </td>
                                            <td>
                                                <input type="number" name="quantites[{{ $produit->id }}]" min="0" class="form-control" placeholder="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('commandes_fournisseur.create') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                Valider la commande <i class="bi bi-check-circle"></i>
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