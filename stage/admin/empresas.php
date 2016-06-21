<?php 
session_start();

if(!isset($_SESSION["email"])){
	
	header("Location: ../index.php");
	exit;
		
}

require 'Templates/phpHeadingTemplate.php'; 

/////////////////////////////////////////////////////////////////////////////////////////////////////

if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "deleteItemForm")) {
	
	mysql_select_db($database, $dbConn);

	// Eliminamos la empresa de la bd.
  $deleteSQL = sprintf("DELETE FROM empresas WHERE id_empresa=%s", GetSQLValueString($_POST['id_empresa'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////

mysql_select_db($database, $dbConn);

/* Obtiene de la Base todas las empresas */
$query_empresas = "SELECT id_empresa, nombre, codigo_color, (select count(*) from planes where planes.id_empresa = empresas.id_empresa) as num_planes FROM empresas ORDER BY id_empresa DESC";
$empresas = mysql_query($query_empresas, $dbConn) or die(mysql_error());
$totalRows_empresas = mysql_num_rows($empresas);

/////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<?php require 'Templates/mainTemplate.php'; ?>

<script type="text/javascript" charset="utf-8" src="../JQuery/jquery.redirect.js"></script>

<script type="text/javascript" charset="utf-8" src="../JQuery/spectrum-1.7.1/spectrum.js"></script>
<link rel="stylesheet" type="text/css" href="../JQuery/spectrum-1.7.1/spectrum.css" />
<link href="../materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="all" />
<link rel="stylesheet" type="text/css" href="css/propio.css" />
<script src="../js/materialize.min.js"></script>
<script type="text/javascript">

	///////////////////////////////////////////////////////////////////////////////////////////////////
	
	function showPopupWindow(caller, transaccion, id_empresa){

		$("div#formEmpresaWindow input[name=transaccion]").val(transaccion);

		$nombre = $('div#formEmpresaWindow input[name=nombre]');
		$codigo_color = $('div#formEmpresaWindow input[name=codigo_color]');
	
		$msg = $('td.msg');
	
		// Limpiamos el posible contenido de todos los inputs.
		allFields = $([]).add($nombre).add($codigo_color);
		
		$btn_guardarDatos = $('div#formEmpresaWindow input[name=saveData]');
		$popUpWindowTitle = $('div#formEmpresaWindow td#title');
				
		// Limpiamos el posible contenido de todos los inputs.
		allFields.val("").removeClass('inputDataMissing');
		$msg.html("Los campos con [*] son requeridos.").removeClass("errorMsg");
		
		switch(transaccion){
		
			case "INSERT":
				
				// Asignamos los valores conocidos.
				$popUpWindowTitle.html("<h2>Nueva Empresa</h2>");
				//$id_permiso.val("2"); //como es un select, seleccionamos la primera opción
				$btn_guardarDatos.val("Guardar");
								
				// Ubicamos la ventana a la altura del elemento que ejecutó esta función.
				$('div#formEmpresaWindow').css('top', $(caller).offset().top);				
				// Mostramos la ventana.
				$('div#formEmpresaWindow').fadeIn();
				removeCursorToWait();	
						
				break;
			
			case "UPDATE":
			
				// Asignamos los valores conocidos.
				$popUpWindowTitle.html("<h2>Editar Empresa</h2>");
				$btn_guardarDatos.val("Guardar Cambios");
				
				// Obtenemos de la base los datos correspondientes del concepto.
				$.getJSON("ajax/getEmpresaData.php", {'id': id_empresa}, function(data) {

						$("div#formEmpresaWindow input[name=id_empresa]").val(id_empresa);
						
						$nombre.val(data['nombre']);
						$codigo_color.val(data['codigo_color']);
																																																			 
				}).done(function(){
	
						$btn_guardarDatos.val("Guardar cambios").attr("onClick","guardarContactos("+id_empresa+")");
						
						// Ubicamos la ventana a la altura del elemento que ejecutó esta función.
						$('div#formEmpresaWindow').css('top', $(caller).offset().top);				
						// Una vez cargados los datos, mostramos la ventana.
						$('div#formEmpresaWindow').fadeIn();
						removeCursorToWait();	
		
				}); //.done(function(){... 
				cargarContactos(id_empresa);
				break;
				
		} //switch
	
	} // function showPopupWindow

	///////////////////////////////////////////////////////////////////////////////////////////////////

	function IsFormDataValid(){
		
			var allDataValid = false;
	
			requiredFields = $([]).add($nombre).add($codigo_color);
							
			if(areRequiredFieldsFilledOut(requiredFields)){

					//fieldsToValidate = [{field: $precio, type: "numeric", label: "Precio"}];
																
					//if(areFieldsDataValid($msg, fieldsToValidate)){
											
							$msg.html("Por favor espera, guardando datos...").removeClass("errorMsg").addClass('waitMsg');
																												
							allDataValid = true;
													
					/*} // if(areFieldsDataValid(...
					else { 

						allDataValid = false;
						
						//errorMsg = "Campos con valores no permitidos.";
						//$msg.text(errorMsg).addClass("errorMsg");
						
						removeCursorToWait();
						
					}*/
								
			} //if(areRequiredFieldsOk(...
			else {
				
				allDataValid = false;
				
				$msg.html("Los campos con [*] son requeridos.").addClass("errorMsg");
				
				removeCursorToWait();
			}
	
			return allDataValid;
			
	} //funcion(isFormDataValid(...
	///////////////////////////////////////////////////////////////////////////////////////////////////

	//Cargar un select de estados para agregar a cada Contacto
	function cargarEstados(){
		$.ajax({
			url: "ajax/getEstados.php", 		// Url to which the request is send
			type: "POST",             			// Type of request to be send, called as method
			//data: new FormData(this), 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
			success: function(data)   			// A function to be called if request succeeds
			{				
				//$msg.html(data);
				$('#SelectEstados').html(data);
				$('#SelectEstadosEditar').html(data);//Revisar y poner un solo select o agregar clase especial a este
			}
		});
	}

	//Devuelve los contactos cuando se muestran al momento de editar una empresa, devuelve JSON co todos los contactos y sus item de la empresa que se le solicite.
	function cargarContactos(id_empresa){
		$.ajax({
			url: "ajax/getContactos.php", 		// Url to which the request is send
			type: "POST",             			// Type of request to be send, called as method
			data: {id_empresa:id_empresa}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
			success: function(data)   			// A function to be called if request succeeds
			{				
				//$msg.html(data);
				console.log('cargarContactos()');
				//console.log(data)
				var obj = JSON.parse(data);
				for( var i in obj.contactos){
					crearContactoGET(JSON.stringify(obj.contactos[i]));
					for(var j in obj.contactos[i]){

					}
				}
			}
		});
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////

	$(document).ready(function() {
		cargarEstados();
		///////////////////////////////////////////////////////////////////////////////////////////////////
		$('.modal-trigger').leanModal();
		$('select').material_select();
		$('#frm_empresa').on('submit',(function(e) {
		
				e.preventDefault();
	
				$msg = $('td.msg');
				
				changeCursorToWait();
				
				if(IsFormDataValid()){
								
					$.ajax({
						url: "ajax/saveEmpresaData.php", 		// Url to which the request is send
						type: "POST",             			// Type of request to be send, called as method
						data: new FormData(this), 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       			// The content type used when sending data to the server.
						cache: false,             			// To unable request pages to be cached
						processData: false,       			// To send DOMDocument or non processed data file it is set to false
						success: function(data)   			// A function to be called if request succeeds
						{	
							/*
							if(data>0){
								guardarContactos(data);
							}
							*/
							removeCursorToWait();
							$('div#formEmpresaWindow').fadeOut();
							location.reload();						
							//$msg.html(data);
						}
					});
				
				}
			
		}));
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
			
	}); //$(document).ready();
	 function mas_contactos() {
	 	var formclone = $("#cloneForm").clone(false);
		//$('.formContacto').append($("#cloneForm").html());
		formclone.addClass('FormContactoMostrado');
		formclone.removeClass('canvas');
		$('.formContacto').append(formclone);
		//alert('mas_contactos')
		//$('.formContacto').html('blablablablablablablalbalbalbalbablablabla')
	}

	//Funcion para crear campos que sirvan para agregar mas_correos, telefonos y enlaces
	function mas_correos(transaccion,acc) {
	 	var formclone = $("#mas_correos").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		//formclone.find('.selectCorreos').html('<select class="algunaclase nombreCorreo"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contacto</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');

		formclone.addClass('CorreosMostrado');
		formclone.removeClass('canvas');
		if(acc=="ADD"){
			$('#contenedor_correos').append(formclone);
		}
		if(acc=="EDIT"){
			$('#editar_contenedor_correos').append(formclone);
		}
		formclone.find('.algunaclase').material_select();
	}

	function mas_telefonos(transaccion,acc) {
	 	var formclone = $("#mas_telefonos").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		//formclone.find('.selectTelefonos').html('<select id="nombreTelefono" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contrataciones</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');
	    formclone.addClass('TelefonoMostrado');
		formclone.removeClass('canvas');
		if(acc=="ADD"){
			$('#contenedor_telefonos').append(formclone);
		}
		if(acc=="EDIT"){
			$('#editar_contenedor_telefonos').append(formclone);
		}
		formclone.find('.algunaclase').material_select();
	}

	function mas_enlaces(transaccion,acc) {
	 	var formclone = $("#mas_enlaces").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		//formclone.find('.selectEnlaces').html('<select id="nombreEnlace" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Sitio web</option><option value="2">Chat en linea</option><option value="3">Ubicacion de oficinas (mapa) </option><option value="4">Otro..</option></select>');
		formclone.addClass('EnlaceMostrado');
		formclone.removeClass('canvas');
		if(acc=="ADD"){
			$('#contenedor_enlaces').append(formclone);
		}
		if(acc=="EDIT"){
			$('#editar_contenedor_enlaces').append(formclone);
		}
		formclone.find('.algunaclase').material_select();
	}

	//Guarda los contactos junto con los datos de la empresa, al cerrar el popup de la empresa
	function guardarContactos(id_empresa){
		$('.insert_contacto').each(function(){			
			var obj = JSON.parse($(this).attr("data-JsonContactos"));
			for( var i in obj.contacto){
				console.log("contacto "+i+" de id_empresa "+id_empresa+": "+obj.contacto[i].estado + " " + obj.contacto[i].tipo + " " + obj.contacto[i].value + " " + obj.contacto[i].nombre)
				$.ajax({
					url: "ajax/saveContactosEmpresa.php", 		// Url to which the request is send
					type: "POST",             			// Type of request to be send, called as method
					data: {estado:obj.contacto[i].estado,id_empresa:id_empresa,transaccion:obj.contacto[i].transaccion,tipoContacto:obj.contacto[i].tipo,value:obj.contacto[i].value,nombre:obj.contacto[i].nombre,descripcion:obj.contacto[i].descripcion}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
					//contentType: JSON,       			// The content type used when sending data to the server.
					//cache: false,             			// To unable request pages to be cached
					success: function(data)   			// A function to be called if request succeeds
					{
						console.log(data)
					}
				});
			}
		})
		$('.updateTR').each(function(){
			var obj = JSON.parse($(this).attr("data-JsonContactos"));
			for( var i in obj.contacto){
				console.log("contacto "+i+" de id_empresa "+id_empresa+": "+obj.contacto[i].estado + " " + obj.contacto[i].tipo + " " + obj.contacto[i].value + " " + obj.contacto[i].nombre + " " + obj.contacto[i].id)
				$.ajax({
					url: "ajax/saveContactosEmpresa.php", 		// Url to which the request is send
					type: "POST",             			// Type of request to be send, called as method
					data: {estado:obj.contacto[i].estado,id_empresa:id_empresa,transaccion:obj.contacto[i].transaccion,tipoContacto:obj.contacto[i].tipo,value:obj.contacto[i].value,nombre:obj.contacto[i].nombre,id:obj.contacto[i].id,descripcion:obj.contacto[i].descripcion}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
					//contentType: JSON,       			// The content type used when sending data to the server.
					//cache: false,             			// To unable request pages to be cached
					success: function(data)   			// A function to be called if request succeeds
					{
						console.log(data)
					}
				});
			}
		})
	}

	//Agrega los conctactos al popup de la empresa, como 'estado' y un botón para editar
	function crearContactoGET(_thisContacto){
		//var obj = JSON.parse(_thisContacto);
		console.log("crearContacto(_thisContacto)")
		console.log(_thisContacto);
		var obj = JSON.parse(_thisContacto);
		for( var i in obj){
			console.log(obj[i].estado)
			//$('#selectEstado').val(obj[i].estado).prop('disabled',true);
			$("#selectEstado option[value='"+obj[i].estado+"']").prop('disabled',true);
			$("#selectEstadoEditar option[value='"+obj[i].estado+"']").prop('disabled',true);
			$('.body_contactos').append('<tr class="contactos_por_estados updateTR" data-estado="'+obj[i].estado+'" data-id="'+obj[i].id+'" data-JsonContactos=\''+_thisContacto+'\'><td>'+$("#selectEstado option[value='"+obj[i].estado+"']").text()+'</td><td><a href="#!" class="waves-effect waves-light btn" data-JsonContactos=\''+_thisContacto+'\' onClick="editarContacto(this)">VER / EDITAR</a></td><td><a class="waves-effect waves-light btn" onclick="deleteContacto(\''+obj[i].id_contacto+'\',\'contacto\'),$(this).closest(\'tr\').remove();">ELIMINAR</a></td></tr>')
			break;
		}
		//_thisContacto.[0]
	}

	//Crea un contacto despues de haber llenado los campos en el ModalPreview
	function crearContacto(){
		var JsonContactos = '{ "contacto" : [';
		var primero = true;

		$('.mas_correos').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.correo').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.correo').val()!=''){
				if(primero){
					//JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"INSERT", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.algunaclase option:selected').text()+'"}';
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"INSERT", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'" }';
				}
			}
		})

		$('.mas_telefonos').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.telefono').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.telefono').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"INSERT", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"INSERT", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'" }';
				}
			}
		})

		$('.mas_enlaces').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.enlace').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.enlace').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"INSERT", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"INSERT", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'" }';
				}
			}
		})

		JsonContactos =JsonContactos + ']}';
		console.log(JsonContactos);
		//var obj = JSON.parse(JsonContactos);
		$('.body_contactos').append('<tr class="contactos_por_estados insert_contacto" data-estado="'+$('#selectEstado option:selected').val()+'" data-JsonContactos=\''+JsonContactos+'\'><td>'+$('#selectEstado option:selected').text()+'</td><td><a class="waves-effect waves-light btn" onClick="editarContacto(\''+JsonContactos+'\')">VER / EDITAR</a></td><td><a class="waves-effect waves-light btn" onclick="">ELIMINAR</a></td></tr>')
	}

	function cargarContactosEmpresa(_this,id){
		/*
		console.log(_this);
		console.log(id);
		$.ajax({
			url: "ajax/getContactos.php", 		// Url to which the request is send
			type: "POST",             			// Type of request to be send, called as method
			data: {id_empresa:id}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: JSON,       			// The content type used when sending data to the server.
			cache: false,             			// To unable request pages to be cached
			success: function(data)   			// A function to be called if request succeeds
			{
				console.log(data)
			}
		});
		*/
	}

	//Cargar los valores de cada Contacto dentro de cada empresa
	function editarContacto(_thisContacto){
		//console.log('editarContacto(_thisContacto)');
		//console.log($(_thisContacto).attr('data-JsonContactos'));
		$(_thisContacto).addClass('update');
		$(_thisContacto).closest("tr").addClass("editando");
		var obj = JSON.parse($(_thisContacto).attr('data-JsonContactos'));
		for( var i in obj){
			console.log(obj[i].estado);
			console.log(obj[i].tipo)
			//$('#selectEstado value').text()
			$("#selectEstado option[value='"+obj[i].estado+"']").prop('disabled',false).attr('selected',true);
			//$("#SelectEstadosEditar option[value='"+obj[i].estado+"']").prop('disabled',false).attr('selected',true);
			if(obj[i].tipo=="correo"){
				editar_mas_correos(obj[i].value,obj[i].nombre,obj[i].id,"UPDATE");
			}
			if(obj[i].tipo=="telefono"){
				editar_mas_telefonos(obj[i].value,obj[i].nombre,obj[i].id,"UPDATE");
			}
			if(obj[i].tipo=="enlace"){
				editar_mas_enlaces(obj[i].value,obj[i].nombre,obj[i].id,obj[i].descripcion,"UPDATE");
			}
			$('#modalEdit').openModal();
		}
	}

	//Luedo de modificar el ModalEditar, adjunta la nueva informacion a dentro del modal, que puede ser campos editados o campos nuevos
	function editarThisContacto(){
		var JsonContactos = '{ "contacto" : [';
		var primero = true;

		$('.mas_correos').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.correo').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.correo').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'","id":"'+$(this).find('.correo').attr("data-id-correo")+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'","id":"'+$(this).find('.correo').attr("data-id-correo")+'"}';
				}
			}
			$('.mas_correos.CorreosMostrado').remove();
		})

		$('.mas_telefonos').each(function(){
			var estado = $(this).attr("data-estado");
			if($(this).find('.telefono').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'","id":"'+$(this).find('.telefono').attr("data-id-telefono")+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'","id":"'+$(this).find('.telefono').attr("data-id-telefono")+'"}';
				}
			}
			$('.mas_telefonos.TelefonoMostrado').remove();
		})

		$('.mas_enlaces').each(function(){
			var estado = $(this).attr("data-estado");
			if($(this).find('.enlace').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'","id":"'+$(this).find('.enlace').attr("data-id-enlace")+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"'+$(this).attr("data-transaccion")+'", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'","id":"'+$(this).find('.enlace').attr("data-id-enlace")+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'"}';
				}
			}
			$('.mas_enlaces.EnlaceMostrado').remove();
		})

		$('.mas_correos_EDIT').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.correo').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.correo').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"UPDATE", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'","id":"'+$(this).find('.correo').attr("data-id-correo")+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo","transaccion":"UPDATE", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.nombre_correo').val()+'","id":"'+$(this).find('.correo').attr("data-id-correo")+'"}';
				}
			}
			$('.mas_correos_EDIT.CorreosMostrado').remove();
		})

		$('.mas_telefonos_EDIT').each(function(){
			var estado = $(this).attr("data-estado");
			if($(this).find('.telefono').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"UPDATE", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'","id":"'+$(this).find('.telefono').attr("data-id-telefono")+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"telefono","transaccion":"UPDATE", "value":"'+$(this).find('.telefono').val()+'", "nombre":"'+$(this).find('.nombre_telefono').val()+'","id":"'+$(this).find('.telefono').attr("data-id-telefono")+'"}';
				}
			}
			$('.mas_telefonos_EDIT.TelefonoMostrado').remove();
		})

		$('.mas_enlaces_EDIT').each(function(){
			var estado = $(this).attr("data-estado");
			if($(this).find('.enlace').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"UPDATE", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'","id":"'+$(this).find('.enlace').attr("data-id-enlace")+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"enlace","transaccion":"UPDATE", "value":"'+$(this).find('.enlace').val()+'", "nombre":"'+$(this).find('.nombre_enlace').val()+'","id":"'+$(this).find('.enlace').attr("data-id-enlace")+'", "descripcion":"'+$(this).find('.descripcion_enlace').val()+'"}';
				}
			}
			$('.mas_enlaces_EDIT.EnlaceMostrado').remove();
		})

		JsonContactos =JsonContactos + ']}';

		$('.editando').attr("data-JsonContactos", JsonContactos);
		$('.editando').removeClass('editando');
	}

	//Estructuras para los campos que se cargan al momento de darle al boton de Editar o ver de cada contacto para cada item (correo, telefono o enlace)
	function editar_mas_correos(correo,nombre_correo,id_correo_contacto,transaccion) {
	 	var formclone = $("#mas_correos_EDIT").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		formclone.find('.correo').val(correo);
		formclone.find('.nombre_correo').val(nombre_correo);
		formclone.find('.correo').attr("data-id-correo",id_correo_contacto);
		//formclone.find('.selectCorreos').html('<select class="algunaclase nombreCorreo"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contacto</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');
		formclone.find('.botoneliminarEDIT').attr("onclick","deleteContacto('"+id_correo_contacto+"','correo'),$(this).closest('.CorreosMostrado').remove();").removeClass('disabled');
		formclone.addClass('CorreosMostrado');
		formclone.removeClass('canvas');
		$('#editar_contenedor_correos').append(formclone);
		formclone.find('.algunaclase').material_select();
	}

	function editar_mas_telefonos(telefono,nombre_telefono,id_telefono_contacto,transaccion) {
	 	var formclone = $("#mas_telefonos_EDIT").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		formclone.find('.telefono').val(telefono);
		formclone.find('.nombre_telefono').val(nombre_telefono);
		formclone.find('.telefono').attr("data-id-telefono",id_telefono_contacto);
		//formclone.find('.selectTelefonos').html('<select id="nombreTelefono" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contrataciones</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');
		formclone.find('.botoneliminarEDIT').attr("onclick","deleteContacto('"+id_telefono_contacto+"','telefono'),$(this).closest('.TelefonoMostrado').remove();").removeClass('disabled');
	    formclone.addClass('TelefonoMostrado');
		formclone.removeClass('canvas');
		$('#editar_contenedor_telefonos').append(formclone);
		formclone.find('.algunaclase').material_select();
	}

	function editar_mas_enlaces(enlace,nombre_enlace,id_enlace_contacto,descripcion_enlace,transaccion) {
	 	var formclone = $("#mas_enlaces_EDIT").clone(false);
	 	formclone.attr("data-transaccion",transaccion);
		formclone.find('.enlace').val(enlace);
		formclone.find('.nombre_enlace').val(nombre_enlace);
		formclone.find('.descripcion_enlace').val(descripcion_enlace)
		formclone.find('.enlace').attr("data-id-enlace",id_enlace_contacto);
		//formclone.find('.selectEnlaces').html('<select id="nombreEnlace" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Sitio web</option><option value="2">Chat en linea</option><option value="3">Ubicacion de oficinas (mapa) </option><option value="4">Otro..</option></select>');
		formclone.find('.botoneliminarEDIT').attr("onclick","deleteContacto('"+id_enlace_contacto+"','enlace'),$(this).closest('.EnlaceMostrado').remove();").removeClass('disabled');
		formclone.addClass('EnlaceMostrado');
		formclone.removeClass('canvas');
		$('#editar_contenedor_enlaces').append(formclone);
		formclone.find('.algunaclase').material_select();
	}

	function deleteContacto(id,tipo){
		var r = confirm("¿Esta seguro que desea eliminar este "+tipo+"?");
		if (r == true) {
		    txt = "You pressed OK!";
		    $.ajax({
				url: "ajax/saveContactosEmpresa.php", 		// Url to which the request is send
				type: "POST",             			// Type of request to be send, called as method
				data: {transaccion:"DELETE",tipoContacto:tipo,id:id}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
				//contentType: JSON,       			// The content type used when sending data to the server.
				//cache: false,             			// To unable request pages to be cached
				success: function(data)   			// A function to be called if request succeeds
				{
					console.log(data)
				}
			});
		} else {
		    txt = "You pressed Cancel!";
		}
	}


