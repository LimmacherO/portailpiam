<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TacheRepository;
use App\Http\Requests\TacheCreateRequest;
use App\Http\Requests\TacheUpdateRequest;
use App\Tache;
use App\TacheType;
use App\Version;

use Carbon\Carbon;

class TacheController extends Controller
{
	protected $tacheRepository;

    public function __construct(TacheRepository $tacheRepository)
    {
        $this->tacheRepository = $tacheRepository;
    }

    public function index(Version $version)
    {

      $select = 'id as id, libelle as libelle, debut as debut, fin as fin, tachetype_id as tachetype_id, version_id as version_id, deletable as deletable, jalon as jalon';

    	$taches = \App\Tache::select(\Illuminate\Support\Facades\DB::raw($select))
								->orderBy('num_order')
                ->where('version_id', $version->id)
                ->get();

    	return view('tache.index', compact('version', 'taches'));
    }

		/*
		 * Fonction createTache(version)
		 * Permet de préparer la vue de création d'une nouvelle tâche pour une version
		 */
    public function createTache(Version $version)
    {
        $tachetypes = TacheType::pluck('libelle', 'id');
        return view('tache.createtache', compact('version', 'tachetypes'));
    }

		/*
		 * Fonction createJalon(version)
		 * Permet de préparer la vue de création d'un nouveau jalon pour une version
		 */
		public function createJalon(Version $version)
    {
        $tachetypes = TacheType::pluck('libelle', 'id');
        return view('tache.createjalon', compact('version', 'tachetypes'));
    }

		public function editTache(Tache $tache)
    {
        $tachetypes = TacheType::pluck('libelle', 'id');
        return view('tache.edittache', compact('tache', 'tachetypes'));
    }

		public function editJalon(Tache $tache)
		{
				$tachetypes = TacheType::pluck('libelle', 'id');
				return view('tache.editjalon', compact('tache', 'tachetypes'));
		}

    public function store(TacheCreateRequest $request)
    {
        $tache = $this->tacheRepository->store($request->all());

        $version = $tache->version_id;

        return redirect()->route('tache.index', compact('version'))->withOk("La tâche a été créé avec succès");
    }



    public function update(TacheUpdateRequest $request, Tache $tache){

        $this->tacheRepository->update($tache, $request->all());
        $version = $tache->version_id;
				$version_to_update = Version::find($tache->version_id);
				$version_to_update->updated_at = Carbon::now();
				$version_to_update->save();
        return redirect()->route('tache.index', compact('version'))->withOk("La tâche a été modifiée avec succès");
    }

    public function delete(Tache $tache)
    {
        $this->tacheRepository->destroy($tache);

        $version = $tache->version_id;

        //return back();

        return redirect()->route('tache.index', compact('version'))->withOk("La tâche a été supprimée avec succès");
    }

}
