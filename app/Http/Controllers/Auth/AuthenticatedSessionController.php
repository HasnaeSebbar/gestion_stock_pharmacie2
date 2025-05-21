<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }

    $request->session()->regenerate();

    // Redirection selon le rôle
    $user = Auth::user();
    switch ($user->role) {
            case 'chef pharmacie':
                return redirect()->route('chef.dashboard');
            case 'pharmacien':
                return redirect()->route('pharmacien.dashboard');
            case 'responsable de service pédiatrie':
                return redirect()->route('pediatrie.dashboard');
            case 'responsable de service urgences':
                return redirect()->route('urgences.dashboard');
            case 'responsable de service réanimation':
                return redirect()->route('reanimation.dashboard');
            default:
                Auth::logout();
                abort(403, 'Rôle inconnu.');
        }

    // if ($user->role === 'pharmacien') {
    //     return redirect()->route('pharmacien.dashboard');
    // } elseif ($user->role === 'chef_service') {
    //     return redirect()->route('chef.dashboard');
    // } else {
    //     return redirect('/'); // Par défaut
}
public function destroy(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}