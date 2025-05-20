<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduit extends Model
{
    use HasFactory;
    protected $primaryKey = null;
    public $incrementing = false;

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}
