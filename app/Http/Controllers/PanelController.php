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
    public function index(Request $request)
    {
        //
        //dd(request()->email);
        $email = $request->email;
        return view('panel.index',compact("email"));        
    }

    public function searchCoupon(Request $request){

        try{

            $coupon = DB::connection('SQL173')->select('SELECT * FROM PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones WHERE codigoCupon = ?', [$request->coupon]);
            //$coupon = DB::connection('SQL173')->select('SELECT * FROM PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones');
            //dd($coupon);
            $agentName = "test";
            if (!empty($coupon)) {
                $this->saveLog($request->coupon,$agentName,$request->agentEmail,"","SEARCH COUPON",date('Y-m-d'),date('H:i:s'));
                return response()->json(['success' => 'Cupón encontrado.', 'data' => $coupon], 200);            
            }else{
                return response()->json(['error' => 'No se encontró ningún cupón con ese código.'], 404);
            }

        } catch(Excepion $e) {
            return response()->json(['error' => 'Hubo un problema '.$e], 500);
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
            $agentName = "test";
            $this->saveLog($request->coupon,$agentName,$request->agentEmail,$request->userEmail,"ACTIVATE COUPON",date('Y-m-d'),date('H:i:s'));
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

    public function saveLog($coupon, $agentName, $agentEmail, $clientEmail, $action, $date, $hour){
        
        if($action == "SEARCH COUPON"){
            //dd("saveLog",$coupon,$agentEmail);
            DB::connection('SQL173')->insert('
                INSERT INTO PLAN_INFLUENCIA_MK.dbo.Log_Panel_UBI (codigo, nombreAgente, emailAgente, emailUser, accion, fecha, hora)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ', [$coupon, $agentName, $agentEmail, "", "SEARCH COUPON", $date, $hour]);
        }else if($action == "ACTIVATE COUPON"){

            DB::connection('SQL173')->insert('
                INSERT INTO PLAN_INFLUENCIA_MK.dbo.Log_Panel_UBI (codigo, nombreAgente, emailAgente, emailUser, accion, fecha, hora)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ', [$coupon, $agentName, $agentEmail, "", "ACTIVATE COUPON", $date, $hour]);

        }

    }
}
