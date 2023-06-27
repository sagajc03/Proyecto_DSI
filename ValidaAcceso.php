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
<?php
    $RFC=$_POST['RFC'];
    $Pwd=$_POST['contrasena'];

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo']['name'];
        $rutaTemporal = $_FILES['archivo']['tmp_name'];
        $rutaDestino = 'llaves/' . $nombreArchivo;

        // Mover el archivo a su ubicación definitiva
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            echo 'El archivo se ha cargado correctamente.';
        } else {
            echo 'Hubo un error al cargar el archivo.';
        }
        }    else {
        echo 'No se ha seleccionado ningún archivo o hubo un error en la carga.';
        }
    }


    $gestor=fopen($rutaDestino,"r");
    $llave=fread($gestor,10);
    fclose($gestor);

    include("Controlador.php");
    
    $Con=Conectar();
    $SQL = "SELECT *
    FROM InicioSesion2
    WHERE RFC='$RFC'";
    
    //   $SQL = "SELECT u.UserID, e.RFC, u.contrasena, u.Estado, u.Bloqueo, u.tipo, u.Intentos
    //  FROM usuarios u, emisor e
    //  WHERE u.EmisorID=e.EmisorID AND e.RFC='$RFC'";
    
    $Result=Ejecutar($Con,$SQL);
    $NFilas=mysqli_num_rows($Result);
    
    if($NFilas==1){
        print("El usuario Existe");
        $Fila=mysqli_fetch_row($Result);
        if($Pwd==$Fila[2]){
            print("Contraseña valida");
            if($llave!=$Fila[7]){
                header("Location: IniciarSesion.html");
                die();
            }
            if ($Fila[3]==1){
                print("Cuenta activa");
                if ($Fila[4]==0){
                    print("User sin bloqueo");
                    print("Entrar");
                    $SQL4="UPDATE usuarios SET Intentos=0 WHERE EmisorID='$Fila[0]';";
                    $Result=Ejecutar($Con,$SQL4);
                    if ($Fila[5]=='U'){
                        print("Usuario");
                        header("Location: MenuUser.php");
                        setcookie("usuario",$Fila[0],time() + (60*10));
                        setcookie("tipo",$Fila[5],time() + (60*10));
                        die();
                    }else{
                        print("Admin");
                        header("Location: MenuAdmin.php");
                        setcookie("usuario",$Fila[0],time() + (60*10));
                        setcookie("tipo",$Fila[5],time() + (60*10));
                        die();
                    }


                }else{
                    header("Location: IniciarSesion.html");
                    //Bloquedo
                }
            }else{
                header("Location: IniciarSesion.html");
                //Cuenta inactiva
            }
        }else{
            //Contraseña invalida
            $SQL2="UPDATE usuarios SET Intentos=Intentos+1 WHERE EmisorID='$Fila[0]';";
            $Result=Ejecutar($Con,$SQL2);
            if ($Fila[6]>2){
                $SQL3="UPDATE usuarios SET Bloqueo=1 WHERE EmisorID='$Fila[0]';";
                $Result=Ejecutar($Con,$SQL3);
            }
            header("Location: IniciarSesion.html");
        }
    }else{
        print("El usuario NO existe");
        header("Location: IniciarSesion.html");
    }
    
    
    Desconectar($Con);
?>
</body>
</html>