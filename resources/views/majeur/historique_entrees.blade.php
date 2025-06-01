@extends('layouts.app')

@section('title', 'Historique des entrées de stock')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Historique des entrées de stock</h3>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
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