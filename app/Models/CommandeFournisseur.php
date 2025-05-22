<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeFournisseur extends Model

{   
    use HasFactory;
     protected $table = 'commande_fournisseurs';
    protected $fillable = ['id_depot', 'id_fournisseur', 'date_commande', 'statut'];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }
   

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    public function details()
    {
        return $this->hasMany(DetailCommande::class, 'commande_id');
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'detail_commandes', 'commande_id', 'produit_id')
                    ->withPivot('quantite');
    }
    public function detailsCommande()
{
    // Supposons que le modèle des détails s'appelle DetailCommande
    // et que la clé étrangère est commande_fournisseur_id
    return $this->hasMany(DetailCommande::class, 'commande_id');
}
public function entrees()
{
    return $this->hasMany(EntreeFournisseur::class);
}


}