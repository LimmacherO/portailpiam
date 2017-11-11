<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Version;

class VersionEtat extends Model
{
   	//Nom de la table associée au modèle
   	protected $table = 'versionetat';

    //Désactivation du timestamp dans la table
	public $timestamps = false;

	//Liste des champs utilisables
    protected $fillable = [
        'libelle', 
    ];

    //Lien avec las versions
    public function versions()
    {
        return $this->hasMany(\App\Version::class);
    }
}
