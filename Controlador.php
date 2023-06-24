<?php
    function Conectar(){
        $Server="124.0.0.1";
        $User="root";
        $Pws="";
        $BD="comprobante_fiscal";
        $Con=mysqli_connect($Server,$User,$Pws,$BD);
        return $Con;
    }
    
    function Ejecutar($Con,$SQL){
        $Result=mysqli_query($Con,$SQL) or die(mysqli_error($Con));
        return $Result;
    }
    
    function Procesar(){
    
    }
    function Desconectar($Con){
        $R=mysqli_close($Con);
        return $R;
    }
?>