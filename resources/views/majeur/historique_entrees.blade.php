@extends('layouts.app')

@section('title', 'Historique des entrées de stock')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Historique des entrées de stock</h3>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
            {{-- Formulaire de recherche par date --}}
            <form method="GET" action="{{ route('entree_depot.historique') }}" class="row g-3 mb-4 align-items-end">
                <div class="col-auto">
                    <label for="date_entree" class="form-label fw-semibold mb-0">Rechercher par date :</label>
                    <input type="date" name="date_entree" id="date_entree" class="form-control" value="{{ request('date_entree') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-primary px-4 rounded-pill fw-bold">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('entree_depot.historique') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-bold">
                        <i class="bi bi-x-circle"></i> Réinitialiser
                    </a>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Date entrée</th>
                            <th>Dépôt</th>
                            <th>Produits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entrees as $entree)
                            <tr>
                                <td>{{ $entree->id }}</td>
                                <td>{{ $entree->date_entree }}</td>
                                <td>{{ $entree->depot->nom ?? '' }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($entree->details as $detail)
                                            <li>
                                                {{ $detail->produit->nom ?? '' }} : <strong>{{ $detail->quantite_recue }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Aucune entrée trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection