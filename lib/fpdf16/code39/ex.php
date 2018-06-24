<?php
define('FPDF_FONTPATH','font/');
require('code39.php');

$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(2,60,'0000001',1,5);
$pdf->Output();
?>
