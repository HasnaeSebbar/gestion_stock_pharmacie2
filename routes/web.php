<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepotController;
// Removed duplicate use statement
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeFournisseurController;
use App\Http\Controllers\DetailCommandeController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\DetailEntreeController;
use App\Http\Controllers\CommandeServiceController;
use App\Http\Controllers\RetourProduitController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\AlerteStockController;
use App\Http\Controllers\PharmacienController;
use App\Http\Controllers\ChefPharmacieController; // Ensure this controller exists in the specified namespace or create it if missing
use App\Http\Controllers\CmdFournisseurController; // Import CmdFournisseurController to resolve the undefined type error
use App\Models\Depot;
use App\Http\Controllers\PediatrieController;
use App\Http\Controllers\UrgencesController;
use App\Http\Controllers\ReanimationController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\CmdDepotController;
use App\Http\Controllers\SortieParCommandeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SortieVersPatientController;
use App\Http\Controllers\DetailSortiePatientController;
use App\Http\Controllers\SortieInterneController;
use App\Http\Controllers\DetailSortieInterneController;
use App\Http\Controllers\SortieDepotController;
use App\Http\Controllers\DetailSortieDepotController;
use App\Http\Controllers\SortieStockController;



/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/login'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// Enregistrement manuel (si pas avec Breeze ou Jetstream)
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes protégées par auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Routes profil utilisateur
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {
    Route::get('/chef/dashboard', [ChefPharmacieController::class, 'index'])->name('chef.dashboard');
    Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
    Route::get('/pediatrie/dashboard', [PediatrieController::class, 'index'])->name('pediatrie.dashboard');
    Route::get('/urgences/dashboard', [UrgencesController::class, 'index'])->name('urgences.dashboard');
    Route::get('/reanimation/dashboard', [ReanimationController::class, 'index'])->name('reanimation.dashboard');
});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cmd-fournisseurs', [\App\Http\Controllers\CommandeFournisseurController::class, 'index'])->name('cmd_fournisseurs.index');
    // Fournisseurs
Route::get('/fournisseurs', [\App\Http\Controllers\FournisseurController::class, 'index'])->name('fournisseurs.index');

// Entrée en stock
Route::get('/entrer-stock', [\App\Http\Controllers\EntreeController::class, 'index'])->name('entrer_stock.index');

// Sortie de stock
// Route::get('/sortie-stock', [\App\Http\Controllers\SortieStockController::class, 'index'])->name('sortie_stock.index');

// Commandes internes
Route::get('/cmd-internes', [\App\Http\Controllers\CommandeServiceController::class, 'index'])->name('cmd_internes.index');


