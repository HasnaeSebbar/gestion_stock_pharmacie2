{{-- filepath: resources/views/chef/sortie/patient.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sortie vers Patient</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('sortie_vers_patients.store') }}">
        @csrf

        {{-- Étape 1 : Infos Patient --}}
        <h4>Informations du patient</h4>
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="date_nais" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Numéro dossier</label>
            <input type="text" name="numero_dossier" class="form-control" required>
        </div>

        {{-- Étape 2 : Infos Sortie --}}
        <h4>Sortie</h4>
        <div class="mb-3">
            <label>Date de sortie</label>
            <input type="date" name="date_sortie" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Dépôt</label>
            <select name="id_depot" class="form-control" required>
                <option value="">-- Choisir un dépôt --</option>
                @foreach($depots as $depot)
                    <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Étape 3 : Produits --}}
        <h4>Produits</h4>
        <div id="produits">
            <div class="row mb-2 align-items-center">
                <div class="col">
                    <select name="produits[0][id_produit]" class="form-control" required>
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
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Supprimer</button>
                </div>
            </div>
        </div>
        <button type="button" onclick="ajouterProduit()" class="btn btn-secondary mb-3">Ajouter un produit</button>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>

<script>
let index = 1;
function ajouterProduit() {
    let produits = @json($produits);
    let selectOptions = `<option value="">-- Choisir un produit --</option>`;
    produits.forEach(function(prod) {
        selectOptions += `<option value="${prod.id}">${prod.nom}</option>`;
    });
    let div = document.createElement('div');
    div.className = 'row mb-2 align-items-center';
    div.innerHTML = `
        <div class="col">
            <select name="produits[${index}][id_produit]" class="form-control" required>
                ${selectOptions}
            </select>
        </div>
        <div class="col">
            <input type="number" name="produits[${index}][quantite]" class="form-control" placeholder="Quantité" min="1" required>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Supprimer</button>
        </div>
    `;
    document.getElementById('produits').appendChild(div);
    index++;
}
</script>
@endsection