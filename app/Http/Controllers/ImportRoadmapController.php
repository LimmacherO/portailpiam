<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Domaine;
use App\Application;

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
                            'application' => $value->application];
    				}

            //Alimentation de la base de données seulement s'il y a des données trouvées
    				if(!empty($insert)){

              for($i = 1; $i < sizeof($insert);$i++)
              {
                try{
                  //Enregistrement des domaines --> création si n'existe pas seulement
                  $domaine = Domaine::firstOrNew(['libelle' => $insert[$i]['domaine']]);
                  $domaine->save();;

                  //Enregistrement des applications --> création si n'existe pas seulement
                  $domaineapp = Domaine::where('libelle', $insert[$i]['domaine'])->first(); //Récupération de l'ID du domaine associé
                  $application = Application::firstOrNew(['libelle' => $insert[$i]['application']],['domaine_id' => $domaineapp->id]);
                  $application->save();

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
