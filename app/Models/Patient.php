<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'id_patient';

    protected $fillable = [
        'nom',
        'prenom',
        'date_nais',
        'numero_dossier',
    ];
}