<?php
// CE211044

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Sesiones;
use Illuminate\Http\Request;

class SesionesController extends Controller
{

    public function logueo(Request $request){

        $result = Sesiones::join('dependiente', 'sesiones.codigo_sesion','=','dependiente.codigo_sesion')->select('dependiente.nombre_dependiente')->where([[Sesiones::raw('aes_decrypt(sesiones.pass, \'hunter2\')'), '=', $request->input('pass')], ['sesiones.usuario', '=', $request->input('user')]])->get();


        if(sizeof($result) > 0){
            return $result;
        }else{
            return NULL;
        }

    }
}
