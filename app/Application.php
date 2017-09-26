<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Application extends Model
{
       
  	//Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'application';

	protected $fillable = [
        'id', 'libelle',
    ];

    // Liste des champs qui peuvent être triés dans un tableau
    use Sortable;
    public $sortable = ['libelle'];

    public function version()
    {
        //return $this->hasMany(\App\Version::class);
        return $this->hasOne('\App\Version::class');
    }

  	public function domaine() 
  	{
  		return $this->belongsTo(\App\Domaine::class);
  	}

}
