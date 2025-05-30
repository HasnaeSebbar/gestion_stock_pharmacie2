@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0">
                <div class="card-header bg-danger text-white d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                    <h4 class="mb-0">Produits en alerte</h4>
                </div>
                <div class="card-body bg-light">
                    <table class="table table-hover align-middle">
                        <thead class="table-danger">
                            <tr>
                                <th>Nom du produit</th>
                                <th>Quantité actuelle</th>
                                <th>Seuil d'alerte</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produitsAlerte as $produit)
                                <tr>
                                    <td class="fw-semibold">{{ $produit->nom }}</td>
                                    <td>
                                        <span class="badge bg-{{ $produit->quantite_initial < $produit->seuil_alerte ? 'danger' : 'success' }}">
                                            {{ $produit->quantite_initial }}
                                        </span>
                                    </td>
                                    <td>{{ $produit->seuil_alerte }}</td>
                                    <td>
                                        @if($produit->quantite_initial < $produit->seuil_alerte)
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> Alerte</span>
                                        @else
                                            <span class="badge bg-success">OK</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun produit en alerte.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Bootstrap Icons CDN (si pas déjà inclus) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush