<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
use App\Models\serieCard;
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
    
    public function distribute()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $mystock = serieCard::where('idgestion','=',session('acteursid'))->where('statut','=',0)->get();
        return view('distributor.distribute', $data)->with('mystock',$mystock);
    }

    public function attribue()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $mystock = serieCard::where('idgestion','=',session('acteursid'))->where('statut','=',2)->get();
        return view('distributor.attribue', $data)->with('mystock',$mystock);
    }

    
    public function mystock()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $mystock = serieCard::where('idgestion','=',session('acteursid'))->get();
        return view('distributor.mystock', $data)->with('mystock',$mystock);
    }

    public function myask()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        
        $myask = demandes::where('iddemandeur','=',session('acteursid'))->get();

        return view('distributor.demandes', $data)->with('myask', $myask);
    }

    public function confirme_ask_ask_agence()
    {
        $acteurid =  $_GET['id'];
        $myask = demandes::where('id','=',$acteurid)
                                ->where('iddemandeur','=',session('acteursid'))
                                ->limit(1)
                                ->update(array('statut' => 2));
        if ($myask) {
            return back()->with('success','Demande confirmée avec succès !');
            }else {
                return back()->with('fail','Echec de confirmation, ressayez plutard');
            }
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
        return back()->with('success','Demande envoyée avec succès !');
       }else {
           return back()->with('fail','Echec de demande, ressayez plutard');
       }
    }


    public function selling(Request $req)
    {
        $req->validate([
            'num_card'=>'required',
            'info_user'=>'required',
            'phone_user'=>'required|integer',
            'racine_user'=>'required|integer',
        ]);
    }
    
}
