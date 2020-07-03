<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
 public $fillable = [ "nom_utilisateur","reference", "liste_commande", "livre", "estvalide","operator_transaction_ref", "transaction_ref", "transaction_type", "transaction_amount", "transaction_currency", "transaction_status", "transaction_reason", "customer_phone_number", "signature"];
}
