<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
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

    public function view_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('branch_manager'))->first()];
        $visacard = VisaCard::where('idreceive','=',session('branch_manager'))->get();
        $demandes = demandes::where('iddemandeur','=',session('branch_manager'))->get();
        $valideAsk = demandes::where('iddemandeur','=',session('branch_manager'))->where('statut','=','1')->get();
        return view('branch_manager.viewcard', $data)
                ->with('visacard',$visacard)
                ->with('demandes',$demandes)
                ->with('valideAsk',$valideAsk);
    }
}
