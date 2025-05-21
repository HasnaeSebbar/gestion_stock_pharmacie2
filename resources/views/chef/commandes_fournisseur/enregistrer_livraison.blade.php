@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Commandes Fournisseur</h2>

    <div class="d-flex justify-content-end mb-4">
       <a href="{{ route('commandes_fournisseur.create') }}" class="btn btn-primary me-2">Passer une commande</a>
<a href="{{ route('livraison.derniere') }}" class="btn btn-primary me-2">Enregistrer une livraison </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->isEmpty())
        <div class="alert alert-info text-center">
            Aucune commande enregistrée pour le moment.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Fournisseur</th>
                    <th>Date de commande</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->fournisseur->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($commande->statut) }}</td>
                        <td>
                            <!-- Ajoute ici d'autres boutons si besoin -->
                             <a href="{{ route('commandes_fournisseur.show_pdf', $commande->id) }}" 
   class="btn btn-sm btn-primary" 
   target="_blank">
    Voir
</a>
  <!-- Nouveau bouton imprimer -->
        <a href="{{ route('commandes_fournisseur.imprimer', $commande->id) }}" target="_blank" class="btn btn-primary">
            Imprimer
        </a>
        <a href="{{ route('commande_fournisseurs.edit', $commande->id) }}" class="btn btn-warning btn-sm">Modifier</a>
         <form action="{{ route('commandes_fournisseur.destroy', $commande->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
        </form>
        <a href="{{ route('livraison.formulaire', ['id' => $commande->id]) }}" class="btn btn-sm btn-primary">
    Enregistrer une livraison
</a>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection