<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortiePatient extends Model
{
    use HasFactory;
    protected $table = 'detail_sortie_patients';
    protected $primaryKey = 'id_detail_sortie_patient';
    public $timestamps = false;

    protected $fillable = [
        'id_sortie_vers_patient',
        'id_produit',
        'quantite',
    ];

    public function sortieVersPatient()
    {
        return $this->belongsTo(SortieVersPatient::class, 'id_sortie_vers_patient');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
    // public function depot()
    // {
    //     return $this->belongsTo(Depot::class, 'id_depot');
    // }
}
