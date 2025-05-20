<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieDepot extends Model
{
    use HasFactory;
    public function depotSource()
{
    return $this->belongsTo(Depot::class, 'id_depot_source');
}

public function depotDestination()
{
    return $this->belongsTo(Depot::class, 'id_depot_destin');
}

public function details()
{
    return $this->hasMany(DetailSortieDepot::class, 'id_sortie_depot');
}
public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
}
