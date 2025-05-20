<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieInterne extends Model
{
    use HasFactory;
    public function depot()
{
    return $this->belongsTo(Depot::class, 'id_depot');
}

public function details()
{
    return $this->hasMany(DetailSortieInterne::class, 'id_sortie_interne');
}
public function produits()
{
    return $this->belongsToMany(Produit::class, 'detail_sortie_internes', 'id_sortie_interne', 'id_produit')
                ->withPivot('quantite');

}
}