Route::get('/chef/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');
Route::get('/chef/fournisseurs', [FournisseurController::class, 'create'])->name('fournisseurs.create');
Route::post('/chef/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');
Route::get('/chef/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::put('/chef/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
Route::delete('/chef/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
Route::resource('fournisseurs', FournisseurController::class);
Route::post('/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');
Route::get('/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
Route::get('/commandes-fournisseur', [App\Http\Controllers\CommandeFournisseurController::class, 'index'])->name('commandes.fournisseur.index');
Route::get('/commandes-fournisseur/create', [App\Http\Controllers\CommandeFournisseurController::class, 'create'])->name('commandes.fournisseur.create');
Route::post('/commandes-fournisseur', [App\Http\Controllers\CommandeFournisseurController::class, 'store'])->name('commandes.fournisseur.store');
Route::get('/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'show'])->name('commandes.fournisseur.show');
Route::get('/commandes-fournisseur/{id}/edit', [App\Http\Controllers\CommandeFournisseurController::class, 'edit'])->name('commandes.fournisseur.edit');
Route::put('/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'update'])->name('commandes.fournisseur.update');
Route::delete('/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'destroy'])->name('commandes.fournisseur.destroy');
Route::get('/commandes-fournisseur', [CommandeFournisseurController::class, 'index'])->name('commandes.index');
Route::get('/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes.create');
Route::get('/livraisons/create', function () {
    return view('chef.commandes_fournisseur.livraison'); // à créer aussi
})->name('livraisons.create');
Route::post('/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes.store');
Route::get('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'show'])->name('commandes.show');
Route::get('/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'update'])->name('commandes.update');
Route::delete('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'destroy'])->name('commandes.destroy');
Route::get('/commandes-fournisseur', [CommandeFournisseurController::class, 'index'])->name('commandes_fournisseur.index');
Route::get('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'show'])->name('commandes_fournisseur.show');
Route::get('/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes_fournisseur.edit');
Route::put('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'update'])->name('commandes_fournisseur.update');
Route::delete('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'destroy'])->name('commandes_fournisseur.destroy');

Route::get('/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');
Route::post('/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
Route::get('/chef/commande-fournisseurs/create', [CommandeFournisseurController::class, 'create'])->name('commande_fournisseurs.create');
Route::post('/chef/commande-fournisseurs', [CommandeFournisseurController::class, 'store'])->name('commande_fournisseurs.store');
Route::get('/chef/commande-fournisseurs/{id}/bon-commande', [CommandeFournisseurController::class, 'bonCommande'])->name('commande_fournisseurs.bon_commande');
Route::resource('commande_fournisseurs', CommandeFournisseurController::class);

Route::get('/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes_fournisseur.edit');
Route::get('/chef/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::get('/commandes-fournisseur/pdf/{id}', [CommandeFournisseurController::class, 'showPDF'])->name('commandes_fournisseur.show_pdf');

Route::get('/commandes_fournisseur/{id}/imprimer', [CommandeFournisseurController::class, 'imprimer'])->name('commandes_fournisseur.imprimer');
Route::resource('depots', DepotController::class);
Route::resource('produits', ProduitController::class);
Route::resource('cmd_depots', CmdDepotController::class);
// Patient
Route::resource('patients', PatientController::class);

// Sortie vers patient
Route::resource('sortie_vers_patients', SortieVersPatientController::class);
Route::get('/sortie_vers_patients/create', [SortieVersPatientController::class, 'create'])->name('sortie_vers_patients.create');
Route::get('/sortie_vers_patients/pdf', [SortieVersPatientController::class, 'genererPDF'])->name('sortie_vers_patients.pdf');



// Sortie interne
Route::resource('sortie_internes', SortieInterneController::class);
Route::resource('detail_sortie_internes', DetailSortieInterneController::class);

// Sortie entre dépôts
Route::resource('sortie_depots', SortieDepotController::class);
Route::resource('detail_sortie_depots', DetailSortieDepotController::class);

// Sortie par commande
Route::resource('sortie_par_commandes', SortieParCommandeController::class);

Route::resource('stocks', App\Http\Controllers\StockController::class);
Route::resource('stock_produits', App\Http\Controllers\StockProduitController::class);
Route::resource('sortie_interne', App\Http\Controllers\SortieInterneController::class);
Route::resource('sortie_vers_patient', App\Http\Controllers\SortieVersPatientController::class);
Route::resource('sortie_vers_patient', SortieVersPatientController::class);
Route::resource('sortie_interne', SortieInterneController::class);
Route::resource('sortie_depot', App\Http\Controllers\SortieDepotController::class); 
Route::resource('sortie_vers_patient', SortieVersPatientController::class);
Route::get('/sortie-vers-patient/create', [SortieVersPatientController::class, 'create'])->name('sortie_vers_patient.create');
Route::get('/sortie_vers_patient/pdf', [SortieVersPatientController::class, 'genererPDF'])->name('sortie_vers_patient.pdf');





// // Route pour Sortie de Stock
// Route::resource('sortie-stock', App\Http\Controllers\SortieStockController::class)->names('sortie_stock');

// // Route pour Visualisation de Stock
// Route::resource('visualisation-stock', App\Http\Controllers\VisualisationStockController::class)->names('visualisation_stock');







    /*
    |--------------------------------------------------------------------------
    | Routes de redirection après login
    |--------------------------------------------------------------------------
    */
    // Route::get('/redirect-after-login', [AuthenticatedSessionController::class, 'redirectAfterLogin'])->name('redirect.after.login');


     /*
    |--------------------------------------------------------------------------
    | Redirection après login selon rôle
    |--------------------------------------------------------------------------
    */
    // Route::get('/redirect-after-login', function () {
    //     $user = Auth::user();
    //     return match ($user->role) {
    //         'pharmacien' => redirect()->route('pharmacien.dashboard'),
    //         'responsable_service_pediatrie' => redirect()->route('pediatrie.dashboard'),
    //         'responsable_service_reanimation' => redirect()->route('reanimation.dashboard'),
    //         'responsable_service_urgences' => redirect()->route('urgences.dashboard'),
    //         'responsable_service_chirurgie' => redirect()->route('chirurgie.dashboard'),
    //         'chef_pharmacie' => redirect()->route('chef.pharmacie.dashboard'),
    //         default      => abort(403, 'Rôle non autorisé.'),
    //     };
    // });
    


    /*
    |--------------------------------------------------------------------------
    | Dashboards par rôle
    |--------------------------------------------------------------------------
    */
    // Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
    // Route::get('/chef/pharmacie/dashboard', fn() => view('chef.pharmacie.dashboard'))->name('chef.pharmacie.dashboard');
    // Route::get('/pharmacie/dashboard', [Depot::class, 'dashboard'])->name('pharmacie.dashboard');

    // Dashboards spécifiques aux responsables de service
    // Route::get('/pediatrie/dashboard', fn() => view('services.pediatrie.dashboard'))->name('pediatrie.dashboard');
    // Route::get('/reanimation/dashboard', fn() => view('services.reanimation.dashboard'))->name('reanimation.dashboard');
    // Route::get('/urgences/dashboard', fn() => view('services.urgences.dashboard'))->name('urgences.dashboard');
    // Route::get('/chirurgie/dashboard', fn() => view('services.chirurgie.dashboard'))->name('chirurgie.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Gestion des utilisateurs et entités de base
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    Route::resource('depots', DepotController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('commande-fournisseurs', CommandeFournisseurController::class);
    Route::resource('details-commandes', DetailCommandeController::class);
    Route::resource('entrees', EntreeController::class);
    Route::resource('details-entrees', DetailEntreeController::class);
    Route::resource('commandes-services', CommandeServiceController::class);
    Route::resource('retours-produits', RetourProduitController::class);
    Route::resource('ordonnances', OrdonnanceController::class);
    Route::resource('alertes-stock', AlerteStockController::class);

    /*
    |--------------------------------------------------------------------------
    | Routes spécifiques
    |--------------------------------------------------------------------------
    */
    // Route::get('/commande-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commande-fournisseur.create');
    // Route::get('/stock', fn() => view('pharmacien.stock'))->name('stock.index');

    /*
    |--------------------------------------------------------------------------
    | Routes responsables de services
    |--------------------------------------------------------------------------
    */
    // Route::middleware(['auth', 'role:responsable_service_pediatrie'])->prefix('pediatrie')->group(function () {
    //     Route::get('/stock', fn() => view('services.pediatrie.stock'))->name('pediatrie.stock');
    //     Route::resource('commandes', CommandeServiceController::class);
    // });

    // Route::middleware(['auth', 'role:responsable_service_reanimation'])->prefix('reanimation')->group(function () {
    //     Route::get('/stock', fn() => view('services.reanimation.stock'))->name('reanimation.stock');
    //     Route::resource('commandes', CommandeServiceController::class);
    // });

    // Route::middleware(['auth', 'role:responsable_service_urgences'])->prefix('urgences')->group(function () {
    //     Route::get('/stock', fn() => view('services.urgences.stock'))->name('urgences.stock');
    //     Route::resource('commandes', CommandeServiceController::class);
    // });

    // Route::middleware(['auth', 'role:responsable_service_chirurgie'])->prefix('chirurgie')->group(function () {
    //     Route::get('/stock', fn() => view('services.chirurgie.stock'))->name('chirurgie.stock');
    //     Route::resource('commandes', CommandeServiceController::class);
    // });

    /*
    |--------------------------------------------------------------------------
    | Déconnexion
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});


Route::get('/commandes-fournisseur/produits', [CommandeFournisseurController::class, 'afficherProduits'])->name('commande_fournisseurs.produits');
Route::get('/commandes-fournisseur/create', [CommandeFournisseurController::class, 'step1'])->name('commandes_fournisseur.create');
Route::post('/commandes-fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');
Route::post('/commandes-fournisseur/store', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
// Route pour afficher le formulaire de création (étape 1)
Route::get('/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');

// Route pour envoyer le formulaire (étape 2)
// Route::post('/commandes-fournisseur/store', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
// Route pour gérer l'étape 2
// Route::post('/commandes-fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');

Route::get('/commandes_fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');
Route::post('/commandes_fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');

Route::post('/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');

Route::get('/commandes-fournisseur/pdf/{id}', [CommandeFournisseurController::class, 'showPDF'])->name('commandes_fournisseur.show_pdf');

Route::get('/commandes_fournisseur/{id}/imprimer', [CommandeFournisseurController::class, 'imprimer'])->name('commandes_fournisseur.imprimer');
Route::post('/patients/ajax-store', [PatientController::class, 'ajaxStore'])->name('patients.ajaxStore');







