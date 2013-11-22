<?php
/*
 *Descripcion general
 *Aqui se tendran los modulos de Recuperar o Cambiar clave, dependiendo al chebox seleccionado es como se
 *muestra el 'div' de recuperar o cambiar clave. Se obtendran los datos y se mandaran al mismo archivo
 *para procesarlos (recuperar o modificar clave) mediante jquery. 
 */
	session_start();
?>
<script>
$(document).ready(function(){
	//Checkbox de recuperar clave
	$("#recu").change(function(){
		$('#recuperar').css('display','block');
		$('#recu').attr('disabled','disabled', true);
		$('#camb').attr('disabled','disabled', true);
	});
	//Checkbox de cambiar clave
	$("#camb").change(function(){
		$("#cambiar").css('display', 'block');
		$('#recu').attr('disabled','disabled', true);
		$('#camb').attr('disabled','disabled', true);
	});
	//Enviar datos para cambiar clave
	$("#cambiarClave").click(function() {
		var usuario = $("#usuario").val();
		var clave = $("#clave").val();
		var clavenue = $("#clavenue").val();
		var clavenue_r = $("#clavenue_r").val();
		if(clavenue == clavenue_r){
			//alert(usuario+clave+clavenue+clavenue_r);
			$.post("./vistas/recuClave.php",  { usuario:usuario,clave:clave, clavenue:clavenue, clavenue_r:clavenue_r, Listado_de: "cambiarclave"  }, function(options) {		
				$("#vista").html(options);	
			});
		}
		else
			alert("Las claves nuevas no coinciden");
	});
	//Enviar datos para recuperar la clave
	$("#recuClave").click(function(){
		var usu = $("#usu").val();
		$('#recuperar').css('display','none');
		$('#cargando').css('display','block');
		//alert(usu);
		$.post("./vistas/recuClave.php",  { usu:usu, Listado_de: "recuperarclave"  }, function(options) {		
			$("#vista").html(options);	
		});
	});
});

</script>
<?php 	
	include "../librerias/caracol.php";
	iniciarCaracol();
	if(isset($_REQUEST['Listado_de']))
		$catalogo = $_REQUEST['Listado_de'];
	else
		$catalogo = "";
	print "<br><br>";
	print $arquitecto->texto("vista_titulo","Recuperar o cambiar clave")->hacerCodigo();
	print "<br><br>";
/*
* #############################################################################################################
* 																				MODULO INICIAL 
* ############################################################################################################
* */
	if(!$catalogo){
			print $arquitecto->tabla("tabla_blanca",array(
																						array(
																						 "Recuperar clave",$arquitecto->entrada("recu", "checkbox", "", "","")->hacerCodigo(),
																						"Cambiar clave",$arquitecto->entrada("camb", "checkbox", "", "","")->hacerCodigo(),
																						),
															"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
			)->hacerCodigo();
			
			print $arquitecto->tabla("tabla_blanca",array(
			array(
			$arquitecto->liga("liga_retorno","vista","inicio.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/regresar_n.png"))
			)->hacerCodigo()),
																													"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
			)->hacerCodigo();
/*
* #############################################################################################################
* 												 DIV OCULTO PARA RECUPERAR DE CLAVE
* ############################################################################################################
* */			
			print "<div id='recuperar' style='display:none;'>";
				print "<br><br>";
				print "Usuario".$arquitecto->entrada("usu", "texto", "")->hacerCodigo();
				print "<br><br>";
				print $arquitecto->tabla("tabla_blanca",array(
													array(
															$arquitecto->liga2("recuClave","vista","","","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/enviar_n.png"))
															)->hacerCodigo(),
															$arquitecto->liga("liga_retorno","vista","inicio.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/cancelar_no.png"))
															)->hacerCodigo()),
															"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
										)->hacerCodigo();
			print "</div>";
