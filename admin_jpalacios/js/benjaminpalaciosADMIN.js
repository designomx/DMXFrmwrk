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
    })
    return false;
});


//Script para registrar usuarios desde la vista de administrador
$( "#FormularioRegistroADMIN" ).submit(function( event ) {
	if($('#password').val()==$('#password_confirmation').val()){
		var formData = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val(),
	            usuario_admin: $("#usuario_admin").is(':checked') ? 1 : 0
	        }
		$.ajax({
			type: "POST",
			url: "php/BenjaminPalacios.php",
			data: formData
			
		})
	    .done(function(data){
				alert(data);
	            }
	    )
	    .fail(function(){
	    	alert("Posting failed");
	    })
	    return false;
	}else{
		alert("El password no coincide");
	}
});