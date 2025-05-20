<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieParCommande extends Model
{
    use HasFactory;
    public function cmdDepot()
{
    return $this->belongsTo(CmdDepot::class, 'id_cmd_depot');
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
