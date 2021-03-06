<?php

namespace App\Http\Controllers;

//immport des classes utilisées
use Illuminate\Http\Request;
use App\Http\Requests\VersionCreateRequest;
use App\Http\Requests\VersionUpdateRequest;
use App\Repositories\VersionRepository;
use App\Version;
use App\Application;
use App\Referentqi;
use App\Referentprd;
use App\Tache;
use App\VersionEtat;

use Illuminate\Support\Facades\Input;

/*
 * Classe VersionController
 *  Contient les méthodes/fonctions utilisés pour gérer les versions
 */
class VersionController extends Controller
{

    protected $versionRepository;

    //Nombre de chantiers affichés sur la page d'index --> pagination
    protected $nbrPerPage = 10;

    /*
     * Fonction __construct()
     *  Contruction/initialisation du controller
     */
    public function __construct(VersionRepository $versionRepository)
    {
        $this->versionRepository = $versionRepository;
        session(['recherche_pagination' => 'Tous']);//Valeur par défaut
        session(['recherche_referentqi' => '0']);//Valeur par défaut 'Tous les référents'
    }

    /*
    * Fonction index()
    *   Prépare et retourne la vue listant les versions. Peut être filtrée /!\
    */
    public function index()
    {
        //Récupération de la dernière recherche effectuée
        $query_search = session('recherche_chantier');

        //Récuparation de la valeur de pagination
        $paginationselect = session('recherche_pagination');
        //Affectation pour la liste déroulante sur la vue
        if($paginationselect == 'Tous'){
            $this->nbrPerPage = '500'; //Valeur assez grande pour démarrer
            //Idée évolution: voir pour récupérer le nombre max de résultats pour être au plus juste
        }
        else{
          $this->nbrPerPage = $paginationselect;
        }

        //Récupération de la valeur du référentQI pour filtrage
        $referentqisselect = session('recherche_referentqi');

        if ($referentqisselect == '0'){
          $versions = Version::filter(0)->paginate($this->nbrPerPage);
        }
        else{
          $referentqi_id = Referentqi::where('nom', $referentqisselect)->first();
          $versions = Version::filter($referentqi_id->id)->paginate($this->nbrPerPage);
        }

        //Récupération de la liste des référents QI et mise en forme
        $referentqis = Referentqi::orderBy('nom')->pluck('nom', 'nom');
        $referentqis_array = $referentqis->toArray();
        array_unshift($referentqis_array, 'Tous les référents'); //Ajout de la valeur par  en tête de liste (toute la liste)

        //Renvoi vers la vue index des chantiers
        return view('version.index', compact('versions', 'query_search', 'paginationselect', 'referentqis_array', 'referentqisselect'));
    }

    /*
    * Fonction search()
    * Permet de mettre à jour les valeurs de recherche et de pagination en session
    */
    public function search(){
        //Sauvegarde en session de la valeur de recherche
        session(['recherche_chantier' => Input::get('search')]);

        //Sauvegarde en session de la valeur de pagination
        session(['recherche_pagination' => Input::get('paginationselect')]);

        //Sauvegarde en session de la valeur du référent QI
        session(['recherche_referentqi' => Input::get('referentqisselect')]);

        //redirection vers la route index() des chantiers
        return redirect()->route('version.index',  compact('version'));
    }

    /*
     * Fonction create()
     *  Prépare et retourne la vue de création d'une version
     */
    public function create()
    {

        //Alimentation des listes déroulantes
        $applications = Application::orderBy('libelle')->pluck('libelle', 'id');
        $referentqis = Referentqi::orderBy('nom')->pluck('nom', 'id');
        $referentprds = Referentprd::orderBy('nom')->pluck('nom', 'id');
        $versionetats = VersionEtat::orderBy('id')->pluck('libelle', 'id');

        return view('version.create', compact('applications', 'referentqis', 'referentprds', 'versionetats'));
    }

