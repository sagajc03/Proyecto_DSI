<?php
    $RFC=$_POST['RFC'];
    $Pwd=$_POST['Pwd'];

    include("Controlador.php");
    
    $Con=Conectar();
    $SQL = "SELECT *
    FROM InicoSesion
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