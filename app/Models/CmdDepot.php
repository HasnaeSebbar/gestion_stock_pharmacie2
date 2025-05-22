<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CmdDepotEntree;
use App\Models\Depot;
use App\Models\DetailCmd;

class CmdDepot extends Model
{
    use HasFactory;

    protected $table = 'cmd_depot'; // <-- Spécifie la table

    protected $fillable = [
        'depot_source_id',
        'depot_dest_id',
        'date_cmd',
        'statut',
    ];

    public function depotSource()
    {
        return $this->belongsTo(Depot::class, 'depot_source_id');
    }

    public function depotDest()
    {
        return $this->belongsTo(Depot::class, 'depot_dest_id');
    }

    public function details()
    {
        return $this->hasMany(DetailCmd::class);
    }

    public function entrees()
    {
        return $this->hasMany(CmdDepotEntree::class);
    }
}
