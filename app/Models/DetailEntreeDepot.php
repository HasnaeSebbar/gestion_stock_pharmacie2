<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntreeDepot extends Model
{
    use HasFactory;
    protected $fillable = ['entree_depot_id', 'produit_id', 'quantite'];

    public function entreeDepot()
    {
        return $this->belongsTo(EntreeDepot::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
}

}