</script>

<?php require 'Templates/headTemplate.php'; ?>

<!-- START CONTENT -->

<table class="identification" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Administrador de Empresas</h2></td>
  </tr>
</table>

<table class="newItemLink" border="0" cellspacing="0" cellpadding="0">
    <td><h3>Selecciona una Empresa o da de alta una <a href="#" onclick="showPopupWindow(this, 'INSERT');">Nueva</a></h3></td>
  </tr>
</table>
        
<table class="itemsList" border="0" cellspacing="0" cellpadding="0"> 
  <tr class="headers nodrop nodrag">
    <td width="10%">Color</td>
    <td width="50%">Nombre</td>
    <td width="20%"></td>
    <td width="20%" class="nota">S&oacute;lo se pueden eliminar las empresas que no tienen planes asociados.</td>
  </tr>
  <?php while($row_empresas = mysql_fetch_assoc($empresas)){ ?>
    
  <tr>
    <td style="background-color: <?php echo $row_empresas['codigo_color']; ?>"></td>
		<td><?php echo $row_empresas['nombre']; ?></td>
    <!--td>< ?php echo $row_empresas['codigo_color']; ? ></td-->
    <td class="button"><input type="button" id="edit" value="Editar" onclick="changeCursorToWait(); showPopupWindow(this, 'UPDATE', <?php echo $row_empresas['id_empresa']; ?>); cargarContactosEmpresa(this,<?php echo $row_empresas['id_empresa']; ?>);" /></td>
    <td class="button">
    <?php if($row_empresas['num_planes'] == 0){ ?>
      <form name="deleteItemForm" method="post" onsubmit="return confirm('¿Está seguro que desea eliminar esta Empresa?\n\nSe eliminarán todos los registros y archivos relacionados.\n\nEsta acción es irreversible.'); changeCursorToWait();">
        <input type="hidden" name="id_empresa" value="<?php echo $row_empresas['id_empresa']; ?>" />
        <input type="submit" value="Eliminar" />
        <input type="hidden" name="MM_delete" value="deleteItemForm">
      </form>
    <?php } ?>        
    </td>
  </tr>
  
  <?php }//while ?>
