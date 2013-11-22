<?php
	if(isset($_GET['rutina']) && ($_GET['rutina'] == 'edita' || $_GET['rutina'] ==  'ver')){
		$titulo = $_POST['detalle_acuerdo'][1];
		$designado = $_POST['detalle_acuerdo'][2];
		$designada = $_POST['detalle_acuerdo'][3];
		$fecha_acuerdo = $_POST['detalle_acuerdo'][4];
		$fecha_compromiso = $_POST['detalle_acuerdo'][5];
		$porcentaje = $_POST['detalle_acuerdo'][6];
		$descripcion = str_replace("_","'",$_POST['detalle_acuerdo'][7]);
		$avance = str_replace("_","'",$_POST['detalle_acuerdo'][8]);
		$imagen ='./imagenes/'. $_POST['detalle_acuerdo'][9].'.png';
		if($_GET['rutina'] == 'edita') $consulta='';
	}
	else{
		$titulo = '';
		$designado = '';
		$designada = '';
		$fecha_acuerdo = '';
		$fecha_compromiso = '';
		$porcentaje = '';
		$descripcion = '';
		$avance = '';
		$imagen ='';
	}
?>