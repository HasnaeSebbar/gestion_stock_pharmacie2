<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model

{
    protected $fillable = ['commande_id', 'produit_id', 'quantite'];

    public function commande()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'id_commande');
    }

    
    
    public function produit()
{
    return $this->belongsTo(Produit::class, 'produit_id');
}

}

