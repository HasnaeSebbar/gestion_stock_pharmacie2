@extends('layouts.app')

@section('content')

    <style>
        .card-stat {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 1rem;
        }
        .card-stat:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
        }
        .text-primary-bg {
            background: #e3f0ff;
            color: #0d6efd;
        }
        .text-success-bg {
            background: #e6f4ea;
            color: #198754;
        }
        .text-danger-bg {
            background: #fdeaea;
            color: #dc3545;
        }
        .card-title {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 2rem;
            font-weight: bold;
        }
        .blinking-dot {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 22px;      /* Augmente la taille ici */
            height: 22px;     /* Augmente la taille ici */
            background-color: red;
            border-radius: 50%;
            animation: blink 1s infinite;
            box-shadow: 0 0 12px 4px #ff4d4f88;
            border: 2px solid #fff;
            z-index: 2;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>

    <h1 class="text-center mb-5 fw-bold text-primary">Bienvenue Chef</h1>

    <div class="container">
        <div class="row text-center g-4 justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-primary-bg mb-2"><i class="bi bi-capsule"></i></div>
                        <h5 class="card-title">Total Produits</h5>
                        <p class="card-text">{{ $nbrProduits }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-success-bg mb-2"><i class="bi bi-bag-check"></i></div>
                        <h5 class="card-title">Commandes internes</h5>
                        <p class="card-text">{{ $nbrCommandes }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card card-stat shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="card-icon text-danger-bg mb-2 position-relative">
                            <i class="bi bi-exclamation-triangle"></i>
                            @if($nbrAlertes > 0)
                                <span class="blinking-dot"></span>
                            @endif
                        </div>
                        <h5 class="card-title">Alertes de stock</h5>
                        <p class="card-text">{{ $nbrAlertes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Icons CDN (si pas déjà inclus dans ton layout) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection