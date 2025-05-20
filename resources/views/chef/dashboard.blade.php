@extends('layouts.app')

@section('content')

    {{-- ✅ Menu de navigation interne --}}
    <style>
        /* CSS pour activer l'affichage au hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>

    <div class="mb-4">
        <nav class="nav nav-pills justify-content-center">

            <a class="nav-link {{ request()->is('fournisseurs*') ? 'active' : '' }}" href="{{ route('fournisseurs.index') }}">
                Gestion Fournisseurs
            </a>

            <a class="nav-link {{ request()->is('commandes_fournisseur*') ? 'active' : '' }}" href="{{ route('commandes_fournisseur.index') }}">
                Commande Fournisseur
            </a>

            <a class="nav-link {{ request()->is('entrer-stock*') ? 'active' : '' }}" href="{{ route('entrer_stock.index') }}">
                Entrer en Stock
            </a>

            {{-- ✅ Dropdown Sortie de Stock --}}
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('sortie_vers_patient*') || request()->is('sortie_depots*') ? 'active' : '' }}"
                   href="#" id="dropdownSortie" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sortie de Stock
                </a>
                <ul class="dropdown-menu text-center" aria-labelledby="dropdownSortie">
                    <li>
                        <a class="dropdown-item" href="{{ route('sortie_vers_patient.create') }}">Sortie vers Patient</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('sortie_depots.index') }}">Sortie vers Service</a>
                    </li>
                </ul>
            </div>

            {{-- <a class="nav-link {{ request()->is('visualisation-stock*') ? 'active' : '' }}" href="{{ route('visualisation_stock.index') }}">
                Visualisation de Stock
            </a> --}}

            <a class="nav-link {{ request()->is('cmd-internes*') ? 'active' : '' }}" href="{{ route('cmd_internes.index') }}">
                Commande Interne des Services
            </a>

        </nav>
    </div>

    {{-- ✅ Titre --}}
    <h1 class="text-center mb-5">Bienvenue Chef</h1>

    {{-- ✅ Cartes de statistiques --}}
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">NBR totale des produits</h5>
                        <p class="card-text">150</p> {{-- Remplacer par variable dynamique si nécessaire --}}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">NBR commandes internes</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Alertes de stock</h5>
                        <p class="card-text">6</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Activités des services</h5>
                        <p class="card-text">12</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
