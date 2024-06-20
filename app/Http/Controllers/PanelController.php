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

            $coupon = DB::connection('SQL173')->select('SELECT * FROM LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones WHERE codigoCupon = ?', [$request->coupon]);
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
        $redimido = $request->redimido - 1;
        try{
            $coupon = DB::connection('SQL173')->update('UPDATE LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones set redimido = '.$redimido.' WHERE codigoCupon = ?', [$request->coupon]);
            if ($coupon > 0) {
                //echo "Actualización satisfactoria. Número de filas afectadas: $affected";
                $agentName = "test";
                $this->saveLog($request->coupon,$agentName,$request->agentEmail,$request->userEmail,"ACTIVATE COUPON",date('Y-m-d'),date('H:i:s'));
                return response()->json(['success' => 'Redimido.'], 200);       
            } else {
                return response()->json(['error' => 'Problema al redimir.'], 404);
            }
        } catch(Excepion $e) {
            return response()->json(['error' => 'Hubo un problema '.$e], 500);
        }

    }

    public function getAccess(){

        try{
            $email = request()->e;
            $decodedCod = base64_decode($email);
            $url = \URL::temporarySignedRoute("panel.index", now()->addMinutes(1), ['e' => "$email"]);
            return $url;
        } catch(Excepion $e) {
            return "error";
        }

    }

    public function saveLog($coupon, $agentName, $agentEmail, $clientEmail, $action, $date, $hour){        
        
        if($action == "SEARCH COUPON"){
            //dd("saveLog",$coupon,$agentEmail);
            try{
                DB::connection('SQL173')->insert('
                    INSERT INTO LAT_NIKKEN_TV.dbo.Log_Panel_UBI (codigo, nombreAgente, emailAgente, emailUser, accion, fecha, hora)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ', [$coupon, $agentName, $agentEmail, "", "SEARCH COUPON", $date, $hour]);
            } catch (\Illuminate\Database\QueryException $ex) {
                // Manejar la excepción
                echo "Error al insertar: " . $ex->getMessage();
            }
        }else if($action == "ACTIVATE COUPON"){

            try{
                DB::connection('SQL173')->insert('
                    INSERT INTO LAT_NIKKEN_TV.dbo.Log_Panel_UBI (codigo, nombreAgente, emailAgente, emailUser, accion, fecha, hora)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ', [$coupon, $agentName, $agentEmail, "", "ACTIVATE COUPON", $date, $hour]);
            } catch (\Illuminate\Database\QueryException $ex) {
                // Manejar la excepción
                echo "Error al insertar: " . $ex->getMessage();
            }

        }

    }
}
