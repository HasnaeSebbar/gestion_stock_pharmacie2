@extends('layouts.app')

@section('title', 'Sortie de stock interne')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            {{-- Bouton historique des sorties --}}
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('sortieinternes.historique') }}" class="btn btn-primary">
                    <i class="bi bi-clock-history"></i> Historique des sorties
                </a>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 fw-bold text-center">
                        <i class="bi bi-box-arrow-up"></i> Enregistrer une sortie de stock interne
                    </h3>
                </div>
                <div class="card-body bg-light">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('sortieinternes.store') }}" method="POST" id="sortieInterneForm">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="date_sortie" class="form-label fw-semibold">Date de sortie</label>
                                <input type="date" name="date_sortie" id="date_sortie" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_depot" class="form-label fw-semibold">Dépôt</label>
                                <select name="id_depot" id="id_depot" class="form-select" required>
                                    <option value="">Sélectionner un dépôt</option>
                                    @foreach($depots as $depot)
                                        <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="destinataire_nom" class="form-label fw-semibold">Destinataire</label>
                                <input type="text" name="destinataire_nom" id="destinataire_nom" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="destinataire_type" class="form-label fw-semibold">Type de destinataire</label>
                            <input type="text" name="destinataire_type" id="destinataire_type" class="form-control" required>
                        </div>

                        <hr>
                        <h5 class="fw-bold mb-3">Produits à sortir</h5>
                        <div id="produits-container">
                            <div class="row mb-3 produit-row">
                                <div class="col-md-7">
                                    <label for="produit_0" class="form-label fw-semibold">Produit</label>
                                    <select name="id_produit[]" id="produit_0" class="form-select" required>
                                        <option value="">Sélectionner un produit</option>
                                        @foreach($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="quantite_0" class="form-label fw-semibold">Quantité</label>
                                    <input type="number" name="quantite[]" id="quantite_0" class="form-control" min="1" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <!-- Bouton de suppression (caché pour le premier) -->
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary mb-3" id="addProduitBtn">
                            <i class="bi bi-plus-circle"></i> Ajouter produit
                        </button>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle"></i> Valider la sortie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

<script>
let produitIndex = 1;
const optionsProduits = `@foreach($produits as $produit)<option value="{{ $produit->id }}">{{ $produit->nom }}</option>@endforeach`;

document.getElementById('addProduitBtn').onclick = function() {
    let container = document.getElementById('produits-container');
    let row = document.createElement('div');
    row.className = 'row mb-3 produit-row';
    row.innerHTML = `
        <div class="col-md-7">
            <label for="produit_${produitIndex}" class="form-label fw-semibold">Produit</label>
            <select name="id_produit[]" id="produit_${produitIndex}" class="form-select" required>
                <option value="">Sélectionner un produit</option>
                ${optionsProduits}
            </select>
        </div>
        <div class="col-md-4">
            <label for="quantite_${produitIndex}" class="form-label fw-semibold">Quantité</label>
            <input type="number" name="quantite[]" id="quantite_${produitIndex}" class="form-control" min="1" required>
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-produit"><i class="bi bi-x"></i></button>
        </div>
    `;
    container.appendChild(row);
    produitIndex++;
};

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-produit')) {
        e.target.closest('.produit-row').remove();
    }
});
</script>
@endsection