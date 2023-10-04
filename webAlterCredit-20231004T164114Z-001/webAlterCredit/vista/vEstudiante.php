<?php
include("../modelo/mEstudiante.php");
 ?>
 <html>
 <head>
 	<title></title>
 	 <!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
<!-- <script src="bootstrap-confirm-delete.js"></script>-->

 	<script src="https://code.jquery.com/jquery-3.3.1.js" 
 	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

 </head>
 <body>
 <table align="center" border="2">
 	<tr><td colspan="2">Datos de estudiante</td></tr>
 	<tr><input id="correlativo" type="text" value="0" hidden/><td>Codigo</td><td><input type="text" id="codigo" /></td></tr>
<tr><td>Nombre</td><td><input type="text" id="nombre" /></td></tr>
<tr><td>Edad</td><td><input type="text" maxlength="2" id="edad" /></td></tr>
<tr><td colspan="2"><button align="center" id="btnGuardar">Guardar</button></td></tr>
 </table><br><br>
 <table align="center" border="3">
 	<tr>
<th>Nombre</th>
<th>Edad</th>
<th>Materia</th>
<th>UV</th>
<th colspan="2">Accion</th>
 	</tr>
<?php
$obj = new mEstudiante();
$resultado=$obj->listadoEstudiantes();
while ($fila = mysqli_fetch_array($resultado)) {
 ?>
<tr>
<!-- <td><?php echo $fila['codigo'];?></td> -->
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['edad']; ?></td> 
<td><?php echo $fila['nombre_materia'];?></td>
<td><?php echo $fila['UV'];?></td>
<td><button id="btnModificar" onclick="btnmodificar(<?php echo $fila['codestudiante'] ?>,'<?php echo $fila['nombre'] ?>',<?php echo $fila['edad'] ?>)">Modificar</button></td>
<td><button id="btnEliminar" onclick="btneliminar(<?php echo $fila['codestudiante']?>)">Eliminar</button></td>
</tr>
<?php }?>
 </table>
 <table border="2">
 	<tr><td>Materias</td><td>
<select name="materia" id="materia">
<option value="-1" selected="selected">Seleccione</option>
<?php
$obj = new mEstudiante();
$resultado = $obj->listadoMaterias();
while ($fila = mysqli_fetch_array($resultado)) {
?>
<option value="<?php echo $fila['codigo_materia']?>"><?php echo $fila['nombre_materia'] ?></option>
<?php }?>
</select>
 	</td></tr><tr><td><button id="btnCombo">Obtener dato seleccionado</button></td></tr>
<tr><td><input id="correo" type="text" value=""/></td></tr>
 </table>
 <table><tr><td>

 </td></tr></table>
 </body>
 <script>

$('#edad').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

$('#correo').on('input', function () { 
var correo = $('#correo').val();
var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
if (caract.test(correo)){
console.log("correo bien");	
}else{
console.log("correo no sirve");	
}
});

$('#btnCombo').click(function(){
	var dato = $("#materia option:selected").val();
	if(dato>-1){
console.log("materia="+dato);
}
}); 

$('#btnGuardar').click(function(){
	var codigo = $('#codigo').val();
	var nombre = $('#nombre').val();
	var edad = $('#edad').val();
	var correlativo = $('#correlativo').val();
	
	if(correlativo==0){
	$.ajax({
		url: '../adiciones/agregarEstudiante.php',
		encoding: "UTF-8",
		type: 'POST',
		datatype: 'html',
		data: "codigo="+codigo+ "&nombre=" + nombre + "&edad="+ edad,
		success: function (datos){
			limpiar();
			alert("Registro guardado correctamente");
			location.reload();		
}
	});
}
else if(correlativo!=0){
	$.ajax({
		url: '../adiciones/modificarEstudiante.php',
		encoding: "UTF-8",
		type: 'POST',
		datatype: 'html',
		data: "codigo=" + codigo + "&nombre=" + nombre + "&edad="+ edad,

success: function (datos){	
	limpiar();
		alert("Modificado correctamente");
		location.reload();
		
}
	});
}
	
});

function btneliminar(id){
	var r = confirm("¿Desea eliminar el estudiante?");
  if (r == true) {
	$.ajax({
		url: '../adiciones/eliminarEstudiante.php',
		encoding: "UTF-8",
		type: 'POST',
		datatype: 'html',
		data: "codigo=" + id,
success: function (datos){		
location.reload();
}
	});
  } 

}

function btnmodificar(id, nombre, edad){
	$('#codigo').val(id);
	$('#codigo').attr('readonly', true);
	$('#codigo').prop( "disabled", true );
	$('#nombre').val(nombre);
	$('#edad').val(edad);
	$('#correlativo').val(id);
}

function limpiar(){
	$('#codigo').val("");
	$('#nombre').val("");
	$('#edad').val("");
	$('#correlativo').val(0);
}

</script>
 </html>