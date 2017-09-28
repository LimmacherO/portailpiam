<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/*
 * Class Application: Modèle permettant la gestion des applications
 * @Auhtor: Romain Jedyank
 */
class Application extends Model
{
    
  	//Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'application';

    //Liste des champs utilisés pour les opérations CRUD
	  protected $fillable = [
        'id', 'libelle',
    ];

    // Liste des champs qui peuvent être triés dans un tableau
    use Sortable;
    public $sortable = ['libelle'];

    //Lien avec une version
    public function version()
    {
        //return $this->hasMany(\App\Version::class);
        return $this->hasOne('\App\Version::class');
    }

    //Lien avec un domaine
  	public function domaine() 
  	{
  		return $this->belongsTo(\App\Domaine::class);
  	}

}
