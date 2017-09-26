<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Log;

class ImportRoadmapToExcelController extends Controller
{
  	public function index()
    {

		$data = \Excel::load('c:\Laragon\Roadmap.xlsx')->get();

		Log::info('Ceci est un test');

    	//Par défaut --> à améliorer pour la gestion des erreurs
        return redirect()->route('version.index')->withOk("Import de la Roadmap terminé:" . $data->count());	
    }
}
