<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntree extends Model
{
    use HasFactory;

    protected $table = 'detail_entrees';

    protected $fillable = [
        'id_entree',
        'id_produit',
        'quantite_recue',
    ];

    // Relation vers l'entrée fournisseur
    public function entree()
    {
        return $this->belongsTo(EntreeFournisseur::class, 'id_entree', 'id_entree');
    }

    // Relation vers le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}