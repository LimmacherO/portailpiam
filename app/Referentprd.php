<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referentprd extends Model
{

	//Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'referentprd';

    protected $fillable = [
        'nom', 'prenom',
    ];

    public function versions()
    {
        return $this->hasMany(\App\Version::class);
    }

}
