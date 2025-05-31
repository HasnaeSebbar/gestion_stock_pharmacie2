<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CmdDepotEntree;
use App\Models\Depot;
use App\Models\DetailEntree;

class EntreeDepot extends Model
{
    use HasFactory;
    protected $fillable = ['id_depot','date_entree'];

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function details()
    {
        return $this->hasMany(DetailEntreeDepot::class);
    }

    public function cmdDepots()
    {
        return $this->hasMany(CmdDepotEntree::class);
}

}
