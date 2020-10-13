<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Bank;
use App\Banks_User;
use App\Pago;
class PagosController extends Controller
{



	public function index()
	{
		$pagos = Pago::all();
		$secName = 'pagos';
		return view('cms.pagos.index', compact('pagos', 'secName'));
	}

    public function cuentasBancarias(Request $request)
    {  
        $user = auth()->user();
        $cuentas = Banks_User::where('title', '!=', 'PayPal')->get();
        if($user)
        {
            if(isset($request->orden))
            {
                
                $orden = Order::find($request->orden);
                
                if($user->id == $orden->user->id)
                {
                    $user_id = $user->id;
                    return view('cuentas', compact('orden', 'cuentas'));
                }
            }
        }

        return redirect('/');
    }


    public function agregarPago(Request $request)
    {	
    	$user = auth()->user();

		   	

     		if($user)
     		{

     			if(isset($request->orden))
     			{
     				
     				$orden = Order::find($request->orden);

     				if($user->id == $orden->user->id)
     				{
     	                $user_id = $user->id;
     	                $banks = Bank::where('title', '!=', 'Otros')->get();
     	                $banksUsers = Banks_User::where('title', '!=', 'PayPal')->get();
     					
     	                return view('pagos', compact('user_id', 'orden', 'banks', 'banksUsers'));
     				}
     			}

     		}

     		return redirect('/');
    }


    public function guardarPago(Request $request)
    {
    	Pago::create($request->all());
    	return redirect('/home')->with('message', 'Orden realizada con éxito y en proceso!');
    }
}
