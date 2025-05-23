{{-- filepath: resources/views/partials/header-chef.blade.php --}}
<nav class="nav nav-pills justify-content-center gap-2 my-3 shadow-sm rounded bg-white py-2" style="font-size: 1.1rem;">
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('entrer-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       href="{{ route('entrees.service.create') }}">
        <i class="bi bi-box-arrow-in-down"></i> Entrer en Stock
    </a>
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1 px-3 py-2 {{ (request()->is('sortie_vers_patient*') || request()->is('sortie_depots*')) ? 'active bg-primary text-white' : 'text-primary' }}"
           href="#" id="dropdownSortie" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-box-arrow-up"></i> Sortie de Stock
        </a>
        <ul class="dropdown-menu text-center shadow" aria-labelledby="dropdownSortie">
            <li>
                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('sortie_vers_patients.create') }}">
                    <i class="bi bi-person"></i> Sortie vers Patient
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('sortie_depots.index') }}">
                    <i class="bi bi-building"></i> Sortie vers Service
                </a>
            </li>
        </ul>
    </div>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('cmd-internes*') ? 'active bg-primary text-white' : 'text-primary' }}"
       {{-- href="{{ route('cmd_internes.index') }}" --}}
       >
        <i class="bi bi-clipboard-data"></i> Commande Interne
    </a>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('visualiser-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       {{-- href="{{ route('visualiser_stock.index') }}" --}}
       >
        <i class="bi bi-eye"></i> Visualiser Stock
    </a>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('alertes-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       {{-- href="{{ route('alertes-stock.index') }}" --}}
       >
        <i class="bi bi-exclamation-triangle"></i> Alerte Stock
    </a>
</nav>

<style>
    .nav-pills .nav-link {
        border-radius: 0.7rem;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }
    .nav-pills .nav-link:not(.active):hover {
        background: #e9ecef;
        color: #0d6efd;
        box-shadow: 0 2px 8px rgba(13,110,253,0.05);
    }
    .nav-pills .nav-link.active {
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(13,110,253,0.10);
    }
    .dropdown-menu {
        min-width: 220px;
        border-radius: 0.7rem;
    }
    .dropdown-item:active, .dropdown-item.active {
        background-color: #0d6efd;
        color: #fff;
    }
</style>