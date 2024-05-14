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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
