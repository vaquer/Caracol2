$(document).ready(function(){
	$('#vista').delegate('#enviarr','click',function (){	
		var cadena_post = "";
		var post = ['Nombre','Primer_Apellido','Segundo_Apellido','sexo','correcto'];
		var cuenta = 0;
		var proxima_vista = "Cacha.php";
		var contenedor = 'respuesta';
		
		for(variable in post){
			if(cuenta > 0)
				cadena_post += '&';
			switch($('#'+post[variable]).attr('type')){
				case 'text':
					cadena_post += post[variable]+'='+$('#'+post[variable]).val();
				break;
				case 'radio':
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
					cadena_post += post[variable]+'='+$('#'+post[variable]).attr('checked').toString();					
				break;
			}								
			cuenta++;
		}
		alert(cadena_post)
		
		$.ajax({
			type : "POST",
			url : "Cacha.php",
			data : "abc=sd",
			success:function(datos){
				// $('#'+contenedor).empty();
				// $('#'+contenedor).append(datos);
			}			
		});
	});
	/*
	$(document).ready(function(){
                                // alert($('#correcto').attr('checked'));
                                $('#vista').delegate('#enviarr','click',function(){  
                                    alert($('#correcto').attr('checked'));
                                    var cadena_post;
                                    var post = ["Nombre","Primer_Apellido","Segundo_Apellido","sexo","correcto"];
                                    var cuenta = 0;
                                    var proxima_vista = "Cachar.php";
                                    var contenedor = 'respuesta';
                                    alert($('#correcto').attr('checked'));
                                    for(variable in post){
                                        if(cuenta > 0)
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
                                        }                               
                                        cuenta++;
                                    }
                                    alert(cadena);
                                    $.ajax({
                                        type = "POST",
                                        url = proxima_vista,
                                        data = cadena_post,
                                        success:function(datos){
                                            $('#'+contenedor).empty();
                                            $('#'+contenedor).append(datos);
                                        }           
                                    });
                                });
                        });*/
});