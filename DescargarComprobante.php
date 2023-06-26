<?php
require('fpdf.php');
include("Controlador.php"); 
$id=$_POST['ID'];

// SELECT e.RFC, e.Nombre, r.RFC, r.Nombre, r.DomicilioFiscalReceptor, r.RegimenFiscalReceptor, r.UsoCFDI,com.ComprobanteID, com.Serie, com.Codigo_Postal, com.Fecha, com.TipoDeComprobante, e.RegimenFiscal, com.Exportacion,con.ClaveProdServ, con.NoIdentificacion, con.cantidad, con.ClaveUnidad, con.Unidad, con.ValorUnitario,con.Importe, con.Descuento, con.ObjetoImp, con.Descripcion,com.Moneda, com.FormaPago, com.MetodoPago, com.SubTotal, com.Total 
// FROM comprobantes com
// JOIN comprobantes_conceptos com_con
// 	ON com_con.ComprobanteID = com.ComprobanteID
// JOIN conceptos con
// 	ON con.ConceptoID=com_con.ConceptosID
// JOIN emisor e
// 	ON e.EmisorID=com.EmisorID
// JOIN receptor r
// 	ON r.ReceptorID=com.ReceptorID;
            //0         1       2       3               4                           5                       6          7            8           9                   10          11                      12          13                  14              15                          16          17          18          19                      20      21          22              23                  24      25              26              27              28          
$SQL="SELECT e.RFC, e.Nombre, r.RFC, r.Nombre, r.DomicilioFiscalReceptor, r.RegimenFiscalReceptor, r.UsoCFDI,com.ComprobanteID, com.Serie, com.Codigo_Postal, com.Fecha, com.TipoDeComprobante, e.RegimenFiscal, com.Exportacion,con.ClaveProdServ, con.NoIdentificacion, con.cantidad, con.ClaveUnidad, con.Unidad, con.ValorUnitario,con.Importe, con.Descuento, con.ObjetoImp, con.Descripcion,com.Moneda, com.FormaPago, com.MetodoPago, com.SubTotal, com.Total 
FROM comprobantes com
JOIN comprobantes_conceptos com_con
	ON com_con.ComprobanteID = com.ComprobanteID
JOIN conceptos con
	ON con.ConceptoID=com_con.ConceptosID
JOIN emisor e
	ON e.EmisorID=com.EmisorID
JOIN receptor r
	ON r.ReceptorID=com.ReceptorID
WHERE com.ComprobanteID = $id;
";

$Con=Conectar();
$Result=Ejecutar($Con,$SQL);
$Fila=mysqli_fetch_row($Result);
$R=Desconectar($Con);

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
$pdf->Cell(2,.2,$Fila[0],0,2); //RFC emisor
$pdf->Cell(2,.2,$Fila[1],0,2);//Nombre emisor
$pdf->Cell(2,.2,'',0,2);
$pdf->Cell(2,.2,$Fila[2],0,2);//RFC receptor:
$pdf->Cell(2,.2,$Fila[3],0,2);//Nombre receptor:
$pdf->Cell(2,.2,$Fila[4],0,2);//Codigo postal del
$pdf->Cell(2,.2,'',0,2);//receptor:
$pdf->Cell(2,.2,$Fila[5],0,2);//Regimen fiscal
$pdf->Cell(2,.2,'',0,2);//receptor:
$pdf->Cell(2,.2,$Fila[6],0,2);//Uso CFDI:

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
$pdf->Cell(2,.2,$Fila[7],0,2);//Folio fiscal:
$pdf->Cell(2,.2,$Fila[8],0,2);//No. de serie del CSD:
$Hora=date("h:i:s");
$pdf->Cell(2,.2,$Fila[9].' '.$Fila[10].' '.$Hora,0,2);//Codigo postal, fecha y hora de
$pdf->Cell(2,.2,'',0,2);//emision:
$pdf->Cell(2,.2,$Fila[11],0,2);//Efecto de comprobante:
$pdf->Cell(2,.2,$Fila[12],0,2);//Regimen fiscal:
$pdf->Cell(2,.2,$Fila[13],0,2);//Exportacion:

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
$pdf->Cell(1.3,.3,$Fila[14],1,0,"C", true);//Clave del producto y/o servicio
$pdf->Cell(1.3,.3,$Fila[15],1,0,"C", true);//No. Identificacion
$pdf->Cell(1.3,.3,$Fila[16],1,0,"C", true);//Cantidad
$pdf->Cell(1.3,.3,$Fila[17],1,0,"C", true);//Clave de unidad
$pdf->Cell(1.3,.3,$Fila[18],1,0,"C", true);//Unidad
$pdf->Cell(1.3,.3,$Fila[19],1,0,"C", true);//Valor Unitario
$pdf->Cell(1.3,.3,$Fila[20],1,0,"C", true);//Importe
$pdf->Cell(1.3,.3,$Fila[21],1,0,"C", true);//Descuento
$pdf->Cell(1.3,.3,$Fila[22],1,0,"C", true);//Objeto impuesto

$pdf->SetFont('Arial','B', 3.5);
$pdf->SetXY(.5,4.3);
$pdf->SetFillColor(191,191,191);
$pdf->Cell(1.3,.3,'Descripcion',1,0,"C", true);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(5.2,.3,$Fila[23],1,0,"", true);//Descripcion

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
$pdf->Cell(2,.3,$Fila[24],0,2,);//Moneda
$pdf->Cell(2,.3,$Fila[25],0,2,);//Forma de pago
$pdf->Cell(2,.3,$Fila[26],0,2,);//Metodo de pago

$pdf->SetFont('Arial','B', 5);
$pdf->SetXY(7,5.5);
$pdf->Cell(2,.3,'Subtotal:',0,2,);
$pdf->Cell(2,.3,'Total:',0,2,);

$pdf->SetFont('Arial','', 5);
$pdf->SetXY(10.2,5.5);
$pdf->Cell(2,.3,$Fila[27],0,2,"R");//Subtotal
$pdf->SetFont('Arial','B', 5);
$pdf->Cell(2,.3,$Fila[28],0,2,"R");//Total

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
$filepath="FILES/$id.pdf";
$pdf->Output('F',$filepath);
header("Location: ConsultaGeneral.php");
?>