</table>



<div id="formEmpresaWindow" class="popUpWindow">

  <form id="frm_empresa" action="" method="post">
             
  		<input type="hidden" name="transaccion" id="transaccion" value="">
      <input type="hidden" name="id_empresa" id="id_empresa" value=""><!-- Para UPDATE -->
                                       
      <table class="form" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td id="title" colspan="2" class="center"></td>
        </tr>
        <tr>
          <td class="msg center" colspan="2">Los campos con [*] son requeridos.</td>
        </tr>
        <tr>
          <td width="50%" class="label">Nombre *:</td>
          <td width="50%"><input type="text" id="nombre" name="nombre" value=""/></td>
        </tr>
        <tr>
          <td class="label">Código color *:</td>
          <td><input type="color" id="codigo_color" name="codigo_color" value=""/></td>
        </tr>
      </table>
      <div class="formContacto">
      	<div class="row">
      		<div class="col"><span>Contactos por estados</span></div>
			<table class="striped ">
				<thead>
					<tr>
						<th data-field="id">Estado</th>
						<th data-field="accion">Ver/Editar</th>
					</tr>
				</thead>
				<tbody class="body_contactos">
					<!--
					<tr class="contactos_por_estados" data-estado="cdmx">
						<td>CDMX</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
						<td><a class="waves-effect waves-light btn">ELIMINAR</a></td>
					</tr>
					<tr class="contactos_por_estados" data-estado="veracruz">
						<td>Veracruz</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
						<td><a class="waves-effect waves-light btn">ELIMINAR</a></td>
					</tr>
					<tr class="contactos_por_estados" data-estado="guerrero">
						<td>Guerrero</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
						<td><a class="waves-effect waves-light btn">ELIMINAR</a></td>
					</tr>
					-->
				</tbody>
			</table>
		</div>   
   	  </div>
	    <a id="mas_contactos" onclick="$('select').material_select();" class="modal-trigger" href="#modalPreview">Agregar Datos de contacto</a>
      <table class="buttons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" class="button">
            <input type="button" value="Cancelar" onClick="$('div#formEmpresaWindow').fadeOut();$('.FormContactoMostrado').remove,$('.contactos_por_estados').remove()" />
          </td>
          <td width="50%" class="button"><input id="saveData" name="saveData" type="submit" value=""></td>
        </tr>
      </table>
  
  </form>
	



