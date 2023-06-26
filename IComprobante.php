    
    <?php
        $regimen_fiscal=$_POST['regimen_fiscal'];
        echo $regimen_fiscal."<br>";
        $codigo_postal=$_POST['codigo_postal']; //Codigo postal del comprobante
        echo $codigo_postal."<br>";
        $fecha=$_POST['fecha'];
        echo $fecha."<br>";
        $tipo_comprobante=$_POST['tipo_comprobante'];
        echo $tipo_comprobante."<br>";

        //Datos generales

        $moneda=$_POST['moneda'];
        echo $moneda."<br>";
        $tipo_cambio=$_POST['Tipo_cambio'];
        echo $tipo_cambio."<br>";

        //Datos del cliente

        $rfc=$_POST['RFC'];
        echo $rfc."<br>";
        $nombre=$_POST['nombre_receptor'];
        echo $nombre."<br>";
        $regimen_fiscal_receptor=$_POST['regimen_fiscal_receptor'];
        echo $regimen_fiscal_receptor."<br>";
        $codigo_postal_receptor=$_POST['codigo_postal_receptor'];
        echo $codigo_postal_receptor."<br>";

        //Productos y servicios
        $descripcion=$_POST['Descripcion'];
        $producto=$_POST['Producto'];
        $unidad=$_POST['Unidad'];
        $cantidad=$_POST['Cantidad'];
        $valorUnitario=$_POST['ValorUnitario'];
        $descuento=$_POST['Descuento'];
        $importeCo = [];
        for ($i=0; $i < count($descripcion); $i++) { 
            $importeCo[$i]=$valorUnitario[$i]*$cantidad[$i]-($descuento[$i]*0.01*$valorUnitario[$i]*$cantidad[$i]);
        }
        $objImp=$_POST['ObjImpuesto'];

        //Impuesto 
        $base=$_POST['Base'];
        $impuesto=$_POST['Impuesto'];
        $tipoFactor=$_POST['TipoFactor'];

        $tipoImpuesto=$_POST['TipoImpuesto'];
        $tasaOCuota=$_POST['TasaOCuota'];
        $importe=$_POST['Importe'];

        $SubTotal=0;
        for ($i=0; $i < count($importeCo); $i++) { 
            $SubTotal += $importeCo[$i];
        }
        $impuestosIm=0;
        for ($i=0; $i < count($importeCo); $i++) { 
            $impuestosIm += $importe[$i];
        }
        $Total=$SubTotal+$impuestosIm;

        include("Controlador.php");
        $Con=Conectar();
        
        for ($i=0; $i < count($descripcion); $i++) { 
            //Hacer una row de impuestos
            $SQLI="INSERT INTO impuestos
                (Base,Impuesto,TipoFactor,TipoImpuesto,TasaOcuota,Importe)
                VALUES('$base[$i]','impuesto[$i]','$tipoFactor[$i]','$tipoImpuesto[$i]','$tasaOCuota[$i]','$importe[$i]');";
            $Result=Ejecutar($Con,$SQLI);
            $numI = mysqli_insert_id($Con);
            $numale = rand();
            //Hacer una row de conceptos
            $SQLC="INSERT INTO conceptos
                (ClaveProdServ,Cantidad,ClaveUnidad,Descripcion,ValorUnitario,Importe,
                ObjetoImp,NoIdentificacion,Unidad,Descuento)
                VALUES('$producto[$i]','$cantidad[$i]','$unidad[$i]','$descripcion[$i]','$valorUnitario[$i]',
                '$importeCo[$i]','$objImp[$i]','$numale','$unidad[$i]','$descuento[$i]');
                ";
            $Result=Ejecutar($Con,$SQLC);
            $numO = mysqli_insert_id($Con);
            //Hacer una row de juntos    
            $SQLM="INSERT INTO conceptos_impuestos
                (ConceptosID,ImpuestoID)
                VALUES('$numO','$numI');
                ";
            $Result=Ejecutar($Con,$SQLM);
        }
        $SQLR="SELECT * FROM receptor
        WHERE RFC='$rfc';
        ";
        $Result=Ejecutar($Con,$SQLR);
        $NFilas=mysqli_num_rows($Result);
        $numale = rand();
        if (!$NFilas==1) {
            $SQLRI="INSERT INTO receptor
                (RFC,Nombre,DomicilioFiscalReceptor,RegimenFiscalReceptor,UsoCFDI,RegimenFiscal)
                VALUES('$rfc','$nombre','$codigo_postal_receptor','$regimen_fiscal_receptor','$numale',
                '$regimen_fiscal');
            ";
            $Result=Ejecutar($Con,$SQLRI);
            $numRI = mysqli_insert_id($Con);
        } else {
            $FilasR=mysqli_fetch_row($Result);
            $numRI=$FilasR[0];
        }
        $emisorId=$_COOKIE['usuario'];
        $SQLFIN="INSERT INTO comprobantes
            (NoCertificado,Total,Moneda,Fecha,Codigo_Postal,Sello,Exportacion,Version,Certificado,
            LugarExpedicion,SubTotal,TipoDeComprobante,Descuento,TipoCambio,EmisorID,ReceptorID)
            VALUES('No hay','$Total','$moneda','$fecha','$codigo_postal','No hay','Sepa la bola','4.0','No se',
            '1234','$SubTotal','$tipo_comprobante','$descuento[0]','$tipo_cambio','$emisorId','$numRI')
            ;
        ";
        $Result=Ejecutar($Con,$SQLFIN);
        $numI = mysqli_insert_id($Con);//Que es esto por dios
        $SQLM="INSERT INTO comprobantes_conceptos
                (comprobanteID,ConceptosID)
                VALUES('$numI','$numO');
                ";
        $Result=Ejecutar($Con,$SQLM);
        Desconectar($Con);
        header("Location: MenuUser.html");
    ?>