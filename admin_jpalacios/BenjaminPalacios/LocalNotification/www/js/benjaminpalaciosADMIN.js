$(document).ready(function(){
	TipoDeUsuario();
});

$(document).on("click", "#pagination ul li a",function() {
    //alert('hello there!');
    var page = $(this).data("id");        
    var dataString = 'page='+page;
    //alert(dataString);
    $.ajax({
            type: "GET",
            url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/BenjaminPalaciosAdminAPP.php",
            data: dataString,
            success: function(data) {
                $('#contenido_tablas').fadeIn(1000).html(data);
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
		if ($('#autorizado').is(":checked"))
		{
			var autorizado = 1;
		}else{
			var autorizado = 0;
		}
		var formData = {
				//Variables del formulario de registro
	            nombre		: $('#nombre').val(),
	            email		: $('#email').val(),
	            password	: $('#password').val(),
	            edad		: $('#edad').val(),
	            sexo		: $("input[name=sexo]:checked").val(),
	            usuario_admin: usuario_admin,
	            autorizado	: autorizado
	        }
		$.ajax({
			type: "POST",
			url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/BenjaminPalacios.php",
			data: formData
			
		})
	    .done(function(data){
					//alert(data);
					if(data=="Resgistro exitoso!"){
						alert("Registrado Exitosamente");
						window.location = "listado.html"
						
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
		if ($('#autorizado').is(":checked"))
		{
			var autorizado = 1;
		}else{
			var autorizado = 0;
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
	            usuario_admin: usuario_admin,
	            autorizado: autorizado
	        }
	    //alert(autorizado);
		$.ajax({
			type: "POST",
			url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/BenjaminPalacios.php",
			data: formData
			
		})
	    .done(function(data){
					//alert(data);
					if(data=="Resgistro exitoso!"){
						//alert("Login correcto.. Redireccionando");
						window.location = "listado.html"
						
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
$(document).on("click", "#BotonEliminar",function() {
    var dataString = $(this).data("registro");
    var formData = 'email='+ dataString;        
    //alert(formData);
	var r = confirm("¿Está seguro que desea eliminar este usuario?");
	if (r == true) {
	    $.ajax({
	            type: "GET",
	            url: "http://designo.mx/DMXFrmwrk/admin_jpalacios/php/eliminar.php",
	            data: formData,
	            success: function(data) {
	            		alert("Registro eliminado exitosamente");
	            		window.location="listado.html";
	            }
	        });
    } else {
        txt = "You pressed Cancel!";
    }
});

//Accion para editar un registro
$(document).on("click", "#BotonEditar",function() {
	if(typeof(Storage) !== "undefined") {
	    localStorage.EDITARemail = $(this).data("email");
	    localStorage.EDITARnombre = $(this).data("nombre");
	    localStorage.EDITARusuarioAdmin = $(this).data("usuarioAdmin");
	    localStorage.EDITARedad = $(this).data("edad");
	    localStorage.EDITARsexo = $(this).data("sexo");
	    localStorage.EDITARautorizado = $(this).data("autorizado");
	    localStorage.EDITARpassword = $(this).data("password");
	    window.location="editar.html";
	} else {
            	alert("Sorry, your browser does not support web storage...");
        }
});

//Función que determina si el tipo de usuario le saldrá o no el menu
function TipoDeUsuario() {
          if(typeof(Storage) !== "undefined") {
              if (localStorage.TipoUsuario) {
                  $("#contenedor").append('<!-- Static navbar --><div class="navbar navbar-default navbar-fixed-top" role="navigation"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span></button><a class="navbar-brand" href="#">Benjamin Palacios</a></div><div class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right"><li><a href="registerADMIN.html">Registrar Nuevo Usuario</a></li><li><a href="listado.html">Lista de Usuarios</a></li><li><a id="cerrarSesion" href="index.html">Salir</a></li></ul></div><!--/.nav-collapse --></div></div>')
              }
          } else {
            	alert("Sorry, your browser does not support web storage...");
          }
      }

//Accion para el boton de cerrar sesion
$(document).on("click", "#cerrarSesion",function() {
    //var dataStringCS = $(this).data("registro");
    //var formData = 'email='+ dataString;        
    //alert(formData);
	var r = confirm("¿Está seguro que desea cerrar la sesion?");
	if (r == true) {
	    /*
	    $.ajax({
	            type: "GET",
	            url: "http://localhost:8888/DMXFrmwrk/admin_jpalacios/php/eliminar.php",
	            data: formData,
	            success: function(data) {
	            		alert("Registro eliminado exitosamente");
	            		window.location="listado.html";
	            }
	        });
	    */
    } else {
        txt = "You pressed Cancel!";
    }
});