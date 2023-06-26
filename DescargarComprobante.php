<?php
require('fpdf.php'); 


$pdf = new FPDF('P','cm', array(13, 13));

$pdf->AddPage();
$pdf->SetAutoPageBreak('false');

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(.5,.7);
$pdf->Cell(2,.2,'RFC emisor:',0,2);
$pdf->Cell(2,.2,'Nombre emisor:',0,2);
$pdf->Cell(2,.2,'',0,2);
$pdf->Cell(2,.2,'RFC receptor:',0,2);
$pdf->Cell(2,.2,'Nombre receptor:',0,2);
$pdf->Cell(2,.2,'Codigo postal del',0,2);
$pdf->Cell(2,.2,'receptor:',0,2);
$pdf->Cell(2,.2,'Regimen fiscal',0,2);
$pdf->Cell(2,.2,'receptor:',0,2);
$pdf->Cell(2,.2,'Uso CFDI:',0,2);
$pdf->Cell(2,.2,'',0,2);
$pdf->SetFont('Arial','B', 6);
$pdf->Cell(2,.2,'Conceptos',0,2);

$pdf->SetFont('Arial','', 4);
$pdf->SetXY(2.2,.7);
$pdf->Cell(2,.2,'HELA6804222T0',0,2); //RFC emisor
$pdf->Cell(2,.2,'ALEJANDRA GUADALUPE HERNANDEZ',0,2);//Nombre emisor
$pdf->Cell(2,.2,'LEON',0,2);
$pdf->Cell(2,.2,'ASR071203AYA',0,2);//RFC receptor:
$pdf->Cell(2,.2,'ASOCIADOS SAN RAFAEL',0,2);//Nombre receptor:
$pdf->Cell(2,.2,'76258',0,2);//Codigo postal del
$pdf->Cell(2,.2,'',0,2);//receptor:
$pdf->Cell(2,.2,'ACTIVIDADES AGRICOLAS, GANADERAS, SILVICOLAS Y',0,2);//Regimen fiscal
$pdf->Cell(2,.2,'PESQUERAS',0,2);//receptor:
$pdf->Cell(2,.2,'GASTOS EN GENERAL',0,2);//Uso CFDI:

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(6.5,.7);
$pdf->Cell(2,.2,'Folio fiscal:',0,2);
$pdf->Cell(2,.2,'No. de serie del CSD:',0,2);
$pdf->Cell(2,.2,'Codigo postal, fecha y hora de',0,2);
$pdf->Cell(2,.2,'emision:',0,2);
$pdf->Cell(2,.2,'Efecto de comprobante:',0,2);
$pdf->Cell(2,.2,'Regimen fiscal:',0,2);
$pdf->Cell(2,.2,'Exportacion:',0,2);

$pdf->SetFont('Arial','', 4);
$pdf->SetXY(9,.7);
$pdf->Cell(2,.2,'C9E7EC04-6095-45E3-ABC0-D5644D3C12D7',0,2);//Folio fiscal:
$pdf->Cell(2,.2,'00001000000413925402',0,2);//No. de serie del CSD:
$pdf->Cell(2,.2,'76260 2023-01-07 11:35:55',0,2);//Codigo postal, fecha y hora de
$pdf->Cell(2,.2,'',0,2);//emision:
$pdf->Cell(2,.2,'Ingreso',0,2);//Efecto de comprobante:
$pdf->Cell(2,.2,'Regimen Simplificado de Confianza',0,2);//Regimen fiscal:
$pdf->Cell(2,.2,'No aplica',0,2);//Exportacion:

