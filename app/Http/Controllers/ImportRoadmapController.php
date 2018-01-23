<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Domaine;
use App\Application;
use App\Version;
use App\VersionEtat;
use App\Referentqi;
use App\Referentprd;
use App\Tache;
use Carbon\Carbon;

class ImportRoadmapController extends Controller
{
  //Affichage de la page d'administration d'import de la Roadmap
  public function index(){
    return view('import.roadmap.index');
  }

  public function importExcel(){

    if(Input::hasFile('import_file')){

    			$path = Input::file('import_file')->getRealPath();

    			$data = Excel::load($path, function($reader) {
    			})->get();

    			if(!empty($data) && $data->count()){

            foreach ($data as $key => $value) {
    					$insert[] = ['domaine' => $value->domaine,
                            'application' => $value->application,
                            'sujet'=> $value->sujet,
                            'versionmoe' => $value->versionmoe,
                            'enjeuxmetier' => $value->enjeuxmetier,
                            'enjeuxsi' => $value->enjeuxsi,
                            'qos' => $value->qos,
                            'referentqi' => $value->referentqi, //Pré-requis --> Colonne à renommer dans la Roadmap + attention au format de la colonne (standard et non date)
                            'dateprevdemqi' => $value->dateprevdemqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'datereelledemqi' => $value->datereelledemqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'iteration' => $value->iteration,
                            'productdimensions' => $value->productdimensions,
                            'versiondimensions' => $value->versiondimensions,
                            'reference' => $value->reference, //Référence DQMP ALFA
                            'date' => $value->date, //Date de la DQMP ALFA
                            'activiteqi' => $value->activiteqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'avancementqi' => $value->avancementqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'prpdateprev' => $value->prpdateprev, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'versiondimensionslivree' => $value->versiondimensionslivree, //Pré-requis --> Colonne à renommer dans la Roadmap + format de la colonne (standard et non date)
                            'prpdatereelle' => $value->prpdatereelle, //Pré-requis: Colonne à renommer
                            'prpdebut' => $value->prpdebut, //Pré-requis: Colonne à renommer
                            'prpfin' => $value->prpfin, //Pré-requis: Colonne à renommer
                            'estimationchargeprp' => $value->estimationchargeprp, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'prddateprev' => $value->prddateprev, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'prddatereelle' => $value->prddatereelle, //Pré-requis: Colonne à renommer
                            'estimationchargeprd' => $value->estimationchargeprd, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'nbreportmep' => $value->nbreportmep, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'referentprd' => $value->referentprd, //Pré-requis --> Colonne à renommer dans la Roadmap + attention au format de la colonne (standard et non date)
                            'commentairedqi' => $value->commentairedqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'commentairedpe' => $value->commentairedpe, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'commentaire' => $value->commentaire,
                            'perimetredqi' => $value->perimetredqi
                          ];
    				}

            //Alimentation de la base de données seulement s'il y a des données trouvées
    				if(!empty($insert)){

              for($i = 0; $i < sizeof($insert);$i++)
              {
                //try{
                  //Enregistrement des domaines --> création si n'existe pas seulement
                  $domaine = Domaine::firstOrNew(['libelle' => $insert[$i]['domaine']]);
                  $domaine->save();
                  //$domaineapp = Domaine::where('libelle', $insert[$i]['domaine'])->first(); //Pour récupération de l'ID du domaine associé

                  //Enregistrement des applications --> création si n'existe pas seulement
                  $application = Application::firstOrNew(['libelle' => $insert[$i]['application']],['domaine_id' => $domaine->id]);
                  $application->save();

                  $version = new Version;
                  $version->application_id = $application->id; //Import de l'application. Le domaine est lié dans le modèle à l'application
                  $version->perimetreqi = true; //A implémenter
                  $version->libelle = $insert[$i]['sujet']; //Correspond à la valeur sujet dans le tableau

                  if($insert[$i]['versionmoe'] == ''){
                    $version->version = 'Non connu';
                  }
                  else{
                    $version->version = $insert[$i]['versionmoe'];
                  }
                  $version->version_dimensions = $insert[$i]['versiondimensions'];
                  $version->product_dimensions = $insert[$i]['productdimensions'];

                  if($insert[$i]['iteration'] == ''){
                    $version->inc_nblivtma = 0;
                  }
                  else{
                    $version->inc_nblivtma = $insert[$i]['iteration'];
                  }

                  $version->referencealfa = $insert[$i]['reference']; //Référence DQMP ALFA

                  //Référence date ALFA
                  if($insert[$i]['date'] != ''){
                    $version->alfadate = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['date'])->format('d/m/Y');
                  }

                  //Si l'enjeux métier n'est pas renseigné, on attribut la note la plus basse
                  if ($insert[$i]['enjeuxmetier'] == ''){
                    $version->enjeuxmetier = 1;
                  }
                  else{
                    $version->enjeuxmetier = $insert[$i]['enjeuxmetier'];
                  }

                  //Si l'enjeux SI n'est pas renseigné, on attribut la note la plus basse
                  if ($insert[$i]['enjeuxsi'] == ''){
                    $version->enjeuxsi = 1;
                  }
                  else{
                    $version->enjeuxsi = $insert[$i]['enjeuxsi'];
                  }

                  //Si le QOS n'est pas renseigné, on attribut la note la plus basse
                  if ($insert[$i]['qos'] == ''){
                    $version->qos = 1;
                  }
                  else{
                    $version->qos = $insert[$i]['qos'];
                  }

                  //Création du référent QI sans prénom si inexistant puis référencement dans la version en cours
                  if ($insert[$i]['referentqi'] == ''){
                    $version->referentqi_id = '1'; //Non renseigné
                  }
                  else{
                    $referentqi = Referentqi::firstOrNew(['nom' => $insert[$i]['referentqi']], ['prenom' => '']);
                    $referentqi->save();
                    $version->referentqi_id = $referentqi->id;
                  }

                  //Création de l'état de version si inexistant puis référencement dans la version en cours
                  if ($insert[$i]['activiteqi'] == '' ){
                    $version->versionetat_id = '1';
                  }
                  else{
                    $versionetat = VersionEtat::firstOrNew(['libelle' => $insert[$i]['activiteqi']]);
                    $versionetat->save();
                    $version->versionetat_id = $versionetat->id;
                  }

                  $version->avancementqi = ((int)$insert[$i]['avancementqi'] * 100);
                  $version->alerteqi = $insert[$i]['commentairedqi'];

                  $version->prd_versiondimensions = $insert[$i]['versiondimensionslivree'];

                  $version->prp_estimationcharge = $insert[$i]['estimationchargeprp'];
                  $version->prd_estimationcharge = $insert[$i]['estimationchargeprd'];
                  $version->prd_nbreports = $insert[$i]['nbreportmep'];

                  //Création du référent PRD sans prénom si inexistant puis référencement dans la version en cours
                  if ($insert[$i]['referentprd'] == ''){
                    $version->referentprd_id = '1'; //Non renseigné
                  }
                  else{
                    $referentprd = Referentprd::firstOrNew(['nom' => $insert[$i]['referentprd']], ['prenom' => '']);
                    $referentprd->save();
                    $version->referentprd_id = $referentprd->id;
                  }

                  $version->alerteprd = $insert[$i]['commentairedpe'];

                  $version->commentaire = $insert[$i]['commentaire'];

                  if ($insert[$i]['perimetredqi'] == 'Oui'){
                    $version->perimetreqi = true;
                  }
                  else {
                    $version->perimetreqi = false;
                  }

                  //Enregistrement de la version seulement et seulement si le sujet n'est pas vide
                  if($insert[$i]['sujet'] != '' ){

                    $version->save();

                    //Lors de la création d'une version, on ajoute la date de démarrage QI prévisionnelle
                    $tache = new Tache;
                    $tache->libelle = 'Date de démarrage QI prévisionnelle';
                    $tache->tachetype_id = 2;
                    $tache->version_id = $version->id;
                    if($insert[$i]['dateprevdemqi'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['dateprevdemqi'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute la date de démarrage QI réelle
                    $tache = new Tache;
                    $tache->libelle = 'Date de démarrage QI réelle';
                    $tache->tachetype_id = 2;
                    $tache->version_id = $version->id;
                    if($insert[$i]['datereelledemqi'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['datereelledemqi'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute la date d'acheminement PROD prévisionnelle
                    $tache = new Tache;
                    $tache->libelle = 'Date acheminement PROD prévisionnelle';
                    $tache->tachetype_id = 5;
                    $tache->version_id = $version->id;
                    if($insert[$i]['prpdateprev'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prpdateprev'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute la date d'acheminement PROD réelle
                    $tache = new Tache;
                    $tache->libelle = 'Date acheminement PROD réelle';
                    $tache->tachetype_id = 5;
                    $tache->version_id = $version->id;
                    if($insert[$i]['prpdatereelle'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prpdatereelle'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute la phase de pré-production
                    $tache = new Tache;
                    $tache->libelle = 'Pré-production';
                    $tache->tachetype_id = 6;
                    $tache->version_id = $version->id;
                    if($insert[$i]['prpdebut'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prpdebut'])->format('d/m/Y');
                    }
                    if($insert[$i]['prpfin'] != ''){
                      $tache->fin = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prpfin'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    $tache->jalon = false; //c'est une tâche, pas un jalon
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute une date de MEP présionnelle non supprimable avec date du jour par défaut
                    $tache = new Tache;
                    $tache->libelle = 'Date prévisionnelle de MES';
                    $tache->tachetype_id = 7;
                    $tache->version_id = $version->id;
                    if($insert[$i]['prddateprev'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prddateprev'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                    //Lors de la création d'une version, on ajoute une date de MEP réelle non supprimable avec date du jour par défaut
                    $tache = new Tache;
                    $tache->libelle = 'Date réelle de MES';
                    $tache->tachetype_id = 7;
                    $tache->version_id = $version->id;
                    if($insert[$i]['prddatereelle'] != ''){
                      $tache->debut = Carbon::createFromFormat('Y-m-d h:i:s', $insert[$i]['prddatereelle'])->format('d/m/Y');
                    }
                    $tache->deletable = false;
                    //Sauvegarde de la tâche
                    $tache->save();

                  }



                 /*}
                 catch (\Illuminate\Database\QueryException $e){
                   //Voir comment gérer l'exception et si besoin réél
                 }*/
              }
            }

    			}
    		}

    return redirect()->route('version.index')->withOk("Import de la Roadmap terminé avec succès");
  }
}
