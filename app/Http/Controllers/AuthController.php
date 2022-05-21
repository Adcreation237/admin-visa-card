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
        if (session()->has('marketing')) {
            session()->pull('marketing');
            return redirect('/');
        }
        if (session()->has('branch_manager')) {
            session()->pull('branch_manager');
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
                        $request->session()->put($userInfo->role_acteur, $userInfo->id);
                        return redirect('/'.$userInfo->role_acteur.'/home');
                }else{
                    return back()->with('fail','Désolé ! Compte inactif, veuillez vous rapprocher de la Direction');
                }
            }else{
                return back()->with('fail','Désolé ! mot de passe incorrect');
            }
        }

    }
}
