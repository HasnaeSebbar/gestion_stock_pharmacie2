@extends('layouts.app')

@section('title', 'Dashboard Majeur')

@section('content')
<div class="container mt-5">
    <h2 class="mb-5 text-primary text-center fw-bold">
        <i class="bi bi-person-badge"></i> Bienvenue Majeur
    </h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <div class="card text-center shadow-lg border-0 h-100">
                <div class="card-body">
                    <i class="bi bi-clipboard-data fs-1 text-primary"></i>
                    <h5 class="card-title mt-3 fw-bold">Commandes</h5>
                    <p class="card-text text-muted">Gérer les commandes du service.</p>
                    <a href="{{ route('commande.passer') }}" class="btn btn-outline-primary btn-sm px-4">
                        <i class="bi bi-plus-circle"></i> Nouvelle commande
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-lg border-0 h-100">
                <div class="card-body">
                    <i class="bi bi-box-arrow-in-down fs-1 text-success"></i>
                    <h5 class="card-title mt-3 fw-bold">Entrées</h5>
                    <p class="card-text text-muted">Ajouter des produits au stock.</p>
                    <a href="{{ route('stock.entrer') }}" class="btn btn-outline-success btn-sm px-4">
                        <i class="bi bi-box-arrow-in-down"></i> Entrer Stock
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-lg border-0 h-100">
                <div class="card-body">
                    <i class="bi bi-box-arrow-up fs-1 text-danger"></i>
                    <h5 class="card-title mt-3 fw-bold">Sorties</h5>
                    <p class="card-text text-muted">Sortir des produits du stock.</p>
                    <a href="{{ route('stock.sortie') }}" class="btn btn-outline-danger btn-sm px-4">
                        <i class="bi bi-box-arrow-up"></i> Sortie Stock
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-lg border-0 h-100">
                <div class="card-body">
                    <i class="bi bi-eye fs-1 text-info"></i>
                    <h5 class="card-title mt-3 fw-bold">Stock</h5>
                    <p class="card-text text-muted">Visualiser l’état du stock.</p>
                    <a href="{{ route('stock.visualiser') }}" class="btn btn-outline-info btn-sm px-4">
                        <i class="bi bi-eye"></i> Visualiser Stock
                    </a>
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