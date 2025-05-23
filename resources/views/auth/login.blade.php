<x-guest-layout>
    <style>
        body {
            background-image: url("{{ asset('images/login.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.98);
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 1.3rem;
            box-shadow: 0 8px 32px rgba(13, 110, 253, 0.13);
            max-width: 400px;
            margin: auto;
            margin-top: 7vh;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 500;
            color: #0d6efd;
            margin-bottom: 0.4rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-control {
            border-radius: 0.7rem;
            border: 1.5px solid #b6d4fe;
            padding: 0.7rem 1rem;
            font-size: 1.08rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px #b6d4fe;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(90deg, #0d6efd 60%, #38bdf8 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 0.7rem;
            padding: 0.7rem 0;
            font-size: 1.1rem;
            margin-top: 1.2rem;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #1d4ed8 60%, #0ea5e9 100%);
        }

        .form-check-label {
            color: #333;
        }
    </style>

    <div class="auth-card">
        <div class="login-title">Connexion à la Pharmacie</div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Adresse Email</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="form-group form-check mb-3">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn-login">
                Se connecter
            </button>
        </form>
    </div>
</x-guest-layout>
