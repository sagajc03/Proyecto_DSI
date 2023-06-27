<?php
include("Controlador.php");
$id=$_GET['ID'];
$Con=Conectar();
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
$Hora=date("h:i:s");
$texto='<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xsi:schemaLocation="http://www.sat.gob.mx/cfd/4 http://www.sat.gob.mx/sitio_internet/cfd/4/cfdv40.xsd" Version="'.$Fila[0].'" Fecha="'.$Fila[1].'T'.$Hora.'" Sello="'.$Fila[2].'" FormaPago="'.$Fila[3].'" NoCertificado="'.$Fila[4].'" Certificado="'.$Fila[5].'" SubTotal="'.$Fila[6].'" Moneda="'.$Fila[7].'" Total="'.$Fila[8].'" TipoDeComprobante="'.$Fila[9].'" Exportacion="'.$Fila[10].'" MetodoPago="'.$Fila[11].'" LugarExpedicion="'.$Fila[12].'" xmlns:cfdi="http://www.sat.gob.mx/cfd/4" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<cfdi:Emisor Rfc="'.$Fila[13].'" Nombre="'.$Fila[14].'" RegimenFiscal="'.$Fila[15].'" />
	<cfdi:Receptor Rfc="'.$Fila[16].'" Nombre="'.$Fila[17].'" DomicilioFiscalReceptor="'.$Fila[18].'" RegimenFiscalReceptor="'.$Fila[19].'" UsoCFDI="'.$Fila[20].'" />
	<cfdi:Conceptos>
	<cfdi:Concepto ClaveProdServ="'.$Fila[21].'" Cantidad="'.$Fila[22].'" ClaveUnidad="'.$Fila[23].'" Unidad="'.$Fila[24].'" Descripcion="'.$Fila[25].'" ValorUnitario="'.$Fila[26].'" Importe="'.$Fila[27].'" ObjetoImp="'.$Fila[28].'" />
	</cfdi:Conceptos>
	<cfdi:Complemento>
	<tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd" Version="1.1" UUID="C9E7EC04-6095-45E3-ABC0-D5644D3C12D7" FechaTimbrado="2023-01-07T11:36:20" RfcProvCertif="SAT970701NN3" SelloCFD="F/HoYaFbTjWYvXdjQOtyCFm7MsRgRj/T4XO11mhIGFlD5wQaAu+hIBPk7hkfglIrVPuzvRWLDtwSV9b18rir817IeMytBfpO3VSJtnOqKSgaK38iip7oJCWPxE5KkhuIGsEbGojNXOp4yqt0udjjasnnPRJT1JpvAXMf8IdQzg6bxaNC7QSBoxDDrvc9IDGuURaO3JZ/eK6unik+g7Rf6GaJIvqZ6dPfYiITs3yMHzwzIucVRaBQ8AdJw51d8tXbUmhFYCcdp0ig0FG8hd30ylirxKcVHjXEF6UmJAF3YarInGbn4He3X8rZM73BGNCPL6xz1j7qIuyR5Wnq6enE8A==" NoCertificadoSAT="00001000000504465028" SelloSAT="PdOwOpNVaV7wtY/Ybwjn/lr3o9Q2ASPBNbB1K/2X1+yb1lQRaFVNsq4KL7pF6sW3Mu/sOU351RzM5yEogbwO6LW3rDLCz5CHpDRB4uEh+dfUqGpjKhtILyCVHuKjapq5H/0JoqMTArDkwd2A8Rif0AL0QWbbUWDYkLgmfFkDBlXK4I/7CvkIIWmCXJNRe7hGd/p4SivSpexdJzsKxWoxOwFFnyBvzFVzpOJEztnZuktQBKg2nF7uG8beEFX1ANWH1FUXj4B1aN3R4VHlD6IiiCoWwP3htQDgPcDFgHD1ekRsavgnINqJBZF1oRtBL79eu92Jz2EyEw/6Y4mCW5WBlA==" />
	</cfdi:Complemento>
</cfdi:Comprobante>';
$path="FILES/$id.xml";
$Manejador=fopen($path,"w"); // Crea el archivo
fwrite($Manejador,$texto); // Trunca a 0
fclose($Manejador);

$Manejador=fopen($path,"r"); // Crea el archivo
$ahhh=fread($Manejador,2000); // Trunca a 0
fclose($Manejador);

print($ahhh);

header("Location: $path");

?>