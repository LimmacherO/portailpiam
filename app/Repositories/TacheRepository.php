<?php

namespace App\Repositories;

use App\Tache;

class TacheRepository
{

    protected $tache;

    public function __construct(Tache $tache)
	{
		$this->tache = $tache;
	}

    public function getPaginate($n)
    {
        return $this->tache->paginate($n);
    }

	public function store(Array $inputs)
	{

		return $this->tache->create($inputs);
	}

	public function update(Tache $tache, Array $inputs)
	{
		 $tache->update($inputs);
	}

	public function destroy(Tache $tache)
	{
		$tache->delete();
	}

}