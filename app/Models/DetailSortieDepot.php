<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortieDepot extends Model
{
    use HasFactory;
    public function sortieDepot()
{
    return $this->belongsTo(SortieDepot::class, 'id_sortie_depot');
}

public function produit()
{
    return $this->belongsTo(\App\Models\Produit::class, 'id_produit');
}

public function depot()
{
    return $this->belongsTo(Depot::class, 'id_depot');
}

}
