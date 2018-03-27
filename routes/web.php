<?php

/*
 * Web.php: contient les routes pour le portail PIAM
 * @Author: Romain JEDYNAK
 */

/* Gestion de l'authentification */
Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );


// Routes vers la page d'accueil
Route::get('/', function () {
    return redirect('version');
});
Route::get('home', function () { return view('home'); })->name('home');

//Routes associées aux opérations sur les versions (CRUD)
Route::get('version', 'VersionController@index')->name('version.index');
Route::get('version/search', 'VersionController@search')->name('version.search');
Route::get('version/{version}', 'VersionController@show')->name('version.show');

//Routes associées aux exports de données (Excel, etc.)
Route::get('export/index', 'ExportController@index')->name('export.index'); //plus utlisé pour le moment
Route::get('export/excel', 'ExportController@exporttoexcel')->name('export.excel');

//Routes associées aux opérations sur les tâches/jalons (CRUD)
Route::get('taches/{version}', 'TacheController@index')->name('tache.index');

// Liste des routes nécessitant d'être authentifié pour y accéder
Route::middleware('auth')->group(function () {

  //Routes associées aux actions d'import de la RoadMap
  Route::get('import/roadmap/index', 'ImportRoadmapController@index');
  Route::post('import/roadmap/importexcel', 'ImportRoadmapController@importExcel');

  //Routes associées aux actions sur les versions/chantiers
  Route::get('version/create/{version}', 'VersionController@create')->name('version.create');
  Route::post('version/store', 'VersionController@store')->name('version.store');
  Route::get('version/edit/{version}', 'VersionController@edit')->name('version.edit');
  Route::put('version/update/{version}', 'VersionController@update')->name('version.update');
  Route::get('version/destroy/{version}', 'VersionController@destroy')->name('version.destroy'); //Suppression d'une version/chantier

  //Routes associées aux actions sur les tâches/jalons
  Route::get('tache/create/{version}', 'TacheController@createTache')->name('tache.create'); //Vue de création d'une nouvelle tâche
  Route::get('jalon/create/{version}', 'TacheController@createJalon')->name('jalon.create'); //Vue de création d'un nouveau jalon
  Route::get('tache/edit/{tache}', 'TacheController@editTache')->name('tache.edit');
  Route::get('jalon/edit/{tache}', 'TacheController@editJalon')->name('jalon.edit');
  Route::post('tache/store', 'TacheController@store')->name('tache.store');
  Route::put('tache/update/{tache}', 'TacheController@update')->name('tache.update');
  Route::get('tache/destroy/{tache}', 'TacheController@delete')->name('tache.delete'); //Suppression d'une tâche

});
