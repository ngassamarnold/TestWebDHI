<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    public $fillable = [ "categorie","nom", "quantite", "prixU"];

}
