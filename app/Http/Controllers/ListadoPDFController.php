<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\Registro;
use App\Models\Referencia;
use App\Models\Pago;
use App\Models\Camisa;
use Illuminate\Support\Facades\DB;

class ListadoPDFController extends Controller
{
    private $fpdf;

    public function __construct()
    {

    }
    public function crearPDF(Request $request){
        //Aprovecho para depurar la BD
        $tec=$request->get('tec');
        $consulta=$request->get('consulta');
        $registros=Registro::where('tec',$tec)->get();
        foreach ($registros as $registro){
            if(Referencia::where('registro',$registro->id)->count()==0){
                Registro::where('id',$registro->id)->delete();
            }
        }
        $this->fpdf=new Fpdf('P','mm','Letter');
        $this->fpdf->AddPage();
        $this->fpdf->SetAutoPageBreak(1,25);
        $imagen="/var/www/html/pagos/public/img/escala2022.jpg";
        $x=30;
        $y=30;
        $escuela=Escuela::where('id',$tec)->first();
        $this->fpdf->Image($imagen,80,10,45,25);
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->SetXY($x,$y);
        $this->fpdf->Cell(150,4,"LISTADO DE ESTUDIANTES REGISTRADOS PARA CONGRESO ESCALA 2022",0,1,'C');
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell(150,4,utf8_decode("TECNOLÓGICO: ").$escuela->tec,0,1,'L');
        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Ln(4);
        if($consulta==2){
            $this->fpdf->Cell(10,4,"NO",1,0,'L');
            $this->fpdf->Cell(90,4,"NOMBRE",1,0,'L');
            $this->fpdf->Cell(27,4,"REFERENCIA",1,0,'L');
            $this->fpdf->Cell(20,4,"PAGADO?",1,0,'L');
            $this->fpdf->Cell(20,4,"CORREO?",1,1,'L');
            $this->fpdf->SetFont('Helvetica','',9);
            $registros2=Registro::where('tec',$tec)->orderBy('appat')
                ->orderBy('apmat')
                ->orderBy('nombre')
                ->get();
            $i=1;
            foreach ($registros2 as $registro){
                $persona=$registro->appat.' '.$registro->apmat.' '.$registro->nombre;
                $pago=$registro->pagado==1?"SI":"NO";
                $this->fpdf->Cell(10,4,$i,1,0,'L');
                $this->fpdf->Cell(90,4,utf8_decode($persona),1,0,'L');
                $datos_referencia=Referencia::where('registro',$registro->id)->first();
                $this->fpdf->Cell(27,4,$datos_referencia->referencia,1,0,'L');
                $this->fpdf->Cell(20,4,$pago,1,0,'L');
                if(Pago::where('referencia',$datos_referencia->referencia)->count()>0){
                    $correo=Pago::where('referencia',$datos_referencia->referencia)->first();
                    $enviado=$correo->enviado==1?"SI":"NO";
                    $this->fpdf->Cell(20,4,$enviado,1,1,'L');
                }else{
                    $this->fpdf->Cell(20,4,$pago,1,1,'L');
                }
                $i++;
            }
        }else{
            $this->fpdf->Cell(10,4,"NO",1,0,'L');
            $this->fpdf->Cell(100,4,"NOMBRE",1,0,'L');
            $this->fpdf->Cell(27,4,"REFERENCIA",1,0,'L');
            $this->fpdf->Cell(18,4,"CAMISETA",1,1,'C');
            $this->fpdf->SetFont('Helvetica','',9);
            $registros2=Registro::where('tec',$tec)
                ->where('pagado',1)
                ->orderBy('appat')
                ->orderBy('apmat')
                ->orderBy('nombre')
                ->get();
            $i=1;
            foreach ($registros2 as $registro){
                $persona=$registro->appat.' '.$registro->apmat.' '.$registro->nombre;
                $this->fpdf->Cell(10,4,$i,1,0,'L');
                $this->fpdf->Cell(100,4,utf8_decode($persona),1,0,'L');
                $datos_referencia=Referencia::where('registro',$registro->id)->first();
                $this->fpdf->Cell(27,4,$datos_referencia->referencia,1,0,'L');
                $camiseta=Camisa::where('id',$registro->camisa)->first();
                $this->fpdf->Cell(18,4,$camiseta->talla,1,1,'C');
                $i++;
            }
            $this->fpdf->Ln(6);
            $this->fpdf->Cell(12,4,"TALLA",1,0,'C');
            $this->fpdf->Cell(18,4,"CANTIDAD",1,1,'C');
            $cant_camisas=Camisa::select('camisas.talla',DB::raw('COUNT(registros.id) AS cantidad'))->
            leftJoin('registros','camisas.id','registros.camisa')->
            where('registros.pagado',1)->
            where('registros.tec',$tec)->
            groupBy('camisas.talla')->
            orderBy('talla')->
            get();
            foreach ($cant_camisas as $camisetas){
                $this->fpdf->Cell(12,4,$camisetas->talla,1,0,'C');
                $this->fpdf->Cell(18,4,$camisetas->cantidad,1,1,'C');
            }
        }
        $this->fpdf->Output();
        exit();
    }
}
