<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    protected $table = 'depots';  // Si le nom de la table est différent

    protected $primaryKey = 'id_depot'; 
    use HasFactory;
    public function users()
{
    return $this->hasMany(User::class);
}
public function utilisateurs() {
    return $this->hasMany(User::class);
}

public function commandes() {
    return $this->hasMany(CommandeFournisseur::class);
}

public function entrees() {
    return $this->hasMany(EntreeFournisseur::class);
}
public function sortiesInternes()
{
    return $this->hasMany(SortieInterne::class, 'id_depot');
}

public function sortiesDepotSource()
{
    return $this->hasMany(SortieDepot::class, 'id_depot_source');
}

public function sortiesDepotDestination()
{
    return $this->hasMany(SortieDepot::class, 'id_depot_destin');
}

public function sortiesParCommande()
{
    return $this->hasMany(SortieParCommande::class, 'id_depot');
}
public function cmdDepotEntrees()
{
    return $this->hasMany(CmdDepotEntree::class, 'id_depot');

}
}
