<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Input;

//Import de la classe tâche
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
     * Fonction scopeFilter($query, $query_search)
     * @Return $query - Liste des versions filtrées
     * Permet de réaliser un filtre sur les versions lors de la recherche en page d'index
     */
	public function scopeFilter($query, $query_search)
  {
      return $query->where('versions.libelle', 'LIKE', $query_search)
                   ->orwhere('version', 'like', $query_search)

                   ->orwhereHas('application', function ($query) use ($query_search) {
                     $query->where('application.libelle', 'like', $query_search)
                   		     ->orwhereHas('domaine', function ($query) use ($query_search) {
                   					  $query->where('domaine.libelle', 'like', $query_search);
                   					});
                   })

                   //Filtrage par nom de famille du référent QI
                   ->orwhereHas('referentqi', function ($query) use ($query_search) {
                     $query->where('referentqi.nom', 'like', $query_search);
                   })

                   //Filtrage par prénom du référent QI
                   ->orwhereHas('referentqi', function ($query) use ($query_search) {
                     $query->where('referentqi.prenom', 'like', $query_search);
                   })

                   ->sortable()
                   ->orderBy('application_id', 'asc');
  }

  /*
   * Fonction calculQos($enjeuxmetier, $enjeuxsi)
   * @Return QoS
   * Permet de calculer la valeur QoS d'une version
   */
  public static function calculQos($enjeuxmetier, $enjeuxsi)
  {

    $qos = 0;

    if ($enjeuxmetier == 3 && $enjeuxsi == 3){
      $qos = 9;
    }
    elseif ($enjeuxmetier == 3 && $enjeuxsi < 3){
      $qos = 5;
    }
    elseif ($enjeuxmetier < 3 && $enjeuxsi == 3){
      $qos = 5;
    }
    else{
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



  public static function getDateByString(Version $version, $tachetype_id, $libelle){
    $returnvalue;

    $tache = Tache::where('tachetype_id', $tachetype_id)
                   ->where('libelle', $libelle)
                   ->where('version_id', $version->id)
                   ->first();

       if ($tache->debut == '') {
         $returnvalue = 'Non renseignée';
       }
       else {
         $returnvalue = \Carbon\Carbon::parse($tache->debut)->format('d/m/Y');
       }

    return $returnvalue;
  }

}
