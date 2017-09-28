<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VersionCreateRequest;
use App\Http\Requests\VersionUpdateRequest;
use App\Repositories\VersionRepository;
use App\Version;
use App\Application;
use App\Referentqi;
use App\Referentprd;

use Illuminate\Support\Facades\Input;

use Yajra\Datatables\Datatables;

class VersionController extends Controller
{
    
    protected $versionRepository;
    protected $nbrPerPage = 10;

    public function __construct(VersionRepository $versionRepository)
    {
        $this->versionRepository = $versionRepository;
    }

    public function index()
    {
        $query_search = Input::get ('search');
        $versions = Version::filter(Input::all(), $this->nbrPerPage)->get();
        return view('version.index', compact('versions', 'query_search'));
    }

    public function create()
    {
        
        $applications = Application::pluck('libelle', 'id');
        $referentqis = Referentqi::pluck('nom', 'id');
        $referentprds = Referentprd::pluck('nom', 'id');

        return view('version.create', compact('applications', 'referentqis', 'referentprds'));
    }


    public function store(VersionCreateRequest $request)
    {
        $version = $this->versionRepository->store($request->all());

        return redirect()->route('version.show',  compact('version'))->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été créé avec succès");
    }

    public function show(Version $version)
    {

        $select = 'label as label, DATE_FORMAT(start, \'%Y-%m-%d\') as start, DATE_FORMAT(end, \'%Y-%m-%d\') as end';

        $taches = \App\Tache::select(\Illuminate\Support\Facades\DB::raw($select))
                ->orderBy('start', 'asc')
                ->orderBy('end', 'asc')
                ->get();

        return view ('version.show', compact('version'));
    }

    public function edit(Version $version)
    {

        $applications = Application::pluck('libelle', 'id');
        $referentqis = Referentqi::pluck('nom', 'id');
        $referentprds = Referentprd::pluck('nom', 'id');

        return view('version.edit', compact('version','applications', 'referentqis', 'referentprds'));
    }

    public function update(VersionUpdateRequest $request, Version $version)
    {
        $this->versionRepository->update($version, $request->all());

        //return redirect()->route('version.index')->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été modifiée avec succès");
        //return view ('show', compact('version'))->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été modifiée avec succès");
        return redirect()->route('version.show', compact('version'))->withOk("La version " . $version->application->libelle . "&nbsp;" . $request->version . " a été modifiée avec succès");

    }

    public function destroy(Version $version)
    {
        $this->versionRepository->destroy($version);

        return redirect()->route('version.index')->withOk("La version " . $version->application->libelle . "&nbsp;" . $version->version . " a été supprimée avec succès");
    }

}
