<?php

namespace App;

//Import des classes externes
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/*
 * Classe Referentqi: Modèle permattant la gestion de Référent de Qualification/Intégration
 *
 */
class Referentqi extends Model
{

	  //Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'referentqi';

    // Liste des champs qui peuvent être triés dans un tableau
    use Sortable;
    public $sortable = ['nom'];

    //List des champs utilisables pour les opérations de CRUD
    protected $fillable = [
        'nom', 'prenom',
    ];

    //Lien avec une version
    public function version()
    {
        return $this->hasOne(\App\Version::class);
    }

}