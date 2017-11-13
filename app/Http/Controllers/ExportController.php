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

            $versionsArray[] = [
                ''
            ];


			//initialisation des en-têtes
			$versionsArray[] = [
                'Domaine', 
                'Application', 
                'Date de dernière modification',
                'Périmètre QI',

                'Sujet',

                'Version MOE', 
                'Version Dimensions',
                'Product Dimensions',
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

                    Version::perimetreqitostring($version->perimetreqi),

                    $version->libelle, 

                    $version->version,
                    $version->version_dimensions,
                    $version->product_dimensions,
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

                //Mise en forme de l'entête des colonnes --> deuxième ligne
                $sheet->row(2, function($row) {
                    //Fond en gris
                    $row->setBackground('#CCCCCC');
                    //Police de caractère, gras et taille
                    $row->setFontWeight('bold');
                    $row->setFontSize(11);
                    $row->setFontFamily('Calibri');
                    $row->setValignment('center');

                });

                //AJout libelle "Chantier"
                $sheet->cell('E1', function($cell) {
                    $cell->setValue('Chantier');
                });

                //Ajout libelle "Version"
                $sheet->cell('F1', function($cell) {
                    $cell->setValue('Version');
                    
                });
                $sheet->mergeCells('F1:I1');
                $sheet->cells('F1:I1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "ALFA/Demande"
                $sheet->cell('J1', function($cell) {
                    $cell->setValue('ALFA/Demande');
                    
                });
                $sheet->mergeCells('J1:K1');
                $sheet->cells('J1:K1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Scoring QoS"
                $sheet->cell('L1', function($cell) {
                    $cell->setValue('Scoring QoS');
                    
                });
                $sheet->mergeCells('L1:N1');
                $sheet->cells('L1:N1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Pilotage QI"
                $sheet->cell('O1', function($cell) {
                    $cell->setValue('Pilotage QI');
                });

                //Ajout libelle "Démarrage travaux QI"
                $sheet->cell('P1', function($cell) {
                    $cell->setValue('Démarrage travaux QI');
                    
                });
                $sheet->mergeCells('P1:Q1');
                $sheet->cells('P1:Q1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Statut"
                $sheet->cell('R1', function($cell) {
                    $cell->setValue('Statut');
                    
                });
                $sheet->mergeCells('R1:S1');
                $sheet->cells('R1:S1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Acheminement PROD"
                $sheet->cell('T1', function($cell) {
                    $cell->setValue('Acheminement PROD');
                    
                });
                $sheet->mergeCells('T1:V1');
                $sheet->cells('T1:V1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Préproduction"
                $sheet->cell('W1', function($cell) {
                    $cell->setValue('Préproduction');
                    
                });
                $sheet->mergeCells('W1:Y1');
                $sheet->cells('W1:Y1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Production"
                $sheet->cell('Z1', function($cell) {
                    $cell->setValue('Production');
                    
                });
                $sheet->mergeCells('Z1:AC1');
                $sheet->cells('Z1:AC1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Pilotage DPE"
                $sheet->cell('AD1', function($cell) {
                    $cell->setValue('Pilotage DPE');
                });

                //Ajout libelle "Alerte/Vigilance"
                $sheet->cell('AE1', function($cell) {
                    $cell->setValue('Alerte/Vigilance');
                });
                $sheet->mergeCells('AE1:AF1');
                $sheet->cells('AE1:AF1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Livrables"
                $sheet->cell('AG1', function($cell) {
                    $cell->setValue('Livrables');
                });
                $sheet->mergeCells('AG1:AH1');
                $sheet->cells('AG1:AH1', function($cells) {
                    $cells->setAlignment('center');
                });

                //Ajout libelle "Divers"
                $sheet->cell('AI1', function($cell) {
                    $cell->setValue('Divers');
                });


                //Hauteur de la ligne d'en-tête
                $sheet->setHeight(2, 40);

        	});


		})->export('xlsx');

    	//Par défaut OK --> à améliorer pour la gestion des erreurs
        return redirect()->route('version.index')->withOk("L'export Excel a été réalisé avec succès");
    }
}
