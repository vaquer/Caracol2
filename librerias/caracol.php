<?php

	if($_SERVER['HTTP_REFERER']=="") exit;
	if($_SESSION["_caracol_seguro_A"] != "caracol_llave_A") exit('');

	//Incluye la libreria de configuracion de la aplicacion
	include "../librerias/caracolitos.php";
	
	//Incluye la librerias de conexion
	include "../librerias/conexion.php";

	//Incluye la libreria constructora
	include "../librerias/constructor.php";

	function iniciarCaracol() {
		global $arquitecto;	
		global $db;
		global $_sistema;
		$_sistema = 'Caracol2.0';
		$arquitecto = new Constructor();
		$db= new DBAdmin;
		$db->conectar();
	}

	function terminarCaracol() {
		global $arquitecto;
		global $db;
		$db->desconectar();
		unset($db);
		unset($arquitecto);
	}
		
?>