<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    					$insert[] = ['title' => $value->title, 'description' => $value->description];
    				}
            
    				if(!empty($insert)){
    					DB::table('items')->insert($insert);
    					dd('Insert Record successfully.');
    				}

    			}
    		}

    return redirect()->route('version.index')->withOk("Import de la Roadmap terminé avec succès");
  }
}
