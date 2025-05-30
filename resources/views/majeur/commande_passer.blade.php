{{-- filepath: e:\Projet_PFE\gestion_stock_pharmacie2\resources\views\majeur\commande_passer.blade.php --}}
@extends('layouts.app')

@php
    $optionsProduits = '';
    foreach($produits ?? [] as $produit) {
        $optionsProduits .= '<option value="'.$produit->id.'">'.e($produit->nom).'</option>';
    }
@endphp

@section('title', 'Passer une commande')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Passer une nouvelle commande</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('commande.store') }}" method="POST" id="commandeForm">
        @csrf

        <div class="mb-3">
            <label for="date_cmd" class="form-label">Date commande</label>
            <input type="date" name="date_cmd" id="date_cmd" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Service</label>
            <input type="text" class="form-control" value="service radiologie" readonly>
            <input type="hidden" name="depot_source_id" value="2">
        </div>

        <div class="mb-3">
            <label class="form-label">Destinataire</label>
            <input type="text" class="form-control" value="pharmacie hospitalière Hassan 2" readonly>
            <input type="hidden" name="depot_dest_id" value="1">
        </div>

        <div class="mb-3">
            <label for="type_commande" class="form-label">Type commande</label>
            <select name="type_commande" id="type_commande" class="form-select" required>
                <option value="">Sélectionner un type</option>
                <option value="bon mensuelle">Bon mensuelle</option>
                <option value="bon retour">Bon retour</option>
                <option value="bon échange">Bon échange</option>
                <option value="bon décharge">Bon décharge</option>
                <option value="bon ordonnance">Bon ordonnance</option>
                <option value="bon supplémentaire">Bon supplémentaire</option>
            </select>
        </div>

        <div id="produits-container">
            <div class="row mb-3 produit-row">
                <div class="col-md-7">
                    <label for="produit_0" class="form-label">Produit</label>
                    <select name="produit_id[]" id="produit_0" class="form-select" required>
                        <option value="">Sélectionner un produit</option>
                        {!! $optionsProduits !!}
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantite_0" class="form-label">Quantité</label>
                    <input type="number" name="quantite[]" id="quantite_0" class="form-control" min="1" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <!-- Bouton de suppression (caché pour le premier) -->
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="addProduitBtn">
            Ajouter produit
        </button>

        <button type="submit" class="btn btn-primary">Valider la commande</button>
    </form>
</div>

<script>
let produitIndex = 1;
const optionsProduits = `{!! $optionsProduits !!}`;

document.getElementById('addProduitBtn').onclick = function() {
    let container = document.getElementById('produits-container');
    let row = document.createElement('div');
    row.className = 'row mb-3 produit-row';
    row.innerHTML = `
        <div class="col-md-7">
            <label for="produit_${produitIndex}" class="form-label">Produit</label>
            <select name="produit_id[]" id="produit_${produitIndex}" class="form-select" required>
                <option value="">Sélectionner un produit</option>
                ${optionsProduits}
            </select>
        </div>
        <div class="col-md-4">
            <label for="quantite_${produitIndex}" class="form-label">Quantité</label>
            <input type="number" name="quantite[]" id="quantite_${produitIndex}" class="form-control" min="1" required>
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-produit">X</button>
        </div>
    `;
    container.appendChild(row);
    produitIndex++;
};

// Suppression d'une ligne produit
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-produit')) {
        e.target.closest('.produit-row').remove();
    }
});
</script>
@endsection