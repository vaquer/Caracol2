<?php
	session_start();
	include "../librerias/caracol.php";
	// print "hola";
	iniciarCaracol();
	$arquitecto->comprobarSesion($_sistema);
	include "rutina.php";
	include "catalogos.php";
	if(!isset($_GET['rutina']) && !isset($_POST['detalle_acuerdo'][0]) && !isset($_GET['proyecto'])){
		$_GET['rutina'] = '';
		$_POST['detalle_acuerdo'][0]='';
		$_GET['proyecto']='';
	}
	// print $arquitecto->fecha("dtpacuerdo",$fecha_acuerdo,($_GET['rutina'] == 'ver')?'disabled':'')->hacerCodigo();
	print '<div id = "seccion_activa"><div id = "seccion_activa_txt">Acuerdo</div></div>';
	if($_GET['rutina'] == 'edita' || $_GET['rutina'] == 'ver')print '<div style="margin-bottom:10px;">'.$arquitecto->imagen("img_semaforo",$imagen,'style="width:134px; height:51px;"')->hacerCodigo().'</div><br>';
	print '<div style="margin-top:50px;">';
	if($_GET['rutina'] == 'registra' ) print "<h2>Nuevo Acuerdo</h2>"; else if ($_GET['rutina'] == 'registra') print "<h2>Edita Acuerdo</h2>";
	print $arquitecto->texto("titulo_1000","Acuerdo","style='*margin-left:10%;'")->hacerCodigo();
	print $arquitecto->tabla("tabla_form",array(	
			array("Titulo del Acuerdo","Responsable","Area"),
			array($arquitecto->entrada("txttituloacuerdo","text",$titulo,'',($_GET['rutina'] == 'ver')?'disabled style="width:350px;"':'style="width:350px;"')->hacerCodigo(),$arquitecto->seleccion("cbbresponsable",$responsable,$designado,($_GET['rutina'] == 'ver')?'disabled':'')->hacerCodigo(),$arquitecto->seleccion("cbbarea",$area,$designada,($_GET['rutina'] == 'ver')?'disabled':'')->hacerCodigo()),
			array("Fecha de Acuerdo","Fecha de Compromiso","Procentaje"),
			array($arquitecto->fecha("dtpacuerdo",$fecha_acuerdo,'',($_GET['rutina'] == 'ver')?'disabled="disabled"':'')->hacerCodigo(),$arquitecto->fecha("dtpcompromiso",$fecha_compromiso,'',($_GET['rutina'] == 'ver')?'disabled="disabled"':'')->hacerCodigo(),$arquitecto->seleccion("txtporcentaje",$porcentajes,$porcentaje,($_GET['rutina'] == 'ver')?'disabled':'')->hacerCodigo())
		),"",array("","",""))->hacerCodigo();		
	print $arquitecto->tabla("tabla_form",array(array("Descripci&oacute;n"),
			array($arquitecto->areaTexto("txadescripcion",$descripcion,($_GET['rutina'] == 'ver')?'disabled="disabled" COLS="105" ROWS="5" style="resize:none;"':'COLS="105" ROWS="5" style="resize:none;"')->hacerCodigo())),"",array("center"))->hacerCodigo();
	print $arquitecto->tabla("tabla_form",array(array("Avance"),
			array($arquitecto->areaTexto("txaavance",$avance,($_GET['rutina'] == 'ver')?'COLS="105" ROWS="5" disabled="disabled" style="resize:none;"':'COLS="105" ROWS="5" style="resize:none;"')->hacerCodigo())),"",array("center"))->hacerCodigo();
	if($_GET['rutina'] == 'edita' || $_GET['rutina'] == 'ver'){
		print $arquitecto->tabla("tabla_form",array(
					array("Terminado"),
					array($arquitecto->entrada("chkterminado","checkbox","terminado",'',($_GET['rutina'] == 'ver')?'checked disabled="disabled"':'')->hacerCodigo().(($_GET['rutina'] == 'ver')?'<p style="color:red;">Esta Terminado</p>':'')
							)					
			),"",array("","",""))->hacerCodigo();		
	}
	if(!isset($_GET['rutina'])){
		$_GET['rutina'] = '';
		$_POST['detalle_acuerdo'][0] = '';
	}
	
	if($_GET['rutina'] != 'ver'){
		print $arquitecto->tabla("tabla_blanca",array(array($arquitecto->Enviar("btnenviar","div_respuesta","vistas/Nuevo/registra.php",array("txttituloacuerdo","cbbresponsable","cbbarea",
								"dtpacuerdo","dtpcompromiso","txtporcentaje","txadescripcion","txaavance","txtrutina","chkterminado","txtidacuerdo","txtidproyecto")
							,array($arquitecto-> imagen("img_envia","./imagenes/enviar.png",'margin-left:center;"')->hacerCodigo()))->hacerCodigo())
				),"",array(""))->hacerCodigo();							
	}		
	print '</div>';
	print $arquitecto->division("div_respuesta")->hacerCodigo();
	print $arquitecto->entrada("txtrutina","hidden",$_GET['rutina'],"")->hacerCodigo();
	print $arquitecto->entrada("txtidacuerdo","hidden",$_POST['detalle_acuerdo'][0],"")->hacerCodigo();
	print $arquitecto->entrada("txtidproyecto","hidden",$_GET['proyecto'],"")->hacerCodigo();
?>