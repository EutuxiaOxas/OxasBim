<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Role;

class IndexController extends Controller
{
    public function index()
    {
        $secName = '';
    	return view('cms.index', compact('secName'));
    }

    public function adminUsers()
    {
    	$roles = Role::all();
        $secName = 'usuarios';
    	$usuarios = User::all();
    	return view('cms.usuarios.index', compact('roles', 'usuarios', 'secName'));
    }
}
