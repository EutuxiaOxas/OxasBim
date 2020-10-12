<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Shiping_data;
class ShipingDataController extends Controller
{
    public function index(Request $request)
    {
    	$user = auth()->user();
    	if($user)
    	{
    		if(isset($request->orden))
    		{
    			
    			$orden = Order::find($request->orden);
    			$ordenProducts = $orden->orderProduct;
                $formulario = Shiping_data::where('user_id', $user->id)->first();

    			if($user->id == $orden->user->id)
    			{
                    $user_id = $user->id;
    				if(isset($formulario))
                    {
                        return view('formulario_envio', compact('orden', 'ordenProducts', 'user_id', 'formulario'));
                    }

                    return view('formulario_envio', compact('orden', 'ordenProducts', 'user_id'));
    			}
    		}
    	}

    	return redirect('/');
    }


    public function guardarDatosEnvio(Request $request)
    {
    	Shiping_data::create($request->all());

    	return redirect("/cuentas?orden=".$request->orden_id);
    }

    public function getShipingData(Request $request, $id){

        if($request->wantsJson()){
            $info = Order::find($id)->shiping;
            return response()->json($info, 200);
        }

        return redirect('/');
    }
}
