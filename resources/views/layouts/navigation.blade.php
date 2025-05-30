{{-- filepath: resources/views/layouts/navigation.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3 text-primary" href="{{ route('dashboard') }}" style="letter-spacing:1px;">
            PharmaGestion
        </a>

        <!-- Dashboard link -->
       

        <!-- User Dropdown -->
        @auth
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle fw-semibold" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Utilisateur' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-lines-fill me-2"></i> Profil
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>

{{-- Bootstrap Icons CDN (si pas déjà inclus dans ton layout) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">