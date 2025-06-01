<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieDepot extends Model
{
    use HasFactory;
    protected $table = 'sortie_depots';
    protected $primaryKey = 'id_sortie_depot';
    public $incrementing = true;
    public $keyType = 'int';

    public function depotSource() {
        return $this->belongsTo(Depot::class, 'id_depot_source', 'id_depot');
    }

    public function depotDestination() {
        return $this->belongsTo(Depot::class, 'id_depot_destin', 'id_depot');
    }

    public function details() {
        return $this->hasMany(DetailSortieDepot::class, 'id_sortie_depot', 'id_sortie_depot');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function sortieParCommande()
    {
        return $this->hasOne(\App\Models\SortieParCommande::class, 'id_sortie_depot');
    }
}
