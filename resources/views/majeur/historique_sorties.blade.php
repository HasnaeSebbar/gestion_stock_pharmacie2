@extends('layouts.app')

@section('title', 'Historique des sorties de stock interne')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Historique des sorties de stock interne</h3>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Date sortie</th>
                            <th>Dépôt</th>
                            <th>Destinataire</th>
                            <th>Type destinataire</th>
                            <th>Produits sortis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sorties as $sortie)
                            <tr>
                                <td>{{ $sortie->id }}</td>
                                <td>{{ $sortie->date_sortie }}</td>
                                <td>{{ $sortie->depot->nom ?? '' }}</td>
                                <td>{{ $sortie->destinataire_nom ?? '' }}</td>
                                <td>{{ $sortie->destinataire_type ?? '' }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($sortie->details as $detail)
                                            <li>
                                                {{ $detail->produit->nom ?? '' }} : <strong>{{ $detail->quantite }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune sortie trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection