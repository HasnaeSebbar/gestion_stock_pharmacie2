@extends('layouts.app')

@section('title', 'Commandes traitées par la pharmacie')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-primary">Commandes traitées par la pharmacie</h3>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Date sortie</th>
                            <th>Dépôt source</th>
                            <th>Dépôt destinataire</th>
                            <th>Produits sortis</th>
                            <th>Commande liée</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sorties as $sortie)
                            <tr>
                                <td>{{ $sortie->id_sortie_depot }}</td>
                                <td>{{ $sortie->date_sortie }}</td>
                                <td>{{ $sortie->depotSource->nom ?? '' }}</td>
                                <td>{{ $sortie->depotDestination->nom ?? '' }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($sortie->details as $detail)
                                            <li>
                                                {{ $detail->produit->nom ?? '' }} : <strong>{{ $detail->quantite ?? $detail->quantite_sortie ?? '' }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if($sortie->sortieParCommande && $sortie->sortieParCommande->cmdDepot)
                                        Commande #{{ $sortie->sortieParCommande->cmdDepot->id }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune commande traitée trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection