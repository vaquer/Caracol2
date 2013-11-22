<?php

	print "<script src=\"librerias/js/eventos.js\"></script>";

	if( isset($_REQUEST['Listado_de'])) 
		$catalogo = $_REQUEST['Listado_de'];
	else 
		$catalogo=' ';
	
	if ($catalogo == "login"){
			$strSql = "SELECT * FROM USUARIO WHERE Usuario ='".$_POST["usuario"]."'";
			//print $strSql;
			$consu = $db->consulta($strSql);
			if($consu){//Se encuentra
				if($consu[0][2] == md5($_POST['clave'])){ //Clave correcta

					if($consu[0][8]==1){//activo
						$_SESSION[$_sistema] = $consu;
						$_SESSION[$_sistema]['usuario'] = $consu[0][0];
						$_SESSION[$_sistema]["sist"] = $GLOBALS['_usando'];
						$_SESSION[$_sistema]["horaAcceso"]= date("Y-n-j H:i:s");
					}
					if($_SESSION[$_sistema]["sist"] != "CARACOL2.0") {
						if ($_SESSION[$_sistema]['usuario'] != 0) {
							$_SESSION[$_sistema]['usuario'] = 0; $GLOBALS['_usando']= NULL;
							alerta("Termino la sesión correctamente. Hasta luego");
						}
					}
	
					if($_SESSION[$_sistema] && $_SESSION[$_sistema]["sist"] == "CARACOL2.0") {
						print $arquitecto->codigo('cargar_menu',
								"<script language=javascript>
									$('#mmenu').load('vistas/menu.php');
									$('#vista').load('vistas/inicio.php');
								</script>"	)->hacerCodigo();
					}
					
					
				}
				else
					$arquitecto->crearInicioSesion("Tu clave es incorrecta");
			}
			else
				$arquitecto->crearInicioSesion("No te encuentras en la base de datos");
			exit('');
	}
	
	
	
?>