    /*
     * Fonction store()
     *  Enregistrement de la version en base de données lors de la création
     */
    public function store(VersionCreateRequest $request)
    {
        $version = $this->versionRepository->store($request->all());

        //Lors de la création d'une version, on ajoute la date de démarrage QI prévisionnelle
        $tache = new Tache;
        $tache->libelle = 'Date de démarrage QI prévisionnelle';
        $tache->tachetype_id = 2;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 1;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute la date de démarrage QI réelle
        $tache = new Tache;
        $tache->libelle = 'Date de démarrage QI réelle';
        $tache->tachetype_id = 2;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 2;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute la date d'acheminement PROD prévisionnelle
        $tache = new Tache;
        $tache->libelle = 'Date acheminement PROD prévisionnelle';
        $tache->tachetype_id = 5;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 3;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute la date d'acheminement PROD réelle
        $tache = new Tache;
        $tache->libelle = 'Date acheminement PROD réelle';
        $tache->tachetype_id = 5;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 4;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute la phase de pré-production
        $tache = new Tache;
        $tache->libelle = 'Pré-production';
        $tache->tachetype_id = 6;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->jalon = false; //c'est une tâche, pas un jalon
        $tache->num_order = 5;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute une date de MEP présionnelle non supprimable avec date du jour par défaut
        $tache = new Tache;
        $tache->libelle = 'Date prévisionnelle de MES';
        $tache->tachetype_id = 7;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 6;
        //Sauvegarde de la tâche
        $tache->save();

        //Lors de la création d'une version, on ajoute une date de MEP réelle non supprimable avec date du jour par défaut
        $tache = new Tache;
        $tache->libelle = 'Date réelle de MES';
        $tache->tachetype_id = 7;
        $tache->version_id = $version->id;
        $tache->deletable = false;
        $tache->num_order = 7;
        //Sauvegarde de la tâche
        $tache->save();


        //Mise à jour du QoS
        $query_qos_enjeuxmetiers = Input::get ('enjeuxmetier');
        $query_qos_enjeuxsi = Input::get ('enjeuxsi');
        $version->qos = (int) Version::calculQos($query_qos_enjeuxmetiers,$query_qos_enjeuxsi);
        $version->save();

        return redirect()->route('version.show',  compact('version'))->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été créé avec succès");
    }

    /*
     * Fonction show()
     *  Fonction permettant de préparer la vue de présentation des détails d'une version
     */
    public function show(Version $version)
    {

        return view ('version.show', compact('version'));
    }

    /*
     * Fonction edit()
     *  Préparation de la vue pour modification d'une version
     */
    public function edit(Version $version)
    {

        //Alimentation des listes déroulantes
        $applications = Application::orderBy('libelle')->pluck('libelle', 'id');
        $referentqis = Referentqi::orderBy('nom')->pluck('nom', 'id');
        $referentprds = Referentprd::orderBy('nom')->pluck('nom', 'id');
        $versionetats = VersionEtat::orderBy('id')->pluck('libelle', 'id');

        return view('version.edit', compact('version','applications', 'referentqis', 'referentprds', 'versionetats'));
    }

    /*
     * Fonction update()
     *  Mise à jour des modifications apportées sur une version en base de données
     */
    public function update(VersionUpdateRequest $request, Version $version)
    {
        $this->versionRepository->update($version, $request->all());

        //Mise à jour du QoS
        $query_qos_enjeuxmetiers = Input::get ('enjeuxmetier');
        $query_qos_enjeuxsi = Input::get ('enjeuxsi');
        $version->qos = (int) Version::calculQos($query_qos_enjeuxmetiers,$query_qos_enjeuxsi);
        $version->save();

        return redirect()->route('version.show', compact('version'))->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été modifiée avec succès");
    }

    /*
     * Fonction destroy()
     *  Suppression d'une version en base de données
     */
    public function destroy(Version $version)
    {
        $this->versionRepository->destroy($version);

        return redirect()->route('version.index')->withOk("La version " . $version->application->libelle . "&nbsp;" . $version->version . " a été supprimée avec succès");
    }

}
