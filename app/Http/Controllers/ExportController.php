<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Version;

class ExportController extends Controller
{

    public function index()
    {
        return view('export.index');
    }

    public function export()
    {

    	$filename = "portail_piam-export-test.xls";

    	Excel::create($filename, function($excel) {

    		// Set the title
    		$excel->setTitle('Export portail PIAM');


        	$versions = Version::all();

			//initialisation du tableau contenant les versions
			$versionsArray = []; 
			//initialisation des en-têtes
			$versionsArray[] = ['id', 'version', 'libellé', 'application_id', 'referentqi_id'];

			//Bascule sous forme de type array()
    		foreach ($versions as $version) {
        		$versionsArray[] = $version->toArray();
    		}

    		//Construction de la feuille "Export portail PIAM" avec la liste des versions
        	$excel->sheet('Export portail PIAM', function($sheet) use ($versionsArray) {
            	$sheet->fromArray($versionsArray, null, 'A1', false, false);
        	});


		})->export('xlsx');

    	//Par défaut --> à améliorer pour la gestion des erreurs
        return redirect()->route('export.index')->withOk("L'export Excel a été réalisé avec succès");
    }


}
