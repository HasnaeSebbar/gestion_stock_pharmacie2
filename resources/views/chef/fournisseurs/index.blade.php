@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4 fw-bold text-primary">Gestion des fournisseurs</h2>

    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Ajouter Fournisseur
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Nom Fournisseur</th>
                    <th>Type</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fournisseurs as $fournisseur)
                    <tr>
                        <td>{{ $fournisseur->nom }}</td>
                        <td>{{ $fournisseur->type }}</td>
                        <td>{{ $fournisseur->adresse }}</td>
                        <td>{{ $fournisseur->telephone }}</td>
                        <td class="text-center">
                            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> Modifier
                            </a>
                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

