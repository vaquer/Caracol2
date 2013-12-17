<?php
	/*
	*	Pagina Index del Marco Caracol
	*	@author Sistemas
	*	@version 1.0
	*	@package Caracol
	*/
	session_start();

	
	//Incluye la configuracion de la aplicacion
	include "librerias/caracolitos.php";
	
	/*
		Variable bandera de seguridad inicial
	*	@global $_SESSION['_caracol_seguro_A']
	*	@name $_donde
	*/
	$_SESSION["_caracol_seguro_A"] = "caracol_llave_A";

	/*
	*
		<script type="text/javascript">
			$(document).ready(function(){
				$("#contenido").load("inicio.php");
			});
		</script>
	*/
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
        <title><?php print $GLOBALS['_titulo']; ?></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>         
		<script type='text/javascript' src='./librerias/js/menu.js'></script>
		<link rel="stylesheet" type="text/css" href="estilos/jquery-ui_date.css">
		<link rel="stylesheet" type="text/css" href="estilos/date_picker.css">
		<script src='librerias/js/jquery.ui.core.js'></script>
		<script src='librerias/js/jquery.ui.widget.js'></script>
		<script src='librerias/js/jquery.ui.datepicker.js'></script>
	    <link rel="stylesheet" href='./estilos/<?php print $GLOBALS['_estilo']; ?>' />		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#contenido").load("inicio.php");
				$('#aute_nav').load('vistas/det_sesion.php');
			});
		</script>
    </head>
    <body>
		<div id="cabeza">
			<div id = "navegacion">
				<div id="logo_nav"></div>
				<div id="menu_nav"><div id="mmenu"></div></div>
			</div>
			<div id = "det_nav">
				<div id="nom_sist">
					<div id="nombre_sistema">
						<?php print $GLOBALS['_titulo']?>
					</div>
				</div>
				<div id="det_sist">
					<div id="aute_nav"></div>
				</div>
			</div>
		</div>
		<div id="cuerpo">
			<div id="barra">
			</div>
			<div id="contenido" <?php if(substr_count ( $_SERVER['HTTP_USER_AGENT'], 'MSIE') == 0) print 'style="overflow:scroll; overflow-x:hidden;"';?>> 
						
			</div>
		</div>
		<div id="pie">
			<div id="logo_pie">
			</div>
			<div id="pie_direcc�on">
			 <!--Direcccion-->
			</div>
		</div>
		
	</body>
</html>
<?

?>