</div><!-- #formUsuarioWindow -->        

<!-- Modal Contactos -->
	<div id="modalPreview" class="modal modal-fixed-footer">
	  <div class="modal-content">
	  	<img class="centerlogo" src="" width="159" alt="" />
	  	<br />
	    <p class="center centerlogo" style="max-width: 300px;">Agregar datos de contacto de empresa.</p>
	    <br/>
	    <div id="SelectEstados">

	    </div>
	    	<div class="row"> <br><br><br>
			    <form class="col s12" id="RegistrarContactoEmpresa">

			    	<div id="contenedor_correos">
			    		<!--
						<div class="row mas_correo">
							<div class="input-field col s6">
							  	<input placeholder="Correo" class="correo" type="text" class="validate">
							</div>
							<div class="input-field col s6">
							    <select class="nombreCorreo algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al correo</option>
							      <option value="1">Contacto</option>
							      <option value="2">Atencion al cliente</option>
							      <option value="3">Atencion Empresarial</option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_correos('INSERT','ADD');"><i class="material-icons right">+</i>Agregar Correo</a>
					</div><br>
					<div id="contenedor_telefonos">
						<!--
						<div class="row">
							<div class="input-field col s6">
							  	<input placeholder="Telefono" id="telefonos" type="text" class="validate">
							</div>
							<div class="input-field col s6">
							    <select class="nombreTelefono algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al teléfono</option>
							      <option value="1">Contrataciones</option>
							      <option value="2">Atencion al cliente</option>
							      <option value="3">Atencion Empresarial</option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_telefonos('INSERT','ADD');"><i class="material-icons right">+</i>Agregar Telefono</a>
					</div>
					<div id="contenedor_enlaces">
						<!--
						<div class="row">
							<div class="input-field col s6">
							  	<input placeholder="Enlaces" id="enlaces" type="text" class="validate">
							</div>
							<div class="input-field col s6">
							    <select class="nombreEnlace algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al enlace</option>
							      <option value="1">Sitio web</option>
							      <option value="2">Chat en linea</option>
							      <option value="3">Ubicacion de oficinas (mapa) </option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_enlaces('INSERT','ADD');"><i class="material-icons right">+</i>Agregar Enlace</a>
					</div>
			    </form>
		  	</div>
	  	</div>
	  	<div class="modal-footer">
      		<a href="#!" onclick="crearContacto(),$('#modalPreview').closeModal(),$('.lean-overlay').remove(),$('.CorreosMostrado,.TelefonoMostrado,.EnlaceMostrado').remove()" class="modal-action modal-close waves-effect waves-teal btn-flat">Agregar</a>
      		
      		<a class="modal-action modal-close waves-effect waves-teal btn-flat" onclick="$('#modalPreview').closeModal(), $('.lean-overlay').remove(),$('.CorreosMostrado,.TelefonoMostrado,.EnlaceMostrado').remove()">Cancelar</a>
    	</div>	
	</div>


