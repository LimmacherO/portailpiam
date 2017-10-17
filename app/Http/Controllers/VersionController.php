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

use Illuminate\Support\Facades\Input;

//use Yajra\Datatables\Datatables;

/*
 * Classe VersionController
 *  Contient les méthodes/fonctions utilisés pour gérer les versions
 */
class VersionController extends Controller
{
    
    protected $versionRepository;
    //Filtre pour pagination --> a voir si celà sert!
    protected $nbrPerPage = 10;

    /*
     * Fonction __construct()
     *  Contruction/initialisation du controller
     */
    public function __construct(VersionRepository $versionRepository)
    {
        $this->versionRepository = $versionRepository;
    }

    /*
    * Fonction index()
    *   Prépare et retourne la vue listant les versions. Peut être filtrée /!\
    */
    public function index()
    {
        //Récupération de l'input et filtrage de la recherche
        $query_search = Input::get ('search');
        $versions = Version::filter(Input::all(), $this->nbrPerPage)->get();

        return view('version.index', compact('versions', 'query_search'));
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

        return view('version.create', compact('applications', 'referentqis', 'referentprds'));
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
        $tachemep->label = 'Mise en production';
        $tachemep->start = \Carbon\Carbon::now();
        $tachemep->end = \Carbon\Carbon::now();
        $tachemep->tachetype_id = 7;
        $tachemep->version_id = $version->id;
        $tachemep->deletable = false;
        //Sauvegarde de la tâche
        $tachemep->save();

        //Mise à jour du QoS
        $version->qos = 3;
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

        return view('version.edit', compact('version','applications', 'referentqis', 'referentprds'));
    }

    /*
     * Fonction update()
     *  Mise à jour des modifications apportées sur une version en base de données
     */
    public function update(VersionUpdateRequest $request, Version $version)
    {
        $this->versionRepository->update($version, $request->all());

        //Mise à jour du QoS
        //$version->qos = App\Version::calculQos(1,1);
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
