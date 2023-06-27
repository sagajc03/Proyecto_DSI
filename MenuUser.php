<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="css/style.css"/>
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
                    <li><a href="" class="text-decoration-none">Trámites</a>                    </li>
                    <li><a href="" class="text-decoration-none">Gobierno</a></li>
                    <li><a href="" class="text-decoration-none"><i class="bi bi-search"></i></a></li>
            </div>
            </header>
        </ul>
    </div>
    <!--Fin Nav -->

    <a href="borrarcookie.php">Salir</a>
    <?php
        $tipo=$_COOKIE['tipo'];
        $usuario=$_COOKIE['usuario'];
        if (!$usuario) {
            header("Location: index.html");
        }
        if($_COOKIE['tipo']!='U'){
            header("Location: index.html");
        }
    ?>
    <div class="container medioxd">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" href="ConsultaGeneral.php" role="button">Consulta de comprobantes creados</a>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" href="EliminarComprobante.php" role="button">Eliminar Comprobantes</a>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <div class="row align-items-center">
            <form action="GenerarComprobante.php" method="get">
                    <div class="col-12">
                        <input type="number" step="1" class="form-control" name="veces" placeholder="Escriba el número de conceptos a agregar en la generación de comprobante">
                    </div>
                    <div class="col-12">
                        <a href="GenerarComprobante.php">
                        <button class="btn btn-primary" type="submit">Generar Comprobante</button>
                    </a>
                    </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>