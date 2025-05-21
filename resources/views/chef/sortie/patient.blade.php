{{-- filepath: resources/views/chef/sortie/patient.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    <h4 class="mb-0">Sortie vers Patient</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('sortie_vers_patients.store') }}">
                        @csrf

                        {{-- Étape 1 : Infos Patient --}}
                        <h5 class="mb-3 mt-2 text-primary"><i class="bi bi-person-fill"></i> Informations du patient</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" name="date_nais" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Numéro dossier</label>
                                <input type="text" name="numero_dossier" class="form-control" required>
                            </div>
                        </div>

                        {{-- Étape 2 : Infos Sortie --}}
                        <h5 class="mb-3 mt-4 text-primary"><i class="bi bi-box-arrow-up"></i> Sortie</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Date de sortie</label>
                                <input type="date" name="date_sortie" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dépôt</label>
                                <select name="id_depot" class="form-select" required>
                                    <option value="">-- Choisir un dépôt --</option>
                                    @foreach($depots as $depot)
                                        <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Étape 3 : Produits --}}
                        <h5 class="mb-3 mt-4 text-primary"><i class="bi bi-capsule"></i> Produits</h5>
                        <div id="produits">
                            <div class="row mb-2 align-items-center produit-row">
                                <div class="col">
                                    <select name="produits[0][id_produit]" class="form-select" required>
                                        <option value="">-- Choisir un produit --</option>
                                        @foreach($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" name="produits[0][quantite]" class="form-control" placeholder="Quantité" min="1" required>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">
                                        <i class="bi bi-x-circle"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="ajouterProduit()" class="btn btn-outline-primary mb-3">
                            <i class="bi bi-plus-circle"></i> Ajouter un produit
                        </button>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle"></i> Valider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap Icons CDN (si pas déjà inclus dans ton layout) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
let index = 1;
function ajouterProduit() {
    let produits = @json($produits);
    let selectOptions = `<option value="">-- Choisir un produit --</option>`;
    produits.forEach(function(prod) {
        selectOptions += `<option value="${prod.id}">${prod.nom}</option>`;
    });
    let div = document.createElement('div');
    div.className = 'row mb-2 align-items-center produit-row';
    div.innerHTML = `
        <div class="col">
            <select name="produits[${index}][id_produit]" class="form-select" required>
                ${selectOptions}
            </select>
        </div>
        <div class="col">
            <input type="number" name="produits[${index}][quantite]" class="form-control" placeholder="Quantité" min="1" required>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-x-circle"></i> Supprimer
            </button>
        </div>
    `;
    document.getElementById('produits').appendChild(div);
    index++;
}
</script>
@endsection