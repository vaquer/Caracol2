<?php
	session_start();
	include "../librerias/caracol.php";
	iniciarCaracol();
	$_SESSION[$_sistema]='';
	$_SESSION[$_sistema]["sist"]="";
	terminarCaracol();
?>
<script type=text/javascript>
	$('#mmenu').load('vistas/menu.php');
	$('#vista').load('vistas/inicio.php');
</script>
