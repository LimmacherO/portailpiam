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

    public $cellbackgroungcolor;


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
    	$filename = "DQI-PIAM-ROADMAPDSI";

      //Instructions pour préparation et mise en page du document Excel
    	Excel::create($filename, function($excel) {

    	//Titre du document et divers
    	$excel->setTitle('Roadmap DSI - DQI/PIAM');
      $excel->setCreator('DQI PIAM');
      $excel->setCompany('RSI DQI PIAM');

      //Récupération de toutes les versions déclarées
      $versions = Version::orderBy('application_id', 'asc')->get();

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

                'Commentaire'
                ];



			//Bascule sous forme de type array()
    		foreach ($versions as $version) {
                $versionsArray[] = array(
                    $version->application->domaine->libelle,
                    $version->application->libelle,
                    \Carbon\Carbon::parse($version->updated_at)->format('d/m/Y'),

                    Version::perimetreqitostring($version->perimetreqi),

                    $version->libelle,

                    $version->version,
                    $version->version_dimensions,
                    $version->product_dimensions,

                    //Nombre de livraisons TMA
                    $version->inc_nblivtma,

                    $version->referencealfa,
                    $version->alfadate,

                    $version->enjeuxmetier,
                    $version->enjeuxsi,
                    $version->qos,

                    $version->referentqi->prenom . ' ' . $version->referentqi->nom,
                    Version::getDateJalonByString($version, '2', 'Date de démarrage QI prévisionnelle'), //Date de démarrage prévisionnelle QI
                    Version::getDateJalonByString($version, '2', 'Date de démarrage QI réelle'), //Date de démarrage réelle QI

                    $version->versionetat->libelle,
                    $version->avancementqi,

                    Version::getDateJalonByString($version, '5', 'Date acheminement PROD prévisionnelle'), //Date d'acheminement PRD prévisionnelle
                    $version->prd_versiondimensions,
                    Version::getDateJalonByString($version, '5', 'Date acheminement PROD réelle'), //Date d'acheminement PRD réelle

                    Version::getDateTacheByString($version, '6', 'Pré-production', 'debut'), //Date de démarrage de la pré-production
                    Version::getDateTacheByString($version, '6', 'Pré-production', 'fin'), //Date de fin de la pré-production
                    $version->prp_estimationcharge,

                    Version::getDateJalonByString($version, '7', 'Date prévisionnelle de MES'), //Date prévisionnelle de MES
                    Version::getDateJalonByString($version, '7', 'Date réelle de MES'), //Date réelle de MES
                    $version->prd_estimationcharge,
                    $version->prd_nbreports,

                    $version->referentprd->prenom . ' ' . $version->referentprd->nom,

                    $version->alerteqi,
                    $version->alerteprd,

                    $version->commentaire,

                    $version->application->domaine->export_color, //Champ provisoire, sera à supprimer
                );
    		}

    		//Construction de la feuille "Export portail PIAM" avec la liste des versions
        	$excel->sheet('Export portail PIAM', function($sheet) use ($versionsArray) {

            	$sheet->fromArray($versionsArray, null, 'A1', true, false);
              // *Note: la 4eme argument à true permet d'afficher les valeurs '0' au lieu d'une cellule vide

                //Mise en forme de l'entête des colonnes --> deuxième ligne
                $sheet->cells('A2:AG2', function($cells) {
                    //Fond en gris
                    $cells->setBackground('#B3C6E7');
                    //Police de caractère, gras et taille
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setValignment('center');
                });

                //Bordure de l'en-tête du document  --> deuxième ligne
                $sheet->setBorder('A2:AG2', 'thin');

                //Couleur de fond spécifique pour les informations de production
                $sheet->cells('W2:Y2', function($cells) {
                    $cells->setBackground('#ED7D31');
                });
                $sheet->cells('AA2:AD2', function($cells) {
                    $cells->setBackground('#ED7D31');
                });
                $sheet->cell('AF2', function($cell) {
                    $cell->setBackground('#ED7D31');
                });

                //AJout libelle "Chantier"
                $sheet->cell('E1', function($cell) {
                    $cell->setValue('Chantier');
                    $cell->setBackground('#1f4e78');
                    $cell->setFontColor('#FFFFFF');
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(11);
                    $cell->setValignment('center');
                });

                //Ajout libelle "Version"
                $sheet->cell('F1', function($cell) {
                    $cell->setValue('Version');

                });
                $sheet->mergeCells('F1:I1');
                $sheet->cells('F1:I1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setValignment('center');
                });

                //Ajout libelle "ALFA/Demande"
                $sheet->cell('J1', function($cell) {
                    $cell->setValue('ALFA/Demande');

                });
                $sheet->mergeCells('J1:K1');
                $sheet->cells('J1:K1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setValignment('center');
                });

                //Ajout libelle "Scoring QoS"
                $sheet->cell('L1', function($cell) {
                    $cell->setValue('Scoring QoS');

                });
                $sheet->mergeCells('L1:N1');
                $sheet->cells('L1:N1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Pilotage QI"
                $sheet->cell('O1', function($cell) {
                    $cell->setValue('Pilotage QI');
                    $cell->setBackground('#1f4e78');
                    $cell->setFontColor('#FFFFFF');
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(11);
                    $cell->setValignment('center');
                });

                //Ajout libelle "Démarrage travaux QI"
                $sheet->cell('P1', function($cell) {
                    $cell->setValue('Démarrage travaux QI');

                });
                $sheet->mergeCells('P1:Q1');
                $sheet->cells('P1:Q1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Statut"
                $sheet->cell('R1', function($cell) {
                    $cell->setValue('Statut');

                });
                $sheet->mergeCells('R1:S1');
                $sheet->cells('R1:S1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Acheminement PROD"
                $sheet->cell('T1', function($cell) {
                    $cell->setValue('Acheminement PROD');

                });
                $sheet->mergeCells('T1:V1');
                $sheet->cells('T1:V1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Préproduction"
                $sheet->cell('W1', function($cell) {
                    $cell->setValue('Préproduction');

                });
                $sheet->mergeCells('W1:Y1');
                $sheet->cells('W1:Y1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Production"
                $sheet->cell('Z1', function($cell) {
                    $cell->setValue('Production');

                });
                $sheet->mergeCells('Z1:AC1');
                $sheet->cells('Z1:AC1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Pilotage DPE"
                $sheet->cell('AD1', function($cell) {
                    $cell->setValue('Pilotage DPE');
                    $cell->setBackground('#1f4e78');
                    $cell->setFontColor('#FFFFFF');
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(11);
                    $cell->setValignment('center');
                });

                //Ajout libelle "Alerte/Vigilance"
                $sheet->cell('AE1', function($cell) {
                    $cell->setValue('Alerte/Vigilance');
                });
                $sheet->mergeCells('AE1:AF1');
                $sheet->cells('AE1:AF1', function($cells) {
                    $cells->setBackground('#1f4e78');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                    $cells->setFontSize(11);
                    $cells->setFontFamily('Calibri');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                //Ajout libelle "Divers"
                $sheet->cell('AG1', function($cell) {
                    $cell->setValue('Divers');
                    $cell->setBackground('#1f4e78');
                    $cell->setFontColor('#FFFFFF');
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(11);
                    $cell->setValignment('center');
                });

                //Hauteur de la ligne d'en-tête
                $sheet->setHeight(2, 40);

                //Mise en forme - centrage des cellules par défaut (majorité des cellules)
                $sheet->cells('A2:AG' . sizeof($versionsArray), function($cells) {
                    $cells->setAlignment('center');
                });
                //Exception: les chantiers sont mis en forme à gauche
                $sheet->cells('E2:E' . sizeof($versionsArray), function($cells) {
                    $cells->setAlignment('left');
                });
                //Exception: les commentaires sont mis en forme à gauche
                $sheet->cells('AG2:AG' . sizeof($versionsArray), function($cells) {
                    $cells->setAlignment('left');
                });

                //Ajout des bordures pour les cellules
                $sheet->setBorder('A2:AG' . sizeof($versionsArray), 'thin');

                //Grisement du chantiers si annulé ou clos et QoS
                $max = sizeof($versionsArray);
                $cellcount = 2; //démarrage à 2 compte tenu de la taille du tableau
                for($i = 2; $i < $max;$i++)
                {

                  //QoS
                  $cellcible = 'N' . ($cellcount + 1);
                  if($versionsArray[$cellcount][13] == "9"){
                    $sheet->cell($cellcible, function($cell) {
                      $cell->setBackground('#C10004');
                      $cell->setFontColor('#FFFFFF');
                      $cell->setFontWeight('bold');
                    });

                  }
                  elseif ($versionsArray[$cellcount][13] == "5"){
                    $sheet->cell($cellcible, function($cell) {
                      $cell->setBackground('#C8580E');
                      $cell->setFontColor('#FFFFFF');
                      $cell->setFontWeight('bold');
                    });
                  }
                  else{
                    $sheet->cell($cellcible, function($cell) {
                      $cell->setBackground('#548134');
                      $cell->setFontColor('#FFFFFF');
                      $cell->setFontWeight('bold');
                    });
                  }

                  //Grisement de la ligne si chantier clos ou annulé
                  if($versionsArray[$cellcount][17] == "Clos" OR $versionsArray[$cellcount][17] == "Annulée"){
                    $cellcount++;
                    $cellcible = 'A' . $cellcount . ':AG' . $cellcount;
                    $sheet->cells($cellcible, function($cells) {
                        $cells->setBackground('#757170');
                        $cells->setFontColor('#000000');
                    });
                  }
                  else{
                    $cellbackgroungcolor = $versionsArray[$cellcount][33];
                    $cellcount++; //Si pas trouvé alors incrémentation du compteur uniquement
                    $cellcible = 'A' . $cellcount . ':AG' . $cellcount;

                    $sheet->cells($cellcible, function($cells) use($cellbackgroungcolor){
                        $cells->setBackground($cellbackgroungcolor);
                        $cells->setFontColor('#000000');
                    });
                  }

                }
        	});


		})->export('xlsx');

    	//Par défaut OK --> à améliorer pour la gestion des erreurs
        return redirect()->route('version.index')->withOk("L'export Excel a été réalisé avec succès");
    }
}
