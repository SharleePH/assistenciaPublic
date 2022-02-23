<?php
/*$array = array();
array_push($array, "1", "1", "2", "2", "2", "3", "3");
asort($array);
$temp = "";
$contador = 0;
$cuentaVeces=0;
$control=0;
$arrSalida = array();
foreach($array as $a){
    if($contador==0){
        $temp = $a;
        $cuentaVeces++;
    }else{
        if($temp==$a){
            $cuentaVeces++;
        }else{
            if($temp==$cuentaVeces){
                $arrSalida[$control] = $temp;
                $control++;
                $temp = $a;                
                $cuantasVeces=1;
            }
        }
    }
    $contador++;
}
//print_r($arrSalida);
if(count($arrSalida)>0)
    echo $arrSalida[count($arrSalida)-1];
else
    echo -1;*/
//************************************************************************************** */
/*function combinaciones($numero){
    $factorial = 1; 
    for ($i = 1; $i <= $numero; $i++){ 
      $factorial = $factorial * $i; 
    } 
    return $factorial;
}
$n=5;
$respuesta = combinaciones($n);
for($i=0;$i<=$respuesta;$i++){

}
echo "El factorial de ".$n." es ".$respuesta;*/

$n=3;
$arrResult = array();
$controlArr = 0;
$cadena="";
for($i=1;$i<=$n;$i++){
    $control=$n;
    $cadena="";
    for($x=1;$x<=$n;$x++){
        if($control>0){
            if(($control-$i)<=0){
                $cadena.= str_repeat("(",$control);
                $cadena.= str_repeat(")",$control);
                $control=$n;
            }else{
                $cadena.= str_repeat("(",$i);
                $cadena.= str_repeat(")",$i);
                $control= $control-$i;
            }
        }else{
            $control=$n;
        }
    }
    $cadena.="|</br>";
    echo $cadena;
}
?>