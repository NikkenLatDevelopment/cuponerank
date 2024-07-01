<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller{
    /*    
    public function getCheckout(){
        $sku = session('items');
        $items = substr($sku, 1);
        $email = session('email');
        $country = \DB::connection('mysql')->table('users')->select('country_id')->where('email', '=', $email)->get();
        $country = $country[0]->country_id;
        
        $discount_abi = "S";
        $env = 1;
        $type = 'cb';

        $dataUrl = base64_encode("$email&$items&$discount_abi&$env&$country&$type");

        $url = "https://nikkenlatam.com/services/checkout/testredirect.php?app=cuponera&data=$dataUrl";
        
        $updatedRows = \DB::connection('SQL173')->table('LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones')
        ->where('email', $email)
        ->increment('redimido');

        if ($updatedRows) {
            // Redirigir a la URL generada
            return redirect($url);
        } else {
            // Manejar el caso en el que no se encontró el registro o la actualización falló
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el campo redimido.']);
        }
        //return $url;
       // return redirect($url);
    }
*/public function getCheckout() {
    $sku = session('items');
    $items = substr($sku, 1);
    $email = session('email');
    $country = \DB::connection('mysql')->table('users')->select('country_id')->where('email', '=', $email)->get();
    if($country){
        $country = $country[0]->country_id;
        $discount_abi = "S";
        $env = 1;
        $type = 'cb';    
        $dataUrl = base64_encode("$email&$items&$discount_abi&$env&$country&$type");    
        $url = "https://nikkenlatam.com/services/checkout/testredirect.php?app=cuponera&data=$dataUrl";
        $updatedRows = \DB::connection('SQL173')->table('LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones')
        ->where('email', $email)
        ->increment('redimido');
        return redirect($url);
    }else{
        $response = $this->createClientUser($email);
        if ($response == true){    
        $country = \DB::connection('mysql')->table('users')->select('country_id')->where('email', '=', $email)->get();
            $country = $country[0]->country_id;
            $discount_abi = "S";
            $env = 1;
            $type = 'cb';    
            $dataUrl = base64_encode("$email&$items&$discount_abi&$env&$country&$type");    
            $url = "https://nikkenlatam.com/services/checkout/testredirect.php?app=cuponera&data=$dataUrl";
            $updatedRows = \DB::connection('SQL173')->table('LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones')
            ->where('email', $email)
            ->increment('redimido');
            return redirect($url);
        }
        else{
            return "No se pudo crear el registro, comunicate con servicio a cliente";
        }
        }   

        }
        
        private function createClientUser($email) {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://testmicrositios.nikkenlatam.com/createClientUser', [
                'form_params' => [
                    'email' => $email
                ]
            ]);
        }


    public function getAccess(){
        $email = request()->e;
        $url = \URL::temporarySignedRoute("redimir", now()->addMinutes(1), ['email' => "$email"]);
        return $url;
    }

    public function redimir(){
        $email = request()->email;
        return "hola: " . $email;
    }
}