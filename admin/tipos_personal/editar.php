<?php 

    require('../../config/conexion.php');
	require('../../config/config.php');

	$conexion = conectar();

	$Descripcion = $_POST['descripcion'];
	
	
	$id= $_POST['id'];
	

	$query = $conexion->prepare(" UPDATE tipos_personal SET descripciont=:descripcion WHERE id=:id");
	$query->bindParam(':descripcion',$Descripcion);
	$query->bindParam(':id',$id);
	$query->execute();

	header("Location: ".RUTA."admin/tipos_personal");







 ?>