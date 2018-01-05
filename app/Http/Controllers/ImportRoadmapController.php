<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Domaine;

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

            //Code à modifier /!\ pour import des données
            foreach ($data as $key => $value) {
    					$insert[] = ['libelle' => $value->domaine];
    				}

    				if(!empty($insert)){
              try{
    					       DB::table('domaine')->insert($insert);
    					       dd('Insertion domaine réalisé avec succès');
               }
               catch (\Illuminate\Database\QueryException $e)
               {
                 //rien à faire pour le moment
               }
    				}

    			}
    		}

    return redirect()->route('version.index')->withOk("Import de la Roadmap terminé avec succès");
  }
}
