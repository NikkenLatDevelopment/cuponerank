<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\checkoutController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');


Route::get('/panel', [PanelController::class, 'index'])->name('panel.index')->middleware('signed');
Route::post('/panel/searchCoupon', [PanelController::class, 'searchCoupon'])->name('panel.search');
Route::post('/panel/updateCoupon', [PanelController::class, 'updateCoupon'])->name('panel.update');
Route::post('/panel/getAccess', [PanelController::class, 'getAccess']);
//Route::get('/redimir', [checkoutController::class, 'redimir'])->name('redimir')->middleware('signed');


Route::get('/test-db', function () {
    // Prueba de conexión a la base de datos local y recuperación de datos
    try {
        $pdoLocal = DB::connection()->getPdo();
        echo "Conexión a la base de datos local exitosa. ";
        // Recuperar datos de la tabla ubiSorprende_Cupones de la conexión local
        $cuponesLocal = DB::table('ubiSorprende_Cupones')->get();
        echo "Datos recuperados de la base local: " . $cuponesLocal->toJson();
    } catch (\Exception $e) {
        echo "No se pudo conectar a la base de datos local o recuperar datos: " . $e->getMessage();
    }

    echo "<br>"; // Para separar las respuestas de las conexiones

    // Prueba de conexión a la base de datos remota y recuperación de datos
    try {
        $pdoRemote = DB::connection('SQL173')->getPdo();
        echo "Conexión a la base de datos remota exitosa. ";
        // Recuperar datos de la tabla ubiSorprende_Cupones de la conexión remota
       // $cuponesRemote = DB::connection('SQL173')->table('ubiSorprende_Cupones')->get();
       $coupon = DB::connection('SQL173')->select('SELECT * FROM LAT_NIKKEN_TV.dbo.ubiSorprende_Cupones'); 
       dd($coupon);
    } catch (\Exception $e) {
        echo "No se pudo conectar a la base de datos remota o recuperar datos: " . $e->getMessage();
    }
});

Route::get('/redimir-cupon/{encodedEmail}', [ProductController::class, 'updateCuponStatus']);

Route::post('/getCheckout', [checkoutController::class, 'getCheckout'])->name('getCheckout');
Route::post('/getAccess', [checkoutController::class, 'getAccess']);
Route::get('/redimir', [checkoutController::class, 'redimir'])->name('redimir')->middleware('signed');
