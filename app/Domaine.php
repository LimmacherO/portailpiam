<?php

namespace App;

//import des classes externes
use Illuminate\Database\Eloquent\Model;

/*
 * Classe Domaine: Modèle permettant de gérer les domaines
 * @Author: Romain Jedynak
 */
class Domaine extends Model
{
    //Désactivation du timestamp dans le modèle de données
   	public $timestamps = false;

   	//Nom de la table associée au modèle
   	protected $table = 'domaine';

    //Liste des champs utilisables pour les opérations CRUD
    protected $fillable = [
        'libelle',
        'export_background_color',
        'export_font_color'
    ];

    //Lien avec une application
    public function application()
    {
        return $this->hasOne(\App\Application::class);
    }

}