$pdf->SetFont('Arial','', 3.5);
$pdf->SetFillColor(191,191,191);
$pdf->SetXY(.5,3.5);
$pdf->Multicell(1.3,.25,"Clave del producto y/o servicio",1,0,"C",true);
$pdf->SetXY(1.8,3.5); 
$pdf->Cell(1.3,.5,'No. Identificacion',1,0,"C", true);
$pdf->Cell(1.3,.5,'Cantidad',1,0,"C", true);
$pdf->Cell(1.3,.5,'Clave de unidad',1,0,"C", true);
$pdf->Cell(1.3,.5,'Unidad',1,0,"C", true);
$pdf->Cell(1.3,.5,'Valor Unitario',1,0,"C", true);
$pdf->Cell(1.3,.5,'Importe',1,0,"C", true);
$pdf->Cell(1.3,.5,'Descuento',1,0,"C", true);
$pdf->Cell(1.3,.5,'Objeto impuesto',1,0,"C", true);

$pdf->SetFont('Arial','', 3.5);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(.5,4);
$pdf->Cell(1.3,.3,'10121503',1,0,"C", true);//Clave del producto y/o servicio
$pdf->Cell(1.3,.3,'',1,0,"C", true);//No. Identificacion
$pdf->Cell(1.3,.3,'66171.5878',1,0,"C", true);//Cantidad
$pdf->Cell(1.3,.3,'KGM',1,0,"C", true);//Clave de unidad
$pdf->Cell(1.3,.3,'Kilogramo',1,0,"C", true);//Unidad
$pdf->Cell(1.3,.3,'0.95000',1,0,"C", true);//Valor Unitario
$pdf->Cell(1.3,.3,'62,863.00',1,0,"C", true);//Importe
$pdf->Cell(1.3,.3,'',1,0,"C", true);//Descuento
$pdf->Cell(1.3,.3,'No objeto de impuesto',1,0,"C", true);//Objeto impuesto

$pdf->SetFont('Arial','B', 3.5);
$pdf->SetXY(.5,4.3);
$pdf->SetFillColor(191,191,191);
$pdf->Cell(1.3,.3,'Descripcion',1,0,"C", true);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(5.2,.3,'SILO DE MAIZ',1,0,"", true);//Descripcion

$pdf->SetFillColor(191,191,191);
$pdf->SetFont('Arial','B', 3.5);
$pdf->SetXY(.5,4.6);
$pdf->Cell(2,.3,'Numero de pedimiento',1,0,"C", true);
$pdf->Cell(2,.3,'Numero de cuenta predial',1,0,"", true);

$pdf->SetFillColor(255,255,255);
$pdf->SetXY(.5,4.9);
$pdf->Cell(2,.3,'',1,0,"C", true);//Numero de pedimiento
$pdf->Cell(2,.3,'',1,0,"", true);//Numero de cuenta predial

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(.5,5.5);
$pdf->Cell(2,.3,'Moneda:',0,2,);
$pdf->Cell(2,.3,'Forma de pago:',0,2,);
$pdf->Cell(2,.3,'Metodo de pago:',0,2,);

$pdf->SetFont('Arial','', 5);
$pdf->SetXY(2.2,5.5);
$pdf->Cell(2,.3,'Peso Mexicano',0,2,);//Moneda
$pdf->Cell(2,.3,'Cheque Nominativo',0,2,);//Forma de pago
$pdf->Cell(2,.3,'Pago en una sola exhibicion',0,2,);//Metodo de pago

$pdf->SetFont('Arial','B', 5);
$pdf->SetXY(7,5.5);
$pdf->Cell(2,.3,'Subtotal:',0,2,);
$pdf->Cell(2,.3,'Total:',0,2,);

