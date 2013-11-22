$(document).ready(function(){
	$("#input_usuario").focus();
	//LOGIN DE USUARIO
	$("#btn_enviar").click(function(){
		var usuario = $("#input_usuario").val();
		var clave = $("#input_clave").val();
		//alert(usuario+clave);
		if(usuario == '' || clave == '')
			$("#div_msj").html("Debes llenar ambos campos");
		else{
			$.post("./vistas/inicio.php",  {usuario:usuario,  clave:clave, Listado_de: "login"  }, function(data) {
			$("#vista").html(data);
			});
		}
	});
	$("#btn_cancelar").click(function(){
		var usuario = document.getElementById("input_usuario");
		var clave = document.getElementById("input_clave");
		usuario.value ='';
		clave.value ='';

	});
});