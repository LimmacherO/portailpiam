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
                            'iteration' => $value->iteration,
                            'productdimensions' => $value->productdimensions,
                            'versiondimensions' => $value->versiondimensions,
                            'reference' => $value->reference, //Référence DQMP ALFA
                            'date' => $value->date, //Date de la DQMP ALFA
                            'activiteqi' => $value->activiteqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'avancementqi' => $value->avancementqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'estimationchargeprp' => $value->estimationchargeprp, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'estimationchargeprd' => $value->estimationchargeprd, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'nbreportmep' => $value->nbreportmep, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'referentprd' => $value->referentprd, //Pré-requis --> Colonne à renommer dans la Roadmap + attention au format de la colonne (standard et non date)
                            'commentairedqi' => $value->commentairedqi, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'commentairedpe' => $value->commentairedpe, //Pré-requis --> Colonne à renommer dans la Roadmap
                            'commentaire' => $value->commentaire
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
                  //$version->libelle = $insert[$i]['avancementqi'] * 100;
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
                  $version->referencealfa_date = $insert[$i]['date']; //Référence date ALFA

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

                  $version->avancementqi = (int)$insert[$i]['avancementqi'] * 100;
                  $version->alerteqi = $insert[$i]['commentairedqi'];

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

                  //Enregistrement de la version seulement et seulement si le sujet n'est pas vide
                  if($insert[$i]['sujet'] != '' ){
                    $version->save();
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
