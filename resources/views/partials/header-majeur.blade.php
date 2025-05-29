{{-- filepath: e:\Projet_PFE\gestion_stock_pharmacie2\resources\views\partials\header-majeur.blade.php --}}
<nav class="nav nav-pills justify-content-center gap-2 my-3 shadow-sm rounded bg-white py-2" style="font-size: 1.1rem;">
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('commande*') ? 'active bg-primary text-white' : 'text-primary' }}"
       href="{{ route('commande.passer') }}">
        <i class="bi bi-clipboard-data"></i> Passer Commande
    </a>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('entrer-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       href="{{ route('stock.entrer') }}">
        <i class="bi bi-box-arrow-in-down"></i> Entrer Stock
    </a>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('sortie-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       href="{{ route('stock.sortie') }}">
        <i class="bi bi-box-arrow-up"></i> Sortie Stock
    </a>
    <a class="nav-link d-flex align-items-center gap-1 px-3 py-2 {{ request()->is('visualiser-stock*') ? 'active bg-primary text-white' : 'text-primary' }}"
       href="{{ route('stock.visualiser') }}">
        <i class="bi bi-eye"></i> Visualiser Stock
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
</style>