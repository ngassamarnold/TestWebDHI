<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
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
     * Valider a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valider(Request $request)
    {
        $request->validate([
            'reference' => ['required', 'string'],
        ]);
        $cmd = Commandes::where('reference', $request->reference)
               ->first();
        if($cmd){
             $cmd->estvalide=true;
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
