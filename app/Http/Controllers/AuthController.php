<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data['title']='AUTHENTIFICATION';
        return view('welcome', $data);
    }

    public function logout(){
        if (session()->has('acteurs')) {
            session()->pull('acteurs');
            session()->pull('acteursid');
            return redirect('/');
        }
        if (session()->has('acteurs')) {
            session()->pull('acteurs');
            session()->pull('acteursid');
            return redirect('/');
        }
        if (session()->has('acteurs')) {
            session()->pull('acteurs');
            session()->pull('acteursid');
            return redirect('/');
        }
    }

    public function login_action(Request $request)
    {
         //validate inputs
        $request->validate([
            'code_acteur'=>'required|min:6|max:7',
            'mdp_acteur'=>'required|min:8',
        ]);

        $userInfo = Acteurs::where('code_acteur','=',$request->code_acteur)->first();

        if (!$userInfo) {
            return back()->with('fail','Désolé ! vous un acteur inexistant');
        } else {
            if (Hash::check($request->mdp_acteur, $userInfo->mdp_acteur)) {
                if (($userInfo->start)=='true') {
                        $request->session()->put('acteursid', $userInfo->id);
                        $request->session()->put('acteurs', $userInfo->role_acteur);
                        return redirect('/'.$userInfo->role_acteur);
                }else{
                    return back()->with('fail','Désolé ! Compte inactif, veuillez vous rapprocher de la Direction');
                }
            }else{
                return back()->with('fail','Désolé ! mot de passe incorrect');
            }
        }

    }
}
