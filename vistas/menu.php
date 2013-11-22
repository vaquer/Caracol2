<?php
	session_start();
	include "../librerias/caracol.php";
	print "<script type='text/javascript' src='./librerias/js/menu.js'></script>";
	iniciarCaracol();

	if($_SESSION[$_sistema]["sist"] == "CARACOL2.0"){
		$arquitecto->comprobarSesion($_sistema);
			$arreglo_inicio = array(
					$arquitecto->liga("inicio_liga_m","vista","inicio.php","","",array( "Inicio" ))->hacerCodigo(),
					"&nbsp;|&nbsp;",
					$arquitecto->liga("inicio_liga_m","vista","prueba.php","","",array( "Preuba" ))->hacerCodigo(),
					"&nbsp;|&nbsp;",
					$arquitecto->liga("inicio_liga_m","vista","delogear.php","","",array( "Salir" ))->hacerCodigo(),
				);
	
			$arreglo_general =
				array(
						//$arquitecto->liga("salir_liga_m","vista","inicio.php","","",array( "Inicio" ))->hacerCodigo(),
						//"&nbsp;|&nbsp;"
				);
	
			$arreglo_admin =
				array(
					//$arquitecto->liga("usuarios_liga_m","vista","Cliente/Cliente.php","","",array( "clientes" ))->hacerCodigo(),
					//"&nbsp;|&nbsp;"
				);
				//print $_SESSION[$_sistema][0][5];			
				if($_SESSION[$_sistema][0][5] <= 46) {// Es Adminsitrador
					 $arreglo_general = array_merge($arreglo_admin,$arreglo_general);
			}
			
			$arreglo_seglinea = array(
					//$arquitecto->liga("usuarios_liga_m","vista","Almacen/Cuarentena.php","","",array("Cuarentena"))->hacerCodigo(),
					//"&nbsp;|&nbsp;",
					//$arquitecto->liga("usuarios_liga_m","vista","Almacen/inicio.php","","",array( "Almacen" ))->hacerCodigo()
			);
			
		    $arreglo_general = array_merge($arreglo_inicio,$arreglo_general);
			$arreglo_general = array($arreglo_general);
			
			print $arquitecto->tabla("tabla_blanca",$arreglo_general,"")->hacerCodigo();
			print $arquitecto->tabla("tabla_blanca",array($arreglo_seglinea),"")->hacerCodigo();

			$strSql = "SELECT * FROM MENU_DET WHERE ID_MENU=3"; //Menu general
			$strSql2 = "SELECT * FROM MENU_DET WHERE ID_MENU= ".$_SESSION[$_sistema][0][11]."AND NIVEL = 0";
			$menu = $db->consulta($strSql);
			$menuDet =$db->consulta($strSql2);
			$ancho = (count($menuDet)+1)*66;
			//ARMAR MENU GENERAL DE INICIO Y SALIR
			print "<div id='contenedor' style='float:center; width: ".$ancho."px;'>";
			print "<div id='tabla_chec' style=' float:center; width:700px;' >";
			print "<ul id='nav'>";
			print "<li>".$arquitecto->liga("inicio_liga_m","vista",$menu[0][5],"","",array($menu[0][4] ))->hacerCodigo()."</a>";
			print "		<ul>
								<li>".$arquitecto->liga("inicio_liga_m","vista",$menu[1][5],"","",array($menu[1][4]))->hacerCodigo()." </li>
							</ul>
						</li>";
			//ARMAR MENU ESPECIFICO
			for ($i=0;$i<count($menuDet);$i++ ){
				$subMenu =$db->consulta("SELECT * FROM MENU_DET WHERE ID_MENU= ".$_SESSION[$_sistema][0][11]."AND NIVEL = ".$menuDet[$i][3]);
				if($subMenu){ //Si se tiene submenus los despliega Despliega
					print "<li>".$arquitecto->liga("inicio_liga_m","vista",$menuDet[$i][5],"","",array($menuDet[$i][4]))->hacerCodigo()." <ul>";
					for ($j=0;$j<count($subMenu);$j++ )
						print "<li>".$arquitecto->liga("inicio_liga_m","vista",$subMenu[$j][5],"","",array($subMenu[$j][4]))->hacerCodigo()." </li>";
					print "</ul>
							</li>";
				}
				else
					print "<li>".$arquitecto->liga("inicio_liga_m","vista",$menuDet[$i][5],"","",array($menuDet[$i][4]))->hacerCodigo()." </li>";
				
			}
			print "</ul>";
			print "</div>";
			print "</div>";
			
	
	}
	
	terminarCaracol();
?>
<br><br>