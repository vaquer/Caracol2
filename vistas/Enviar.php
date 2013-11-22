<?php	
	session_start();

	include	"../librerias/caracol.php";

	iniciarCaracol();
	print '<div id = "seccion_activa"><div id = "seccion_activa_txt">Enviar</div></div>';
	print $arquitecto->texto("subtitulo","Prueba de titulo")->hacerCodigo();
	print $arquitecto->entrada("Nombre","text","")->hacerCodigo();
	print $arquitecto->entrada("Primer_Apellido","text","")->hacerCodigo();
	print $arquitecto->entrada("Segundo_Apellido","text","")->hacerCodigo();
	print $arquitecto->entrada("sexo","radio","F","Femenino","checked")->hacerCodigo();
	print $arquitecto->entrada("sexo","radio","M","Masculino")->hacerCodigo();
	print $arquitecto->entrada("correcto","checkbox","Correcto","Correcto")->hacerCodigo();
	print "<select id='Seleccion'><option value='Uno'>Uno</option><option value='Dos'>Dos</option></select>";
	print "<textarea id='areatexto'></textarea>";
	print $arquitecto->Enviar("Enviar","respuesta","./vistas/Cachar.php",array("Nombre","Primer_Apellido","Segundo_Apellido","sexo","correcto","Seleccion","areatexto"),array("Enviar"))->hacerCodigo();
	// enviar("proceso.php","Nombre,Primer_Apellido,Sexo,Correcto");
	print "<div id ='respuesta'><div>";
	// print "<a id ='enviarr' href='#'>Enviarrrr</a>";
	terminarCaracol();
?>

