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
                
                if($user->id == $orden->user->id && $orden->status === 'ACTIVO' || $orden->status === 'REGISTRADO')
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

     				if($user->id == $orden->user->id && $orden->status === 'ACTIVO')
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


    public function agregarNuevoPago(Request $request)
    {
            $user = auth()->user();

            

                if($user)
                {

                    if(isset($request->orden))
                    {
                        
                        $orden = Order::find($request->orden);

                        if($user->id == $orden->user->id && $orden->status === 'REGISTRADO')
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
        $orden = Order::find($request->orden_id);

    	Pago::create($request->all());
        $orden->status = 'REGISTRADO';
        $orden->save();
    	return redirect('/home')->with('message', 'Orden realizada con éxito y en proceso!');
    }


    public function obtenerPagos($id)
    {
        $orden = Order::find($id);

        $pagos = $orden->pagos;
        $total_cuenta = $orden->total_amount;

        $pagos_data = [];
        $contador = 1;
        
        foreach ($pagos as $pago) {
            $total_cuenta -= $pago->monto;

            $pagos_data[] = [
                'numero' => $contador,
                'titular' => $pago->titular_cuenta,
                'monto' => $pago->monto,
                'banco_emisor' => $pago->emisor->title,
                'banco_receptor' => $pago->receptor->title,
                'referencia' => $pago->referencia,
                'fecha' => $pago->fecha,
                'identidad_titular' => $pago->documento_identidad_titular, 
            ];
            $contador++;
        }


        $data = [
            'orden_id' => $orden->id,
            'total_pago' => $orden->total_amount,
            'restante' => $total_cuenta,
            'pagos' => $pagos_data,
        ];

        return response()->json($data, 200);

    }
}
