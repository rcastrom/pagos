<?php

namespace App\Http\Controllers;


use App\Models\Pago;
use App\Models\Registro;
use App\Models\Escuela;
use App\Models\Referencia;
use App\Models\Camisa;
use App\Models\Correo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\PagosImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\EnvioPagadoMailable;
use Illuminate\Support\Facades\Mail;

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
            $hecho=$this->envio_individual($linea);
            return view('pagos.liberado')->with(compact('hecho'));
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
    public function mandar_correos(){
        //Quienes pagaron?
        $pagos=Pago::where('encontrado',0)->where('enviado',0)->distinct()->get();
        $i=0; $j=0; $errores=array();  $k=1;
        foreach ($pagos as $pago){
            $referencia=$pago->referencia;
            if($k<30){
                if(Referencia::where('referencia',$referencia)->count()>0){
                    Pago::where('referencia',$referencia)->update(['encontrado'=>1]);
                    $id_persona=Referencia::where('referencia',$referencia)->first();
                    $info=Registro::where('id',$id_persona->registro)->first();
                    $datos_correo = new Correo();
                    $datos_correo->appat=$info->appat;
                    $datos_correo->apmat=$info->apmat;
                    $datos_correo->nombre=$info->nombre;
                    $datos_correo->referencia=$referencia;
                    $datos_correo->save();
                    $id_registrado=$datos_correo->id;
                    Registro::where('id',$id_persona->registro)->update(['pagado'=>1]);
                    Mail::to($info->correo)->send(new EnvioPagadoMailable($datos_correo));
                    if(count(Mail::failures())>0){
                        $errores[$j]=$info->correo;
                        Pago::where('referencia',$referencia)->update(['enviado'=>2]);
                        $j++;
                      }else{
                    Pago::where('referencia',$referencia)->update(['enviado'=>1]);
                    $i++;
                    }
                    Correo::where('id',$id_registrado)->delete();
                }else{
                    Pago::where('referencia',$referencia)->update([
                        'encontrado'=>2
                    ]);
                }
                //Código 1 será que se localizó a quien le pertenece el pago
                //Código 2 será que no se sabe de quién es el pago
            }
            $k++;
        }
        return view('pagos.enviados')->with(compact('i','j','errores'));
    }
    public function envio_individual($referencia)
    {
        $id_persona = Referencia::where('referencia', $referencia)->first();
        $info = Registro::where('id', $id_persona->registro)->first();
        $datos_correo = new Correo();
        $datos_correo->appat = $info->appat;
        $datos_correo->apmat = $info->apmat;
        $datos_correo->nombre = $info->nombre;
        $datos_correo->referencia = $referencia;
        $datos_correo->save();
        $id_registrado = $datos_correo->id;
        Mail::to($info->correo)->send(new EnvioPagadoMailable($datos_correo));
        if (count(Mail::failures()) > 0) {
            $bandera=0;
        } else {
            $bandera=1;
        }
        Correo::where('id', $id_registrado)->delete();
        return $bandera;
    }
    public function listado1(){
        $ciudades=Escuela::select('id','tec')->orderBy('ciudad')->get();
        return view('pagos.listado1')->with(compact('ciudades'));
    }
    public function alta(){
        $escuelas=Escuela::select('id','tec')->orderBy('ciudad')->get();
        $camisetas=Camisa::select()->get();
        return view('pagos.alta')->with(compact('escuelas','camisetas'));
    }
    public function alta2(Request $request){
        request()->validate([
            'appat'=>'required',
            'nombre'=>'required',
            'correo'=>'required|email',
            'monto'=>'required|numeric'
        ],[
            'appat.required'=>'Debe indicar el primer apellido para realizar el registro',
            'nombre.required'=>'Debe indicar el nombre para realizar el registro',
            'correo.required'=>'Debe indicar el correo electrónico de la persona',
            'correo.email'=>'El correo que señala no tiene un formato válido',
            'monto.required'=>'Debe indicar el monto a pagar',
            'monto.numeric'=>'Indique el monto a pagar sin símbolos'
        ]);
        $datos=$request->collect();
        $registro = new Registro();
        $registro->nombre=$datos->get('nombre');
        $registro->appat=$datos->get('appat');
        $registro->apmat=$datos->get('apmat');
        $registro->correo=$datos->get('correo');
        $registro->status=$datos->get('status');
        $registro->tec=$datos->get('tec');
        $registro->camisa=$datos->get('camisa');
        $control=empty($datos->get('control'))?null:$datos->get('control');
        $registro->control=$control;
        $pago=$datos->get('accion')==1?1:0;
        $registro->pagado=$pago;
        $registro->save();
        $ultimo_registro=$registro->id;
        $anio=date('y');
        $ref1=$anio.$datos->get('tec').$datos->get('status');
        $txt="";
        for($i=1;$i<=6-strlen($ultimo_registro);$i++){
            $txt.="0";
        }
        $referencia=$ref1.trim($txt).$ultimo_registro;
        $monto=$datos->get('monto');
        $ref=new Referencia();
        $ref->registro=$ultimo_registro;
        $ref->referencia=$referencia;
        $ref->save();
        if($datos->get('accion')==1){
            $hecho=$this->envio_individual($referencia);
            return view('pagos.liberado')->with(compact('hecho'));
        }else{
            $persona=$datos->get('appat').' '.$datos->get('apmat').' '.$datos->get('nombre');
            $escuela=Escuela::where('id',$datos->get('tec'))->first();
            $tec=$escuela->tec;
            return view('pagos.alta2')->with(compact('referencia',
                'monto','persona','tec'));
        }
    }
    public function listado_ponentes(){
        $ponentes=Registro::where('pagado','1')->
           where(function ($q){
               $q->where('status','2')
                   ->orWhere('status','3');
           })->
            orderBy('appat')->
            orderBy('apmat')->
            orderBy('nombre')->
            get();
        return view('pagos.ponentes')->with(compact('ponentes'));
    }
}
