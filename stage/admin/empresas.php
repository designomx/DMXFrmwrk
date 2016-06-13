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
	
						$btn_guardarDatos.val("Guardar cambios");
						
						// Ubicamos la ventana a la altura del elemento que ejecutó esta función.
						$('div#formEmpresaWindow').css('top', $(caller).offset().top);				
						// Una vez cargados los datos, mostramos la ventana.
						$('div#formEmpresaWindow').fadeIn();
						removeCursorToWait();	
		
				}); //.done(function(){... 
			
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

	function cargarEstados(){
		$.ajax({
			url: "ajax/getEstados.php", 		// Url to which the request is send
			type: "POST",             			// Type of request to be send, called as method
			//data: new FormData(this), 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
			success: function(data)   			// A function to be called if request succeeds
			{				
				//$msg.html(data);
				$('#SelectEstados').html(data);
				
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
							if(data>0){
								guardarContactos(data);
							}
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

	function mas_correos() {
	 	var formclone = $("#mas_correos").clone(false);
		//$('.formContacto').append($("#cloneForm").html());
		//formclone.find('select').material_select();
		formclone.find('.selectCorreos').html('<select class="algunaclase nombreCorreo"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contacto</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');
		//formclone.find('.algunaclase').material_select('destroy');
		
		//formclone.find('.sele').material_select();

		formclone.addClass('CorreosMostrado');
		formclone.removeClass('canvas');
		$('#contenedor_correos').append(formclone);
		formclone.find('.algunaclase').material_select();
		//alert('mas_contactos')
		//$('.formContacto').html('blablablablablablablalbalbalbalbablablabla')
	}

	function mas_telefonos() {
	 	var formclone = $("#mas_telefonos").clone(false);
		//$('.formContacto').append($("#cloneForm").html());
		formclone.find('.selectTelefonos').html('<select id="nombreTelefono" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Contrataciones</option><option value="2">Atencion al cliente</option><option value="3">Atencion Empresarial</option><option value="4">Otro..</option></select>');
	    formclone.addClass('TelefonoMostrado');
		formclone.removeClass('canvas');
		$('#contenedor_telefonos').append(formclone);
		formclone.find('.algunaclase').material_select();
		//alert('mas_contactos')
		//$('.formContacto').html('blablablablablablablalbalbalbalbablablabla')
	}

	function mas_enlaces() {
	 	var formclone = $("#mas_enlaces").clone(false);
		//$('.formContacto').append($("#cloneForm").html());
		formclone.find('.selectEnlaces').html('<select id="nombreEnlace" class="algunaclase"><option value="" disabled selected>Escoge un texto que acompañe al correo</option><option value="1">Sitio web</option><option value="2">Chat en linea</option><option value="3">Ubicacion de oficinas (mapa) </option><option value="4">Otro..</option></select>');
		formclone.addClass('EnlaceMostrado');
		formclone.removeClass('canvas');
		$('#contenedor_enlaces').append(formclone);
		formclone.find('.algunaclase').material_select();
		//alert('mas_contactos')
		//$('.formContacto').html('blablablablablablablalbalbalbalbablablabla')
	}

	function guardarContactos(id_empresa){
		$('.insert_contacto').each(function(){			
			var obj = JSON.parse($(this).attr("data-JsonContactos"));
			for( var i in obj.contacto){
				console.log("contacto "+i+" de id_empresa "+id_empresa+": "+obj.contacto[i].estado + " " + obj.contacto[i].tipo + " " + obj.contacto[i].value + " " + obj.contacto[i].nombre)
				$.ajax({
					url: "ajax/saveContactosEmpresa.php", 		// Url to which the request is send
					type: "POST",             			// Type of request to be send, called as method
					data: {estado:obj.contacto[i].estado,id_empresa:id_empresa,transaccion:'INSERT',tipoContacto:obj.contacto[i].tipo,value:obj.contacto[i].value,nombre:obj.contacto[i].nombre}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
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

	function crearContacto(){
		var JsonContactos = '{ "contacto" : [';
		var primero = true;

		$('.mas_correo').each(function(){
			var estado = $(this).attr("data-estado");
			console.log($(this).find('.correo').val())
			//console.log($('.correo').val());
			console.log($(this).find('.algunaclase option:selected').text())
			
			if($(this).find('.correo').val()!=''){
				if(primero){
					JsonContactos =JsonContactos + '{ "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.algunaclase option:selected').text()+'"}';
					primero=false;
				}else{
					JsonContactos =JsonContactos + ', { "estado":"'+$('#selectEstado option:selected').val()+'" , "tipo":"correo", "value":"'+$(this).find('.correo').val()+'", "nombre":"'+$(this).find('.algunaclase option:selected').text()+'" }';
				}

				/*
				$.ajax({
					url: "ajax/saveContactosEmpresa.php", 		// Url to which the request is send
					type: "POST",             			// Type of request to be send, called as method
					data: {id_empresa:id_empresa,transaccion:'INSERT',tipoContacto:'correo',correo:$(this).find('.correo').val(),nombreCorreo:$(this).find('.algunaclase option:selected').text()}, 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
					//contentType: JSON,       			// The content type used when sending data to the server.
					//cache: false,             			// To unable request pages to be cached
					success: function(data)   			// A function to be called if request succeeds
					{
						console.log(data)
					}
				});
				*/
			}
		})

		JsonContactos =JsonContactos + ']}';
		console.log(JsonContactos);
		//var obj = JSON.parse(JsonContactos);
		$('.body_contactos').append('<tr class="contactos_por_estados insert_contacto" data-estado="'+$('#selectEstado option:selected').val()+'" data-JsonContactos=\''+JsonContactos+'\'><td>'+$('#selectEstado option:selected').text()+'</td><td><a class="waves-effect waves-light btn">VER / EDITAR</a></td></tr>')
	}

	function cargarContactosEmpresa(_this,id){
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
						<th data-field="accion">Ver/Editar/Eliminar</th>
					</tr>
				</thead>
				<tbody class="body_contactos">
					<tr class="contactos_por_estados" data-estado="cdmx">
						<td>CDMX</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
					</tr>
					<tr class="contactos_por_estados" data-estado="veracruz">
						<td>Veracruz</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
					</tr>
					<tr class="contactos_por_estados" data-estado="guerrero">
						<td>Guerrero</td>
						<td><a class="waves-effect waves-light btn">VER / EDITAR</a></td>
					</tr>
				</tbody>
			</table>
		</div>   
   	  </div>
	    <a id="mas_contactos" onclick="$('select').material_select();" class="modal-trigger" href="#modalPreview">Agregar Datos de contacto</a>
      <table class="buttons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" class="button">
            <input type="button" value="Cancelar" onClick="$('div#formEmpresaWindow').fadeOut();$('.FormContactoMostrado').remove" />
          </td>
          <td width="50%" class="button"><input id="saveData" name="saveData" type="submit" value=""></td>
        </tr>
      </table>
  
  </form>
	



</div><!-- #formUsuarioWindow -->        

<!-- Modal Preregistro -->
	<div id="modalPreview" class="modal">
	  <div class="modal-content">
	  	<img class="centerlogo" src="" width="159" alt="" />
	  	<br />
	    <p class="center centerlogo" style="max-width: 300px;">Agregar datos de contacto de empresa.</p>
	    <br/>
	    <div id="SelectEstados">

	    </div>
	    	<div class="row">
			    <form class="col s12" id="RegistrarContactoEmpresa">
			    	<div id="contenedor_correos">
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
					</div>
					<div class="row col s12">
						<a class="btn-floating btn-large waves-effect waves-light red" onclick="mas_correos();"><i class="material-icons">+</i></a>
					</div>
					<div id="contenedor_telefonos">
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
					</div>
					<div class="row col s12">
						<a class="btn-floating btn-large waves-effect waves-light red" onclick="mas_telefonos();"><i class="material-icons">+</i></a>
					</div>
					<div id="contenedor_enlaces">
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
					</div>
					<div class="row col s12">
						<a class="btn-floating btn-large waves-effect waves-light red" onclick="mas_enlaces();"><i class="material-icons">+</i></a>
					</div>
			    </form>
		  	</div>
	  </div>
	  	
	</div>

<div class="row canvas mas_correo" id="mas_correos">
	<div class="input-field col s6">
	  	<input placeholder="Correo" class="correo" type="text" class="validate">
	</div>
	<div class="input-field col s6 selectCorreos">
	    
	</div>
</div>

<div class="row canvas" id="mas_telefonos">
	<div class="input-field col s6">
	  	<input placeholder="Telefono" id="telefono" type="text" class="validate">
	</div>
	<div class="input-field col s6 selectTelefonos">
	    
	</div>
</div>

<div class="row canvas" id="mas_enlaces">
	<div class="input-field col s6">
	  	<input placeholder="Enlace" id="enlace" type="text" class="validate">
	</div>
	<div class="input-field col s6 selectEnlaces">
	    
	</div>
</div>


	



 
<!-- CONTENT END -->

<?php 
    require ('Templates/footerTemplate.php'); 
?>