<?php

namespace App\Http\Controllers;

use App\Models\cuentabancaria;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentabancariaController extends Controller
{
    public function cuentas($dui)
    {

        $result = DB::table('Cuentabancaria')->join('Cliente', 'Cuentabancaria.codigo_cliente', '=', 'Cliente.codigo_cliente')->select('cuentabancaria.numCuenta', 'cuentabancaria.tipoCuenta', 'cuentabancaria.saldoCuenta', 'Cliente.nombre_cliente')->where('cliente.DUI_cliente', $dui)->get(); // CE211044

        $cliente = $result[0]->nombre_cliente;

        if (sizeof($result) > 0) {
            return json_encode(['cliente' => $cliente, 'cuentas' => $result]);
        } else {
            return NULL;
        }
    }



    public function retiro(Request $request)
    {
        
        $movimiento = new Movimientos();

        $cadena_base = '0123456789';
        $code = 'MO';
        $limite = strlen($cadena_base) - 1;
        for ($i = 0; $i < 5; $i++) {
            $code .= $cadena_base[rand(0, $limite)];
        }

        $saldoC = DB::table('Cuentabancaria')->select('saldoCuenta')->where('numCuenta', $request->input('cuenta'))->get();
       
        $saldoC = $saldoC[0]->saldoCuenta - $request->input('monto');

      
        DB::table('Cuentabancaria')->where('numCuenta', $request->input('cuenta'))->update(['saldoCuenta' => $saldoC]);

        //Guardando los datos del nuevo cliente
        $movimiento->numTransaccion = $code;
        $movimiento->tipoTransaccion = 'Retiro de dinero';
        $movimiento->fechaTransaccion = $request->input('fecha');
        $movimiento->montoTransaccion = $request->input('monto');
        $movimiento->lugarTransaccion = 'En local';
        $movimiento->numCuenta = $request->input('cuenta');
        $movimiento->save();

        //retornando un mensaje de exito
        return json_encode(['msg' => 'Exito']);
    }



    public function ingreso(Request $request)
    {
        
        $movimiento = new Movimientos();

        $cadena_base = '0123456789';
        $code = 'MO';
        $limite = strlen($cadena_base) - 1;
        for ($i = 0; $i < 5; $i++) {
            $code .= $cadena_base[rand(0, $limite)];
        }


        $saldoC = DB::table('Cuentabancaria')->select('saldoCuenta')->where('numCuenta', $request->input('cuenta'))->get();
       
        $saldoC = $saldoC[0]->saldoCuenta + $request->input('monto');

      
        DB::table('Cuentabancaria')->where('numCuenta', $request->input('cuenta'))->update(['saldoCuenta' => $saldoC]);

        //Guardando los datos del nuevo cliente
        $movimiento->numTransaccion = $code;
        $movimiento->tipoTransaccion = 'Ingreso de dinero';
        $movimiento->fechaTransaccion = $request->input('fecha');
        $movimiento->montoTransaccion = $request->input('monto');
        $movimiento->lugarTransaccion = 'En local';
        $movimiento->numCuenta = $request->input('cuenta');
        $movimiento->save();

        //retornando un mensaje de exito
        return json_encode(['msg' => 'Exito']);
    }
}
// CE211044