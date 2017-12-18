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

//use Yajra\Datatables\Datatables;

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
        session(['recherche_pagination' => '10']);
    }

    /*
    * Fonction index()
    *   Prépare et retourne la vue listant les versions. Peut être filtrée /!\
    */
    public function index()
    {
        //Récupération de la dernière recherche effectuée
        $query_search = session('recherche_chantier');
        //$query_search = session('recherche_pagination');

        //Récuparation de la valeur de pagination
        $this->nbrPerPage = session('recherche_pagination');
        $paginationselect = $this->nbrPerPage;

        //Recherche/filtrage de la liste des versions
        $versions = Version::filter('%' . $query_search . '%')->paginate($this->nbrPerPage);

        //Mise à jour de la date de MEP en fonction du planning
        //Rappel: la date de MEP dans la table version est "fictive"
        foreach ($versions as $version){
            $tache = Tache::where('tachetype_id', '7')
                           ->where('version_id', $version->id)
                           ->first();
            $version->date_mep = $tache->debut;
        }

        return view('version.index', compact('versions', 'query_search', 'paginationselect'));
    }

    public function search(){
        //Sauvegarde en session de la valeur de recherche
        session(['recherche_chantier' => Input::get('search')]);

        //Sauvegarde en session de la valeur de pagination
        session(['recherche_pagination' => Input::get('paginationselect')]);

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

        //Lors de la création d'une version, on ajoute une date de MEP non supprimable avec date du jour par défaut
        $tachemep = new Tache;
        $tachemep->libelle = 'Mise en production';
        //$tachemep->debut = \Carbon\Carbon::now();
        //$tachemep->fin = \Carbon\Carbon::now();
        $tachemep->tachetype_id = 7;
        $tachemep->version_id = $version->id;
        $tachemep->deletable = false;
        //Sauvegarde de la tâche
        $tachemep->save();

        //Lors de la création d'une version, on ajoute la date de démarrage QI prévisionnelle
        $tachemep = new Tache;
        $tachemep->libelle = 'Date de démarrage QI prévisionnelle';
        //$tachemep->debut = \Carbon\Carbon::now();
        //$tachemep->fin = \Carbon\Carbon::now();
        $tachemep->tachetype_id = 2;
        $tachemep->version_id = $version->id;
        $tachemep->deletable = false;
        //Sauvegarde de la tâche
        $tachemep->save();

        //Lors de la création d'une version, on ajoute la date de démarrage QI réelle
        $tachemep = new Tache;
        $tachemep->libelle = 'Date de démarrage QI réelle';
        //$tachemep->debut = \Carbon\Carbon::now();
        //$tachemep->fin = \Carbon\Carbon::now();
        $tachemep->tachetype_id = 2;
        $tachemep->version_id = $version->id;
        $tachemep->deletable = false;
        //Sauvegarde de la tâche
        $tachemep->save();



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
