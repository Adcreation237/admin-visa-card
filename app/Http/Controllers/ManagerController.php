<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
use App\Models\serieCard;
use App\Models\VisaCard;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function branch_manager()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('branch_manager.home', $data);
    }
    public function profile()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('branch_manager.profile', $data);
    }
    public function setting()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('branch_manager.setting', $data);
    }

    //demander un stock de carte
    public function ask_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('branch_manager.demander', $data);
    }
    
    //voir ses demandes
    public function myasker()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        
        $myask = demandes::where('iddemandeur','=',session('acteursid'))->get();

        return view('branch_manager.demandes', $data)->with('myask', $myask);
    }

    //confirmer la reception de commande
    public function confirme_ask()
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

    //voir les demandes recues et traiter ou annuler
    public function trans_card_branch(){
        
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        
        $myask =  demandes::join('acteurs', 'acteurs.id', '=', 'demandes.iddemandeur')
                        ->where('idreceive','=',session('acteursid'))
                        ->get(['demandes.*', 'acteurs.name_acteur', 'acteurs.role_acteur']);

        return view('branch_manager.card_trans', $data)->with('myask', $myask);
    }
    
    //Annuler une demande
    public function trash_ask(){
        $acteurid =  $_GET['id'];
        $myask = demandes::where('id','=',$acteurid)
                                ->where('idreceive','=',session('acteursid'))
                                ->limit(1)
                                ->update(array('statut' => 3));
        if ($myask) {
            return back()->with('success','Demande annulée avec succès !');
            }else {
                return back()->with('fail',"Echec d'annulation, ressayez plutard");
            }
    }

    //Traiter un demande
    public function treated_ask(){

        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        $id = Acteurs::where('localisation','=','Yaounde')->where('role_acteur','=','distributor')->get('id');
        
        $getid='';
        foreach($id as $item){
            $getid = $item['id'];
        }

        $iddemande =  $_GET['id'];
        $seriecard = serieCard::join('acteurs', 'acteurs.id', '=', 'serie_cards.idgestion')
                                ->where('idgestion','=',session('acteursid'))
                                ->orwhere('idgestion','=',$getid)
                                ->get(['serie_cards.*', 'acteurs.name_acteur', 'acteurs.role_acteur']);

        if ($seriecard) {
            return view('branch_manager.send_card', $data)->with('iddemande', $iddemande)->with('seriecard', $seriecard);
        }else {
            return back()->with('fail','Echec de confirmation, ressayez plutard');
        }
    }

    //Transferer une carte
    public function trans_card(){

        $iddemande =  $_GET['idask'];
        $idtrans =  $_GET['id'];

        $id = Acteurs::where('localisation','=','Yaounde')->where('role_acteur','=','distributor')->get('id');
        
        $getid='';
        foreach($id as $item){
            $getid = $item['id'];
        }
        $TransSerie = serieCard::where('id','=',$idtrans)
                                ->where('idgestion','=',session('acteursid'))
                                ->limit(1)
                                ->update(array('idgestion' => $getid));

        //confirme le traitement
        $confAsk = demandes::where('id','=',$iddemande)
                                ->where('idreceive','=',session('acteursid'))
                                ->limit(1)
                                ->update(array('statut' => 1));

        if ($TransSerie && $confAsk) {
            return back()->with('success','Cartes transférée avec succès !');
        }else {
            return back()->with('fail',"Echec transfère, ressayez plutard");
        }
    }

    //Envoyer sa demande de cartes
    public function send(Request $request)
    {
        $acteurid =  $_GET['acteurid'];
        $id = Acteurs::where('role_acteur','=','marketing')->get('id');
        
        $getid='';
        foreach($id as $item){
            $getid = $item['id'];
        }

        $request->validate([
            'segment'=>'required',
            'nbre_card'=>'required|integer',
        ]);

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

    public function view_card_branch()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $visacard = VisaCard::where('idreceive','=',session('acteursid'))->get();
        $demandes = demandes::where('iddemandeur','=',session('acteursid'))->get();
        $valideAsk = demandes::where('iddemandeur','=',session('acteursid'))->get();
        return view('branch_manager.viewcard', $data)
                ->with('visacard',$visacard)
                ->with('demandes',$demandes)
                ->with('valideAsk',$valideAsk);
    }

    public function receive($id)
    {
        $accept_ask = demandes::where('id', $id)  // find your user by their id
                                ->limit(1)  // optional - to ensure only one record is updated.
                                ->update(array('statut' => '2'));;

        if ($accept_ask) {
            return back()->with('success','Demande approuvée avec succès');
        }else {
            return back()->with('fail',"Echec d'approuvement, ressayez plutard");
        }
    }

    public function show_card_branch($id)
    {
        $visacardid = serieCard::where('idcard','=',$id)->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        return view('branch_manager.seg_detail', $data)->with('visacardid', $visacardid);
    }

    
    
}
