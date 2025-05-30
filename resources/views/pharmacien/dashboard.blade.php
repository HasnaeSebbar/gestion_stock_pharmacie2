@extends('layouts.app')

@section('content')

    <style>
        .card-stat {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-stat:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
    </style>

    <h1 class="text-center mb-5 fw-bold text-primary">Bienvenue Chef</h1>

    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-primary"><i class="bi bi-capsule"></i></div>
                        <h5 class="card-title">NBR totale des produits</h5>
                        <p class="card-text fs-4 fw-semibold">{{ $nbrProduits }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-success"><i class="bi bi-bag-check"></i></div>
                        <h5 class="card-title">NBR commandes internes</h5>
                        <p class="card-text fs-4 fw-semibold">{{ $nbrCommandes }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-danger"><i class="bi bi-exclamation-triangle"></i></div>
                        <h5 class="card-title">Alertes de stock</h5>
                        <p class="card-text fs-4 fw-semibold">{{ $nbrAlertes }}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- Bootstrap Icons CDN (si pas déjà inclus dans ton layout) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection