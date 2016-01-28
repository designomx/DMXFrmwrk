$(document).ready(function(){
	
});

$(document).on("click", "#pagination ul li a",function() {
    //alert('hello there!');
    var page = $(this).data("id");        
    var dataString = 'page='+page;
    //alert(page);
    $.ajax({
            type: "GET",
            url: "php/BenjaminPalaciosADMIN.php",
            data: dataString,
            success: function(data) {
                $('#tabla_usuarios').fadeIn(1000).html(data);
            }
        });
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

//Accion de eliminar registro
$( "#BotonEliminar" ).click(function( event ) {
    var dataString = $(this).data("registro");        
    //alert(page);
	var r = confirm("Press a button!");
	if (r == true) {
	    $.ajax({
	            type: "GET",
	            url: "php/eliminar.php",
	            data: dataString,
	            success: function(data) {
	                window.location("listado.php");
	            }
	        });
    } else {
        txt = "You pressed Cancel!";
    }
});
