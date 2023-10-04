<?php
include("../modelo/mEstudiante.php");
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$obj = new mEstudiante();
$modificado=$obj->modificarEstudiante($codigo,$nombre,$edad);
echo $modificado;
?>