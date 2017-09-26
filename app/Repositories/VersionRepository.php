<?php

namespace App\Repositories;

use App\Version;

class VersionRepository
{

    protected $version;

    public function __construct(Version $version)
	{
		$this->version = $version;
	}

    public function getPaginate($n)
    {
        return $this->version->paginate($n);
    }

	public function store(Array $inputs)
	{

		return $this->version->create($inputs);
	}

	public function update(Version $version, Array $inputs)
	{
		 $version->update($inputs);
	}

	public function destroy(Version $version)
	{
		$version->delete();
	}

}