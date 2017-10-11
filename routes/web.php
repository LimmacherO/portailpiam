<?php

/*
 * Web.php: contient les routes pour le portail PIAM
 * @Author: Romain JEDYNAK
 */

// Routes vers la page d'accueil
Route::get('/', function () {
    return redirect('version');
});
Route::get('home', function () { return view('home'); })->name('home');

//Routes associées aux opérations sur les versions (CRUD)
Route::get('version', 'VersionController@index')->name('version.index');
Route::get('version/{version}', 'VersionController@show')->name('version.show');
Route::get('version/create/{version}', 'VersionController@create')->name('version.create');
Route::post('version/store', 'VersionController@store')->name('version.store');
Route::get('version/edit/{version}', 'VersionController@edit')->name('version.edit');
Route::put('version/update/{version}', 'VersionController@update')->name('version.update');
Route::get('version/destroy/{version}', 'VersionController@destroy')->name('version.destroy');

//Routes associées aux exports de données (Excel, etc.)
Route::get('export/index', 'ExportController@index')->name('export.index'); //plus utlisé pour le moment
Route::get('export/excel', 'ExportController@exporttoexcel')->name('export.excel');


//Routes associées aux opérations sur les tâches/jalons (CRUD)
Route::get('taches/{version}', 'TacheController@index')->name('tache.index');
Route::get('tache/create/{version}', 'TacheController@create')->name('tache.create');
Route::post('tache/store', 'TacheController@store')->name('tache.store');
Route::get('tache/edit/{tache}', 'TacheController@edit')->name('tache.edit');
Route::put('tache/update/{tache}', 'TacheController@update')->name('tache.update');
Route::get('tache/delete/{tache}', 'TacheController@delete')->name('tache.delete');