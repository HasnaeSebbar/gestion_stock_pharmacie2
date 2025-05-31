<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieParCommande extends Model
{
    use HasFactory;
    protected $table = 'sortie_par_commandes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_cmd_depot',
        'id_sortie_depot',
    ];

    public function sortieDepot()
    {
        return $this->belongsTo(\App\Models\SortieDepot::class, 'id_sortie_depot', 'id_sortie_depot');
    }

    public function cmdDepot()
    {
        return $this->belongsTo(\App\Models\CmdDepot::class, 'id_cmd_depot');
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }

    public function details()
    {
        return $this->hasMany(DetailSortieInterne::class, 'id_sortie_par_commande');
    }
}
