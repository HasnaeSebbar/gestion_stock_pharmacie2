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
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\AlerteStockController;
use App\Http\Controllers\PharmacienController;
use App\Http\Controllers\ChefPharmacieController; // Ensure this controller exists in the specified namespace or create it if missing
use App\Http\Controllers\CmdFournisseurController; // Import CmdFournisseurController to resolve the undefined type error
use App\Models\Depot;
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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StockProduitController;
use App\Http\Controllers\EntreeDepotController;



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
    Route::get('/chef/dashboard', [App\Http\Controllers\ChefPharmacieController::class, 'dashboard'])->name('chef.dashboard');
    Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
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

Route::resource('depots', DepotController::class);
Route::resource('produits', ProduitController::class);
Route::resource('cmd_depots', CmdDepotController::class);
// Patient
Route::resource('patients', PatientController::class);

// Sortie vers patient
Route::resource('sortie_vers_patients', SortieVersPatientController::class);

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
    Route::resource('alertes-stock', AlerteStockController::class);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

//**************************************************************************** */

// Groupe routes chef de pharmacie uniquement (exemple pour les vues dans chef/)
Route::middleware(['auth', 'role:chef pharmacie'])->group(function () {
    Route::get('/chef/dashboard', [ChefPharmacieController::class, 'dashboard'])->name('chef.dashboard');
    // Toutes les routes qui affichent les vues dans le dossier chef/
    Route::get('chef/fournisseurs', [FournisseurController::class, 'index'])->name('chef.fournisseurs.index');
    Route::get('chef/fournisseurs/create', [FournisseurController::class, 'create'])->name('chef.fournisseurs.create');
    Route::post('chef/fournisseurs', [FournisseurController::class, 'store'])->name('chef.fournisseurs.store');
    // ...autres routes chef/
    Route::get('/chef/commandes-fournisseur/produits', [CommandeFournisseurController::class, 'afficherProduits'])->name('commande_fournisseurs.produits');
Route::get('/chef/commandes-fournisseur/create', [CommandeFournisseurController::class, 'step1'])->name('commandes_fournisseur.create');
Route::post('/chef/commandes-fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');
Route::post('/chef/commandes-fournisseur/store', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
// Route pour afficher le formulaire de création (étape 1)
Route::get('/chef/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');

// Route pour envoyer le formulaire (étape 2)
// Route::post('/commandes-fournisseur/store', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
// Route pour gérer l'étape 2
// Route::post('/commandes-fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');

Route::get('/chef/commandes_fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');
Route::post('/chef/commandes_fournisseur/step2', [CommandeFournisseurController::class, 'step2'])->name('commandes_fournisseur.step2');

Route::post('/chef/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');

Route::get('/chef/commandes-fournisseur/pdf/{id}', [CommandeFournisseurController::class, 'showPDF'])->name('commandes_fournisseur.show_pdf');

Route::get('/chef/commandes_fournisseur/{id}/imprimer', [CommandeFournisseurController::class, 'imprimer'])->name('commandes_fournisseur.imprimer');
Route::get('/chef/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');
Route::get('/chef/fournisseurs', [FournisseurController::class, 'create'])->name('fournisseurs.create');
Route::post('/chef/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');
Route::get('/chef/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::put('/chef/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
Route::delete('/chef/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
Route::resource('fournisseurs', FournisseurController::class);
Route::post('/chef/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');
Route::get('/chef/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::put('/chef/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
Route::delete('/chef/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
Route::get('/chef/commandes-fournisseur', [App\Http\Controllers\CommandeFournisseurController::class, 'index'])->name('commandes.fournisseur.index');
Route::get('/chef/commandes-fournisseur/create', [App\Http\Controllers\CommandeFournisseurController::class, 'create'])->name('commandes.fournisseur.create');
Route::post('/chef/commandes-fournisseur', [App\Http\Controllers\CommandeFournisseurController::class, 'store'])->name('commandes.fournisseur.store');
Route::get('/chef/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'show'])->name('commandes.fournisseur.show');
Route::get('/chef/commandes-fournisseur/{id}/edit', [App\Http\Controllers\CommandeFournisseurController::class, 'edit'])->name('commandes.fournisseur.edit');
Route::put('/chef/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'update'])->name('commandes.fournisseur.update');
Route::delete('/chef/commandes-fournisseur/{id}', [App\Http\Controllers\CommandeFournisseurController::class, 'destroy'])->name('commandes.fournisseur.destroy');
Route::get('/chef/commandes-fournisseur', [CommandeFournisseurController::class, 'index'])->name('commandes.index');
Route::get('/chef/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes.create');
Route::get('/chef/livraisons/create', function () {
    return view('chef.commandes_fournisseur.livraison'); // à créer aussi
})->name('livraisons.create');
Route::post('/chef/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes.store');
Route::get('/chef/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'show'])->name('commandes.show');
Route::get('/chef/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'update'])->name('commandes.update');
Route::delete('/chef/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'destroy'])->name('commandes.destroy');
Route::get('/chef/commandes-fournisseur', [CommandeFournisseurController::class, 'index'])->name('commandes_fournisseur.index');
Route::get('/chef/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'show'])->name('commandes_fournisseur.show');
Route::get('/chef/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes_fournisseur.edit');
Route::put('/chef/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'update'])->name('commandes_fournisseur.update');
Route::delete('/chef/commandes-fournisseur/{id}', [CommandeFournisseurController::class, 'destroy'])->name('commandes_fournisseur.destroy');

Route::get('/chef/commandes-fournisseur/create', [CommandeFournisseurController::class, 'create'])->name('commandes_fournisseur.create');
Route::post('/chef/commandes-fournisseur', [CommandeFournisseurController::class, 'store'])->name('commandes_fournisseur.store');
Route::get('/chef/commande-fournisseurs/create', [CommandeFournisseurController::class, 'create'])->name('commande_fournisseurs.create');
Route::post('/chef/commande-fournisseurs', [CommandeFournisseurController::class, 'store'])->name('commande_fournisseurs.store');
Route::get('/chef/commande-fournisseurs/{id}/bon-commande', [CommandeFournisseurController::class, 'bonCommande'])->name('commande_fournisseurs.bon_commande');
Route::resource('commande_fournisseurs', CommandeFournisseurController::class);

Route::get('/chef/commandes-fournisseur/{id}/edit', [CommandeFournisseurController::class, 'edit'])->name('commandes_fournisseur.edit');
Route::get('/chef/fournisseurs/{id}/edit', [FournisseurController::class, 'edit'])->name('fournisseurs.edit');
Route::get('/commandes-fournisseur/pdf/{id}', [CommandeFournisseurController::class, 'showPDF'])->name('commandes_fournisseur.show_pdf');

Route::get('/chef/commandes_fournisseur/{id}/imprimer', [CommandeFournisseurController::class, 'imprimer'])->name('commandes_fournisseur.imprimer');
Route::get('/chef/livraison/derniere', [CommandeFournisseurController::class, 'livraisonDerniereCommande'])->name('livraison.derniere');
Route::post('/chef/livraison/enregistrer', [CommandeFournisseurController::class, 'sauvegarderLivraison'])->name('livraison.sauvegarder');

// web.php
Route::get('/chef/livraison/commande/{id}', [CommandeFournisseurController::class, 'formulaireLivraison'])->name('livraison.formulaire');


});



// Groupe routes communes pharmacien + chef (pour entrees/ et sortie/)
Route::middleware(['auth', 'role:pharmacien,chef pharmacie'])->group(function () {
    // Dashboard pharmacien
    Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
    // Entrées
    Route::get('/entrees/service/create', [EntreeController::class, 'createEntreeService'])->name('entrees.service.create');
    Route::post('/entrees/service/store', [EntreeController::class, 'storeEntreeService'])->name('entrees.service.store');
    // Sorties (exemple)
    // Route::get('/sortie/vers-patient', [SortieVersPatientController::class, 'create'])->name('sortie_vers_patients.create');
    // ...autres routes entrees/ et sortie/
    Route::get('chef-pharmacien/entrees/recherche-par-date', [EntreeController::class, 'searchByDate'])->name('entrees.searchByDate');
// entreede pharma d'apres le service 
Route::get('chef-pharmacien/entrees/service/create', [EntreeController::class, 'createEntreeService'])
     ->name('entrees.service.create');

Route::post('chef-pharmacien/entrees/service/store', [EntreeController::class, 'storeEntreeService'])
     ->name('entrees.service.store');


Route::get('chef-pharmacien/entrees/service/create', [EntreeController::class, 'createEntreeService'])
     ->name('entrees.service.create');
Route::post('chef-pharmacien/entrees/service/store', [EntreeController::class, 'storeEntreeService'])
     ->name('entrees.service.store');
    

Route::post('chef-pharmacien/entrees/service/store', [EntreeController::class, 'storeEntreeService'])->name('entrees.service.store');

Route::get('chef-pharmacien/entrees/create-service', [EntreeController::class, 'createEntreeService'])->name('entrees.create-service');
Route::get('chef-pharmacien/entrees/service/create', [App\Http\Controllers\EntreeController::class, 'createEntreeService'])->name('entrees.service.create');
Route::post('chef-pharmacien/patients/ajax-store', [PatientController::class, 'ajaxStore'])->name('patients.ajaxStore');
Route::post('chef-pharmacien/sortie_vers_patient', [SortieVersPatientController::class, 'store'])->name('sortie_vers_patients.store');
Route::get('chef-pharmacien/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('chef-pharmacien/patients', [PatientController::class, 'store'])->name('patients.store');

Route::get('chef-pharmacien/sortie/patient', [SortieVersPatientController::class, 'create'])->name('sortie_vers_patients.create');
Route::post('chef-pharmacien/sortie/patient', [SortieVersPatientController::class, 'store'])->name('sortie_vers_patients.store');
Route::get('chef-pharmacien/sortie_vers_patients/create', [SortieVersPatientController::class, 'create'])->name('sortie_vers_patients.create');
Route::get('chef-pharmacien/sortie_vers_patients/pdf', [SortieVersPatientController::class, 'genererPDF'])->name('sortie_vers_patients.pdf');

Route::get('/alertes-stock', [App\Http\Controllers\AlerteStockController::class, 'produitsEnAlerte'])->name('alertes-stock.index');

Route::get('/visualiser-stock', [App\Http\Controllers\StockController::class, 'visualiser'])->name('visualiser_stock.index');

Route::get('/visualiser-stock', [StockProduitController::class, 'visualiser'])->name('visualiser_stock.index');
});

// Groupe routes majeurs
Route::middleware(['auth', 'role:majeur'])->group(function () {
    Route::get('/majeur/dashboard', function () {
        return view('majeur.dashboard');
    })->name('majeur.dashboard');

    // Ajoute cette ligne pour la commande
    Route::get('/majeur/commande/passer', [App\Http\Controllers\MajeurRadioController::class, 'passerCommande'])->name('commande.passer');

    // Ajoute cette route pour l'entrée de stock
    Route::get('/majeur/stock/entrer', [EntreeDepotController::class, 'create'])->name('stock.entrer');
    Route::post('/majeur/stock/entrer', [EntreeDepotController::class, 'store'])->name('entree_depot.store');
    Route::get('/majeur/stock/entrees/historique', [EntreeDepotController::class, 'historique'])->name('entree_depot.historique');

    // Ajoute cette route pour la sortie de stock
    Route::get('/majeur/stock/sortie', [SortieInterneController::class, 'create'])->name('stock.sortie');
    Route::post('/majeur/stock/sortie', [SortieInterneController::class, 'store'])->name('sortieinternes.store');

    // Ajoute cette route pour visualiser le stock
    Route::get('/majeur/stock/visualiser', function () {
        return view('majeur.stock_visualiser');
    })->name('stock.visualiser');

    Route::post('/majeur/commande/store', [App\Http\Controllers\MajeurRadioController::class, 'storeCommande'])->name('commande.store');
    Route::get('/majeur/sortie/commandes-traitees', [SortieDepotController::class, 'commandesTraitees'])->name('stock.entrer.parcommande');
});




