<?php
/**
 * conexión de base de datos Oracle
 * @ autor  Ricardo Vega
 * @ version  1.0 
 */
 
class DBAdmin {
	var $conect;
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	var $Base;
	var $query;

	function DBAdmin(){
		$this->BaseDatos = "dboci8"; // "dboci8","mysql"
		$this->Servidor = "SIMPAQ52";
		$this->Usuario = "EJEMPLOS";
		$this->Clave = "EJEMSIMPAQ";
		$this->Base = "EJEMPLOS"; //Necesario solamente para MySQL
	}
	
	function conectar() {
		//print $Servidor;
		switch($this->BaseDatos){
		case'dboci8':
			$conn = oci_connect($this->Usuario, $this->Clave, $this->Servidor);
			if (!$conn) {
				$e = oci_error("Error de comunicacion (:E402.1.0). Favor de ponerse en contacto con el administrador");
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
		break;
		case 'mysql':
			$conn = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
			mysql_select_db($thid->Base);
		break;
		}
		$this->conect=$conn;
		return true;	
	}
	
	function consulta($sql_query){
		$cc_fila = 0;
		$rtArry = array();
		switch($this->BaseDatos){
		case'dboci8':
		//print $sql_query;
		if ($this->conectar()==false) return false;
		    
			$stid = oci_parse($this->conect, $sql_query );
			oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
			while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS) ) {
				$cc_columna = 0;
				foreach($row as $item){
					if($item != NULL) $rtArry[$cc_fila][$cc_columna] = $item; else $rtArry[$cc_fila][$cc_columna]='[NULL]';
					$cc_columna++;
				}
				$cc_fila++;
			}
		break;
		case 'mysql':
			$resultado = mysql_query($sql_query,$this->conect) or die(mysql_error());
			$renglones = mysql_num_rows($resultado);
			while($cc_fila<$renglones){
				$arreglo = mysql_fetch_array($resultado);
				$cc_columna = 0;
				foreach($arreglo as $item){
					if($item != NULL) $rtArry[$cc_fila][$cc_columna] = $item; else $rtArry[$cc_fila][$cc_columna]='[NULL]';
					$cc_columna++;
				}
				$cc_fila++;
			}
		break;
		}
		//print_r($rtArry);
		return $rtArry;
	}
	
	function exeSql($sql_query) {
		if ($this->conectar()==false) return false;
		//print $sql_query;
		$this->query = oci_parse($this->conect, $sql_query);
		$rr = oci_execute($this->query);
		
		if($rr)
			return $this->query;
		else
			return $rr;
	}

	function desconectar() {
		switch($this->BaseDatos){
			case'dboci8':
				oci_close($this->conect);
			break;
			case 'mysql':
				mysql_close($this->conect);
			break;
		}
	}
}

?>