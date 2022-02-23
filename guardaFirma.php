<?php
$path = "firmas/".$_POST['idCurso']."/".$_POST['idEmpleado']."/";
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
$img = $_POST['base64'];
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
//$fileName = $path.uniqid().'.png';
$fileName = $path.'sign.png';


file_put_contents($fileName, $fileData);

header("Location: ./listaAsistenciaCurso.php?idCurso=".$_POST['idCurso']);

?>