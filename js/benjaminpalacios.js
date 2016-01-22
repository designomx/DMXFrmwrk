/*
	Scripts para inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/

$( "#formulario" ).submit(function( event ) {
	var formData = {
			//Variables del formulario de registro
            nombre	: $('#nombre').val(),
            email		: $('#email').val(),
            password	: $('#password').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalaciosREGISTRO.php",
		data: formData,
		success: function(data){
	      alert("entro");
	      console.log(data);
		}
	})
});