/*
	Scripts para inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/

$( "#formularioRegistro" ).submit(function( event ) {
	var formData = {
			//Variables del formulario de registro
            nombre		: $('#nombre').val(),
            email		: $('#email').val(),
            password	: $('#password').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalacios.php",
		data: formData,
		success: function(data){
	      alert("entro");
	      window.location="dashboard.php";
	      console.log(data);
		}
	})
});

$( "#formularioLogin" ).submit(function( event ) {
	var formData = {
			//Variables del formulario de login
            email		: $('#email').val(),
            password	: $('#password').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalacios.php",
		data: formData,
		success: function(data){
		    if(html=='true')    {
				alert("Login correcto");
				//window.location="dashboard.php";
			}
			else    {
				alert("Datos incorrectos");
			}  
	    }
	})
});