<!-- Modal Editar Contacto -->
	<div id="modalEdit" class="modal modal-fixed-footer">
	  <div class="modal-content">
	  	<img class="centerlogo" src="" width="159" alt="" />
	  	<br />
	    <p class="center centerlogo" style="max-width: 300px;">Agregar datos de contacto de empresa.</p>
	    <br/>
	    <div id="SelectEstadosEditar">

	    </div>
	    	<div class="row">
			    <form class="col s12" id="RegistrarContactoEmpresa">
			    	<div id="editar_contenedor_correos">
			    		<!--
						<div class="row mas_correo">
							<div class="input-field col s6">
							  	<input placeholder="Correo" class="correo" type="text" class="validate">
							</div>
							<div class="input-field col s6">
							    <select class="nombreCorreo algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al correo</option>
							      <option value="1">Contacto</option>
							      <option value="2">Atencion al cliente</option>
							      <option value="3">Atencion Empresarial</option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_correos('INSERT','EDIT');"><i class="material-icons right">+</i>Agregar Correo</a>
					</div>
					<div id="editar_contenedor_telefonos">
						<!--
						<div class="row">
							<div class="input-field col s5">
							  	<input placeholder="Telefono" id="telefonos" type="text" class="validate">
							</div>
							<div class="input-field col s5">
							    <select class="nombreTelefono algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al teléfono</option>
							      <option value="1">Contrataciones</option>
							      <option value="2">Atencion al cliente</option>
							      <option value="3">Atencion Empresarial</option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
							<div class="input-field col s2">
							  	<a class="btn-floating btn-small waves-effect waves-light red disabled" onclick=""><i class="material-icons">-</i></a>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_telefonos('INSERT','EDIT');"><i class="material-icons right">+</i> Agregar Telefono</a>
					</div>
					<div id="editar_contenedor_enlaces">
						<!--
						<div class="row">
							<div class="input-field col s6">
							  	<input placeholder="Enlaces" id="enlaces" type="text" class="validate">
							</div>
							<div class="input-field col s6">
							    <select class="nombreEnlace algunaclase">
							      <option value="0" disabled selected>Escoge un texto que acompañe al enlace</option>
							      <option value="1">Sitio web</option>
							      <option value="2">Chat en linea</option>
							      <option value="3">Ubicacion de oficinas (mapa) </option>
							      <option value="4">Otro..</option>
							    </select>
							</div>
						</div>
						-->
					</div>
					<div class="row col s12">
						<a class="waves-effect waves-light btn" onclick="mas_enlaces('INSERT','EDIT');"><i class="material-icons right">+</i>Agregar enlace</a>
					</div>
			    </form>
		  	</div>
	  </div>
	  	<div class="modal-footer row">	  		
      		<a href="#!" onclick="editarThisContacto(),$('#modalEdit').closeModal(),$('.lean-overlay').remove(),$('.CorreosMostrado,.TelefonoMostrado,.EnlaceMostrado').remove()" class="modal-action modal-close waves-effect waves-teal btn-flat">Agregar</a>
      		<a class="modal-action modal-close waves-effect waves-teal btn-flat" onclick="$('#modalEdit').closeModal(), $('.lean-overlay').remove(),$('.CorreosMostrado,.TelefonoMostrado,.EnlaceMostrado').remove(),$('.editando').removeClass('editando')">Cancelar</a>
    	</div>
	  	
	</div>

