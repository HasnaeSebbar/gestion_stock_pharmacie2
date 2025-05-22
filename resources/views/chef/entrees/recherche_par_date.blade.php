@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-search me-2 fs-4"></i>
                    <h4 class="mb-0">Recherche des Entrées par Date</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('entrees.searchByDate') }}" class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold">Date d'entrée</label>
                            <input type="date" id="date" name="date" class="form-control" value="{{ request('date') }}" required>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-search"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($entrees) && count($entrees))
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @foreach($entrees as $entree)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary me-2">Entrée N°{{ $entree->id_entree }}</span>
                                <span class="text-muted"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($entree->date_entree)->format('d/m/Y') }}</span>
                            </div>
                            <div>
                                <span class="me-3"><i class="bi bi-box"></i> <strong>Dépôt :</strong> {{ $entree->depot->nom ?? '-' }}</span>
                                {{-- <span><i class="bi bi-truck"></i> <strong>Fournisseur :</strong> {{ $entree->fournisseur->nom ?? '-' }}</span> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-list-ul"></i> Détails des produits</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width:60%">Produit</th>
                                            <th style="width:40%">Quantité entrée</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entree->details as $detail)
                                            <tr>
                                                <td>{{ $detail->produit->nom ?? '-' }}</td>
                                                <td class="text-center">{{ $detail->quantite_recue }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif(request('date'))
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-warning text-center shadow-sm mt-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Aucune entrée trouvée pour cette date.
                </div>
            </div>
        </div>
    @endif
</div>
@endsection