<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Hash;
class LoginGoogleController extends Controller
{
    public function loginRedirect()
    {
    	return Socialite::driver('google')->redirect();
    }

    public function loginCallback()
    {
    	$auth_user = Socialite::driver('google')->user();
        $nombre_apellido = explode(" ", $auth_user->name);

    	$userVerification = User::where('email', $auth_user->email)->first();

    	if($userVerification)
    	{
    		Auth::login($userVerification, true);
    		
    	}else {
    		$user = User::create([
    			'name' => $nombre_apellido[0],
                'apellido' => $nombre_apellido[1],
    			'email' => $auth_user->email,
    			
    		]);
    	}

    	return redirect('/home');
    }
}
