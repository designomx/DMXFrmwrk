/*
	Scripts de inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/

//Script para registrar usuarios
$( "#FormularioRegistro" ).submit(function( event ) {
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
			url: "php/BenjaminPalacios.php",
			data: formData
			
		})
	    .done(function(data){
					//alert(data);
					if(data=="Resgistro exitoso!"){
						//alert("Login correcto.. Redireccionando");
						window.location = "#"
						
					}else{
						if(data=="Error creando el registro!"){
							alert("Error creando usuario")
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
				alert("Login correcto.. Redireccionando");
				alert(data);
				window.location = "listado.php";

			}else{
				if(data=="usuario"){
					alert("Usuario NO administrador");
					//window.location = "#";
					alert(data);
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
    	alert(data);
    	return false;

    })
});
