<?php
	session_start();
	include "../librerias/caracol.php";
	iniciarCaracol();
		print "<br>";
		print $arquitecto->texto("titulo_aplicacion",$GLOBALS['_titulo']." &nbsp;")->hacerCodigo();
	terminarCaracol();
?>