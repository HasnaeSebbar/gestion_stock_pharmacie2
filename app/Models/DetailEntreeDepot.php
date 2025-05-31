<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntreeDepot extends Model
{
    use HasFactory;
    protected $table = 'detail_entree_depot';
    protected $fillable = ['entree_depot_id', 'produit_id', 'quantite_recue'];

    public function entreeDepot()
    {
        return $this->belongsTo(EntreeDepot::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
