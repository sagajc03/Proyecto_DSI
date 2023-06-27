<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="css/style.css"/>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  

</head>
    <title>Inicio</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!--Nav -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <div class="header">
        <ul class="nav">
            <header id="navigation" class="text-decoration-none">
                    <div class="headerp1"><li><a href="index.html" target="_blank" class="logo text-decoration-none">
                        <img src="images/logoheader.svg" alt="logo">
                    </a></li></div>
                    <div class="headerp2">
                    <li><a href="" class="text-decoration-none">Trámites</a></li>
                    <li><a href="" class="text-decoration-none" >Gobierno</a></li>
                    <li><a href="" class="text-decoration-none"><i class="bi bi-search"></i></a></li>
            </div>
            </header>
        </ul>
    </div>
    <!--Fin Nav -->
    <a href="borrarcookie.php">Salir</a>
    <?php
        if($_COOKIE['tipo']!='U'){
            header("Location: index.html");
        }
    ?>
    <div class="container medioxd">
    <form action="IComprobante.php" method="post">
        <div class="row g-3 align-items-center text-end">
            <div class="col-1">
              <label class="col-form-label fw-bold">Régimen Fiscal:</label>
            </div>
            <div class="col-2">
              <input type="text" class="form-control" name="regimen_fiscal" placeholder="Persona,etc.">
            </div>
            <div class="col-1">
              <label class="col-form-label fw-bold">Código Postal:</label><!-- Domicilio fiscal receptor-->
            </div>
            <div class="col-1">
              <input type="text" class="form-control" name="codigo_postal" placeholder="">
            </div>
            <div class="col-1">
              <label class="col-form-label fw-bold">Fecha de emisión:</label>
            </div>
            <div class="col-2">
              <input type="date" name="fecha" class="form-control" />
            </div>
            <div class="col-2">
              <label class="col-form-label fw-bold fs-6">Tipo de comprobante:</label> 
            </div>
            <div class="col-2">
              <input type="text" name="tipo_comprobante" class="form-control" />
            </div>
        </div>
        <hr>
        <div class="row g-3 align-items-center text-start">
            <div class="container">
                <h4>Datos Generales</h4>
            </div>
        </div>
        <div class="row g-3 align-items-center text-end">
            <div class="col-2">
              <label class="col-form-label fw-bold">Moneda:</label>
            </div>
            <div class="col-2">
              <input type="text" class="form-control" name="moneda" placeholder="Peso mexicano, dolar">
            </div>
            <div class="col-2 ">
              <label class="col-form-label fw-bold">Tipo de cambio:</label><!-- Domicilio fiscal receptor-->
            </div>
            <div class="col-2">
              <input type="number" step="0.01" class="form-control" name="Tipo_cambio" placeholder="" value="1">
            </div>
        </div>
        <hr>
        <div class="row g-3 align-items-center text-start">
            <div class="container">
                <h4>Datos del cliente</h4>
            </div>
        </div>
        <div class="row g-3 align-items-center text-end">
            <div class="col-2">
              <label class="col-form-label fw-bold">RFC:</label>
            </div>
            <div class="col-2">
              <input type="text" class="form-control" name="RFC" placeholder="RFC">
            </div>
            <div class="col-2 ">
              <label class="col-form-label fw-bold">Nombre o razón social:</label>
            </div>
            <div class="col-2">
              <input type="text"  class="form-control" name="nombre_receptor" placeholder="">
            </div>
        </div>
        <div class="row g-3 align-items-center text-end">
            <div class="col-2">
              <label class="col-form-label fw-bold">Régimen Fiscal:</label>
            </div>
            <div class="col-2">
              <input type="text" class="form-control" name="regimen_fiscal_receptor" placeholder="Peso mexicano, dolar">
            </div>
            <div class="col-2 ">
              <label class="col-form-label fw-bold">Código postal:</label><!-- Domicilio fiscal receptor-->
            </div>
            <div class="col-2">
              <input type="text"  class="form-control" name="codigo_postal_receptor" placeholder="">
            </div>
        </div>
        <hr>
        <div class="row g-3 align-items-center text-start">
            <div class="container">
                <h5>Productos y servicios</h5>
            </div>
        </div>
        <?php 
        $veces=$_GET['veces'];
        if (!$veces) {
            $veces=1;
        }
        for ($i=0; $i < $veces; $i++) { 
            include("conceptos.php");
            echo "<h5>Impuesto del producto</h5>";
            include("impuestos.php");
        }
        ?>
        <div class="row align-items-end text-end">
            <div class="col-sm">
              <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </div>
    </form>
    </div>
</body>
</html>