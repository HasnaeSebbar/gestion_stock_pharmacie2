@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0 fw-bold text-center">Nouvelle commande fournisseur</h2>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('commandes_fournisseur.step2') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="id_fournisseur" class="form-label fw-semibold">Fournisseur</label>
                            <select name="id_fournisseur" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                @foreach ($fournisseurs as $f)
                                    <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="fait_par" class="form-label fw-semibold">Fait par</label>
                            <input type="text" name="fait_par" id="fait_par" class="form-control" value="Hôpital Hassan II" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Date de commande</label>
                            <input type="date" name="date_commande" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('commandes_fournisseur.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                Suivant <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Bootstrap Icons CDN (si pas déjà inclus dans le layout) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush