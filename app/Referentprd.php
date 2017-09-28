<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;

/*
 * Classe Referentprd: Modèle permettant la gestion des Référents de Production
 * @Author: Romain Jedynak
 */
class Referentprd extends Model
{

	  //Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'referentprd';

    //Liste des champs utilisables pour les opérations de type CRUD
    protected $fillable = [
        'nom', 'prenom',
    ];

    //Lien avec une version
    public function versions()
    {
        return $this->hasMany(\App\Version::class);
    }

}
