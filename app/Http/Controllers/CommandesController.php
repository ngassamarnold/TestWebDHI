<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    /**
     * Fonction pour afficher les commandes non livrés.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $commandes = Commandes::orderBy('id', 'DESC')
        ->where('livre', false)
        ->where('transaction_status', "SUCCESS")        ->paginate(4);
      return view('commandes.list', compact('commandes'));
    }
    /**
     * Fonction pour afficher les commandes  livrés.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLivre()
    {
      $commandes = Commandes::orderBy('id', 'DESC')
        ->where('livre', true)
        ->where('transaction_status', "SUCCESS")        ->paginate(4);
      return view('commandes.listLivre', compact('commandes'));
    }

    /**
     * Fonction pour valider la livraison d'une commande
     *
     * @return \Illuminate\Http\Response
     */
    public function livrer( $id){
        $commande = Commandes::where('id', $id)->first();
        $commande->livre=true;
        if($commande->save()) return  redirect()->route("ListCommandesNonLivre")->with("success", "Produit marqué livré");

        else return  redirect()->route("ListCommandesNonLivre")->with("error", "erreur veillez réeseillez!!!");
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Enregistrer une commande
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_utilisateur' => ['required', 'string'],
            'telephone' => ['required', 'string', 'max:255'],
            'liste_commande' => ['required'],
            'reference' => ['required', 'string'],

        ]);
        $commandes= new Commandes([
            'nom_utilisateur' => $request->nom_utilisateur,
            'telephone' =>$request->telephone,
            'liste_commande' => json_encode($request->liste_commande),
            'reference' =>$request->reference,
        ]);
        if( $commandes->save()) return response()->json(["success"=>true]);

        return response()->json([], 500);
        return $request ;
    }
    /**
     * Fonction callback appelé après le paiement
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $request->validate([
            'app_transaction_ref' => ['required', 'string'],
            'transaction_status' => ['required', 'string'],
        ]);
        $cmd = Commandes::where('reference', $request->app_transaction_ref)
               ->first();
        if($cmd){
            $request->transaction_status==="SUCCESS"?$cmd->estvalide=true:true;
            $cmd->operator_transaction_ref=$request->operator_transaction_ref;
            $cmd->transaction_ref=$request->transaction_ref;
            $cmd->transaction_type=$request->transaction_type;
            $cmd->transaction_amount=$request->transaction_amount;
            $cmd->transaction_currency=$request->transaction_currency;
            $cmd->transaction_status=$request->transaction_status;
            $cmd->transaction_reason=$request->transaction_reason;
            $cmd->customer_phone_number=$request->customer_phone_number;
            $cmd->signature=$request->signature;
            if( $cmd->save())return response()->json(["success"=>true]); //return view('commandes.paiement');
            // return response()->json(["success"=>true]);
        }
        return response()->json([], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function show(Commandes $commandes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function edit(Commandes $commandes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commandes $commandes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commandes $commandes)
    {
        //
    }
}
