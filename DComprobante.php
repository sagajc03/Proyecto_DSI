<?php
    include("Controlador.php"); 
    $id=$_POST['ID'];

    $SQL1="DELETE FROM comprobantes_conceptos
    WHERE ComprobanteID = $id;
    ;";

    $SQL2="DELETE FROM comprobantes
    WHERE ComprobanteID = $id;
    ;";

    $Con=Conectar();
    $Result=Ejecutar($Con,$SQL1);
    $Result=Ejecutar($Con,$SQL2);
    $R=Desconectar($Con);
    header("Location: EliminarComprobante.php");
?>