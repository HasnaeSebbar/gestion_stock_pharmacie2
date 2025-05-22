<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeFournisseur extends Model
{

    protected $table = 'entrees'; // obligatoire si tu ne suis pas le nom par défaut
    protected $primaryKey = 'id_entree'; // important aussi si tu n’utilises pas "id"
    public $timestamps = true;
     protected $keyType = 'int';

    protected $fillable = [
        'commande_id',
        'date_entree',
        'id_depot',
        'fournisseur_id',
    ];


    
    public function commande()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'commande_id');
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    public function details()
    {
        return $this->hasMany(DetailEntree::class, 'id_entree');
    }
    
}