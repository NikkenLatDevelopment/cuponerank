<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $pais = session('pais');
        $redimido = session('redimido');
        $tipo_u= session('tipo_u');
        $nombre_u= session('nombre_u');
      //  dd($pais,$redimido, $tipo_u, $nombre_u);

        $products = DB::table('products as p')
    ->join('warehouses_products as wp', 'p.id', '=', 'wp.product_id')
    ->select(
        'p.id',
        'p.sku', 
        'p.name', 
        'p.detail_image',  // Asegúrate de incluir esta línea si necesitas acceder a detail_image
        'p.description', 
        'wp.product_id',
        'wp.points',
        'wp.vc_to_suggested', 
        'wp.suggested_price', 
        'wp.country_id', 
        'wp.suggested_tax',
        'wp.applies_to_tv', 
        DB::raw('wp.suggested_price + wp.suggested_tax AS total'), 
        'wp.active_status'
    )
    ->where('wp.country_id', $pais)
    ->where('wp.active_status', 1)
   // ->where('p.sku', 'like', '%M')
    ->where('wp.applies_to_tv', 1)
    ->orderBy('p.id', 'asc')
    ->limit(20)
    ->get();
    
   // dd($products); 


        return view('products.index', compact('products' , 'redimido', 'tipo_u', 'nombre_u'));
    }
    public function checkout(Request $request)
    {
        $quantities = $request->input('quantity');
        $productIds = array_keys(array_filter($quantities, function ($qty) {
            return $qty > 0;
        }));
    
        $products = Product::whereIn('id', $productIds)->get()->map(function ($product) use ($quantities) {
            $product->quantity = $quantities[$product->id];
            return $product;
        });
        
        session()->forget('items');
        $items = "";
        for ($x=0; $x < sizeof($products); $x++) { 
            $items .= ";" . $products[$x]->sku . ":" . $products[$x]->quantity;
        }
        session(['items' => "$items"]);
    
        return view('products.checkout', compact('products'));
    }

    public function updateCuponStatus($encodedEmail)
    {
        session()->flush();
        // Decodificar el correo electrónico
        $email = base64_decode($encodedEmail);
        session(['email' => "$email"]);

        // Establecer la conexión 'SQL173' y realizar la consulta y actualización
        $result = DB::connection('SQL173')->table('PLAN_INFLUENCIA_MK.dbo.ubiSorprende_Cupones')
                    ->where('email', $email)
                    ->update(['redimido' => 1]);
    
        // Comprobar si la actualización fue exitosa y responder
        if ($result) {
          //  return response()->json(['success' => true, 'message' => 'Cupón redimido exitosamente.']);
            return view('products.index', compact('products'));
        } else {
            return response()->json(['success' => false, 'message' => 'No se encontró el cupón o ya estaba redimido.']);
        }
    }
         public function acceso($encodedEmail)
        {
           // dd("entra");
            session()->flush();
            // Decodificar el correo electrónico
            $email = base64_decode($encodedEmail);
            session(['email' => "$email"]);

            // Establecer la conexión 'SQL173' y realizar la consulta
            $cupon = DB::connection('SQL173')->table('LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones')
                ->where('email', $email)
                ->first();

                
            $pais = $cupon ? $cupon->pais : null;
            $redimido = $cupon ? $cupon->redimido : null;
            $tipo_u = $cupon ? $cupon->tipo_u : null;
            $nombre_u = $cupon ? $cupon->nombre_u : null;

            if($tipo_u === 'CLIENTE'){
                session(['pais' => $pais, 'redimido' => $redimido, 'tipo_u' => $tipo_u , 'nombre_u' => $nombre_u ]);

                if ($redimido < 1) {
                    
                    return redirect()->action([ProductController::class, 'index']);
    
                
                } else {
                    return response()->json(['success' => false, 'message' => 'No se encontró el cupón.']);
                }
            }
            else{
                session(['pais' => $pais, 'redimido' => $redimido, 'tipo_u' => $tipo_u , 'nombre_u' => $nombre_u ]);

                if ($redimido < 3) {
                    
                    return redirect()->action([ProductController::class, 'index']);
    
                
                } else {
                    return response()->json(['success' => false, 'message' => 'No se encontró el cupón.']);
                }
            }
               
            //   dd(['pais' => $pais, 'redimido' => $redimido]);

            
                
        }

}