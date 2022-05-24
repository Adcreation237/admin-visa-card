<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function distributor()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('distributor.distribution', $data);
    }

    public function ask_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('distributor.demander', $data);
    }

    public function opera_demande(Request $request,)
    {
        $location=  $_GET['location'];
        $acteurid =  $_GET['acteurid'];
        $id = Acteurs::where('localisation','=',$location)->where('role_acteur','=','branch_manager')->get('id');
        
        $getid='';
        foreach($id as $item){
            $getid = $item['id'];
        }

        $request->validate([
            'segment'=>'required',
            'nbre_card'=>'required|integer',
        ]);

        echo $location.' '.$acteurid.' '.$getid;

        //insert demande acceuil
        $ask = new demandes();
        $ask->iddemandeur = $acteurid;
        $ask->idreceive = $getid;
        $ask->segment = $request->segment;
        $ask->nbre_card = $request->nbre_card;
        $ask->statut = '0';
        $save = $ask->save();

       if ($save) {
        return back()->with('success','Carte visa enregistré avec succès');
       }else {
           return back()->with('fail','Echec sauvegarde, ressayez plutard');
       }
    }
    
}
