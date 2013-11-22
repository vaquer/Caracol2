<?php
	/*
	*	Constructor
	*	Libreria para crear elementos
	*	@author Sistemas
	*	@version 2.0
	*	@package Caracol
	*/
	/*
	*	Clase Elemento
	*	@package Caracol
	*	@subpackage Classes
	*/
	class Elemento {
		//	@access private
		//	@var string
		var $_nombre;
		//	@access private
		//	@var string
		var $_abre;
		//	@access private
		//	@var string
		var $_cierra;
		//	@access private
		//	@var array
		var $_contenido;
	
		/*
			*	Constructor : Elemento
		*	@see Elemento()
		*	@param string $abre
		*	@param string $cierra
		*	@param array $contenido
		*/
		function Elemento($nombre,$abre,$cierra,$contenido) {
			$this->_nombre = $nombre;
			$this->_abre = $abre;
			$this->_cierra = $cierra;
			$this->_contenido = $contenido;
		}
	
		function obtenNombre() {
			return $this->_nombre;
		}
	
		function defineContenido($contenido) {
			$this->_contenido=$contenido;
		}
	
		function obtenContenido($contenido) {
			return $this->_contenido;
		}
	
		/*
			*	hacerCodigo retorna un string con el codigo html del elemento
		*	@return string
		*/
		function hacerCodigo() {
			$ret = $this->_abre;
			for($i_elemento=0;$i_elemento<  sizeof($this->_contenido);$i_elemento++){
			if(isset($this->_contenido[$i_elemento])){
					if ($this->_contenido[$i_elemento] instanceof Elemento){
						$ret .= $this->_contenido[$i_elemento]->hacerCodigo();
					}else{
						$ret .= $this->_contenido[$i_elemento];
					}
				}
			}
			$ret .= $this->_cierra;
			return $ret;
		}
	}
	/*
	*	Clase Constructor
	*/
	class Constructor {
		
		/*
		*	Constructor : Constructor
     	*/
		function Constructor() {
		}
		
		/*
		*	codigo inserta codigo de forma libre del tipo html
		*	retorna un objeto del tipo Elemento
		*	@param string $codigo
		*	@return Elemento
		*/
		function codigo($nombre,$codigo) {
		$contenido = "";
		$ret = new Elemento($nombre,"<span id='".$nombre."' class='".$nombre."' >".$codigo,"</span>",$contenido);
					return $ret;
		}
		
		/*Descripcion crearInicioSesion()
		* Se crea la funcion general de crear acceso para poder retornar ciertos mensajes
		* con la variable $msj. Solo mandamos a llamar a la funcion enviandole un valor a la variable
		* $msj y nos retornara toda la division de login con el mensaje enviado por parametro.
		* Detalle
		* @param $msj Valor que mostrara en aviso en la parte inferior del login
		* */
		function crearInicioSesion($msj){
			global $arquitecto;
								print $arquitecto->division("loginFuera","", array(
																										"<center><h1>Modulo de Acceso</h1></center>",$arquitecto->division("frmLogin_area","",
																										array( "<br>",
																										$arquitecto->tabla("div_usuario",array(array(
																										$arquitecto->etiqueta("lbl_usuario","input_usuario","Usuario")->hacerCodigo(),
																										$arquitecto->entrada("input_usuario","text","","")->hacerCodigo()
																										),array(																																																				
																										$arquitecto->etiqueta("lbl_clave","input_clave","Clave")->hacerCodigo(),
																										$arquitecto->entrada("input_clave","password","","")->hacerCodigo()																										
																										)),array("","",""),array("","",""))->hacerCodigo(),
																										$arquitecto->division("div_recu","",array(
																											$arquitecto->liga("liga_recu","vista","recuClave.php","","",array( "Recuperar o cambiar Clave" ))->hacerCodigo()
																											//$arquitecto->texto("recu", "Recuperar contraseña","")->hacerCodigo()
																										)
																										),
																										 $arquitecto->division("div_msj","",array(
																											$msj
																											/*	$arquitecto->liga("liga_retorno","vista","Almacen/agregaProducto.php","","style='float: right;' ",
																												array($arquitecto->imagen("liga_retorno_imagen","imagenes/agregar_producto.png"))
																												)->hacerCodigo(),*/
																											)
																										)
																								)
																							),$arquitecto->division("div_botones","",array(																																																																						"<br>",
																										/*	$arquitecto->liga("liga_retorno","vista","Almacen/agregaProducto.php","","style='float: right;' ",
																										 array($arquitecto->imagen("liga_retorno_imagen","imagenes/agregar_producto.png"))
																										)->hacerCodigo(),*/
																										'<div id="divbtn_enviar"><a id="btn_enviar" href="#"><img src="./imagenes/ingresar.png"></img></a></div>',
																										'<div id="divbtn_cancelar"><a id="btn_cancelar" href="#"><img src="./imagenes/limpiar.png"></img></a></div>'
																										
																										)
																										)
																						)
																				)->hacerCodigo();
		}
		/*Descripcion comprobarSesion()
		*Comprobara la sesion, verificara el valor inicial que se crea al iniciar sesion y sacara
		*el valor actual. Restara los valores de la hora actual menos la hora de inicio y SI es menor
		*a 15 minutos cambiara la hora de acceso con la hora actual, SI NO es menor se caduco la sesion
		*y se mandara al archivo de cerrar sesion 
		* Detalle
		* @param $_sistema Valor que identifica que sistema esta y en que sesion
		* */
		function comprobarSesion($_sistema){
			$horaAcceso = $_SESSION[$_sistema]['horaAcceso'];
			$horaActual = date("Y-n-j H:i:s");
			$tiempo_transcurrido = ( strtotime($horaActual) - strtotime($horaAcceso));
			if($tiempo_transcurrido < 900){//Calculo de 15 minutos = 900 Seg
				$_SESSION[$_sistema]['horaAcceso'] =date("Y-n-j H:i:s");
			}
			else{
					print "<script language='javascript'>
								$(document).ready(function(){
									alert('Tu sesion a caducado');
									$('#vista').load('vistas/delogear.php');
									$('#aute_nav').empty();
								});
							</script>";
			}
		}

		/*
		*	division crea una division del tipo html <div>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function division($nombre,$atributos="",$contenido="") {
			$ret = new Elemento($nombre,"<div id='".$nombre."' name='".$nombre."' class='".$nombre."' ".$atributos." >","</div>",$contenido);
			return $ret;
		}
		
		/*
		*	texto crea un un font con texto del tipo html <font>texto</font>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $texto
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function texto($nombre,$texto,$atributos="",$contenido="") {
			$ret = new Elemento($nombre,"<div id='".$nombre."' nombre='".$nombre."' class='".$nombre."' ".$atributos." >", //se exlimino la etiqueta font
							$texto."</div>", $contenido);
			return $ret;
		}

		/*
		*	imagen crea una imagen del tipo html <img></img>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $imagen
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function imagen($nombre,$imagen,$atributos="",$contenido="") {
			$ret = new Elemento($nombre,"<div id='div".$nombre."' style = \"float:left;\"><img id='".$nombre."' name='".$nombre."' class='".$nombre."' src='".$imagen."' ".$atributos." >",
							"</img></div>", $contenido);
			return $ret;
		}
		/*
		*	areaTexto crea una area de texto del tipo html <textarea></textarea>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $texto
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function areaTexto($nombre,$texto,$atributos="",$contenido="") {
			$ret = new Elemento($nombre,"<div id='div".$nombre."'><textarea  id='".$nombre."' name='".$nombre."' class='".$nombre."' ".$atributos." >",
							$texto."</textarea></div>",
							$contenido);
			return $ret;
		}

		/*
		*	liga crea una liga(link) del tipo html <a></a>
		*	esta liga actualiza un Elemento existente por una vista
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $vista
		*	@param string $post_arreglo
		*	@param string $modificado
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function liga($nombre,$contenedor,$vista_siguiente,$post_arreglo="",$atributos="",$contenido="",$clase="") { //se le agrego un parametro para pasar variables post
			$varPost="";
			if($post_arreglo != ""){
				$varPost = " { ";
				for($i=0;$i<count($post_arreglo);$i++){
					$varPost = $varPost.$i.":\"".$post_arreglo[$i]."\",";
				}
				$varPost = ", { \"".$nombre."\":".substr($varPost,0,-1)." } }";
			}
			
			if ($clase == "") $clase = $nombre;
			$ret = new Elemento($nombre,"<div id='div_".$nombre."'><a id='".$nombre."' name='".$nombre."' class='".$clase."' href='#' onClick='
							$(\"#".$contenedor."\").fadeIn(\"fast\",function(){
								$(\"#".$contenedor."\").load(\"vistas/".$vista_siguiente."\"".$varPost.");								
							});
							return false;							
							' ".$atributos." >",
							"</a></div>", $contenido);
			return $ret;
		}
		function liga2($nombre,$contenedor,$vista_siguiente,$post_arreglo="",$atributos="",$contenido="",$clase="") { //Mandar a llamar una funcion
			//se le agrego un parametro para pasar variables post
			$varPost="";
			if($post_arreglo != ""){
				$varPost = " { ";
				for($i=0;$i<count($post_arreglo);$i++){
					$varPost = $varPost.$i.":\"".$post_arreglo[$i]."\",";
				}
				$varPost = ", { \"".$nombre."\":".substr($varPost,0,-1)." } }";
			}
			if ($clase == "") $clase = $nombre;
			$ret = new Elemento($nombre,"<div id='div_".$nombre."'><a id='".$nombre."' name='".$nombre."' class='".$clase."' href='#' onClick='$vista_siguiente' ".$atributos." >",
									"</a></div>", $contenido);
			return $ret;
		}
		/*
		*	Le falta que le apunten que hace xD
		*	@return Elemento
     	*/				
		function fecha($nombre, $valor='',$contenido="", $atributos=''){
			if($valor == "") $v = date('d/m/Y'); else $v = $valor;
			$ret = new Elemento($nombre,
				"<div id='_".$nombre."'>
				<input id='".$nombre."' name= '".$nombre."' type='text' value='".$v."' ".$atributos." >",
				"</input></div>
				<script type='text/javascript'>
				$(document).ready(function(){
					$('#".$nombre."').datepicker({
						changeMonth: true,
					    changeYear: true
						});
				});
				</script>
				",$contenido);
			return $ret;
		}
		/*
		*	sleccion crea una seleccion del tipo html apartir de un arreglo <select></select>
		*	el arreglo puede estar vacio e integrarle las opciones desde el constructor o bien con codigo html
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param array $arreglo
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function seleccion($nombre,$arreglo,$ubicar="",$atributos="",$contenido="") {
			$opt_str="";
			if(isset($arreglo)){
				for($i_opt_str=0;$i_opt_str<sizeof($arreglo);$i_opt_str++){
					if(sizeof($arreglo[$i_opt_str])<2) return "[No se pudo crear la SELECCION: no hay elementos suficientes en el arreglo]";
					if ($ubicar==$arreglo[$i_opt_str][0]) $marca = "Selected"; else $marca = "";
					$opt_str.="<option value='".$arreglo[$i_opt_str][0]."' $marca>".$arreglo[$i_opt_str][1]."</option>";
				}
			}
			$ret = new Elemento($nombre,"<div><select id='".$nombre."' name='".$nombre."' class='".$nombre."' ".$atributos." >".$opt_str,
							"</select></div>",
							$contenido);
			return $ret;
		}
			/*
		*	Enviar crea una liga <a> que envia los datos contenidos en los controles especificados por el usuario
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $contenedor
		*	@param array $vista_siguiente
		*	@param array $arreglo_port
		*	@param array $contenido
		*	@param array $clase
		*	@param array $funcionext
		*	@return Elemento
     	*/		
		public function Enviar($nombre,$contenedor,$vista_siguiente,$arreglo_post,$contenido=array(),$clase="",$funcionext="",$atributos=""){
			if(sizeof($arreglo_post) == 0)
				return "<p>No hay elementos para enviar. Comprueba tu arreglo.</p>";
			else{
			$cadena = "";
			$cuenta = 0;
				foreach($arreglo_post as $post){
				if($cuenta > 0 && $cuenta < (sizeof($arreglo_post)))  $cadena  .=',';
					$cadena  .= "\"".$post."\"";
					$cuenta++;
				}
					//print $cadena;
				$funcion = "<script>
					
								function enviar_".$nombre."(){	
									var cadena_post='';
									var post = [".$cadena."];
									var cuenta = 0;
									var proxima_vista = \"".$vista_siguiente."\";
									var contenedor = \"".$contenedor."\";
									for(variable in post){
										if(cuenta > 0)
										// alert($('#'+post[variable]).attr('type'));
											cadena_post += '&';
										switch($('#'+post[variable]).attr('type')){
											case 'text':
												cadena_post += post[variable]+'='+$('#'+post[variable]).val();
											break;
											case 'radio':
												var strRt = '';
												g = document.getElementsByName(post[variable]);
												for(j=0;j<g.length;j+=1){
													if(g[j] != null){
														strType = g[j].type.toLowerCase();
													   if(g[j].checked == true) strRt = g[j].value;
													}
												}
												cadena_post += post[variable]+'='+strRt;
											break;
											case 'checkbox':
												cadena_post += post[variable]+'='+$('#'+post[variable]).attr('checked');					
											break;
											case 'select-one':
												cadena_post += post[variable]+'='+$('#'+post[variable]).val();
											break;
											
											case 'textarea':
												cadena_post += post[variable]+'='+$('#'+post[variable]).val();	
											break;
											case 'hidden':
												cadena_post += post[variable]+'='+$('#'+post[variable]).val();	
											break;
											
										}								
										cuenta++;
									}
									
									$.ajax({
										type : \"POST\",
										url : proxima_vista,
										data : cadena_post,
										success:function(datos){
											$('#'+contenedor).empty();
											$('#'+contenedor).append(datos);
											return 0;
										}			
									});
								}</script>";
				
				$ret = new Elemento($nombre,$funcion."<div id='div".$nombre."'><a id='".$nombre."' name='".$nombre."' class='".$clase."' href='#' onClick='enviar_".$nombre."()' ".$atributos." >",
									"</a></div>", $contenido);
				return $ret;
				
			}
		}
		
		/*
		*	tabla crea una tabla del tipo html apartir de un arreglo <table></table>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param array $arreglo
		*	@param array $contenido
		*	@return Elemento
     	*/						
		function tabla($nombre,$arreglo,$atributos="",$atributos_columans="",$contenido="") {
			$tbl_str = "";
			$col_arry = array();
			// print $arreglo[1][0];
			if(is_array($atributos_columans)) $col_arry = $atributos_columans;	
			$alt = 1;
			for($i_table_rows=0;$i_table_rows<sizeof($arreglo);$i_table_rows++){
				if($alt == 1) $alter = 'alt'; else $alter = '';
				$tbl_str .= "<tr id='".$nombre."_tr".$i_table_rows."'; class='".$alter."'>";  // se realizo cambio de linea a 1 y 2 para el estilo //realizo cambio id agrego nombre
					for($i_table_cols=0;$i_table_cols<sizeof($arreglo[$i_table_rows]);$i_table_cols++){
					if(isset($arreglo[$i_table_rows][$i_table_cols]) && isset($col_arry[$i_table_cols]) ){
						$tbl_str .= 
						"<td id='".$nombre."_td".$i_table_cols."' align='"
						.$col_arry[$i_table_cols]."'>"
						.$arreglo[$i_table_rows][$i_table_cols].
						"</td>";
					} //else print "NO<br>";
					}
				$tbl_str .= "</tr>";
				if($alt == 1) $alt = 0; else $alt = 1;
			}
			
			$ret = new Elemento($nombre,"<table id='".$nombre."' name='".$nombre."' class='".$nombre."' ".$atributos." >".$tbl_str, //se realizo cambio, se quitarons los divs y se dejo solo la tabla
							"</table>",
							$contenido);
			//print $ret->hacerCodigo();
			return $ret;
		}		
		
		/*
		*	tabla crea una tabla con atributos por celda del tipo html apartir de un arreglo <table></table>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param array $arreglo
		*	@param array $contenido
		*	@return Elemento
     	*/						
		function tabla_simple($nombre,$arreglo,$atributos="", $atributo_celda="", $atributos_columans="",$contenido="") {
			$tbl_str = "";
			$col_arry = array();
			$celda_array= array();
			
			if(is_array($atributos_columans)) $col_arry = $atributos_columans;
			if(is_array($atributo_celda)) $celda_array = $atributo_celda;
			
			for($i_table_rows=0;$i_table_rows<sizeof($arreglo);$i_table_rows++) {
				$tbl_str .= "<tr id='".$nombre."_tr".$i_table_rows."'; class='fila_".($i_table_rows%2)."'>";  // se realizo cambio de linea a 1 y 2 para el estilo //realizo cambio id agrego nombre
					for($i_table_cols=0;$i_table_cols<sizeof($arreglo[$i_table_rows]);$i_table_cols++){
						$tbl_str .= 
						"<td id='".$nombre."_td".$i_table_rows."' align='"
						.$col_arry[$i_table_cols]."' ".$celda_array[$i_table_rows][$i_table_cols].">"
						.$arreglo[$i_table_rows][$i_table_cols].
						"</td>";
						//print $arreglo[$i_table_rows][$i_table_cols];
					}
				$tbl_str .= "</tr>";
			}
			
			$ret = new Elemento($nombre,"<table id='".$nombre."' ".$atributos." >".$tbl_str, //se realizo cambio, se quitarons los divs y se dejo solo la tabla
							"</table>",
							$contenido);
			return $ret;
		}	
		/*
		*	etiqueta crea una etiqueta del tipo html <label></label>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $para
		*	@param string $texto
		*	@param array $contenido
		*	@return Elemento
		*/
		function etiqueta($nombre,$para,$texto,$atributos="",$contenido="") {
			$ret = new Elemento($nombre,"<div id='div".$nombre."' style = 'float:left;'><label id='".$nombre."' name='".$nombre."' class='".$nombre."' for='".$para."' ".$atributos." >",
			$texto."</label></div>",
			$contenido);
			return $ret;
		}

		/*
		*	entrada crea un input del tipo html <input></input>
		*	retorna un objeto del tipo Elemento
		*	@param string $nombre
		*	@param string $tipo
		*	@param string $texto
		*	@param array $contenido
		*	@return Elemento
     	*/				
		function entrada($nombre,$tipo,$valor,$texto="",$atributos="",$contenido="",$clase="",$atributosdiv="") {
			$clase = ($clase == "") ? $clase = $nombre : $clase;
			$textoizq = ($tipo == "text" || $tipo == "radio") ? $texto:'';
			$texto = ($textoizq != "") ?'': $texto;
			
			$ret = new Elemento($nombre,"<div id='div".$nombre."' $atributosdiv>$textoizq<input id='".$nombre."' name='".$nombre."' class='".$clase."' type='".$tipo."' value='".$valor."' ".$atributos." >",
							$texto."</input></div>",
							$contenido);
			
			return $ret;
		}	
		
		function null($var) {
			if (isset($var)) 
				return ($var);
			else {
				return ('');
			}
		}	

	

	}
		
  

?>