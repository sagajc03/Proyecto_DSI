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

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">RFC Receptor</th>
        <th scope="col">Nombre o razón social</th>
        <th scope="col">Fecha</th>
        <th scope="col">Total</th>
        </tr>
    </thead>
        <tbody>
            <?php
                $emisor=$_COOKIE['usuario'];
                
                include("Controlador.php");
                $Con=Conectar();
                $SQL="SELECT *  FROM vista_ami
                    WHERE EmisorID='$emisor';
                    ";
                if($_COOKIE['tipo']=='A'){
                    $SQL="SELECT *  FROM vista_ami
                    ;
                    ";
                }
                $Result=Ejecutar($Con,$SQL);
                $NFilas=mysqli_num_rows($Result);

                for ($i=0; $i < $NFilas; $i++) {
                    $Registro=mysqli_fetch_row($Result);
                    echo   "<tr>";
                    echo   "<th scope='row'>$Registro[0]</th>";
                    echo   "<td>$Registro[1]</td>";
                    echo   "<td>$Registro[2]</td>";
                    echo   "<td>$Registro[3]</td>";
                    echo   "<td>$Registro[4]</td>";
                    echo   "</tr>";
                }
            ?>
        </tbody>
    </table>
    <div class="d-grid gap-2 col-6 mx-auto">
            <div class="row align-items-center">
            <form action="DescargarComprobante.php" method="post">
                    <div class="col-12">
                        <input type="number" step="1" class="form-control" name="ID" placeholder="Escriba el número de comprobante">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Descargar comprobante</button>
                    </div>
            </form>
        </div>
    </body>
</html>