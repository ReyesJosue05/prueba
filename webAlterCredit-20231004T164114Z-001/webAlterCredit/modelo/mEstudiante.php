<?php
include('../conexion.php');
class mEstudiante{
	function agregarEstudiante($codigo,$nombre,$edad){
		$resultado="";
		$objConex = new Conexion();
		$conn= $objConex->conectarse();
		$consulta = "INSERT INTO estudiante(codigo,nombre,edad) values($codigo,'$nombre',$edad)";

		if(mysqli_query($conn,$consulta)){
			$resultado = mysql_insert_id($conn);
		}
		return $resultado;
	}

	function listadoEstudiantes(){
			
		$objConex=new Conexion();
		$conn=$objConex->conectarse();
		$query="select e.codigo codestudiante,nombre,edad,nombre_materia,UV from estudiante e left join materia m on e.codigo=m.codigo";
		$resultado = mysqli_query($conn,$query) or die('Consulta fallida: ' . mysqli_error());
		return $resultado;
	}

	function listadoMaterias(){
		$resultado="";
		$obj = new Conexion();
		$conn= $obj->conectarse();
		$sql="select codigo_materia,nombre_materia from materia";
		$resultado = mysqli_query($conn,$sql);
		return $resultado;
	}

	function eliminarEstudiante($codigo){
		$resultado="";
		$objConex = new Conexion();
		$conn= $objConex->conectarse();
		$sql="DELETE FROM estudiante WHERE codigo=$codigo";
		if(mysqli_query($conn,$sql)){
			$resultado=1;
		}else{
			$resultado=0;
		}
		return $resultado;
	}

	function modificarEstudiante($codigo,$nombre,$edad){
		$resultado="";
		$objConex=new Conexion();
		$conn=$objConex->conectarse();
		$sql="UPDATE estudiante SET nombre='$nombre', edad=$edad WHERE codigo=$codigo";
		if(mysqli_query($conn,$sql)){
			$resultado=1;
		}else{
			$resultado=0;
		}
		return $resultado;
	}
}
?>



<!-- create database nombredb;
use nombredb
create table estudiante(
codigo int not null primary key,
nombre varchar(60) not null,
edad int not null
);
create table materia(
codigo_materia int primary key,
nombre_materia varchar(60) not null,
UV int not null,
codigo int,
foreign key(codigo) references estudiante(codigo)
);
select nombre,edad,nombre_materia,UV from estudiante e inner join materia m
on e.codigo=m.codigo; -->