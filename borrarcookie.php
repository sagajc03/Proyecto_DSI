<?php 
setcookie("usuario",$Fila[0],time() + (-1));
setcookie("tipo",$Fila[5],time() + (-1));
header("Location: index.html");
?>