/*
* #############################################################################################################
* 												 DIV OCULTO PARA EL CAMBIO DE CLAVE
* ############################################################################################################
* */
			print "<div id='cambiar' style='display:none;'>";
			print "<br>";
			print $arquitecto->texto('titulo_1000','Cambio de Clave')->hacerCodigo();
				print $arquitecto->tabla("tabla_generica", array(
																						array("Usuario",$arquitecto->entrada("usuario", "texto", "")->hacerCodigo()),
																						array("Clave",$arquitecto->entrada("clave", "password", "")->hacerCodigo()),
																						array("Clave Nueva",$arquitecto->entrada("clavenue", "password", "")->hacerCodigo()),
																						array("Repetir Clave",$arquitecto->entrada("clavenue_r", "password", "")->hacerCodigo()),
																	),"",array("left' width='120","left")
										)->hacerCodigo();
				print "<br>";
				print $arquitecto->tabla("tabla_blanca",array(
																					array(
																					$arquitecto->liga2("cambiarClave","vista","","","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/enviar_n.png"))
																					)->hacerCodigo(),
																					$arquitecto->liga("liga_retorno","vista","inicio.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/cancelar_no.png"))
																					)->hacerCodigo()),
																			"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
													)->hacerCodigo();
			
			print "</div>";
	}

	switch($catalogo){
/*
* #############################################################################################################
* 												 MODULOS PARA  ACTUALIZACION DE CLAVE
* ############################################################################################################
* */
		case "cambiarclave":
			$usuario = $_POST['usuario'];
			$clave = $_POST['clave'];
			$clavenue = $_POST['clavenue'];
			$clavenue_r = $_POST['clavenue_r'];
			$idUsu = $db->consulta("SELECT id_usuario FROM Usuario WHERE usuario ='".$usuario."' AND clave='".md5($clave)."'");
			if($idUsu){
				$res = "UPDATE Usuario SET
								clave ='".md5($clavenue)."'
							WHERE
								id_usuario = ".$idUsu[0][0];
				if($db->exeSql($res)){
					print $arquitecto->texto("vista_titulo", "Se a modificado correctamente")->hacerCodigo();
					print "<br>";
						print $arquitecto->tabla("tabla_blanca",array(
																					array(
																					$arquitecto->liga("liga_retorno","vista","inicio.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/regresar_n.png"))
																					)->hacerCodigo()),
																			"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
													)->hacerCodigo();
				}
				
			}
			else{
				print "<br>";
				print $arquitecto->texto("vista_titulo_no", "Usuario o clave incorrecta")->hacerCodigo();
				print $arquitecto->tabla("tabla_blanca",array(
																							array(
																							$arquitecto->liga("liga_retorno","vista","recuClave.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/regresar_n.png"))
																							)->hacerCodigo()),
																							"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
																							)->hacerCodigo();
			}
			break;
/*
* #############################################################################################################
* 												 MODULOS PARA  RECUPERACION DE CLAVE
* ############################################################################################################
* */
		case "recuperarclave":
			$usuario = $_POST['usu'];
			include "../librerias/phpmailer/class.phpmailer.php";
			$mail = new PHPMailer();
			$idUsu = $db->consulta("SELECT id_usuario, id_persona FROM Usuario WHERE usuario ='".$usuario."'");
			if($idUsu){
					$ma = $db->consulta("SELECT mail FROM Persona WHERE id_persona = ".$idUsu[0][1]);
					//$ma= $db->consulta("SELECT");
					if($ma[0][0] != '[NULL]'){
							$mail2 = $ma[0][0];//alimentamos el generador de aleatorios
							mt_srand (time());//generamos un número aleatorio
							$numero_aleatorio = mt_rand(100000,200000);
							$mail->From     = "sistemas@gruposimpaq.com"; // Mail de origen
							$mail->FromName = "Sistemas"; // Nombre del que envia
							$mail->AddAddress($mail2); // Mail destino, podemos agregar muchas direcciones
							$mail->WordWrap = 50; // Largo de las lineas
							$mail->IsHTML(true); // Podemos incluir tags html
							$mail->Subject  =  "Nueva Clave:";
							$mail->Body     =  "Usuario $usuario, tu nueva clave es:$numero_aleatorio \n<br />";
							$mail->AltBody  =  strip_tags($mail->Body); // Este es el contenido alternativo sin html
							$mail->IsSMTP(); // vamos a conectarnos a un servidor SMTP
							$mail->Host = "mail.gruposimpaq.com"; // direccion del servidor
							$mail->SMTPAuth = true; // usaremos autenticacion
							$mail->Username = "sistemas@gruposimpaq.com"; // usuario
							$mail->Password = "221436"; // contraseña
							
							$res = "UPDATE Usuario SET
															clave ='".md5($numero_aleatorio)."'
														WHERE
															id_usuario = ".$idUsu[0][0];
							if ($mail->Send()){
								print $arquitecto->texto("vista_titulo", "Su clave nueva fue enviada a su correo electronico $mail2 <br> Si no es su mail consulte con el administrador")->hacerCodigo();
								$db->exeSql($res);
							}
							else
								print $arquitecto->texto("vista_titulo_no", "Hubo un error con el cliente de correo. Consulta al administrador")->hacerCodigo();
						
					}
					else
						print $arquitecto->texto("vista_titulo_no", "No tienes mail. Consulta al administrador")->hacerCodigo();
			}
			else 
				print $arquitecto->texto("vista_titulo_no", "No te encuentras en la base de datos")->hacerCodigo();
			
			print $arquitecto->tabla("tabla_blanca",array(
			array(
			$arquitecto->liga("liga_retorno","vista","recuClave.php", "cancelar","",array($arquitecto->imagen("liga_retorno_imagen","imagenes/regresar_n.png"))
			)->hacerCodigo()),
																										"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
			)->hacerCodigo();
	break;
	}
	print "<div id='cargando' style='display:none;'>";
					print $arquitecto->tabla("tabla_blanca",array(
																					array(
																					$arquitecto->texto("vista_titulo", "Enviando")->hacerCodigo(),
																					$arquitecto->imagen("liga_retorno_imagen","imagenes/roller.gif")->hacerCodigo()),
																			"",array() ), "",array("right' width='110' style='font-size:.9em; font-weight:bold;","","right' width='140' style='font-size:.9em; font-weight:bold;","")
													)->hacerCodigo();
	print "</div>";
	terminarCaracol();
	print "<br><br><br><br>";
?>

