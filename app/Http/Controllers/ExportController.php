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
        	$versions = Version::all();

			//initialisation du tableau contenant les versions
			$versionsArray = []; 
			//initialisation des en-têtes
			$versionsArray[] = [
                'Domaine', 
                'Application', 
                'Date de dernière modification',
                'Périmètre QI',

                'Sujet',

                'Version Dimensions',
                'Version MOE', 
                'Itération',

                'Référence', 
                'Date',

                'Enjeux Métier',
                'Enjeux SI',
                'QoS',

                'Suivi par',
                'Date prévisionnelle',
                'Date réelle',

                'Activité QI',
                'Avancement QI',

                'Date prévisionnelle',
                'Version Dimensions livrée',
                'Date réelle',


                'Début',
                'Fin',
                'Estimation charge j/h',

                'Date prévisionnelle de MES',
                'Date réelle de MES',
                'Estimation charge j/h',
                'Nb report MEP',
                'Suivi par',

                'Vue DQI', 
                'Vue DPE',

                'Entrée QI',
                'Entrée DPE',

                'Commentaire'
                ];

			//Bascule sous forme de type array()
    		foreach ($versions as $version) {
                $versionsArray[] = array(
                    $version->application->domaine->libelle,
                    $version->application->libelle,
                    'A implémenter',
                    'A implémenter',

                    $version->libelle, 

                    $version->version_dimensions,
                    $version->version,
                    $version->inc_nblivtma, 

                    $version->referencealfa,
                    $version->referencealfa_date,

                    $version->enjeuxmetier,
                    $version->enjeuxsi,
                    $version->qos,

                    $version->referentqi->nom . ' ' . $version->referentqi->prenom,
                    'A implémenter',
                    'A implémenter',

                    $version->versionetat->libelle,
                    $version->avancementqi,

                    'A implémenter',
                    'A implémenter',
                    'A implémenter',

                    'A implémenter',
                    'A implémenter',
                    $version->prp_estimationcharge,

                    'A implémenter',
                    'A implémenter',
                    $version->prd_estimationcharge,
                    $version->prd_nbreports,

                    $version->referentprd->nom . ' ' . $version->referentprd->prenom,

                    $version->alerteqi,
                    $version->alerteprd,

                    'A implémenter',
                    'A implémenter',

                    $version->commentaire
                );
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
                    $row->setFontSize(11);
                    $row->setFontFamily('Calibri');
                    $row->setValignment('center');

                });

                //Hauteur de la ligne d'en-tête
                $sheet->setHeight(1, 40);

        	});


		})->export('xlsx');

    	//Par défaut OK --> à améliorer pour la gestion des erreurs
        return redirect()->route('version.index')->withOk("L'export Excel a été réalisé avec succès");
    }
}
