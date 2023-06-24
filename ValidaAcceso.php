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

    include("Controlador.php");
    
    $Con=Conectar();
    $SQL = "SELECT *
    FROM InicioSesion
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
            if ($Fila[3]==1){
                print("Cuenta activa");
                if ($Fila[4]==0){
                    print("User sin bloqueo");
                    print("Entrar");
                    $SQL4="UPDATE usuarios SET Intentos=0 WHERE EmisorID='$Fila[0]';";
                    $Result=Ejecutar($Con,$SQL4);
                    if ($Fila[5]=='U'){
                        print("Usuario");
                        header("Location: MenuUser.html");
                        die();
                    }else{
                        print("Admin");
                        header("Location: MenuAdmin.html");
                        die();
                    }


                }else{
                    //Bloquedo
                }
            }else{
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
        }
    }else{
        print("El usuario NO existe");
    }
    
    
    Desconectar($Con);
?>
</body>
</html>