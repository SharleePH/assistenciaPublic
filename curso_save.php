<?php
if (!isset($_POST["name"]) || !isset($_POST["idProveedor"])  
|| !isset($_POST["inicio"])  || !isset($_POST["final"])
|| !isset($_POST["descripcion"])) {
    exit("No data provided");
}
include_once "functions.php";
$name = $_POST["name"];
$idProveedor = $_POST["idProveedor"];
$inicio = $_POST["inicio"];
$final = $_POST["final"];
$descripcion = $_POST["descripcion"];
$idTipoCurso = $_POST["idTipoCurso"];
saveCurso($name, $idProveedor, $inicio, $final, $descripcion, $idTipoCurso);
header("Location: cursos.php");
