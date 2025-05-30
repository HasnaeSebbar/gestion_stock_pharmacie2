<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCmd extends Model
{
    use HasFactory;
    protected $fillable = ['cmd_depot_id', 'produit_id', 'quantite'];
    protected $table = 'detail_cmd'; // Spécifie la table associée
    protected $primaryKey = 'id'; //

public function commande()
    {
        return $this->belongsTo(CmdDepot::class, 'cmd_depot_id');
    }

    public function produit()
    {
        return $this->belongsTo(\App\Models\Produit::class, 'id_produit', 'id');
    }

}
