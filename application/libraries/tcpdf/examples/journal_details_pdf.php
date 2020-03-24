<?php

date_default_timezone_set('UTC');

//Include the main TCPDF library
require_once('./tcpdf/examples/tcpdf_include.php');

//Initial PDF format declaration
$orientation = 'P';
$unit = 'mm';
$format = 'A4';
$unicode = true;
$encoding = 'UTF-8';

$pdf = new TCPDF($orientation, $unit, $format, $unicode, $encoding);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

//$fname = $CI->session->userdata('fname');
//$lname = $CI->session->userdata('lname');

//Set the font
$pdf->SetFont('helvetica', '', 10);

//Set the coordinates
$x = 10;
$y = 10;

$style = array('width' => 0, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));


$pdf->AddPage();



$pdf->SetFont('helvetica', 'B', 10);
$pdf->Text($x, $y+5,"CREATED BY:", 0, false);
// enter value here..
$pdf->Text($x+100, $y+5,"STATUS:", 0, false);
// enter value here..
$pdf->Text($x, $y+12, "DATE CREATED:", 0, false);
// enter value here..

$pdf->Line($x, $y+25, $x+190, $y+25, $style);

$pdf->Text($x, $y+27, "TITLE:", 0, false);
// set color for background
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(95, 5, "", 1, 'L', 1, 0, $x+1, $y+32, true);
// enter value here..
$pdf->Text($x+100, $y+27, "WORK PLAN TYPE:", 0, false);
$pdf->MultiCell(87, 5, "", 1, 'L', 1, 0, $x+101, $y+32, true);
// enter value here..

//$pdf->Line($x, $y+41, $x+190, $y+41, $style);
$y = $y - 3;

$pdf->Text($x, $y+42, "ACCOUNT NAME:", 0, false);
$pdf->MultiCell(95, 5, "", 1, 'L', 1, 0, $x+1, $y+47, true);
// enter value here..
$pdf->Text($x+100, $y+42, "COVERAGE TYPE:", 0, false);
$pdf->MultiCell(87, 5, "", 1, 'L', 1, 0, $x+101, $y+47, true);
// enter value here..

$pdf->Text($x, $y+55, "DATE FROM:", 0, false);
$pdf->MultiCell(57, 5, "", 1, 'L', 1, 0, $x+1, $y+60, true);
// enter value here..
$pdf->Text($x+63, $y+55, "TIME FROM:", 0, false);
$pdf->MultiCell(61, 5, "", 1, 'L', 1, 0, $x+64, $y+60, true);
// enter value here..
$pdf->Text($x+130, $y+55, "FREQUENCY/REPEAT:", 0, false);
$pdf->MultiCell(57, 5, "", 1, 'L', 1, 0, $x+131, $y+60, true);
// enter value here..

$pdf->Text($x, $y+68, "TO: ", 0, false);
$pdf->MultiCell(57, 5, "", 1, 'L', 1, 0, $x+1, $y+73, true); 
// enter value here..
$pdf->Text($x+63, $y+68, "TO:", 0, false);
$pdf->MultiCell(61, 5, "", 1, 'L', 1, 0, $x+64, $y+73, true);
// enter value here..
$pdf->Text($x+130, $y+68, "OCCURRENCE:", 0, false);
$pdf->MultiCell(57, 5, "", 1, 'L', 1, 0, $x+131, $y+73, true);
// enter value here..

$pdf->Line($x, $y+82, $x+190, $y+82, $style);

$pdf->Text($x, $y+84, "LOCATION:", 0, false);
$pdf->MultiCell(187, 5, "", 1, 'L', 1, 0, $x+1, $y+89, true);
// enter value here..

$pdf->Line($x, $y+98, $x+190, $y+98, $style);
$y = $y + 3;

$pdf->SetFont('helvetica', '', 13);
$pdf->Text($x, $y+97, "COVERAGE DETAILS", 0, false);

$pdf->SetFont('helvetica', 'B', 10);

$pdf->Text($x+42, $y+105, "OBJECTIVE", 0, false);
$pdf->Text($x+117, $y+105, "ACTUAL", 0, false);

$pdf->Text($x, $y+111.5, "SALES: ", 0, false);
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+43, $y+111, true);
// enter value here..
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+118, $y+111, true); 
// enter value here..


$pdf->Text($x, $y+119.5, "FOR COLLECTION: ", 0, false);
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+43, $y+119, true);
// enter value here..
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+118, $y+119, true); 
// enter value here..

$pdf->Text($x, $y+127.5, "RPS: ", 0, false);
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+43, $y+127, true);
// enter value here..
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+118, $y+127, true); 
// enter value here..

$pdf->Text($x, $y+140.5, "PARTICIPANTS: ", 0, false);
$pdf->MultiCell(70, 5, "", 1, 'L', 1, 0, $x+53, $y+140, true);

$pdf->Output('journal_details_pdf.pdf');



?>