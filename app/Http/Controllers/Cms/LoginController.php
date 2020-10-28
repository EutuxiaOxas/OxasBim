<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            return redirect('/cms');
        }
        $navbar_null = true;
    	return view('cms.auth.login', compact('navbar_null'));
    }


    public function login(Request $request)
    {
    	$user = User::where('email', $request->email)->first();
    	if(isset($user))
    	{
    		if($user->cms)
    		{
    			if(Hash::check($request->password, $user->password))
    			{
    				if($request->remember == 'on')
                    {
                        Auth::login($user, true);
                    } else {
                        Auth::login($user);
                    }
    				return redirect('/cms');
    			}

                return back()->with('message', 'Usuario no encontrado o datos incorrectos');

    		} else {
    			return back()->with('message', 'Usuario no encontrado o datos incorrectos');
    		}
    	} else {
    		return back()->with('message', 'Usuario no encontrado o datos incorrectos');
    	}
    }


    //logout de administracion
    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
