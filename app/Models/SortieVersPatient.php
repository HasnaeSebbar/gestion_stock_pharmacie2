<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieVersPatient extends Model
{
    protected $table = 'sortie_vers_patient';
    protected $primaryKey = 'id_sortie_vers_patient';
    public $timestamps = false;

    protected $fillable = ['id_patient', 'date_sortie', 'id_depot'];
    use HasFactory;
    public function patient()
{
    return $this->belongsTo(Patient::class, 'id_patient');
}

public function details()
{
    return $this->hasMany(DetailSortiePatient::class, 'id_sortie_vers_patient');
}
public function produits()
{
    return $this->belongsToMany(Produit::class, 'detail_sortie_patients', 'id_sortie_vers_patient', 'id_produit')
                ->withPivot('quantite');
}

}
