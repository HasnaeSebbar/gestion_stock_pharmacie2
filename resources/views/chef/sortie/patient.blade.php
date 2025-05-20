@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Nouvelle sortie vers patient</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sortie_vers_patient.store') }}" method="POST">
        @csrf

        {{-- Informations du patient --}}
        <div class="row mb-3">
            <div class="col">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="col">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="date_nais" class="form-label">Date de naissance</label>
                <input type="date" name="date_nais" class="form-control" required>
            </div>
            <div class="col">
                <label for="numero_dossier" class="form-label">N° dossier</label>
                <input type="text" name="numero_dossier" class="form-control" required>
            </div>
        </div>

        {{-- Dépôt --}}
        <div class="mb-3">
            <label for="id_depot" class="form-label">Dépôt</label>
            <select name="id_depot" class="form-select" required>
                <option value="">-- Choisir un dépôt --</option>
                @foreach($depots as $depot)
                    <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Produits --}}
        <h5>Produits</h5>
        <div id="produits-container">
            <div class="row produit-row mb-3" data-index="0">
                <div class="col-md-6">
                    <select name="produits[0][id_produit]" class="form-select" required>
                        <option value="">-- Choisir un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="produits[0][quantite]" class="form-control" placeholder="Quantité" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-produit">X</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" id="add-produit" class="btn btn-secondary">Ajouter un produit</button>
            <button type="submit" class="btn btn-primary">Valider la sortie</button>
        </div>
    </form>
</div>

{{-- JS pour gestion dynamique des produits --}}
<script>
    let index = 1;

    document.getElementById('add-produit').addEventListener('click', function () {
        const container = document.getElementById('produits-container');

        const row = document.createElement('div');
        row.className = 'row produit-row mb-3';
        row.setAttribute('data-index', index);

        row.innerHTML = `
            <div class="col-md-6">
                <select name="produits[${index}][id_produit]" class="form-select" required>
                    <option value="">-- Choisir un produit --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="produits[${index}][quantite]" class="form-control" placeholder="Quantité" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger remove-produit">X</button>
            </div>
        `;
        container.appendChild(row);
        index++;
    });

    function reindexProduitRows() {
        const rows = document.querySelectorAll('.produit-row');
        rows.forEach((row, idx) => {
            row.setAttribute('data-index', idx);
            row.querySelector('select').setAttribute('name', `produits[${idx}][id_produit]`);
            row.querySelector('input[type=number]').setAttribute('name', `produits[${idx}][quantite]`);
        });
    }

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-produit')) {
            e.target.closest('.produit-row').remove();
            reindexProduitRows();
        }
    });
</script>
@endsection