$pdf->SetFont('Arial','', 5);
$pdf->SetXY(10.2,5.5);
$pdf->Cell(2,.3,'$62,863.00',0,2,"R");//Subtotal
$pdf->SetFont('Arial','B', 5);
$pdf->Cell(2,.3,'$62,863.00',0,2,"R");//Total

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(.5,6.8);
$pdf->Cell(2,.3,'Sello digital del CFDI:',0,2);
$pdf->SetFont('Arial','', 4);
$pdf->Multicell(12,.2,"JFASÑLFJAÑSLFDJSAÑLKFJSALKFJSLAKFJÑSLAFJSAÑLKFJDSALKDFJÑASLKFJSÑALKFJASLKFJASÑLFJASÑLKFJÑASLFJAÑLJDLKSJFÑLKSAFJAÑLSKFJÑLKSAFJÑSALFJSAÑLFJASÑLKFJALSÑFJASÑLKFJSAÑLKFJKAÑSLFJKLSAFJSALFJSALFJÑSADLFJDAÑSLFKJSAÑLFJAÑSLFJÑLSAFJSALKÑFJSAJFSAFJDSAÑLFJKSAÑFJSAÑLFJKASÑLFJÑSAFJKÑSALFJÑKASLFJASFJSÑAL",0,2);
$pdf->Cell(2,.3,'',0,2);
//Sello digital del CFDI:   

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(.5,7.8);
$pdf->Cell(2,.3,'Sello digital del SAT',0,2);
$pdf->SetFont('Arial','', 4);
$pdf->Multicell(12,.2,"JFASÑLFJAÑSLFDJSAÑLKFJSALKFJSLAKFJÑSLAFJSAÑLKFJDSALKDFJÑASLKFJSÑALKFJASLKFJASÑLFJASÑLKFJÑASLFJAÑLJDLKSJFÑLKSAFJAÑLSKFJÑLKSAFJÑSALFJSAÑLFJASÑLKFJALSÑFJASÑLKFJSAÑLKFJKAÑSLFJKLSAFJSALFJSALFJÑSADLFJDAÑSLFKJSAÑLFJAÑSLFJÑLSAFJSALKÑFJSAJFSAFJDSAÑLFJKSAÑFJSAÑLFJKASÑLFJÑSAFJKÑSALFJÑKASLFJASFJSÑAL",0,2);
//Sello digital del SAT

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(3,8.8);
$pdf->Cell(2,.3,'Cadena Original del complemento de certificacion digital del SAT:',0,2);
$pdf->SetFont('Arial','', 4);
$pdf->Multicell(9.5,.2,"JFASÑLFJAÑSLFDJSAÑLKFJSALKFJSLjfadskdfsakfjkasfjlkdsajñlkfasdjñfdsajkfdsajkdfsjkfdasjñlkfdsjñlkfdsjñlkfdsjñlkfdsjñlkfdsjñlkfdjfdakjlkAKFJÑSLAFJSAÑLKFJDSALKDFJÑASLKFJSÑALKFJASLKFJASÑLFJASÑLKFJÑASLFJAÑLJDLKSJFÑLKSAFJAÑLSKFJÑLKSAFJÑSALFJSAÑLFJASÑLKFJALSÑFJASÑLKFJSAÑLKFJKAÑSLFJKLSAFJSALFJSALFJÑSADLFJDAÑSLFKJSAÑLFJAÑSLFJÑLSAFJSALKÑFJSAJFSAFJDSAÑLFJKSAÑFJSAÑLFJKASÑLFJÑSAFJKÑSALFJÑKASLFJASFJSÑAL",0,2);
//Cadena Original del complemento de certificacion digital del SAT:

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(3,10);
$pdf->Cell(2.5,.3,'RFC del proveedor de certificacion:',0,0);
$pdf->SetFont('Arial','', 4);
$pdf->Cell(2,.3,'SAT970701NN3',0,0);//RFC del proveedor de certificacion:
$pdf->SetFont('Arial','B', 4);
$pdf->Cell(2.5,.3,'Fecha y hora de certificacion:',0,0);
$pdf->SetFont('Arial','', 4);
$fecha_actual = date("d-m-Y h:i:s");
$pdf->Cell(2,.3,$fecha_actual,0,0);//Fecha y hora de certificacion:

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(3,10.3);
$pdf->Cell(2.5,.3,'No. de serie del certificado SAT:',0,0);
$pdf->SetFont('Arial','', 4);
$pdf->Cell(2,.3,'00001000000504465028',0,0);//No. de serie del certificado SAT:

$pdf->SetFont('Arial','B', 4);
$pdf->SetXY(5.5,12);
$pdf->Cell(2.5,.3,'Este documento es una representacion impresa de un CFDI',0,0,"C");

$pdf->Image('images/QR.png',.8,9,2,2);

$pdf->Output();
?>