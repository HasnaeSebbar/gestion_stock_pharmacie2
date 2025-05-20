<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmdDepotEntree extends Model
{
    use HasFactory;
    protected $fillable = ['cmd_depot_id', 'entree_depot_id'];

    public function cmdDepot()
    {
        return $this->belongsTo(CmdDepot::class);
    }

    public function entreeDepot()
    {
        return $this->belongsTo(EntreeDepot::class);
}
public function sortiesParCommande()
{
    return $this->hasMany(SortieParCommande::class, 'id_cmd_depot');
}
public function depot()
{
    return $this->belongsTo(Depot::class, 'id_depot');

}
}
