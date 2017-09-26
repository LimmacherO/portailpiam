<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Referentqi extends Model
{

	//Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'referentqi';

    // Liste des champs qui peuvent être triés dans un tableau
    use Sortable;
    public $sortable = ['nom'];

    protected $fillable = [
        'nom', 'prenom',
    ];

    public function version()
    {
        return $this->hasOne(\App\Version::class);
    }

}