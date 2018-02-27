<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Import des classes spécifiques à l'application
use App\Domaine;

class IndicateursController extends Controller
{

  public function index()
  {

    $domaines = Domaine::all();

    return view('indicateurs.index', compact('domaines'));
  }

}
