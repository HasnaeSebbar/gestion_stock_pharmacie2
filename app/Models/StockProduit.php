<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduit extends Model
{
    use HasFactory;

    protected $table = 'stock_produits';
    public $incrementing = false; // Clé primaire composée
    protected $primaryKey = ['id_stock', 'id_produit'];

    protected $fillable = [
        'id_stock',
        'id_produit',
        'quantite_initial',
        'seuil_alerte',
        'seuil_alerte_reactif',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}
