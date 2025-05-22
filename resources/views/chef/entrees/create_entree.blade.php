@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0">
         {{-- Bouton recherche par date placé ici --}}
            <div class="mb-4 text-end">
                <a href="{{ route('entrees.searchByDate') }}" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i> Chercher une entrée par date
                </a>
            </div>
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Enregistrement d’une Entrée – Service Hospitalier</h3>
        </div>
        <div class="card-body">

       

            {{-- Message de succès --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Affichage des erreurs --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5 class="mb-2">Erreurs détectées :</h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulaire principal --}}
            <form method="POST" action="{{ route('entrees.service.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_entree" class="form-label fw-semibold"> Date d’entrée</label>
                        <input 
                            type="date" 
                            id="date_entree" 
                            name="date_entree" 
                            class="form-control border-primary" 
                            required 
                            value="{{ old('date_entree', date('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="id_depot" class="form-label fw-semibold"> Service concerné</label>
                        <select id="id_depot" name="id_depot" class="form-select border-primary" required>
                            <option value="">-- Sélectionner un service --</option>
                            @foreach($depotsSecondaires as $depot)
                                <option value="{{ $depot->id_depot }}" {{ old('id_depot') == $depot->id_depot ? 'selected' : '' }}>
                                    {{ $depot->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3 text-primary fw-bold"> Détail des Produits Entrés</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Nom du Produit</th>
                                <th style="width: 200px;">Quantité Reçue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom }}</td>
                                    <td>
                                        <input 
                                            type="number" 
                                            name="quantite_recue[{{ $produit->id }}]" 
                                            min="0" 
                                            value="{{ old('quantite_recue.' . $produit->id, 0) }}" 
                                            class="form-control text-center border-primary"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Enregistrer l'entrée
                    </button>
                </div>
            </form>

            

        </div>
    </div>
</div>
@endsection
