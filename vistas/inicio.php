<?php
	session_start();
	include "../librerias/caracol.php";

	iniciarCaracol();
	print "<br><br><br><br>";
	if(!isset($_SESSION[$_sistema]["sist"]))
		$_SESSION[$_sistema]["sist"] = '';
	if( $_SESSION[$_sistema] && $_SESSION[$_sistema]["sist"] == "CARACOL2.0"){
			$arquitecto->comprobarSesion($_sistema);
			print $arquitecto->codigo('cargar_menu',
											"<script language=javascript>
												$('#mmenu').load('vistas/menu.php');
											</script>"	)->hacerCodigo();
			
			
				print $arquitecto->liga("salir_liga","vista","delogear.php","","",array( "Salir" ))->hacerCodigo();
				print "<br>";
			

		}
		else{
				include "../librerias/login.php";
				$arquitecto->crearInicioSesion("");
		}
	
	terminarCaracol();
print "<br><br><br><br>";
?>

