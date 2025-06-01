<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeDepot extends Model
{
    use HasFactory;
    protected $table = 'entree_depot';
    protected $fillable = ['id_depot', 'date_entree'];

    public function details()
    {
        return $this->hasMany(DetailEntreeDepot::class, 'entree_depot_id');
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }
}
