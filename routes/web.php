<?php


Route::get('/', function () {
    return redirect('/home');
});
Route::get('home', function () { return view('home'); })->name('home');

Route::get('version', 'VersionController@index')->name('version.index');
Route::get('version/{version}', 'VersionController@show')->name('version.show');
Route::get('version/create/{version}', 'VersionController@create')->name('version.create');
Route::post('version/store', 'VersionController@store')->name('version.store');
Route::get('version/edit/{version}', 'VersionController@edit')->name('version.edit');
Route::put('version/update/{version}', 'VersionController@update')->name('version.update');
Route::get('version/destroy/{version}', 'VersionController@destroy')->name('version.destroy');


Route::get('export/index', 'ExportController@index')->name('export.index');


Route::get('taches/{version}', 'TacheController@index')->name('tache.index');

// Création d'une tâche
Route::get('tache/create/{version}', 'TacheController@create')->name('tache.create');

// Enregistrement/modification d'une tâche
Route::post('tache/store', 'TacheController@store')->name('tache.store');

// Suppression d'une tâche
Route::get('tache/delete/{tache}', 'TacheController@delete')->name('tache.delete');

// Mise à jour d'une tâche
Route::get('tache/edit/{tache}', 'TacheController@edit')->name('tache.edit');
Route::put('tache/update/{tache}', 'TacheController@update')->name('tache.update');


