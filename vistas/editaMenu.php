<?php
	session_start();
	include "../librerias/caracol.php";
	iniciarCaracol(); 
	
	print $arquitecto->texto("vista_titulo", "Editar Menu")->hacerCodigo();

	terminarCaracol();
?>
