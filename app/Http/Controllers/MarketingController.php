<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
use App\Models\serieCard;
use App\Models\VisaCard;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function marketing()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.home', $data);
    }
    public function profile()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.profile', $data);
    }
    public function setting()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.setting', $data);
    }


    public function save_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.save', $data);
    }

    public function view_card()
    {
        $segment = ['Segment1','Segment2','Segment3'];
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.view', $data)->with('segment', $segment);
    }

    public function seg_card($segment)
    {
        $visacard = VisaCard::where('segment_card','=',$segment)->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.segment', $data)->with('visacard', $visacard);
    }

    public function show_card($id)
    {
        $visacardid = serieCard::where('idcard','=',$id)->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];

        return view('marketing.segview', $data)->with('visacardid', $visacardid);
    }

    /*public function search_card(Request $request)
    {

        $request->validate([
            'search'=>'required|string',
        ]);

        $search = $request->search;
        $searchcardid = serieCard::where('num_card','=',$search)->get();

        $id='';
        foreach ($searchcardid as $key) {
            $id = $key->id;
        }

        $row = $id;
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];
        return view('marketing.segview', $data)->with('visacardid', $row);
    }*/

    public function view_demandes()
    {
        $visademande = demandes::all();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('marketing'))->first()];

        $id = '';
        foreach ($visademande as $key) {
            $id = $key->iddemandeur;
        }
        $user = ['demandeur'=>Acteurs::where('id','=',$id)->first()];
        return view('marketing.demande', $data,$user)->with('visademande', $visademande);
    }

    public function saving(Request $request)
    {
        $save = $save2 = null;
        //validate inputs
        $request->validate([
            'idrespo'=>'required',
            'segment'=>'required',
            'date_start'=>'required',
            'num_bank'=>'required',
            'branch_partner'=>'required|min:21|max:21',
            'branch_distri'=>'required',
            'first_num'=>'required|min:7|max:7',
            'last_num'=>'required|min:7|max:7',
        ]);

        //insert card
       $visacard = new VisaCard();
       $visacard->idrespo = $request->idrespo;
       $visacard->idreceive = $request->idrespo;
       $visacard->segment_card = $request->segment;
       $visacard->date_start = $request->date_start;
       $visacard->num_bank = $request->num_bank;
       $visacard->branch_partner = $request->branch_partner;
       $visacard->branch_distri = $request->branch_distri;
       $visacard->first_num = $request->first_num;
       $visacard->last_num = $request->last_num;
       $save = $visacard->save();

       $tab = $request->last_num - $request->first_num;

       for ($i=0; $i < $tab+1; $i++) {

            //insert serie card
            $seriecard = new serieCard();

            $seriecard->idcard = $visacard->id;
            $seriecard->num_card = $request->first_num+$i;
            $save2 = $seriecard->save();
       }

       if ($save && $save2) {
        return back()->with('success','Carte visa enregistré avec succès');
       }else {
           return back()->with('fail','Echec sauvegarde, ressayez plutard');
       }
    }
}
