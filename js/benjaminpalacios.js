/*
	Scripts para inicio de sesion, registro y administrador para aplicacion de BenjaminPalacios
*/

$( "#formularioRegistro" ).submit(function( event ) {
	var formData = {
			//Variables del formulario de registro
            nombre		: $('#nombre').val(),
            email		: $('#email').val(),
            password	: $('#password').val(),
            edad		: $('#edad').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "php/BenjaminPalacios.php",
		data: formData
		
	})
    .done(function(data){
			alert(data);
            //$("#Resultado").html(data);
            //$("#Resultado").html("Procesando, espere por favor...");
            }
    )
    .fail(function(){
    	alert("Posting failed");
    })
    return false;
});

$( "#BotonLogin" ).submit(function( event ) {
	var formData = {
			//Variables del formulario de login
            email		: $('#login-name').val(),
            password	: $('#login-pass').val()
        }
        //alert($('#email').val())
	$.ajax({
		type: "POST",
		url: "../php/BenjaminPalacios.php",
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
