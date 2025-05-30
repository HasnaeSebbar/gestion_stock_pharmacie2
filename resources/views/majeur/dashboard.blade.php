@extends('layouts.app')

@section('title', 'Dashboard Majeur')

@section('content')

    <div class="container mt-4">
        <h1 class="mb-4">Bienvenue sur le tableau de bord du Majeur</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Passer une commande</h5>
                        <p class="card-text">Créer une nouvelle commande pour le service.</p>
                        <a href="{{ route('commande.passer') }}" class="btn btn-primary">Passer Commande</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Entrer du stock</h5>
                        <p class="card-text">Ajouter des produits au stock du service.</p>
                        <a href="{{ route('stock.entrer') }}" class="btn btn-success">Entrer Stock</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Sortie de stock</h5>
                        <p class="card-text">Enregistrer une sortie de produits du stock.</p>
                        <a href="{{ route('stock.sortie') }}" class="btn btn-danger">Sortie Stock</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Visualiser le stock</h5>
                        <p class="card-text">Consulter l’état actuel du stock.</p>
                        <a href="{{ route('stock.visualiser') }}" class="btn btn-info">Visualiser Stock</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection