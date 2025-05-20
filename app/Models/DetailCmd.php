<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCmd extends Model
{
    use HasFactory;
    protected $fillable = ['cmd_depot_id', 'produit_id', 'quantite'];

    public function cmdDepot()
    {
        return $this->belongsTo(CmdDepot::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
}

}
