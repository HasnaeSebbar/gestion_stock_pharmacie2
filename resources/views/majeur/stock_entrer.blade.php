@extends('layouts.app')

@section('title', 'Entrée de stock')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            {{-- Boutons en haut --}}
            <div class="mb-3 d-flex justify-content-end gap-2">
                <a href="{{ route('entree_depot.historique') }}" class="btn btn-primary">
                    <i class="bi bi-clock-history"></i> Historique des entrées
                </a>
                <a href="{{ route('stock.entrer.parcommande') }}" class="btn btn-success">
                    <i class="bi bi-cart-plus"></i> Entrer en stock par commande
                </a>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 fw-bold text-center">
                        <i class="bi bi-box-arrow-in-down"></i> Enregistrer une entrée de stock
                    </h3>
                </div>
                <div class="card-body bg-light">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('entree_depot.store') }}" method="POST" id="entreeDepotForm">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_entree" class="form-label fw-semibold">Date d'entrée</label>
                                <input type="date" name="date_entree" id="date_entree" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="depot_id" class="form-label fw-semibold">Dépôt concerné</label>
                                <select name="depot_id" id="depot_id" class="form-select" required>
                                    <option value="">Sélectionner un dépôt</option>
                                    @foreach($depots as $depot)
                                        <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="produits-container">
                            <div class="row mb-3 produit-row">
                                <div class="col-md-7">
                                    <label for="produit_0" class="form-label fw-semibold">Produit</label>
                                    <select name="produit_id[]" id="produit_0" class="form-select" required>
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
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-circle"></i> Valider l'entrée
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
            <select name="produit_id[]" id="produit_${produitIndex}" class="form-select" required>
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