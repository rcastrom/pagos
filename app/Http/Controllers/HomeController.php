<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Escuela;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pagos.inicio');
    }
    public function registro(){
       $registros_pagados=Escuela::select('escuelas.tec',DB::raw('count(registros.id) as registrados'))
           ->leftJoin('registros','escuelas.id','=','registros.tec')
           ->where('pagado',1)
           ->groupBy('escuelas.tec')
           ->groupBy('ciudad')
           ->orderBy('ciudad')
           ->get();
        $registros_sin_pagar=Escuela::select('escuelas.tec',DB::raw('count(registros.id) as registrados'))
            ->leftJoin('registros','escuelas.id','=','registros.tec')
            ->where('pagado',0)
            ->groupBy('escuelas.tec')
            ->groupBy('ciudad')
            ->orderBy('ciudad')
            ->get();
       return view('pagos.registros')->with(compact('registros_pagados',
           'registros_sin_pagar'));
    }
    public function pago1(){
        return view('pagos.liberar1');
    }
    public function pago2(Request $request){

    }
}
