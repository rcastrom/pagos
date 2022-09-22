<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    private $fpdf;
    public function __construct(){

    }
    public function crearPDF(Request $request){
        $this->fpdf=new Fpdf('P','mm','Letter');
        $this->fpdf->AddPage();
        $this->fpdf->SetAutoPageBreak(0);
        $imagen="/var/www/html/pagos/public/img/escala2022.jpg";
        $x=30;
        $y=90;
        $this->fpdf->Image($imagen,60,10,105,85);
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->SetXY($x,$y-6);
        $this->fpdf->Cell(150,4,"HOJA DE PAGO PARA CONGRESO ESCALA 2022",0,1,'C');
        $this->fpdf->SetXY($x,$y+6);
        $this->fpdf->Cell(115,4,"Nombre: ".utf8_decode($request->get('persona')),0,1,'L');
        //$this->fpdf->SetFont('Arial','',12);
        $this->fpdf->SetXY($x,$y+12);
        $this->fpdf->Cell(115,4,utf8_decode('Institución: ').$request->get('escuela'),0,1,'L');
        $this->fpdf->SetXY($x,$y+18);
        $this->fpdf->Cell(115,4,'Banco: ScotiaBank',0,1,'L');
        $this->fpdf->SetXY($x,$y+24);
        $this->fpdf->Cell(115,4,'Cuenta: 13003338223',0,1,'L');
        $this->fpdf->SetXY($x,$y+30);
        $this->fpdf->Cell(115,4,'CLABE: 044028130033382234',0,1,'L');
        $this->fpdf->SetXY($x,$y+36);
        $this->fpdf->Cell(115,4,"Referencia: ".$request->get('ref'),0,1,'L');
        $this->fpdf->SetXY($x,$y+42);
        $this->fpdf->Cell(115,4,"Monto a pagar: $".number_format($request->get('monto'),2,".",","),0,1,'L');
        $this->fpdf->Output();
        exit();
    }
}
