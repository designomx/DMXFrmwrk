/*
	Scripts de inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/
$(document).ready(function(){
		localStorage.autorizado = window.localStorage.getItem("autorizado");
	    // value is now equal to "value"
	    //alert(localStorage.autorizado);
		if(window.localStorage.getItem("autorizado")=="1"){
			window.location = "BenjaminPalaciosAPP.html";
		}
    
  

});

//Script para registrar usuarios
$( "#BotonRegistrar" ).click(function( event ) {
	if($('#password').val()==$('#password_confirmation').val()){
		var formData = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val()

	        }
		$.ajax({
			type: "POST",
			url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/BenjaminPalacios.php",
			data: formData
			
		})
	    .done(function(data){
					//alert(data);
					if(data=="Resgistro exitoso!"){
						//alert("Login correcto.. Redireccionando");
						window.location = "index.html"
						
					}else{
						if(data=="Error creando el registro!"){
							alert("Error creando usuario");

						}else{
							alert("Usuario ya registrado")
						}
						return false;
					}
	          	}
	    )
	    .fail(function(){
	    	alert("Posting failed");
	    })
	}else{
		alert("El password no coincide")
	}
	return false;

});

//Script para inicio de sesión
$( "#BotonLogin" ).click(function( event ) {
	if ($('#AceptaTerminos').is(":checked"))
		{
			var Acepta = 1;
		}else{
			var Acepta = 0;
		}
	//alert(Acepta);
	if(Acepta=='1'){	
		var formData = {
				//Variables del formulario de login
	            email		: $('#login-name').val(),
	            password	: $('#login-pass').val()
	        }
	        //alert($('#email').val())
		$.ajax({
			type: "POST",
			url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/BenjaminPalaciosPG.php",
			data: formData,
			dataType: "json"
		})
		.done(function(data){
				//alert(data);
				//alert(data.name);
				if(typeof(Storage) !== "undefined") {
					window.localStorage.setItem("TipoUsuario", data.tipo_usuario);
					window.localStorage.setItem("autorizado", data.autorizado);
					window.localStorage.setItem("email", data.email);
					window.localStorage.setItem("name", data.name);

					localStorage.TipoUsuario = data.tipo_usuario;
					localStorage.NombreUsuario = data.name;
					localStorage.email = data.email;
					localStorage.autorizado = data.autorizado;					
				}else{
					alert("Sorry, your browser does not support web storage...");
				}
				if(localStorage.TipoUsuario=="1"){
					//alert("Bienvenido");
					//alert(data);
					window.location = "BenjaminPalaciosAPP.html";
					return false;

				}else{
					if(localStorage.autorizado=="1"){
						//alert("Usuario NO administrador");
						window.location = "BenjaminPalaciosAPP.html";
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
	    .fail(function(data){
	    	alert("Error!");
	    	//alert(data);
	    	return false;

	    })
	}else{
		alert("Debe aceptar Términos y Condiciones");
	}
});


