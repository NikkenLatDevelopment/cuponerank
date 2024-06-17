<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller{
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

        $url = env('REDIRECT_URL') . "$dataUrl";
        return $url;
        return redirect($url);
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
