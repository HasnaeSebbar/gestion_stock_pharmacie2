@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">Nouvelle commande fournisseur</h2>
    <form method="POST" action="{{ route('commandes_fournisseur.step2') }}">
        @csrf
        <div class="mb-3">
            <label for="id_fournisseur" class="form-label">Fournisseur</label>
            <select name="id_fournisseur" class="form-select" required>
                <option value="">-- Choisir --</option>
                @foreach ($fournisseurs as $f)
                    <option value="{{ $f->id }}">{{ $f->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fait_par" class="form-label">Fait par</label>
            <input type="text" name="fait_par" id="fait_par" class="form-control" value="Hôpital Hassan II" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Date de commande</label>
            <input type="date" name="date_commande" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('commandes_fournisseur.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </div>
    </form>
</div>
@endsection