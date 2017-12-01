<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Input;

use App\Tache;

/*
 * Classe "version": Modèle permettant la gestion des "versions"
 * @Author: Romain Jedynak
 */
class Version extends Model
{

	//Nom de la table associée au modèle
  protected $table = 'versions';

	//Activation du timestamp dans la table "versions"
	public $timestamps = true;

    //Liste des champs utilisables
    protected $fillable = [
        'version', 'version_dimensions',
        'libelle', 'product_dimensions',
        'application_id',
        'referentqi_id', 'alerteqi', 'avancementqi', 'perimetreqi',
        'referencealfa', 'referencealfa_date',
        'inc_nblivtma',
        'qos', 'enjeuxmetier', 'enjeuxsi',
        'referentprd_id', 'date_mep', 'alerteprd', 'prp_estimationcharge', 'prd_estimationcharge', 'prd_nbreports',
        'commentaire',
        'versionetat_id',
    ];

    // Liste des champs qui peuvent être triés (dans un tableau par exemple)
    use Sortable;
    public $sortable = ['version', 'libelle', 'inc_nblivtma'];

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
                  //->orwhere('inc_nblivtma', 'LIKE', '%'. trim($params['search'] . '%'))
                  //Ajout du tri
            	  ->sortable()
                ->orderBy('application_id', 'asc')
                  //Filtre du nombre de données en sortie
            	  ->paginate($nbrPerPage);
        }
        else {
          //Si c'est vide, la fonction renvoi toute la lioste des versions

          //Ajout du tri
        	$query->sortable()
                ->orderBy('application_id', 'asc')
                 //Filtre du nombre de données en sortie
            	  ->paginate($nbrPerPage);
        }

        return $query;
    }

  public static function calculQos($enjeuxmetier, $enjeuxsi)
  {

    $qos = 0;

    if ($enjeuxmetier == 3 && $enjeuxsi == 3)
    {
      $qos = 9;
    }
    elseif ($enjeuxmetier == 3 && $enjeuxsi < 3)
    {
      $qos = 5;
    }
    elseif ($enjeuxmetier < 3 && $enjeuxsi == 3)
    {
      $qos = 5;
    }
    else
    {
      $qos = 1;
    }

    return $qos;
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

  // Lien avec la classe VersionEtat qui contient la liste des états possibles d'une version
  public function versionetat()
  {
    return $this->belongsTo(\App\VersionEtat::class);
  }

  public static function perimetreqitostring($perimetreqi){
    $returnvalue;

    if($perimetreqi){
       $returnvalue = 'Oui';
    }
    else{
      $returnvalue = 'Non';
    }

    return $returnvalue;
  }


  public static function getDateDemTrvQIPrev(Version $version){
    $returnvalue;

    $tache = Tache::where('tachetype_id', '2')
                   ->where('libelle', 'Date de démarrage QI prévisionnelle')
                   ->where('version_id', $version->id)
                   ->first();
                   
    if ($tache->debut == '')
    {
      $returnvalue = 'Non renseignée';
    }
    else
    {
      $returnvalue = \Carbon\Carbon::parse($tache->debut)->format('d/m/Y');
    }

    return $returnvalue;
  }

  public static function getDateDemTrvQIReelle(Version $version){
    $returnvalue;

    $tache = Tache::where('tachetype_id', '2')
                   ->where('libelle', 'Date de démarrage QI réelle')
                   ->where('version_id', $version->id)
                   ->first();

   if ($tache->debut == '')
   {
     $returnvalue = 'Non renseignée';
   }
   else
   {
     $returnvalue = \Carbon\Carbon::parse($tache->debut)->format('d/m/Y');
   }

    return $returnvalue;
  }

}
