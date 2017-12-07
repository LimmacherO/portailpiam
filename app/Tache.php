<?php

namespace App;

//Import des classes externes
use Illuminate\Database\Eloquent\Model;

/*
 * Class Tache: Modèle de gestion des taches/jalons d'une version
 * @Author: Romain Jedynak
 */
class Tache extends Model
{

	//Nom de la table associée au modèle
  protected $table = 'tache';

    // Désactivation du timestamp dans la table "tache"
	public $timestamps = false;

	//Liste des champs utilisés pour les opérations CRUD
    protected $fillable = [
        'id', 'libelle', 'debut', 'fin', 'tachetype_id', 'version_id',
        'jalon',
    ];

  // Lien avec la classe TacheType QI qui contient la liste des référents QI PIAM
	public function tachetype()
	{
		return $this->belongsTo(\App\TacheType::class);
	}

  public static function jalonTostring(Tache $tache){

    if($tache->jalon == true){
      return "Jalon";
    }
    else {
      return "Tâche";
    }

  }

	protected $casts = [
        'deletable' => 'boolean',
    ];
}
