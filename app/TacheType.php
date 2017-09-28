<?php

namespace App;

//Import des classes externes
use Illuminate\Database\Eloquent\Model;

/*
 * Classe TacheType: Modèle permettant la vestion des types de tâches (Jalons, Tâches, etc.)
 * @Author: Romain Jedynak
 */
class TacheType extends Model
{
    //Nom de la table associée au modèle
   	protected $table = 'tachetype';

    // Désactivation du timestamp dans la table "tachetype"
	public $timestamps = false;

    //Liste des champs utilisables pour les opérations de CRUD
    protected $fillable = [
        'id', 'libelle', 
    ];

    //Lien avec mes tâches
    public function taches()
    {
        return $this->hasMany(\App\Taches::class);
    }
}
