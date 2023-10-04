<?php
class conexion{
	function conectarse(){
		$conn = mysqli_connect("localhost","root","","escuela2");
		if($conn){
			//echo "conexion exitosa";
		}else{
			echo "no se pudo conectar";
		}
		return $conn;
	}
}
 ?>