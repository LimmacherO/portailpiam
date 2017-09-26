<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    //Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'domaine';

    protected $fillable = [
        'libelle',
    ];

    public function application()
    {
        return $this->hasOne(\App\Application::class);
    }

}
