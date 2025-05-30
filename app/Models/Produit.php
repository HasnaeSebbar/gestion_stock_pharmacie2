<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailSortiePatient;

// Ensure the following line is only present if the class exists
// use App\Models\DetailEntreeInterne;
use App\Models\DetailSortieInterne;
use App\Models\DetailSortieDepot;
use App\Models\DetailEntree;
use App\Models\DetailEntreeDepot;

    

class Produit extends Model
{
    protected $fillable = ['nom', 'type'];
    use HasFactory;
    public function detailSortiePatient()
    {
        return $this->hasMany(DetailSortiePatient::class, 'id_produit');
    }
    public function detailSortieInterne()
    {
        return $this->hasMany(DetailSortieInterne::class, 'id_produit');
    }
    public function detailSortieDepot()
    {
        return $this->hasMany(DetailSortieDepot::class, 'id_produit');
    }
    public function detailEntree()
    {
    // Uncomment the following function only if DetailEntreeInterne exists
    // public function detailEntreeInterne()
    // {
    //     return $this->hasMany(DetailEntreeInterne::class, 'id_produit');
    // }
        return $this->hasMany(DetailEntreeDepot::class, 'id_produit');
    }
    public function detailEntreeDepot()
    {
        return $this->hasMany(DetailEntreeDepot::class, 'id_produit');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}

