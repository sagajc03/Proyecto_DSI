<?php
    $SQL="SELECT com.Version, com.Fecha, com.Sello, com.FormaPago, com.NoCertificado, com.Certificado,
    com.SubTotal, com.Moneda, com.Moneda, com.Total, com.TipoDeComprobante,
    com.Exportacion, com.MetodoPago, com.LugarExpedicion,
    e.RFC, e.RFC, e.RegimenFiscal,
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

    $texto='<?xml version="1.0" encoding="utf-8"?>
    <cfdi:Comprobante xsi:schemaLocation="http://www.sat.gob.mx/cfd/4 http://www.sat.gob.mx/sitio_internet/cfd/4/cfdv40.xsd" Version="4.0" Fecha="2023-01-07T11:35:55" Sello="F/HoYaFbTjWYvXdjQOtyCFm7MsRgRj/T4XO11mhIGFlD5wQaAu+hIBPk7hkfglIrVPuzvRWLDtwSV9b18rir817IeMytBfpO3VSJtnOqKSgaK38iip7oJCWPxE5KkhuIGsEbGojNXOp4yqt0udjjasnnPRJT1JpvAXMf8IdQzg6bxaNC7QSBoxDDrvc9IDGuURaO3JZ/eK6unik+g7Rf6GaJIvqZ6dPfYiITs3yMHzwzIucVRaBQ8AdJw51d8tXbUmhFYCcdp0ig0FG8hd30ylirxKcVHjXEF6UmJAF3YarInGbn4He3X8rZM73BGNCPL6xz1j7qIuyR5Wnq6enE8A==" FormaPago="02" NoCertificado="00001000000413925402" Certificado="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" SubTotal="62863.00" Moneda="MXN" Total="62863.00" TipoDeComprobante="I" Exportacion="01" MetodoPago="PUE" LugarExpedicion="76260" xmlns:cfdi="http://www.sat.gob.mx/cfd/4" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
      <cfdi:Emisor Rfc="HELA6804222T0" Nombre="ALEJANDRA GUADALUPE HERNANDEZ LEON" RegimenFiscal="626" />
      <cfdi:Receptor Rfc="ASR071203AYA" Nombre="ASOCIADOS SAN RAFAEL" DomicilioFiscalReceptor="76258" RegimenFiscalReceptor="622" UsoCFDI="G03" />
      <cfdi:Conceptos>
        <cfdi:Concepto ClaveProdServ="10121503" Cantidad="66171.578" ClaveUnidad="KGM" Unidad="Kilogramo" Descripcion="SILO DE MAIZ" ValorUnitario="0.95000" Importe="62863.00" ObjetoImp="01" />
      </cfdi:Conceptos>
      <cfdi:Complemento>
        <tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd" Version="1.1" UUID="C9E7EC04-6095-45E3-ABC0-D5644D3C12D7" FechaTimbrado="2023-01-07T11:36:20" RfcProvCertif="SAT970701NN3" SelloCFD="F/HoYaFbTjWYvXdjQOtyCFm7MsRgRj/T4XO11mhIGFlD5wQaAu+hIBPk7hkfglIrVPuzvRWLDtwSV9b18rir817IeMytBfpO3VSJtnOqKSgaK38iip7oJCWPxE5KkhuIGsEbGojNXOp4yqt0udjjasnnPRJT1JpvAXMf8IdQzg6bxaNC7QSBoxDDrvc9IDGuURaO3JZ/eK6unik+g7Rf6GaJIvqZ6dPfYiITs3yMHzwzIucVRaBQ8AdJw51d8tXbUmhFYCcdp0ig0FG8hd30ylirxKcVHjXEF6UmJAF3YarInGbn4He3X8rZM73BGNCPL6xz1j7qIuyR5Wnq6enE8A==" NoCertificadoSAT="00001000000504465028" SelloSAT="PdOwOpNVaV7wtY/Ybwjn/lr3o9Q2ASPBNbB1K/2X1+yb1lQRaFVNsq4KL7pF6sW3Mu/sOU351RzM5yEogbwO6LW3rDLCz5CHpDRB4uEh+dfUqGpjKhtILyCVHuKjapq5H/0JoqMTArDkwd2A8Rif0AL0QWbbUWDYkLgmfFkDBlXK4I/7CvkIIWmCXJNRe7hGd/p4SivSpexdJzsKxWoxOwFFnyBvzFVzpOJEztnZuktQBKg2nF7uG8beEFX1ANWH1FUXj4B1aN3R4VHlD6IiiCoWwP3htQDgPcDFgHD1ekRsavgnINqJBZF1oRtBL79eu92Jz2EyEw/6Y4mCW5WBlA==" />
      </cfdi:Complemento>
    </cfdi:Comprobante>';
    $path="FILES/Datos1.xml";
    $Manejador=fopen($path,"w"); // Crea el archivo
    fwrite($Manejador,$texto); // Trunca a 0
    fclose($Manejador);

?>