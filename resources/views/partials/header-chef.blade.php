{{-- filepath: resources/views/partials/header-chef.blade.php --}}
<nav class="nav nav-pills justify-content-center gap-2 my-3">
    <a class="nav-link {{ request()->is('fournisseurs*') ? 'active' : '' }}" href="{{ route('fournisseurs.index') }}">
        <i class="bi bi-truck"></i> Fournisseurs
    </a>
    <a class="nav-link {{ request()->is('commandes_fournisseur*') ? 'active' : '' }}" href="{{ route('commandes_fournisseur.index') }}">
        <i class="bi bi-bag-check"></i> Commande Fournisseur
    </a>
    <a class="nav-link {{ request()->is('entrer-stock*') ? 'active' : '' }}" href="{{ route('entrer_stock.index') }}">
        <i class="bi bi-box-arrow-in-down"></i> Entrer en Stock
    </a>
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->is('sortie_vers_patient*') || request()->is('sortie_depots*') ? 'active' : '' }}"
           href="#" id="dropdownSortie" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-box-arrow-up"></i> Sortie de Stock
        </a>
        <ul class="dropdown-menu text-center" aria-labelledby="dropdownSortie">
            <li>
                <a class="dropdown-item" href="{{ route('sortie_vers_patients.create') }}">
                    <i class="bi bi-person"></i> Sortie vers Patient
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('sortie_depots.index') }}">
                    <i class="bi bi-building"></i> Sortie vers Service
                </a>
            </li>
        </ul>
    </div>
    <a class="nav-link {{ request()->is('cmd-internes*') ? 'active' : '' }}" href="{{ route('cmd_internes.index') }}">
        <i class="bi bi-clipboard-data"></i> Commande Interne
    </a>
</nav>