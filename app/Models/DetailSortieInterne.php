<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortieInterne extends Model
{
    use HasFactory;
    protected $table = 'detail_sortie_internes';
    protected $primaryKey = 'id_detail_interne';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'id_sortie_interne',
        'id_produit',
        'quantite',
    ];

    public function sortieInterne()
    {
        return $this->belongsTo(SortieInterne::class, 'id_sortie_interne');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}
