<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheType extends Model
{
    //Nom de la table associée au modèle
   	protected $table = 'tachetype';

    // Désactivation du timestamp dans la table "tachetype"
	public $timestamps = false;

    protected $fillable = [
        'id', 'libelle', 
    ];

    public function taches()
    {
        return $this->hasMany(\App\Taches::class);
    }
}
