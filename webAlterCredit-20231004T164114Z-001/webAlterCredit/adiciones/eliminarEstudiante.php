<?php
include("../modelo/mEstudiante.php");
$codigo=$_POST['codigo'];
$obj = new mEstudiante();

$eliminar= $obj->eliminarEstudiante($codigo);
echo $eliminar;

 ?>