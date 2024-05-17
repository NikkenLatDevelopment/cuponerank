<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\coreCms;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd(request()->email);
        return view('panel.index');        
    }

    public function searchCoupon(Request $request){
        
        $coupon = DB::connection('SQL173')->select('SELECT * FROM PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones WHERE codigoCupon = ?', [$request->coupon]);
        //$coupon = DB::connection('SQL173')->select('SELECT * FROM PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones');
        //dd($coupon);
        if (!empty($coupon)) {
            return response()->json(['success' => 'Cupón encontrado.', 'data' => $coupon], 200);            
        }else{
            return response()->json(['error' => 'No se encontró ningún cupón con ese código.'], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCoupon(Request $request)
    {
        //
        $coupon = DB::connection('SQL173')->update('UPDATE PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones set redimido = 0 WHERE codigoCupon = ?', [$request->coupon]);
        if ($coupon > 0) {
            //echo "Actualización satisfactoria. Número de filas afectadas: $affected";
            return response()->json(['success' => 'Redimido.'], 200);       
        } else {
            return response()->json(['error' => 'Problema al redimir.'], 404);
        }

    }

    public function getAccess(){

        $email = request()->e;
        $url = \URL::temporarySignedRoute("panel.index", now()->addMinutes(1), ['email' => "$email"]);
        return $url;

    }
}
