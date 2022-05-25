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
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.home', $data);
    }
    public function profile()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.profile', $data);
    }
    public function setting()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.setting', $data);
    }


    public function save_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.save', $data);
    }

    public function view_card()
    {
        $segment = ['Segment1','Segment2','Segment3'];
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.view', $data)->with('segment', $segment);
    }

    public function seg_card($segment)
    {
        $visacard = VisaCard::where('segment_card','=',$segment)->where('idreceive','=',session('acteursid'))->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.segment', $data)->with('visacard', $visacard);
    }

    public function show_card($id)
    {
        $visacardid = serieCard::where('idcard','=',$id)->get();
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

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
        
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        $visademande =  demandes::join('acteurs', 'acteurs.id', '=', 'demandes.iddemandeur')
                        ->get(['demandes.*', 'acteurs.name_acteur', 'acteurs.role_acteur']);
                        
        return view('marketing.demande', $data)->with('visademande', $visademande);
    }

    public function traitement_demande($id)
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $accept_ask = demandes::where('id', $id)
                                ->limit(1)
                                ->update(array('statut' => '1'));

        $askceur = ['InfoAskceur'=>demandes::where('id', $id)->first()];
        
        $visacard = VisaCard::where('idreceive','=',session('acteursid'))->get();

        return view('marketing.transmission', $data,$askceur)->with('visacard', $visacard);
    }

    public function share_demande($id, $idask)
    {
        $sendStock = VisaCard::where('id', $id)
                                ->limit(1)  // optional - to ensure only one record is updated.
                                ->update(array('idreceive' => $idask));

        if ($sendStock) {
            return back()->with('success','Demande traitée et stock transmis avec succès');
        }else {
            return back()->with('fail','Une erreur est survenue, ressayez plutard');
        }
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
            $seriecard->idgestion = $visacard->id;
            $seriecard->segment = $request->segment;
            $seriecard->statut = 0;
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
