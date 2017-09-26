<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Input;

/*
 * Classe "version": gestion des versions des produits
 * @Author: Romain Jedynak
 */
class Version extends Model
{

	//Nom de la table associée au modèle
   	protected $table = 'versions';

	// Désactivation du timestamp dans la table "versions"
	public $timestamps = true;

    protected $fillable = [
        'version', 'libelle', 'application_id', 
        'referentqi_id', 'alerteqi',
        'referencealfa', 'inc_nblivtma', 
        'referentprd_id', 'date_mep', 'alerteprd',
        'commentaire',
    ];

	
    // Liste des champs qui peuvent être triés dans un tableau
    use Sortable;
    public $sortable = ['version', 'libelle', 'inc_nblivtma', 'date_mep'];

    /*
     * Fonction scopeFilter($query, $params)
     * @Return $query - Liste des versions filtrées
     * Permet de réaliser un filtre sur les versions
     */
	public function scopeFilter($query, $params, $nbrPerPage)
    {
    	//Contrôle sur les paramètres contiennent bien une variable "search" non vide
        if ( isset($params['search']) && trim($params['search']) !== '' )
        {
        	//Filtrage sur différents champs
            $query->where('versions.libelle', 'LIKE', '%'. trim($params['search'] . '%'))
            	  ->orwhere('version', 'LIKE', '%'. trim($params['search'] . '%'))
            	  ->orwhereHas('application', function ($query) use ($params) {
					    	$query->where('application.libelle', 'like', '%'. trim($params['search'] . '%'))
					    		  ->orwhereHas('domaine', function ($query) use ($params) {
					    		$query->where('domaine.libelle', 'like', '%'. trim($params['search'] . '%'));
					    		});
					    })
                  ->orwhereHas('referentqi', function ($query) use ($params) {
                                $query->where('referentqi.nom', 'like', '%'. trim($params['search'] . '%'));
                        })
                  ->orwhereHas('referentqi', function ($query) use ($params) {
                                $query->where('referentqi.prenom', 'like', '%'. trim($params['search'] . '%'));
                        })
            	  ->sortable()
            	  ->paginate($nbrPerPage);
        }
        else {
        	$query->sortable()
            	  ->paginate($nbrPerPage);
        }

        return $query;
    }
    

    // Lien avec la classe Référent QI qui contient la liste des référents QI PIAM
	public function referentqi() 
	{
		return $this->belongsTo(\App\Referentqi::class);
	}

	// Lien avec la classe Application qui contient la liste des application
	public function application() 
	{
		return $this->belongsTo(\App\Application::class);
	}

    // Lien avec la classe Référent PRD qui contient la liste des référents PRD DPE
	public function referentprd() 
	{
		return $this->belongsTo(\App\Referentprd::class);
	}

}
