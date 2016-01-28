/*
	Scripts de inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/
$(document).ready()
//Script para registrar usuarios
$( "#FormularioRegistro" ).submit(function( event ) {
	if($('#password').val()==$('#password_confirmation').val()){
		var formData2 = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val()
	        }
		$.ajax({
			type: "POST",
			url: "php/BenjaminPalacios.php",
			data: formData2,
			dataType: "html"
		})
	    .done(function(data){
					//alert(data);
					console.log('SUCCESS :)');
					if(data=="exitoso"){
						//alert("Registro Exitoso");
						window.location = "index.php";			
					}else{
						if(data=="Error creando el registro!"){
							alert("Error creando usuario");
						}else{
							alert("Usuario ya registrado");
						}
						return false;

					}
	          	}
	    )
	    .fail(function(xhr,data){
	    	alert("Posting failed");
	    	console.log('FAIL :(');
	    	console.log(xhr);
	    	console.log(data);
			window.location = "index.php";
	    })
	    .always(function() { 
	    	console.log('Doh, I\'m fired anyway');
			window.location = "index.php";
	    });
	}else{
		alert("El password no coincide");
		return false;

	}
});

//Script para inicio de sesión
$( "#BotonLogin" ).click(function( event ) {
	var formData = {
			//Variables del formulario de login
            email		: $('#login-name').val(),
            password	: $('#login-pass').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalacios.php",
		data: formData,
		dataType: "html"
	})
	.done(function(data){
			//alert(data);
			if(data=="admin"){
				alert("Bienvenido");
				//alert(data);
				window.location = "listado.php";

			}else{
				if(data=="usuario"){
					alert("Usuario NO administrador");
					//window.location = "#";
					//alert(data);
					return false;
				}else{
					alert("Error en usuario y/o contraseña");
					return false;
				}
			}
            //$("#Resultado").html(data);
            //$("#Resultado").html("Procesando, espere por favor...");
        }
    )
    .fail(function(){
    	alert("Error!");
    	//alert(data);
    	return false;

    })
});
