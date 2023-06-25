    
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
    ?>