<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',  // Référence au produit
        'niveau_stock',  // Niveau du stock
        'seuil_alerte', // Seuil qui déclenche l'alerte
        'date_alerte',
    ];

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
    protected $primaryKey = 'id_alert';

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }
}
