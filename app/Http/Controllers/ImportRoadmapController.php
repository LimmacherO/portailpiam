<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Domaine;
use App\Application;
use App\Version;

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
                            'iteration' => $value->iteration,
                            'productdimensions' => $value->productdimensions,
                            'versiondimensions' => $value->versiondimensions,
                            'reference' => $value->reference, //Référence DQMP ALFA
                            'date' => $value->date, //Date de la DQMP ALFA
                            'avancementqi' => $value->avancementqi //Pré-requis --> Colonne à renommer la Roadmap
                          ];
    				}

            //Alimentation de la base de données seulement s'il y a des données trouvées
    				if(!empty($insert)){

              for($i = 1; $i < sizeof($insert);$i++)
              {
                try{
                  //Enregistrement des domaines --> création si n'existe pas seulement
                  $domaine = Domaine::firstOrNew(['libelle' => $insert[$i]['domaine']]);
                  $domaine->save();;
                  //$domaineapp = Domaine::where('libelle', $insert[$i]['domaine'])->first(); //Pour récupération de l'ID du domaine associé

                  //Enregistrement des applications --> création si n'existe pas seulement
                  $application = Application::firstOrNew(['libelle' => $insert[$i]['application']],['domaine_id' => $domaine->id]);
                  $application->save();

                  $version = new Version;
                  $version->application_id = $application->id; //Import de l'application. Le domaine est lié dans le modèle à l'application
                  $version->perimetreqi = true; //A implémenter
                  $version->libelle = $insert[$i]['sujet']; //Correspond à la valeur sujet dans le tableau
                  $version->version = $insert[$i]['versionmoe'];
                  $version->version_dimensions = $insert[$i]['versiondimensions'];
                  $version->product_dimensions = $insert[$i]['productdimensions'];
                  $version->inc_nblivtma = $insert[$i]['iteration'];
                  $version->referencealfa = $insert[$i]['reference']; //Référence DQMP ALFA
                  $version->referencealfa_date = $insert[$i]['date']; //Référence date ALFA
                  $version->enjeuxmetier = $insert[$i]['enjeuxmetier'];
                  $version->qos = $insert[$i]['qos'];
                  $version->enjeuxsi = $insert[$i]['enjeuxsi'];
                  $version->referentqi_id = '1'; //A implémenter

                  //$version->avancementqi = intval($insert[$i]['avancementqi']) * 100;

                  $version->referentprd_id = '1';
                  $version->versionetat_id = '1';









                  $version->save();

                 }
                 catch (\Illuminate\Database\QueryException $e){
                   //Voir comment gérer l'exception et si besoin réél
                 }
              }
            }

    			}
    		}

    return redirect()->route('version.index')->withOk("Import de la Roadmap terminé avec succès");
  }
}