<!--Estructuras para campos de valor y nombre de los item de cada contacto -->
<div class="row canvas mas_correos" id="mas_correos">
	<div class="input-field col s5">
	  	<input placeholder="Correo" class="correo" type="text" class="validate">
	</div>
	<!--
	<div class="input-field col s5 selectCorreos">
	    
	</div>
	-->
	<div class="input-field col s5 selectCorreos">
		<input placeholder="Nombre de Correo" class="nombre_correo" type="text" class="validate">
	</div>
	<div class="input-field col s2">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>

<div class="row canvas mas_telefonos" id="mas_telefonos">
	<div class="input-field col s5">
	  	<input placeholder="Telefono" class="telefono" type="text" class="validate">
	</div>
	<!--
	<div class="input-field col s5 selectTelefonos">
	    
	</div>
	-->
	<div class="input-field col s5 selectTelefonos">
		<input placeholder="Nombre de Enlace" class="nombre_telefono" type="text" class="validate" title="url del enlace, ejemplo http://www.eligefacil.com">
	</div>
	<div class="input-field col s2">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>

<div class="row canvas mas_enlaces" id="mas_enlaces">
	<div class="input-field col s4">
	  	<input placeholder="Enlace" class="enlace" type="url" class="validate">
	</div>
	<!--
	<div class="input-field col s5 selectEnlaces">
	    
	</div>
	-->
	<div class="input-field col s4 selectEnlaces">
		<input placeholder="Nombre de Enlace" class="nombre_enlace" type="text" class="validate">
	</div>
	<div class="input-field col s2 selectEnlaces">
		<input placeholder="Descripcion de Enlace" class="descripcion_enlace" type="text" class="validate">
	</div>
	<div class="input-field col s2">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>
