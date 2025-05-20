<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // App\Models\Patient.php

protected $primaryKey = 'id_patient';

protected $fillable = [
    'nom',
    'prenom',
    'date_nais', // Correction ici pour correspondre à la base de données
    'numero_dossier',
];
protected $table = 'patients';
    public function sortiesVersPatient()
{
    return $this->hasMany(SortieVersPatient::class, 'id_patient');
}
public function detailSortiePatients()
{
    return $this->hasManyThrough(DetailSortiePatient::class, SortieVersPatient::class, 'id_patient', 'id_sortie_vers_patient', 'id_patient', 'id_sortie_vers_patient');

}
}
