$(document).ready(function(){
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalaciosADMIN.php",
	})
	.done(function(data){
				$("#tabla_usuarios").html(data);	
            }
    )
    .fail(function(){
    	alert("Error!");
    	return false;

    })
});


//Script para registrar usuarios desde la vista de administrador
$( "#FormularioRegistroADMIN" ).submit(function( event ) {
	if($('#password').val()==$('#password_confirmation').val()){
		if ($('#usuario_admin').is(":checked"))
		{
			var usuario_admin = 1;
		}else{
			var usuario_admin = 0;
		}
		var formData = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val(),
	            usuario_admin: usuario_admin
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
						window.location = "listado.php"
						
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

//Script para editar registro
$( "#EditarRegistro" ).submit(function( event ) {
	if($('#password').val()==$('#password_confirmation').val()){
		if ($('#usuario_admin').is(":checked"))
		{
			var usuario_admin = 1;
		}else{
			var usuario_admin = 0;
		}
		var editar_usuario=1;
		var formData = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val(),
	            editar_usuario: editar_usuario,
	            usuario_admin: usuario_admin
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
						window.location = "listado.php"
						
					}else{
						if(data=="Error creando el registro!"){
							alert("Error creando usuario");

						}else{
							alert(data);
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