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
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        return view('branch_manager.home', $data);
    }
    public function profile()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        return view('branch_manager.profile', $data);
    }
    public function setting()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        return view('branch_manager.setting', $data);
    }

    public function ask_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        return view('branch_manager.demander', $data);
    }

    public function send(Request $request)
    {
        $request->validate([
            'idrespo'=>'required|integer',
            'segment'=>'required',
            'nbre_card'=>'required|integer',
        ]);

        //insert card
       $ask = new demandes();
       $ask->iddemandeur = $request->idrespo;
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
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        $visacard = VisaCard::where('idreceive','=',session('branch_manager'))->get();
        $demandes = demandes::where('iddemandeur','=',session('branch_manager'))->get();
        $valideAsk = demandes::where('iddemandeur','=',session('branch_manager'))->get();
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
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];

        return view('branch_manager.seg_detail', $data)->with('visacardid', $visacardid);
    }

    
    public function trans_card_branch(){
        
        $visacard = VisaCard::where('idreceive','=',session('branch_manager'))->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        

        return view('branch_manager.card_trans', $data)->with('visacard', $visacard);
    }
}
