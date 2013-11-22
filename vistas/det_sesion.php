<?php
	session_start();
	include "../librerias/conexion.php";
	$_sistema = "acuerdos_desarrollo";
	if(isset($_SESSION[$_sistema]['usuario']) && $_SESSION[$_sistema]['usuario'] != ""){
		$conex = new DBAdmin();		
		$sql = "SELECT A.NOMBRE, B.AREA FROM USUARIO A INNER JOIN AREA B ON A.AREA = B.IDAREA WHERE A.ID_USUARIO = ".$_SESSION[$_sistema]['usuario'];
		$sesion = $conex->consulta($sql);
		print "		<div id = 'ref_usuario'>
						<div >USUARIO: <span style='color:#F2F2F2;'>".$sesion[0][0]."</span></div>
					</div>		   
					<div id = 'ref_area'>
						<div >AREA: <span style='color:#F2F2F2;'>".$sesion[0][1]."</span></div>
					</div>
				";
	}
	
?>