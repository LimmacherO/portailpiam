<?php

namespace App\Http\Controllers;

//import des classes externes
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Version;

/*
 * Class ExportController: actions d'exports (Excel, etc.)
 * @Author: Romain Jedynak
 */
class ExportController extends Controller
{

    /*
     * Fonction index()
     * Retour la vue de paramétrage des exports
     * /!\ La vue n'est pas opérationnelle
     */
    public function index()
    {
        return view('export.index');
    }

    /*
     * Fonction exporttoexcel()
     * Permet un export des Versions sous forme de tableau Excel
     */
    public function exporttoexcel()
    {

        //Nom du fichier en sortie
        //Actuellement en dur mais à mettre en variable dans la future vue
    	$filename = "DQI-PIAM-ROADMAPDSI.xls";

        //Instructions pour préparation et mise en page du document Excel
    	Excel::create($filename, function($excel) {

    		//Titre du document et divers
    		$excel->setTitle('Roadmap DSI - DQI/PIAM');
            $excel->setCreator('DQI PIAM');
            $excel->setCompany('RSI DQI PIAM');

            //Récupération de toutes les versions déclarées
        	//$versions = Version::all();
            //$versions = DB::table('')->select('name', 'email as user_email')->get();
            $versions = Version::select('id', 'version', 'libelle')
                                ->get();

			//initialisation du tableau contenant les versions
			$versionsArray = []; 
			//initialisation des en-têtes
			$versionsArray[] = ['id', 'version', 'libellé'];



			//Bascule sous forme de type array()
    		foreach ($versions as $version) {
        		$versionsArray[] = $version->toArray();
    		}

    		//Construction de la feuille "Export portail PIAM" avec la liste des versions
        	$excel->sheet('Export portail PIAM', function($sheet) use ($versionsArray) {
            	$sheet->fromArray($versionsArray, null, 'A1', false, false);

                //Mise en forme de l'entête des colonnes
                $sheet->row(1, function($row) {
                    //Fond en gris
                    $row->setBackground('#CCCCCC');
                    //Police de caractère, gras et taille
                    $row->setFontWeight('bold');
                    $row->setFontSize(12);
                    $row->setFontFamily('Calibri');

                });

        	});


		})->export('xlsx');

    	//Par défaut OK --> à améliorer pour la gestion des erreurs
        return redirect()->route('version.index')->withOk("L'export Excel a été réalisé avec succès");
    }
}
