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
    $filepath="FILES/Eliminados/$id.pdf";
    $pdf->Output('F',$filepath);
    
    $SQL="SELECT com.Version, com.Fecha, com.Sello, com.FormaPago, com.NoCertificado, com.Certificado,
        com.SubTotal, com.Moneda, com.Total, com.TipoDeComprobante,
        com.Exportacion, com.MetodoPago, com.LugarExpedicion,
        e.RFC, e.nombre, e.RegimenFiscal,
        r.RFC, r.Nombre, r.DomicilioFiscalReceptor, r.RegimenFiscalReceptor, r.UsoCFDI,
        con.ClaveProdServ, con.Cantidad, con.ClaveUnidad, con.Unidad,
        con.Descripcion, con.ValorUnitario, con.Importe, con.ObjetoImp
        FROM comprobantes com 
        JOIN comprobantes_conceptos com_con 
            ON com_con.ComprobanteID = com.ComprobanteID 
        JOIN conceptos con 
            ON con.ConceptoID=com_con.ConceptosID 
        JOIN emisor e 
            ON e.EmisorID=com.EmisorID 
        JOIN receptor r ON r.ReceptorID=com.ReceptorID
        WHERE com.ComprobanteID = $id;";
    $Result=Ejecutar($Con,$SQL);
    $Fila=mysqli_fetch_row($Result);
    
    $texto='<?xml version="1.0" encoding="utf-8"?>
    <cfdi:Comprobante xsi:schemaLocation="http://www.sat.gob.mx/cfd/4 http://www.sat.gob.mx/sitio_internet/cfd/4/cfdv40.xsd" Version='.$Fila[0].' Fecha="'.$Fila[1].'T'.$Hora.'" Sello="'.$Fila[2].'" FormaPago="'.$Fila[3].'" NoCertificado="'.$Fila[4].'" Certificado="'.$Fila[5].'" SubTotal="'.$Fila[6].'" Moneda="'.$Fila[7].'" Total="'.$Fila[8].'" TipoDeComprobante="'.$Fila[9].'" Exportacion="'.$Fila[10].'" MetodoPago="'.$Fila[11].'" LugarExpedicion="'.$Fila[12].'" xmlns:cfdi="http://www.sat.gob.mx/cfd/4" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <cfdi:Emisor Rfc="'.$Fila[13].'" Nombre="'.$Fila[14].'" RegimenFiscal="'.$Fila[15].'" />
        <cfdi:Receptor Rfc="'.$Fila[16].'" Nombre="'.$Fila[17].'" DomicilioFiscalReceptor="'.$Fila[18].'" RegimenFiscalReceptor="'.$Fila[19].'" UsoCFDI="'.$Fila[20].'" />
        <cfdi:Conceptos>
        <cfdi:Concepto ClaveProdServ="'.$Fila[21].'" Cantidad="'.$Fila[22].'" ClaveUnidad="'.$Fila[23].'" Unidad="'.$Fila[24].'" Descripcion="'.$Fila[25].'" ValorUnitario="'.$Fila[26].'" Importe="'.$Fila[27].'" ObjetoImp="'.$Fila[28].'" />
        </cfdi:Conceptos>
        <cfdi:Complemento>
        <tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd" Version="1.1" UUID="C9E7EC04-6095-45E3-ABC0-D5644D3C12D7" FechaTimbrado="2023-01-07T11:36:20" RfcProvCertif="SAT970701NN3" SelloCFD="F/HoYaFbTjWYvXdjQOtyCFm7MsRgRj/T4XO11mhIGFlD5wQaAu+hIBPk7hkfglIrVPuzvRWLDtwSV9b18rir817IeMytBfpO3VSJtnOqKSgaK38iip7oJCWPxE5KkhuIGsEbGojNXOp4yqt0udjjasnnPRJT1JpvAXMf8IdQzg6bxaNC7QSBoxDDrvc9IDGuURaO3JZ/eK6unik+g7Rf6GaJIvqZ6dPfYiITs3yMHzwzIucVRaBQ8AdJw51d8tXbUmhFYCcdp0ig0FG8hd30ylirxKcVHjXEF6UmJAF3YarInGbn4He3X8rZM73BGNCPL6xz1j7qIuyR5Wnq6enE8A==" NoCertificadoSAT="00001000000504465028" SelloSAT="PdOwOpNVaV7wtY/Ybwjn/lr3o9Q2ASPBNbB1K/2X1+yb1lQRaFVNsq4KL7pF6sW3Mu/sOU351RzM5yEogbwO6LW3rDLCz5CHpDRB4uEh+dfUqGpjKhtILyCVHuKjapq5H/0JoqMTArDkwd2A8Rif0AL0QWbbUWDYkLgmfFkDBlXK4I/7CvkIIWmCXJNRe7hGd/p4SivSpexdJzsKxWoxOwFFnyBvzFVzpOJEztnZuktQBKg2nF7uG8beEFX1ANWH1FUXj4B1aN3R4VHlD6IiiCoWwP3htQDgPcDFgHD1ekRsavgnINqJBZF1oRtBL79eu92Jz2EyEw/6Y4mCW5WBlA==" />
        </cfdi:Complemento>
    </cfdi:Comprobante>';
    $path="FILES/Eliminados/$id.xml";
    $Manejador=fopen($path,"w"); // Crea el archivo
    fwrite($Manejador,$texto); // Trunca a 0
    fclose($Manejador);
    $R=Desconectar($Con);

    $SQL1="DELETE FROM comprobantes_conceptos
    WHERE ComprobanteID = $id;
    ;";

    $SQL2="DELETE FROM comprobantes
    WHERE ComprobanteID = $id;
    ;";

    $Con=Conectar();
    $Result=Ejecutar($Con,$SQL1);
    $Result=Ejecutar($Con,$SQL2);
    $R=Desconectar($Con);


    header("Location: EliminarComprobante.php");
?>