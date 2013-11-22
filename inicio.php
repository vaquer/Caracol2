<?php
	/*
	*	Inicio.php
	*	Página de Inicio Real, aquí se cargan las vistas
	*	@author Sistemas
	*	@version 2.0
	*	@package Caracol
	*/
	session_start();

	//seguro para nulificar el acceso directo e indirecto no autorizado
	if($_SERVER['HTTP_REFERER']=="") exit;
	if($_SESSION["_caracol_seguro_A"] != "caracol_llave_A") exit('');

	//Incluye la libreria de configuracion de la aplicacion
	include "librerias/caracolitos.php";
	
	//Incluye la configuracion de la aplicacion
	include "librerias/constructor.php";
	
	//Creamos una instancia al Constructor
	$arquitecto = new Constructor();

	print $arquitecto->division("vista")->hacerCodigo();
	//Secciones que integran la pagina
	/*print $arquitecto->tabla("marco",array(
		array(
			$arquitecto->division("cabeza_izquierda")->hacerCodigo(),
			$arquitecto->division("cabeza")->hacerCodigo(),
			$arquitecto->division("cabeza_derecha")->hacerCodigo()
		),
		array(
			$arquitecto->division("mmenu_izquierdo")->hacerCodigo(),
			$arquitecto->division("mmenu")->hacerCodigo(),
			$arquitecto->division("mmenu_derecho")->hacerCodigo()
		),
		array(
			$arquitecto->division("vista_izquierda")->hacerCodigo(),
			$arquitecto->division("vista")->hacerCodigo(),
			$arquitecto->division("vista_derecha")->hacerCodigo()
		),
		array(
			$arquitecto->division("pie_izquierdo")->hacerCodigo(),
			$arquitecto->division("pie")->hacerCodigo(),
			$arquitecto->division("pie_derecho")->hacerCodigo()
		)
	),"cellpadding=0 cellspacing=0",array('center','center','center'))->hacerCodigo();*/

		//Asignacion de Vista para cada seccion creada anteriormente
		print $arquitecto->codigo("salto","
			<script language='javascript'>
				$(document).ready(function(){
					//$('#izquierdo').load('vistas/izquierdo.php');
					//$('#cabeza').load('vistas/".$GLOBALS['_vista_cabeza']."');
					$('#vista').load('vistas/".$GLOBALS['_vista_inicio']."');
					//$('#pie').load('vistas/".$GLOBALS['_vista_pie']."');
				});
			</script>
		")->hacerCodigo();

?>