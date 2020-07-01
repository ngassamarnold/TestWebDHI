<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
 public $fillable = [ "nom_utilisateur","reference", "liste_commande", "livre", "estvalide"];

}