<div class="row canvas mas_correos_EDIT" id="mas_correos_EDIT">
	<div class="input-field col s5">
	  	<input placeholder="Correo" class="correo" type="text" class="validate">
	</div>
	<!--
	<div class="input-field col s5 selectCorreos">
	    
	</div>
	-->
	<div class="input-field col s5 selectCorreos">
		<input placeholder="Nombre de Correo" class="nombre_correo" type="text" class="validate">
	</div>
	<div class="input-field col s2">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>

<div class="row canvas mas_telefonos_EDIT" id="mas_telefonos_EDIT">
	<div class="input-field col s5">
	  	<input placeholder="Telefono" class="telefono" type="text" class="validate">
	</div>
	<!--
	<div class="input-field col s5 selectTelefonos">
	    
	</div>
	-->
	<div class="input-field col s5 selectTelefonos">
		<input placeholder="Nombre de Telefono" class="nombre_telefono" type="text" class="validate">
	</div>
	<div class="input-field col s2">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>

<div class="row canvas mas_enlaces_EDIT" id="mas_enlaces_EDIT">
	<div class="input-field col s4">
	  	<input placeholder="Enlace" class="enlace" type="url" class="validate" title="url del enlace, ejemplo http://www.eligefacil.com">
	    
	</div>
	-->
	<div class="input-field col s4 selectEnlaces">
		<input placeholder="Nombre de Enlace" class="nombre_enlace" type="text" class="validate">
	</div>
	<div class="input-field col s2 selectEnlaces">
		<input placeholder="Descripcion de Enlace" class="descripcion_enlace" type="text" class="validate">
	</div>
	<div class="input-field col s2 ">
	  	<a class="btn-floating btn-small waves-effect waves-light red disabled botoneliminarEDIT" onclick=""><i class="material-icons">-</i></a>
	</div>
</div>


	



 
<!-- CONTENT END -->

<?php 
    require ('Templates/footerTemplate.php'); 
?>