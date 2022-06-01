<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use App\Models\demandes;
use App\Models\Roles;
use App\Models\serieCard;
use App\Models\VisaCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MarketingController extends Controller
{
    //Aller à la page Home
    public function marketing()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.home', $data);
    }

    public function historik()
    {

        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        $file ="./file/historik_transac_marktg_".session('acteursid').".txt";
        # Affichage du fichier texte au complet
        $txt = file($file);

        return view('marketing.historik', $data)->with('txt',$txt);
    }

    //Gestion du profil
    public function profile()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.profile', $data);
    }

    //Gestion des paramètres
    public function setting()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.setting', $data);
    }

    //Gestion enrégistrement d'une série de carte
    public function save_card()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('marketing.save', $data);
    }


    //Consulter les cartes par segment
    public function view_card()
    {
        $segment = ['Segment1','Segment2','Segment3'];
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))
                                        ->first()];
        return view('marketing.view', $data)->with('segment', $segment);
    }


    //Voir les segements de cartes
    public function seg_card($segment)
    {
        $visacard = VisaCard::join('acteurs', 'acteurs.id', '=', 'visa_cards.idreceive')
                                ->where('segment_card','=',$segment)
                                ->get(['visa_cards.*', 'acteurs.name_acteur', 'acteurs.role_acteur']);

        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        return view('marketing.segment', $data)->with('visacard', $visacard);
    }


    //voir les cartes d'un segment precis
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

    //voir les demandes envoyées
    public function view_demandes()
    {

        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];

        $visademande =  demandes::join('acteurs', 'acteurs.id', '=', 'demandes.iddemandeur')
                                ->where('idreceive','=',session('acteursid'))
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
        $sendStock = serieCard::where('idcard', $id)
                                ->update(array('idgestion' => $idask));


        $visacard = VisaCard::where('id','=',$id)->get();
        $user = Acteurs::where('id','=',$idask)->get();

        $serie = $segment = $agence = '';

        foreach ($user as $value) {
            $agence = $value->localisation;
        }

        foreach ($visacard as $value) {
            $serie = $value->first_num.' - '.$value->last_num;
            $segment = $value->segment_card;
        }

        $file ="./file/historik_transac_marktg_".session('acteursid').".txt";
        $fileopen=(fopen("$file",'a+'));
        fwrite($fileopen,"Vous avez transféré le stock de ".$serie." de Segment ".$segment['7']." à l'agence de ".$agence." en date du ".date('d-M-Y').".\n");
        fclose($fileopen);

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

        $newdate = date('Y-m-d', strtotime($request->date_start.'+2 year'));

        //insert card
       $visacard = new VisaCard();
       $visacard->idrespo = $request->idrespo;
       $visacard->idreceive = $request->idrespo;
       $visacard->segment_card = $request->segment;
       $visacard->date_start = $request->date_start;
       $visacard->date_end = $newdate;
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

        $file ="./file/historik_transac_marktg_".session('acteursid').".txt";
        $fileopen=(fopen("$file",'a+'));
        fwrite($fileopen,"Vous avez enrégistré ".$tab." cartes de Segment ".$request->segment['7']." en date du ".date('d-M-Y').".\n");
        fclose($fileopen);

       if ($save && $save2) {
            return back()->with('success','Carte visa enregistré avec succès');
       }else {
            return back()->with('fail','Echec sauvegarde, ressayez plutard');
       }
    }

    //Gestion des utilisateurs
    public function users()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        $users = Acteurs::all();
        $roles = Roles::all();
        $code='';
        foreach ($users as $value) {
            $code = $value->code_acteur + 1;
        }
        return view('marketing.users', $data)
                    ->with('users',$users)
                    ->with('roles',$roles)
                    ->with('code',$code);
    }

    public function add_users(Request $req)
    {
        //validate inputs
        $req->validate([
            'name_acteur'=>'required',
            'role_acteur'=>'required',
            'code_acteur'=>'required',
            'agence'=>'required',
        ]);
        $password='';
        // Initialisation des caractères utilisables
        $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

        for($i=0;$i<10;$i++)
        {
            $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
        }

        $code_user = 0;
        if (strlen($req->code_acteur)==2) {
            $code_user = '0000'.$req->code_acteur;
        }
        if (strlen($req->code_acteur)==1) {
            $code_user = '00000'.$req->code_acteur;
        }


        $sendStock = Roles::where('name', $req->role_acteur)
                                ->limit(1)  // optional - to ensure only one record is updated.
                                ->update(array('statut'=> Roles::raw('statut+1')));


       $usersInsert = new Acteurs();
       $usersInsert->name_acteur = $req->name_acteur;
       $usersInsert->role_acteur = $req->role_acteur;
       $usersInsert->code_acteur = $code_user;
       $usersInsert->mdp_acteur = Hash::make($password);
       $usersInsert->localisation = $req->agence;
       $usersInsert->start = 'false';

       $save = $usersInsert->save();

        if ($save && $sendStock) {
            return back()->with('success','utilisateur ajouté avec succès');
        }else {
            return back()->with('fail','Une erreur est survene, ressayez plutard');
        }

    }
}
