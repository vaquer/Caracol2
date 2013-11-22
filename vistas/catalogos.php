<?php
	if($_SESSION[$_sistema]['usuario'] == 202 || $_SESSION[$_sistema]['usuario'] == 203 || $_SESSION[$_sistema]['usuario'] == 204 ) $sql = "SELECT IDAREA, AREA FROM AREA WHERE ACTIVO = 1";
	else $sql = "SELECT IDAREA, AREA FROM AREA WHERE ACTIVO = 1 AND IDAREA = (SELECT AREA FROM USUARIO WHERE ID_USUARIO = ".$_SESSION[$_sistema]['usuario'].")";
	$area = $db->consulta($sql);
	if($_SESSION[$_sistema]['usuario'] == 202 || $_SESSION[$_sistema]['usuario'] == 203 || $_SESSION[$_sistema]['usuario'] == 204 )
		$sql = "SELECT ID_USUARIO, NOMBRE FROM USUARIO WHERE SUCURSAL = (SELECT SUCURSAL FROM USUARIO WHERE ID_USUARIO = ".$_SESSION[$_sistema]['usuario'].")";
	else $sql = "SELECT ID_USUARIO, NOMBRE FROM USUARIO WHERE SUCURSAL = (SELECT SUCURSAL FROM USUARIO WHERE ID_USUARIO = ".$_SESSION[$_sistema]['usuario'].") AND AREA = (SELECT AREA FROM USUARIO WHERE ID_USUARIO = ".$_SESSION[$_sistema]['usuario'].")";
	$responsable = $db->consulta($sql);
	$porcentajes = array();
	for($i = 0; $i < 11; $i++){
		$porcentajes[$i][0] = $i * 10;
		$porcentajes[$i][1] = ($i * 10) . "%";
	}
	
	
?>