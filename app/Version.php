<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Input;

use Illuminate\Database\Eloquent\ModelNotFoundException;

//Import de la classe tâche
use App\Tache;

use Carbon\Carbon;

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
        'referencealfa', 'alfadate',
        'inc_nblivtma',
        'qos', 'enjeuxmetier', 'enjeuxsi',
        'referentprd_id', 'alerteprd', 'prp_estimationcharge', 'prd_estimationcharge', 'prd_nbreports', 'prd_versiondimensions',
        'commentaire',
        'versionetat_id',
    ];

    // Liste des champs qui peuvent être triés (dans un tableau par exemple)
    use Sortable;
    public $sortable = ['version', 'libelle', 'inc_nblivtma', 'qos'];

    public function getAlfadateAttribute($value)
    {
      if($value){
        return Carbon::parse($value)->format('d/m/Y');
      }
      else {
        return $value;
      }
    }

    public function setAlfadateAttribute($value) {
        if($value){
          $this->attributes['alfadate'] = Carbon::createFromFormat('d/m/Y', $value);
        }
        else{
          $this->attributes['alfadate'] = null;
        }
      }

    /*
     * Fonction scopeFilter($query, $query_search)
     * @Return $query - Liste des versions filtrées
     * Permet de réaliser un filtre sur les versions lors de la recherche en page d'index
     */
	public function scopeFilter($query, $referentqisselect)
  {

      if ($referentqisselect == 0){
        return $query->where('libelle', 'like', '%')
                      ->sortable()
                      ->orderBy('application_id', 'asc');
      }
      else{
        return $query->where('referentqi_id', $referentqisselect)
                      ->sortable()
                      ->orderBy('application_id', 'asc');
      }

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

  public static function getDateJalonByString(Version $version, $tachetype_id, $libelle){
    $returnvalue;

    try {
      $tache = Tache::where('tachetype_id', $tachetype_id)
                   ->where('libelle', $libelle)
                   ->where('version_id', $version->id)
                   ->firstOrFail();

      if ($tache->debut == '') {
        $returnvalue = 'Non renseignée';
      }
      else {
        $returnvalue = $tache->debut;
      }
    }
    catch (ModelNotFoundException $ex) // Exception levée si aucun résultat n'est trouvé "ModelNotFoundException"
    {
      $returnvalue = 'Non renseignée';
    }

    return $returnvalue;
  }

  public static function getDateTacheByString(Version $version, $tachetype_id, $libelle, $type){
    $returnvalue;

    try {
      $tache = Tache::where('tachetype_id', $tachetype_id)
                   ->where('libelle', $libelle)
                   ->where('version_id', $version->id)
                   ->firstOrFail();
      if($type == "debut" ){
        if ($tache->debut == '') {
          $returnvalue = 'Non renseignée';
        }
        else {
          $returnvalue = $tache->debut;
        }
      }
      else {
        if ($tache->fin == '') {
          $returnvalue = 'Non renseignée';
        }
        else {
          $returnvalue = $tache->fin;
        }
      }

    }
    catch (ModelNotFoundException $ex) // Exception levée si aucun résultat n'est trouvé "ModelNotFoundException"
    {
      $returnvalue = 'Non renseignée';
    }

    return $returnvalue;
  }

}
