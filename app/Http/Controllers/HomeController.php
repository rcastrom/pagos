<?php

namespace App\Http\Controllers;


use App\Models\Registro;
use App\Models\Escuela;
use App\Models\Referencia;
use App\Models\Camisa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\PagosImport;
use Maatwebsite\Excel\Facades\Excel;

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
    public function datos_persona($id_registro){
        $data=DB::select("CALL datos_persona('$id_registro');");
        return $data;
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
    public function buscar(){
        return view('pagos.buscar');
    }
    public function busqueda(Request $request){
        request()->validate([
            'dato'=>'required'
        ],[
            'dato.required'=>'Debe indicar algún apellido para llevar a cabo la búsqueda',
        ]);
        $dato=$request->get('dato');
        $personas = Registro::select('registros.id','appat','apmat','nombre','escuelas.tec','escuelas.ciudad')->
            join('escuelas','registros.tec','escuelas.id')->
            where('appat',strtoupper($dato))->
            orWhere('apmat',strtoupper($dato))->
            orWhere('nombre',strtoupper($dato))->
            orderBy('ciudad')->
            orderBy('appat')->
            orderBy('apmat')->
            orderBy('nombre')->
            get();
        return view('pagos.buscar2')->with(compact('personas'));
    }
    public function eliminar1($control1){
        $id_persona=base64_decode($control1);
        if(Referencia::where('registro',$id_persona)->count()>0){
            $persona = $this->datos_persona($id_persona);
            return view('pagos.eliminar2')->with(compact('persona'));
        }else{
            Registro::where('id',$id_persona)->delete();
            return view('pagos.error');
        }
    }
    public function pago1($control1){
        $id_persona=base64_decode($control1);
        if(Referencia::where('registro',$id_persona)->count()>0){
            $persona = $this->datos_persona($id_persona);
            return view('pagos.liberar2')->with(compact('persona'));
        }else{
            Registro::where('id',$id_persona)->delete();
            return view('pagos.error');
        }
    }
    public function imprimir1($control1){
        $id_persona=base64_decode($control1);
        if(Referencia::where('registro',$id_persona)->count()>0){
            $persona = $this->datos_persona($id_persona);
            return view('pagos.imprimir2')->with(compact('persona'));
        }else{
            Registro::where('id',$id_persona)->delete();
            return view('pagos.error');
        }
    }
    public function pago2(Request $request){
        $linea=base64_decode($request->get('referencia'));
        $liberar=$request->get('continuar');
        if($liberar){
            $id_registro=Referencia::where('referencia',$linea)->first();
            Registro::where('id',$id_registro->registro)->update([
                'pagado'=>1
            ]);
            return view('pagos.liberado');
        }
        return view('pagos.inicio');
    }
    public function eliminar2(Request $request){
        $linea=base64_decode($request->get('referencia'));
        $liberar=$request->get('continuar');
        if($liberar){
            $id_registro=Referencia::where('referencia',$linea)->first();
            Registro::where('id',$id_registro->registro)->delete();
            return view('pagos.eliminado');
        }
        return view('pagos.inicio');
    }
    public function camisetas(){
        $ensenadas=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',1)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
        $mexicalis=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',2)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
        $tijuanas=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',3)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
        $muleges=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',4)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
        $otros=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',5)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
        return view('pagos.camisas')->with(compact('ensenadas',
            'mexicalis','tijuanas','muleges','otros'));
    }
    public function importForm(){
        return view('pagos.import');
    }
    public function importar(Request $request){
        $import = new PagosImport();
        Excel::import($import, \request()->file('pagos'));
        return view('pagos.import',['numRows'=>$import->getRowCount()]);
    }
}
