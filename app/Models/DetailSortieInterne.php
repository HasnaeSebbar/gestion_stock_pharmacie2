<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortieInterne extends Model
{
    use HasFactory;
    public function sortieInterne()
{
    return $this->belongsTo(SortieInterne::class, 'id_sortie_interne');
}

public function produit()
{
    return $this->belongsTo(Produit::class, 'id_produit', 'id');
}
public function depot()
{
    return $this->belongsTo(Depot::class, 'id_depot');
}
}
