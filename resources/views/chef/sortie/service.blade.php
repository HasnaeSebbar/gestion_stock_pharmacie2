<!-- filepath: d:\projetpfe\gestion_stock_pharmacie2\resources\views\chef\sortie\service.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Nouvelle Sortie vers Service</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Formulaire principal de sortie -->
            <form action="{{ route('sortie.store') }}" method="POST" class="row g-3">
                @csrf

                <!-- Service -->
                <div class="col-md-6">
                    <label for="id_depot_destin" class="form-label">Service</label>
                    <select name="id_depot_destin" id="id_depot_destin" class="form-select" required>
                        <option value="" disabled selected>Choisir un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id_depot }}">{{ $service->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date de livraison -->
                <div class="col-md-6">
                    <label for="date_sortie" class="form-label">Date de livraison</label>
                    <input type="date" name="date_sortie" id="date_sortie" class="form-control" required>
                </div>

                <!-- Type de commande -->
                <div class="col-md-6">
                    <label for="type_commande" class="form-label">Type de commande</label>
                    <select name="type_commande" id="type_commande" class="form-select" required>
                        <option value="" disabled selected>Choisir le type</option>
                        @foreach($types_commande as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date commande -->
                <div class="col-md-6">
                    <label for="date_cmd" class="form-label">Date commande</label>
                    <input type="date" name="date_cmd" id="date_cmd" class="form-control" required>
                </div>

              
                 <!-- Champ Commande N° et bouton Rechercher -->
                <div class="col-md-6">
                    <label for="commande_id" class="form-label">Commande N°</label>
                    <input type="number" name="commande_id" id="commande_id" class="form-control" min="1" value="{{ old('commande_id', $commande_id ?? '') }}" required>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" formaction="{{ route('sortie.serviceRecherche') }}" formmethod="GET" class="btn btn-secondary me-2">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>

            <!-- Tableau des détails de la commande juste après le bouton -->
            @if(isset($commandeProduits) && $commandeProduits->count())
                <div class="col-12 mt-5">
                    <h5>Détails de la commande N° {{ $commande_id }}</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom produit</th>
                                <th>Quantité commandée</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commandeProduits as $produit)
                                <tr>
                                    <td>{{ $produit->produit->nom ?? 'N/A' }}</td>
                                    <td>{{ $produit->quantite_cmd }}</td>
                                    <td>{{ $produit->produit->prix ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(isset($commande_id))
                <div class="col-12 alert alert-warning mt-4">
                    Aucun produit trouvé pour la commande N° {{ $commande_id }}.
                </div>
            @endif
<!-- Bouton Valider la sortie -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Valider la sortie
                    </button>
                </div>
        </div>
    </div>
    
</div>

@endsection