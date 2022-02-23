<?php
include_once "functions.php";
$datos = array_keys($_POST);
$i=0;
foreach($datos as $a){
    $arreglo    = explode('-',$a);
    if(count($arreglo)==2){
        $idEmpleado = $arreglo[0];
        $idCurso    = $arreglo[1];
        if($i==0){
            eliminaRelacionEmpleados($idCurso);
        }
        insertaRelacion($idEmpleado, $idCurso);
        $i++;
    }
}
header("Location: cursoEmpleados.php");