<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{

	//Nom de la table associée au modèle
   	protected $table = 'tache';

    // Désactivation du timestamp dans la table "tache"
	public $timestamps = false;

    protected $fillable = [
        'id', 'label', 'start', 'end', 'tachetype_id', 'version_id',
    ];

    // Lien avec la classe TacheType QI qui contient la liste des référents QI PIAM
	public function tachetype() 
	{
		return $this->belongsTo(\App\TacheType::class);
	}
}
