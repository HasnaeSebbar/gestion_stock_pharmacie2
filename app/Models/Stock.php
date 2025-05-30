<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'id_stock';

    protected $fillable = [
        'id_depot',
        // autres champs si besoin
    ];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }

    public function stockProduits()
    {
        return $this->hasMany(StockProduit::class, 'id_stock');
    }

    public function alerteStocks()
    {
        return $this->hasMany(AlerteStock::class, 'id_depot');
    }
}
