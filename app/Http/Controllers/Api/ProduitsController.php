<?php

namespace App\Http\Controllers\Api;

use App\Models\Produits;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use League\CommonMark\Util\ArrayCollection;
use Session;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produits::all();

        return response()->json([
            'produits' => $produits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // die("ok");
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if(in_array(strtolower($extension),$valid_extension)){

            if($fileSize <= $maxFileSize){

                // File upload location
                $location = 'uploads';

        // Upload file
        $file->move($location,$filename);

        // Import CSV to Database
        $filepath = public_path($location."/".$filename);

        // Reading file
        $file = fopen($filepath,"r");

        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );
            for ($c=0; $c < $num; $c++) {
            $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
        }
        fclose($file);
        // dd($importData_arr);
        //$products_=new ArrayCollection();
        // Insert to MySQL database
        foreach($importData_arr as $key =>$importData){

            if($key!==0){
            $res = explode(";", $importData[0]);
            $produits = new Produits([
                "categorie"=>$res[0],
                "nom"=>$res[1],
                "quantite"=>$res[2],
                "prixU"=>$res[3]
            ]);
            $prods = Produits::where('categorie', $res[0])
               ->where('nom', $res[1])
               ->first();
                if($prods){
                    $prods->quantite=$prods->quantite+$res[2];
                    $prods->prixU=$res[3];
                    //die('ok');
                    if($prods->save()) true;
                    else{ return  redirect()->route("ProduitsCreate")
                        ->with("error", "erreur d'enrégistrement");
                        }
                }else{
                    if($produits->save()) true;
                    else{ return  redirect()->route("ProduitsCreate")
                    ->with("error", "erreur d'enrégistrement");
                    }
                }
            }
        }
            return  redirect()->route("ProduitsCreate")
                ->with("success", "Produits enrégistré avec success");
            }

        }

        return  redirect()->route("ProduitsCreate")
            ->with("error", "Extension invalide. viellez choisir un fichier csv");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function show(Produits $produits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function edit(Produits $produits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produits $produits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produits $produits)
    {
        //
    }
}
