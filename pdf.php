<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de p�gina
function Header()
{
    // Logo
    //$this->Image('logo_pb.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // T�tulo
    $this->Cell(30,10,'ImpactFilm',1,0,'C');
    // Salto de l�nea
    $this->Ln(20);
}

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // T�tulo
    $this->Cell(0,6,"Cap�tulo $num : $label",0,1,'L',true);
    // Salto de l�nea
    $this->Ln(4);
}

// Pie de p�gina
function Footer()
{
    // Posici�n: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // N�mero de p�gina
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo l�nea n�mero '.$i,0,1);
//$pdf->PrintChapter(1,'UN RIZO DE HUIDA','20k_c1.txt');	
$pdf->Output();
?>