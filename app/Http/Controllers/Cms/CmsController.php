<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function tiendaVirtual()
    {
    	$secName = 'web';
    	return view('cms.productos.index', compact('secName'));
    }
}
