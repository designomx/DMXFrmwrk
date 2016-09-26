<?php 
session_start();

if(!isset($_SESSION["email"])){
	
	header("Location: ../index.php");
	exit;
		
}

require 'Templates/phpHeadingTemplate.php'; 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "deleteItemForm")) {
	
	include('phpTools/utilities.php');

	//Primero eliminamos los archivos del plan, del servidor.
	rrmdir("../uploads/planes/" . $_POST['id_plan']);

	mysql_select_db($database, $dbConn);

	// Eliminamos la cobertura del plan
  $deleteSQL = sprintf("DELETE FROM cobertura WHERE id_plan=%s", GetSQLValueString($_POST['id_plan'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());

	// Eliminamos la relación plan - tipos de servicios
  $deleteSQL = sprintf("DELETE FROM planes_tipoServicios WHERE id_plan=%s", GetSQLValueString($_POST['id_plan'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());

	// Eliminamos las redes sociales del plan (si las tiene)
  $deleteSQL = sprintf("DELETE FROM planes_redesSociales WHERE id_plan=%s", GetSQLValueString($_POST['id_plan'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());

	// Eliminamos los celulares más populares del plan (si los tiene)
  $deleteSQL = sprintf("DELETE FROM planes_celulares WHERE id_plan=%s", GetSQLValueString($_POST['id_plan'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());
	
	// Eliminamos los datos del plan.
  $deleteSQL = sprintf("DELETE FROM planes WHERE id_plan=%s", GetSQLValueString($_POST['id_plan'], "int"));
	$result = mysql_query($deleteSQL, $dbConn) or die(mysql_error());
		
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

mysql_select_db($database, $dbConn);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/* FUNCIONES */

function createMultipleSelect($recordset, $title, $id_name, $assignedName, $unassignedName){

		echo "<tr>";
		echo "	<td colspan='3'>";
		echo "		<div class='multipleSelectContainer'>";
    echo "			<div id='titles'>";
    echo "				<h3 class='selectable'>" . $title . ":</h3>";
    echo "   			<h3 class='selection'>" . $title . " Asignados:</h3>";
    echo "  			<div class='clearfix'></div>";
    echo "  		</div>";
    echo "  		<select multiple='multiple' id='" . $assignedName . "' name='" . $assignedName . "[]'>";
		while($row = mysql_fetch_assoc($recordset)){
				echo "		<option value='" .  $row[$id_name] . "'>" . $row['nombre'] . "</option>";
		}
		echo "			</select>";
            
    echo "			<select multiple='multiple' id='" . $unassignedName . "' name='" . $unassignedName . "[]' style='position:absolute; left:-9999px;'></select>";
    echo "		</div>";
		echo "	<td>";
		echo "</tr>";  
}


//createMultipleSelect($servicios, "Servicios", "id_tipoServicio", "services", "unassignedServices");
function createMainDataInputNEW($tipoDatosServicios){
	mysql_data_seek($tipoDatosServicios, 0);
	echo '	<tr>';
			    while($row_tipoDatosServicios = mysql_fetch_assoc($tipoDatosServicios)){
			    	if($row_tipoDatosServicios['tipo'] != 'NULL'){
				    	echo '<tr class="tipoServicio'.$row_tipoDatosServicios['id_tipoServicio'].'">
				    				<td>';    
				    				echo $row_tipoDatosServicios['label'];
				    		echo '	</td>';
				    	if($row_tipoDatosServicios['tipo'] == 'boolean'){
				    		echo '<td>';
				    			echo '<input type="checkbox" name="atributo'.$row_tipoDatosServicios['id_tipoDato'].'" value="1" data-idTipoDato="'.$row_tipoDatosServicios['id_tipoDato'].'">';
				    		echo '</td>';
				    	}else{
				    		//if($row_tipoDatosServicios['tipo'] == 'integer'){
								echo '<td>';
					    			echo '<input type="text" name="atributo'.$row_tipoDatosServicios['id_tipoDato'].'" data-idTipoDato="'.$row_tipoDatosServicios['id_tipoDato'].'">';
					    		echo '</td>';
				    		//}
				    	}
				    	echo '</tr>';
				    }
			    }
    echo '	</tr>';


}

function createMainDataInput($tipoDatosServicios, $selectName, $inputName, $label){

		mysql_data_seek($tipoDatosServicios, 0);

		echo "<tr>";
    echo "	<td>" . $label . "</td>";
    echo "	<td>";
		echo "		<select name='" . $selectName . "' id='" . $selectName . "' input='" . $inputName . "' class='mainData'>";
		echo "			<option value='' type='boolean'>Selecciona un tipo de dato</option>"; //Le ponemos type="boolean" para que no muestre el input.
    while($row_tipoDatosServicios = mysql_fetch_assoc($tipoDatosServicios)){
   		echo "		<option value='" . $row_tipoDatosServicios['id_tipoDato'] . "' type='" . $row_tipoDatosServicios['tipo'] . "'>" .  $row_tipoDatosServicios['label'] . "</option>";
    } 
    echo "    </select>";

    echo "  </td>";
    echo "  <td><input type='text' id='" . $inputName . "' name='" . $inputName . "' value=''/></td>";
    echo "</tr>";
		
}

function createCelularInput($celularesMasPopulares, $selectName, $label){

		mysql_data_seek($celularesMasPopulares, 0);

		echo "<tr><td colspan='3'>&nbsp;</td></tr>";
		echo "<tr>";
    echo "	<td width='20%'>" . $label . "</td>";
    echo "	<td width='30%'>";
		echo "		<select name='" . $selectName . "' id='" . $selectName . "' input='" . $inputName . "'>";
		echo "			<option value=''>Selecciona un celular</option>";
    while($row_celularesMasPopulares = mysql_fetch_assoc($celularesMasPopulares)){
   		echo "		<option value='" . $row_celularesMasPopulares['id_celular'] . "' >" .  $row_celularesMasPopulares['nombre'] . "</option>";
    } 
    echo "    </select>";
    echo "  </td>";
    echo "  <td width='40%'>";
		echo "		<label for='" . $selectName . "_precio_12m'>Precio 12m:</label>";
		echo "		<input type='text' id='" . $selectName . "_precio_12m' name='" . $selectName . "_precio_12m' value=''/>";
		echo "		<label for='" . $selectName . "_precio_18m'>Precio 18m:</label>";
    echo "  	<input type='text' id='" . $selectName . "_precio_18m' name='" . $selectName . "_precio_18m' value=''/>";
		echo "		<label for='" . $selectName . "_precio_24m'>Precio 24m:</label>";
    echo "  	<input type='text' id='" . $selectName . "_precio_24m' name='" . $selectName . "_precio_24m' value=''/>";
		echo "		<label for='" . $selectName . "_precio_prepago'>Precio Prepago:</label>";
    echo "  	<input type='text' id='" . $selectName . "_precio_prepago' name='" . $selectName . "_precio_prepago' value=''/>";
		echo "	</td>";
    echo "</tr>";
		
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/* DEFINICION DE CONSTANTES */

/* TIPOS DE SERVICIO */
define(TEL_MOVIL, 1);
/*define(TEL_FIJO, 2);
define(INTERNET, 3); 
define(TV, 4);*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/* VALORES DEFAULT*/

if(!isset($_POST['servicios'])){

	$_POST['servicios'] = array(TEL_MOVIL);
	
}
if(!isset($_POST['FiltroEstado'])){
	$_POST['FiltroEstado'] = 0;
}else{
	//$('#ListaEstados').val($_POST['FiltroEstado'])
}
if(!isset($_POST['FiltroEmpresas'])){
	$_POST['FiltroEmpresas'] = 0;
}else{
	//$('#ListaEmpresas').val($_POST['FiltroEmpresas'])
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

if($_POST['servicios'] == "todos"){
	if($_POST['FiltroEstado'] ==0){
	/* Obtiene todos los planes existentes en la base de datos */
		if($_POST['FiltroEmpresas']==0){
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
			P.dato_principal_3, 
			P.id_tipoDato_principal_3, 
			P.dato_principal_4,
			P.id_tipoDato_principal_4, 
			P.mas_datos, P.visible, 
			E.nombre as empresa, 
			E.codigo_color as empresa_color,
			(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
				FROM planes P
				INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
				ORDER BY empresa ASC, precio DESC");
		}else{
			$query_planes = "SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
				FROM planes P
				INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
				WHERE P.id_empresa=".$_POST['FiltroEmpresas']." 
			 	ORDER BY empresa ASC, precio DESC";
		}

	}else{
		if($_POST['FiltroEmpresas']==0){
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
					FROM planes P
					INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
					INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
					WHERE C.ID_ESTADO='".$_POST['FiltroEstado']."' 
					 ORDER BY empresa ASC, precio DESC");
		}else{
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
					FROM planes P
					INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
					INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
					WHERE C.ID_ESTADO='".$_POST['FiltroEstado']."' AND P.id_empresa=".$_POST['FiltroEmpresas']."  
					 ORDER BY empresa ASC, precio DESC");
		}
	}
	$planes = mysql_query($query_planes, $dbConn) or die(mysql_error());
	$totalRows_planes = mysql_num_rows($planes);

} else {
//echo "<script> alert('Servicios! ".count($_POST['servicios'])."')</script>";
//exit();
	if($_POST['FiltroEstado']==0){
		/* Obtiene todos los planes que corresponden con los parámetros de filtrado */
		if($_POST['FiltroEmpresas']==0){
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
					FROM planes P
					INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
					WHERE P.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_POST['servicios']).") ) )
					 ORDER BY empresa ASC, precio DESC
					  	 ");
		}else{
			$query_planes = "SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
				FROM planes P
				INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
				WHERE P.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_POST['servicios']).") ) )
				 AND P.id_empresa=".$_POST["FiltroEmpresas"]." 
				 ORDER BY empresa ASC, precio DESC
					  	 ";
		}
		//echo $query_planes;
	}else{
		if($_POST["FiltroEmpresas"]==0){
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
				FROM planes P
				INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
				INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
				WHERE C.ID_ESTADO='".$_POST['FiltroEstado']."' 
				AND P.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_POST['servicios']).") ) )
		  	  	ORDER BY empresa ASC, precio DESC");
		}else{
			$query_planes = sprintf("SELECT 
			DISTINCT(P.id_plan),
				P.nombre, 
				P.precio, 
				P.dato_principal_1,
				P.id_tipoDato_principal_1, 
				P.dato_principal_2, 
				P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color,
				(select count(*) from planes_tipoServicios where planes_tipoServicios.id_plan=P.id_plan and planes_tipoServicios.id_tipoServicio=1) as telMovil  
				FROM planes P
				INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
				INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
				WHERE C.ID_ESTADO='".$_POST['FiltroEstado']."' 
				AND P.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_POST['servicios']).") ) ) 
				AND P.id_empresa=".$_POST['FiltroEmpresas']." 
		  	  	ORDER BY empresa ASC, precio DESC");
		}
	}
	$planes = mysql_query($query_planes, $dbConn) or die(mysql_error());
	$totalRows_planes = mysql_num_rows($planes);

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

/* Obtiene el catálogo de tipos de servicios */
$query_servicios = "SELECT * FROM tipoServicios ORDER BY id_tipoServicio ASC";
$servicios = mysql_query($query_servicios, $dbConn) or die(mysql_error());

/* Obtiene el catalogo de tipo de datos de los servicios */
$query_tipoDatosServicios = "SELECT * FROM tipoDatosServicios ORDER BY orden ASC";
$tipoDatosServicios = mysql_query($query_tipoDatosServicios, $dbConn) or die(mysql_error());

/* Obtiene el catálogo de empresas */
$query_empresas = "SELECT * FROM empresas ORDER BY id_empresa ASC";
$empresas = mysql_query($query_empresas, $dbConn) or die(mysql_error());
$ListaFiltroEmpresas= mysql_query($query_empresas, $dbConn) or die(mysql_error());

/* Obtiene el catálogo de estados */
$query_estados = "SELECT * FROM estados ORDER BY id_estado ASC";
$estados = mysql_query($query_estados, $dbConn) or die(mysql_error());
$ListaFiltroEstados=mysql_query($query_estados, $dbConn) or die(mysql_error());

/* Obtiene el catalogo de redes sociales */
$query_redesSociales = "SELECT * FROM redesSociales ORDER BY id_redSocial ASC";
$redesSociales = mysql_query($query_redesSociales, $dbConn) or die(mysql_error());

/* Obtiene el catalogo de redes sociales */
$query_redesSociales = "SELECT * FROM redesSociales ORDER BY id_redSocial ASC";
$redesSociales = mysql_query($query_redesSociales, $dbConn) or die(mysql_error());

/* Obtiene el catalogo de celulares más populares */
$query_celulares = "SELECT * FROM celularesMasPopulares ORDER BY id_celular ASC";
$celulares = mysql_query($query_celulares, $dbConn) or die(mysql_error());

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

?>

<?php require 'Templates/mainTemplate.php'; ?>

<script type="text/javascript" charset="utf-8" src="../JQuery/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../JQuery/jquery-ui-1.11.4.custom/jquery-ui.min.css" />

<link href="JQuery/multiSelect-2.0/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" charset="utf-8" src="JQuery/multiSelect-2.0/js/jquery.multi-select.js"></script>

<!-- Editor WYSIWYG para #mas_datos -->
<script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
<script src="//cdn-source.ckeditor.com/4.5.4/standard/adapters/jquery.js"></script>

<script type="text/javascript" charset="utf-8" src="../JQuery/jquery.redirect.js"></script>


<script type="text/javascript">

	function bulletsDatosPrincipales(){
		//Activar y desactivar bullets cuando se cambian servicios
		//$('select#services option[value="1"]').prop('selected')==false;
		var celular=$('select#services option[value="1"]').prop('selected');
		var telefono=$('select#services option[value="2"]').prop('selected');
		var internet=$('select#services option[value="3"]').prop('selected');
		var tv = $('select#services option[value="4"]').prop('selected');
		console.log("celular "+celular);
		console.log("telefono "+telefono);
		console.log("internet "+internet);
		console.log("tv "+tv);

		if(!celular && !telefono && !internet && !tv){
			$('select#id_tipoDato_principal_1').val('');
			$('select#id_tipoDato_principal_2').val('');
			$('select#id_tipoDato_principal_3').val('');
			$('select#id_tipoDato_principal_4').val('');
			$('.tipoServicio1').hide();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').hide();
		}

		if(celular && (telefono || internet || tv)){
			alert("No puede seleccionar Teléfono móvil junto con ningun otro servicio");
			$('.tipoServicio1').hide();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').hide();
			//Desactivar los bullets que no corresponden al servicio
			
		}

		if(celular && !telefono && !internet && !tv){
			$('.tipoServicio1').show();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').hide();
			

		}

		//Single play telefono
		if(!celular && telefono && !internet && !tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').show();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').hide();
			
		}

		//Single Play Internet
		if(!celular && !telefono && internet && !tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').show();
			$('.tipoServicio4').hide();
			
		}

		//Single Play TV
		if(!celular && !telefono && !internet && tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').show();

		}

		//DoblePlay TV+Internet
		if(!celular && !telefono && internet && tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').hide();
			$('.tipoServicio3').show();
			$('.tipoServicio4').show();

		}

		//DoblePlay TV+Internet
		if(!celular && telefono && !internet && tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').show();
			$('.tipoServicio3').hide();
			$('.tipoServicio4').show();
	
		}

		//DoblePlay Telefono+Internet
		if(!celular && telefono && internet && !tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').show();
			$('.tipoServicio3').show();
			$('.tipoServicio4').hide();

		}

		//TriplePlay Telefono+TV+Internet
		if(!celular && telefono && internet && tv){
			$('.tipoServicio1').hide();
			$('.tipoServicio2').show();
			$('.tipoServicio3').show();
			$('.tipoServicio4').show();

		}


	}

	///////////////////////////////////////////////////////////////////////////////////////////////////
	// Global Variables

	var originalAssignedServices = [];
	var originalAssignedStates = [];
	var originalAssignedRedesSociales = [];
	var originalAssignedCelulares = [];
	var originalAssignedDataServices = [];

	///////////////////////////////////////////////////////////////////////////////////////////////////
	
	function showPopupWindow(caller, transaccion, id_plan){
		
		
		$("div#formPlanWindow input[name=transaccion]").val(transaccion);
		
		$id_empresa = $('div#formPlanWindow select[name=id_empresa]');
		$nombre = $('div#formPlanWindow input[name=nombre]');
		$precio = $('div#formPlanWindow input[name=precio]');

		$id_tipoDato_principal_1 = $('div#formPlanWindow select[name=id_tipoDato_principal_1]');
		$id_tipoDato_principal_2 = $('div#formPlanWindow select[name=id_tipoDato_principal_2]');
		$id_tipoDato_principal_3 = $('div#formPlanWindow select[name=id_tipoDato_principal_3]');
		$id_tipoDato_principal_4 = $('div#formPlanWindow select[name=id_tipoDato_principal_4]');
		
		$dato_principal_1 = $('div#formPlanWindow input[name=dato_principal_1]');
		$dato_principal_2 = $('div#formPlanWindow input[name=dato_principal_2]');
		$dato_principal_3 = $('div#formPlanWindow input[name=dato_principal_3]');
		$dato_principal_4 = $('div#formPlanWindow input[name=dato_principal_4]');
		
		$mas_datos = $('div#formPlanWindow input[name=mas_datos]');
		$mas_datos_aux = $('div#formPlanWindow textarea[name=mas_datos_aux]');
		
		$pdf_celulares = $('div#formPlanWindow input[name=pdf_celulares]');
		$pdf_canalesTV = $('div#formPlanWindow input[name=pdf_canalesTV]');
		$pdf_celulares_current = $('div#formPlanWindow input[name=pdf_celulares_current]');
		$pdf_canalesTV_current = $('div#formPlanWindow input[name=pdf_canalesTV_current]');
		
		$visible = $('div#formPlanWindow input[name=visible]');
			
		$msg = $('td.msg');
		$btn_guardarDatos = $('div#formPlanWindow input[name=saveData]');
		$popUpWindowTitle = $('div#formPlanWindow td#title');
	
		// Limpiamos el posible contenido de todos los inputs.
		allFields = $([]).add($id_empresa).add($nombre).add($precio);
		
		$id_tipoDato_principal_1.val("");
		$id_tipoDato_principal_2.val("");
		$id_tipoDato_principal_3.val("");
		$id_tipoDato_principal_4.val("");
		
		$dato_principal_1.val("").hide();
		$dato_principal_2.val("").hide();
		$dato_principal_3.val("").hide();
		$dato_principal_4.val("").hide();
		
		$mas_datos.val("");
		$mas_datos_aux.val("");
		
		$pdf_celulares.val("");
		$pdf_canalesTV.val("");
		$pdf_celulares_current.val("");
		$pdf_canalesTV_current.val("");
		
		$visible.prop('checked', false);
		
		//Deseleccionamos todas las opciones, para resetear.
		$('select#services option').attr('selected', false);
		$('select#states option').attr('selected', false);
		$('select#redesSociales option').attr('selected', false);	
		$('select#celulares option').attr('selected', false);	
		//Limpiamos los arreglos.
		originalAssignedServices = []; 	
		originalAssignedStates = [];
		originalAssignedRedesSociales = [];
		originalAssignedCelulares = [];
		originalAssignedDataServices = [];
	
		// Limpiamos el posible contenido de todos los inputs.
		allFields.val("").removeClass('error');
		$msg.html("Los campos con [*] son requeridos.").removeClass("errorMsg");
									
		switch(transaccion){
		
			case "INSERT":
				
				// Asignamos los valores conocidos.
				$popUpWindowTitle.html("<h2>Nuevo Plan</h2>");
				$id_empresa.val("1"); //como es un select, seleccionamos la primera opción
				$btn_guardarDatos.val("Guardar");

				$('select#services').multiSelect("destroy");
				$('select#services').multiSelect({
					afterSelect: function(values){
						/*
				    	console.log("Select value: "+values);
				    	if(values==1){
				    		//Opciones de Tel.Movil
				    		$('select#services option[value="1"]').prop('selected', true);

				    		$('select#services option[value="2"]').attr('disabled', 'disabled');
				    		$('select#services option[value="3"]').attr('disabled', 'disabled');
				    		$('select#services option[value="4"]').attr('disabled', 'disabled');
				    		//$('select#services').multiSelect('refresh');
				    		//bulletsDatosPrincipales();
				    	}
				    	if(values==2){
				    		//Opciones de Tel.fijo
				    		$('select#services option[value="2"]').prop('selected', true);

				    		$('select#services option[value="1"]').attr('disabled', 'disabled');
				    		//$('select#services').multiSelect('refresh');

				    	}
				    	if(values==3){
				    		//Opciones de Internet
				    		$('select#services option[value="3"]').prop('selected', true);

				    		$('select#services option[value="1"]').attr('disabled', 'disabled');
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	if(values==4){
				    		//Opciones de T.V.
				    		$('select#services option[value="4"]').prop('selected', true);

				    		$('select#services option[value="1"]').attr('disabled', 'disabled');
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	$('select#services').multiSelect('refresh');
				    	*/
				    	bulletsDatosPrincipales();
					},
					afterDeselect: function(values){
						/*
				    	console.log("Deselect value: "+values);
				    	if(values==1){
				    		//Opciones de Tel.Movil
				    		$('select#services option[value="1"]').prop('selected', false);

				    		$('select#services option[value="2"]').attr('disabled', false);
				    		$('select#services option[value="3"]').attr('disabled', false);
				    		$('select#services option[value="4"]').attr('disabled', false);
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	if(values==2){
				    		//Opciones de Tel.fijo

				    		$('select#services option[value="2"]').prop('selected', false);
				    		if($('select#services option[value="3"]').prop('selected')==false && $('select#services option[value="4"]').prop('selected')==false){
				    			$('select#services option[value="1"]').attr('disabled', false);
				    			$('select#services option[value="2"]').attr('disabled', false);
				    			$('select#services option[value="3"]').attr('disabled', false);
				    			$('select#services option[value="4"]').attr('disabled', false);
				    		}
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	if(values==3){
				    		//Opciones de Internet
				    		$('select#services option[value="3"]').prop('selected', false);
				    		if($('select#services option[value="2"]').prop('selected')==false && $('select#services option[value="4"]').prop('selected')==false){
				    			$('select#services option[value="1"]').attr('disabled', false);
				    			$('select#services option[value="2"]').attr('disabled', false);
				    			$('select#services option[value="3"]').attr('disabled', false);
				    			$('select#services option[value="4"]').attr('disabled', false);
				    		}
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	if(values==4){
				    		//Opciones de T.V.
				    		$('select#services option[value="4"]').prop('selected', false);
				    		if($('select#services option[value="2"]').prop('selected')==false && $('select#services option[value="3"]').prop('selected')==false){
				    			$('select#services option[value="1"]').attr('disabled', false);
				    			$('select#services option[value="2"]').attr('disabled', false);
				    			$('select#services option[value="3"]').attr('disabled', false);
				    			$('select#services option[value="4"]').attr('disabled', false);
				    		}
				    		//$('select#services').multiSelect('refresh');
				    	}
				    	$('select#services').multiSelect('refresh');
				    	*/
				    	bulletsDatosPrincipales();
					}
				  });

				$('select#states').multiSelect("destroy");
				$('select#states').multiSelect();

				$('select#redesSociales').multiSelect("destroy");
				$('select#redesSociales').multiSelect();

				$('select#celulares').multiSelect("destroy");
				$('select#celulares').multiSelect();
													
				break;
			
			case "UPDATE":
			
				// Asignamos los valores conocidos.
				$popUpWindowTitle.html("<h2>Editar Plan</h2>");
				$btn_guardarDatos.val("Guardar Cambios");
				
				// Obtenemos de la base los datos correspondientes del plan.
				$.getJSON("ajax/getPlanData.php", {'id': id_plan}, function(data) {
						
						$("div#formPlanWindow input[name=id_plan]").val(id_plan);
						
						$id_empresa.val(data['id_empresa']);
						$nombre.val(data['nombre']);
						$precio.val(data['precio']);
						
						$id_tipoDato_principal_1.val(data['id_tipoDato_principal_1']);
						$id_tipoDato_principal_2.val(data['id_tipoDato_principal_2']);
						$id_tipoDato_principal_3.val(data['id_tipoDato_principal_3']);
						$id_tipoDato_principal_4.val(data['id_tipoDato_principal_4']);

						$dato_principal_1.val(data['dato_principal_1']);
						$dato_principal_2.val(data['dato_principal_2']);
						$dato_principal_3.val(data['dato_principal_3']);
						$dato_principal_4.val(data['dato_principal_4']);
						
						var tipo_dato_1 = $id_tipoDato_principal_1.find('option:selected').attr("type");
						if(tipo_dato_1 != "boolean"){$dato_principal_1.show()}

						var tipo_dato_2 = $id_tipoDato_principal_2.find('option:selected').attr("type");
						if(tipo_dato_2 != "boolean"){$dato_principal_2.show()}

						var tipo_dato_3 = $id_tipoDato_principal_3.find('option:selected').attr("type");
						if(tipo_dato_3 != "boolean"){$dato_principal_3.show()}

						var tipo_dato_4 = $id_tipoDato_principal_4.find('option:selected').attr("type");
						if(tipo_dato_4 != "boolean"){$dato_principal_4.show()}

						$mas_datos.val(data['mas_datos']);
						$mas_datos_aux.val(data['mas_datos']);
						
						if(data['pdf_celulares'] != ""){
							//$pdf_celulares_current.val(data['pdf_celulares'] + " (actual)");
							$pdf_celulares_current.val(data['pdf_celulares']);
						}
						
						if(data['pdf_canalesTV'] != ""){
							//$pdf_canalesTV_current.val(data['pdf_canalesTV'] + " (actual)");
							$pdf_canalesTV_current.val(data['pdf_canalesTV']);
						}
						
						var checked = (data['visible'] == 1) ? true : false;
						$visible.prop('checked', checked);
						
						// Obtenemos de la base los servicios asignados al plan.
						$.getJSON("ajax/getPlanServicios.php", {'id': id_plan}, function(serviciosPlan) {
							$('select#services').multiSelect("refresh");
							$.each(serviciosPlan, function(recordNum, servicio) {
								//alert("GetServiciosPlan")
															
								$('select#services option[value="' + servicio['id_tipoServicio'] + '"]').attr("selected", "selected");
								originalAssignedServices.push(servicio['id_tipoServicio']);
							
							});
						
						}).done(function(){
							//alert(".done getPlanServicios")
							$('select#services').multiSelect("destroy");
							//$('select#services').multiSelect();				
							$('select#services').multiSelect({
								afterSelect: function(values){
							    	bulletsDatosPrincipales();
								},
								afterDeselect: function(values){
							    	bulletsDatosPrincipales();
								}
							});
							bulletsDatosPrincipales();
						});	

						// Obtenemos de la base los atributos del servicios asignados al plan.
						$.getJSON("ajax/getPlanDataServicios.php", {'id': id_plan}, function(serviciosDataPlan) {
							//$('select#services').multiSelect("refresh");
							$.each(serviciosDataPlan, function(recordNum, servicio) {
								//alert("GetServiciosPlan")
															
								//$('select#services option[value="' + servicio['id_tipoServicio'] + '"]').attr("selected", "selected");
								if(servicio['tipo']=='boolean'){
									if(servicio['valor']==1){
										$('input[name=atributo'+servicio['id_tipoDato']+']').prop('checked','checked');
									}
								}else{
									if(servicio['valor']!='null'){
										$('input[name=atributo'+servicio['id_tipoDato']+']').val(servicio['valor']);
									}
								}
								originalAssignedDataServices.push([servicio['id_tipoDato'],servicio['valor']]);
							
							});
						
						}).done(function(){
							//alert(".done getPlanServicios")
							//$('select#services').multiSelect("destroy");
							//$('select#services').multiSelect();							
						
						});					
												
						// Obtenemos de la base los estados asignados al plan.
						$.getJSON("ajax/getPlanEstados.php", {'id': id_plan}, function(estadosPlan) {
												
							$.each(estadosPlan, function(recordNum, estado) {
															
								$('select#states option[value="' + estado['id_estado'] + '"]').attr("selected", "selected");
								originalAssignedStates.push(estado['id_estado']);
							
							});
						
						}).done(function(){
						
							$('select#states').multiSelect("destroy");
							$('select#states').multiSelect();
						
						});
						
						// Obtenemos de la base las redes sociales asignadas al plan.
						$.getJSON("ajax/getPlanRedesSociales.php", {'id': id_plan}, function(redesSociales) {
												
							$.each(redesSociales, function(recordNum, redSocial) {
															
								$('select#redesSociales option[value="' + redSocial['id_redSocial'] + '"]').attr("selected", "selected");
								originalAssignedRedesSociales.push(redSocial['id_redSocial']);
							
							});
						
						}).done(function(){
						
							$('select#redesSociales').multiSelect("destroy");
							$('select#redesSociales').multiSelect();
						
						});
						
						// Obtenemos de la base los celulares asignados al plan.
						$.getJSON("ajax/getPlanCelulares.php", {'id': id_plan}, function(celulares) {
												
							$.each(celulares, function(recordNum, celular) {
															
								$('select#celulares option[value="' + celular['id_celular'] + '"]').attr("selected", "selected");
								originalAssignedCelulares.push(celular['id_celular']);
							
							});
						
						}).done(function(){
						
							$('select#celulares').multiSelect("destroy");
							$('select#celulares').multiSelect();
						
						});
																																																			 
				}).done(function(){
	
						$btn_guardarDatos.val("Guardar cambios");
		
				}); //.done(function(){... 
			
				break;

				case "DUPLICATE":
			
				// Asignamos los valores conocidos.
				$popUpWindowTitle.html("<h2>Duplicar Plan</h2>");
				$btn_guardarDatos.val("Guardar");
				
				// Obtenemos de la base los datos correspondientes del plan.
				$.getJSON("ajax/getPlanData.php", {'id': id_plan}, function(data) {
						
						$("div#formPlanWindow input[name=id_plan]").val(id_plan);
						
						$id_empresa.val(data['id_empresa']);
						$nombre.val(data['nombre']);
						$precio.val(data['precio']);
						
						$id_tipoDato_principal_1.val(data['id_tipoDato_principal_1']);
						$id_tipoDato_principal_2.val(data['id_tipoDato_principal_2']);
						$id_tipoDato_principal_3.val(data['id_tipoDato_principal_3']);
						$id_tipoDato_principal_4.val(data['id_tipoDato_principal_4']);

						$dato_principal_1.val(data['dato_principal_1']);
						$dato_principal_2.val(data['dato_principal_2']);
						$dato_principal_3.val(data['dato_principal_3']);
						$dato_principal_4.val(data['dato_principal_4']);
						
						var tipo_dato_1 = $id_tipoDato_principal_1.find('option:selected').attr("type");
						if(tipo_dato_1 != "boolean"){$dato_principal_1.show()}

						var tipo_dato_2 = $id_tipoDato_principal_2.find('option:selected').attr("type");
						if(tipo_dato_2 != "boolean"){$dato_principal_2.show()}

						var tipo_dato_3 = $id_tipoDato_principal_3.find('option:selected').attr("type");
						if(tipo_dato_3 != "boolean"){$dato_principal_3.show()}

						var tipo_dato_4 = $id_tipoDato_principal_4.find('option:selected').attr("type");
						if(tipo_dato_4 != "boolean"){$dato_principal_4.show()}

						$mas_datos.val(data['mas_datos']);
						$mas_datos_aux.val(data['mas_datos']);
						
						if(data['pdf_celulares'] != ""){
							//$pdf_celulares_current.val(data['pdf_celulares'] + " (actual)");
							$pdf_celulares_current.val(data['pdf_celulares']);
						}
						
						if(data['pdf_canalesTV'] != ""){
							//$pdf_canalesTV_current.val(data['pdf_canalesTV'] + " (actual)");
							$pdf_canalesTV_current.val(data['pdf_canalesTV']);
						}
						
						var checked = (data['visible'] == 1) ? true : false;
						$visible.prop('checked', checked);
						
						// Obtenemos de la base los servicios asignados al plan.
						$.getJSON("ajax/getPlanServicios.php", {'id': id_plan}, function(serviciosPlan) {
												
							$.each(serviciosPlan, function(recordNum, servicio) {
															
								$('select#services option[value="' + servicio['id_tipoServicio'] + '"]').attr("selected", "selected");
								originalAssignedServices.push(servicio['id_tipoServicio']);
							
							});
						
						}).done(function(){
							//alert(".done getPlanServicios")
							$('select#services').multiSelect("destroy");
							//$('select#services').multiSelect();				
							$('select#services').multiSelect({
								afterSelect: function(values){
							    	bulletsDatosPrincipales();
								},
								afterDeselect: function(values){
							    	bulletsDatosPrincipales();
								}
							});
							bulletsDatosPrincipales();
						});	
	

						// Obtenemos de la base los atributos del servicios asignados al plan.
						$.getJSON("ajax/getPlanDataServicios.php", {'id': id_plan}, function(serviciosDataPlan) {
							//$('select#services').multiSelect("refresh");
							$.each(serviciosDataPlan, function(recordNum, servicio) {
								//alert("GetServiciosPlan")
															
								//$('select#services option[value="' + servicio['id_tipoServicio'] + '"]').attr("selected", "selected");
								if(servicio['tipo']=='boolean'){
									if(servicio['valor']==1){
										$('input[name=atributo'+servicio['id_tipoDato']+']').prop('checked','checked');
									}
								}else{
									if(servicio['valor']!='null'){
										$('input[name=atributo'+servicio['id_tipoDato']+']').val(servicio['valor']);
									}
								}
								originalAssignedDataServices.push([servicio['id_tipoDato'],servicio['valor']]);
							
							});
						
						}).done(function(){
							//alert(".done getPlanServicios")
							//$('select#services').multiSelect("destroy");
							//$('select#services').multiSelect();							
						
						});									
												
						// Obtenemos de la base los estados asignados al plan.
						$.getJSON("ajax/getPlanEstados.php", {'id': id_plan}, function(estadosPlan) {
												
							$.each(estadosPlan, function(recordNum, estado) {
															
								$('select#states option[value="' + estado['id_estado'] + '"]').attr("selected", "selected");
								originalAssignedStates.push(estado['id_estado']);
							
							});
						
						}).done(function(){
						
							$('select#states').multiSelect("destroy");
							$('select#states').multiSelect();
						
						});
						
						// Obtenemos de la base las redes sociales asignadas al plan.
						$.getJSON("ajax/getPlanRedesSociales.php", {'id': id_plan}, function(redesSociales) {
												
							$.each(redesSociales, function(recordNum, redSocial) {
															
								$('select#redesSociales option[value="' + redSocial['id_redSocial'] + '"]').attr("selected", "selected");
								originalAssignedRedesSociales.push(redSocial['id_redSocial']);
							
							});
						
						}).done(function(){
						
							$('select#redesSociales').multiSelect("destroy");
							$('select#redesSociales').multiSelect();
						
						});
						
						// Obtenemos de la base los celulares asignados al plan.
						$.getJSON("ajax/getPlanCelulares.php", {'id': id_plan}, function(celulares) {
												
							$.each(celulares, function(recordNum, celular) {
															
								$('select#celulares option[value="' + celular['id_celular'] + '"]').attr("selected", "selected");
								originalAssignedCelulares.push(celular['id_celular']);
							
							});
						
						}).done(function(){
						
							$('select#celulares').multiSelect("destroy");
							$('select#celulares').multiSelect();
						
						});
																																																			 
				}).done(function(){
						$btn_guardarDatos.val("Guardar");
		
				}); //.done(function(){... 
			
				break;




				
		} //switch


		// Ubicamos la ventana a la altura del elemento que ejecutó esta función.
		$('div#formPlanWindow').css('top', $(caller).offset().top);				
		// Al final, mostramos la ventana.
		$('div#formPlanWindow').fadeIn();
		// Hacemos scroll para ver la popUpWindow, que se pone siempre hasta arriba.
		//$('html, body').animate({scrollTop: 0}, 2000);

		removeCursorToWait();	
	
	} // function showPopupWindow

	///////////////////////////////////////////////////////////////////////////////////////////////////

	function showPopupWindow2(caller, id_plan, plan_nombre){
				
		$("div#formPlanCelularesWindow input[name=transaccion]").val(transaccion);
		$("div#formPlanCelularesWindow input[name=id_plan]").val(id_plan);
		
		var $id_celular = [];
		
		$id_celular[0] = $('div#formPlanCelularesWindow select[name=id_celular_1]');
		$id_celular[1] = $('div#formPlanCelularesWindow select[name=id_celular_2]');
		$id_celular[2] = $('div#formPlanCelularesWindow select[name=id_celular_3]');
		$id_celular[3] = $('div#formPlanCelularesWindow select[name=id_celular_4]');
		
		$id_celular[0][1] = $('div#formPlanCelularesWindow input[name=id_celular_1_precio_12m]');
		$id_celular[0][2] = $('div#formPlanCelularesWindow input[name=id_celular_1_precio_18m]');
		$id_celular[0][3] = $('div#formPlanCelularesWindow input[name=id_celular_1_precio_24m]');
		$id_celular[0][4] = $('div#formPlanCelularesWindow input[name=id_celular_1_precio_prepago]');

		$id_celular[1][1] = $('div#formPlanCelularesWindow input[name=id_celular_2_precio_12m]');
		$id_celular[1][2] = $('div#formPlanCelularesWindow input[name=id_celular_2_precio_18m]');
		$id_celular[1][3] = $('div#formPlanCelularesWindow input[name=id_celular_2_precio_24m]');
		$id_celular[1][4] = $('div#formPlanCelularesWindow input[name=id_celular_2_precio_prepago]');

		$id_celular[2][1] = $('div#formPlanCelularesWindow input[name=id_celular_3_precio_12m]');
		$id_celular[2][2] = $('div#formPlanCelularesWindow input[name=id_celular_3_precio_18m]');
		$id_celular[2][3] = $('div#formPlanCelularesWindow input[name=id_celular_3_precio_24m]');
		$id_celular[2][4] = $('div#formPlanCelularesWindow input[name=id_celular_3_precio_prepago]');

		$id_celular[3][1] = $('div#formPlanCelularesWindow input[name=id_celular_4_precio_12m]');
		$id_celular[3][2] = $('div#formPlanCelularesWindow input[name=id_celular_4_precio_18m]');
		$id_celular[3][3] = $('div#formPlanCelularesWindow input[name=id_celular_4_precio_24m]');
		$id_celular[3][4] = $('div#formPlanCelularesWindow input[name=id_celular_4_precio_prepago]');
				
		$msg = $('div#formPlanCelularesWindow td.msg');
		$btn_guardarDatos = $('div#formPlanCelularesWindow input[name=saveData2]');
		$popUpWindowTitle = $('div#formPlanCelularesWindow td#title');
	
		// Limpiamos el posible contenido de todos los inputs.
		for(i=0 ; i < 4 ; i++){
			for(j=1 ; j < 5 ; j++ ){
				$id_celular[i][j].val("").removeClass('error');
			}
		}
		
		// Seleccionamos la primera opción de los selects.
		$id_celular[0].val("");
		$id_celular[1].val("");
		$id_celular[2].val("");
		$id_celular[3].val("");
		
		$msg.html("").removeClass("errorMsg");

		$popUpWindowTitle.html("<h2>Celulares más populares - [ " + plan_nombre + " ]</h2>");
		$btn_guardarDatos.val("Guardar");
				
		// Obtenemos de la base los datos correspondientes del plan.
		$.getJSON("ajax/getPlanCelulares.php", {'id': id_plan}, function(data) {
				
				$.each(data, function(index, record) {
					
					//alert(index);
												
					$id_celular[index].val(record['id_celular']);
					$id_celular[index][1].val(record['precio_12m']);
					$id_celular[index][2].val(record['precio_18m']);
					$id_celular[index][3].val(record['precio_24m']);
					$id_celular[index][4].val(record['precio_prepago']);
				
				});						
																																																	 
		}); //$.getJSON(... 


		// Ubicamos la ventana a la altura del elemento que ejecutó esta función.
		$('div#formPlanCelularesWindow').css('top', $(caller).offset().top);				
		// Al final, mostramos la ventana.
		$('div#formPlanCelularesWindow').fadeIn();
		// Hacemos scroll para ver la popUpWindow, que se pone siempre hasta arriba.
		//$('html, body').animate({scrollTop: 0}, 2000);

		removeCursorToWait();	
	
	} // function showPopupWindow

	///////////////////////////////////////////////////////////////////////////////////////////////////

	function IsFormDataValid(){
		
			var allDataValid = false;
	
			requiredFields = $([]).add($nombre).add($precio);
							
			if(areRequiredFieldsFilledOut(requiredFields)){

					fieldsToValidate = [{field: $precio, type: "numeric", label: "Precio"}];
																
					if(areFieldsDataValid($msg, fieldsToValidate)){
											
							$msg.html("Por favor espera, guardando datos...").removeClass("errorMsg").addClass('waitMsg');
														
							// Servicios
							fillUnassignedItems("select#services option:selected", "select#unassignedServices", originalAssignedServices);
							// Estados
							fillUnassignedItems("select#states option:selected", "select#unassignedStates", originalAssignedStates);	
							// Redes Sociales
							fillUnassignedItems("select#redesSociales option:selected", "select#unassignedRedesSociales", originalAssignedRedesSociales);	
							// Celulares más populares
							fillUnassignedItems("select#celulares option:selected", "select#unassignedCelulares", originalAssignedCelulares);	
														
							allDataValid = true;
													
					} // if(areFieldsDataValid(...
					else { 

						allDataValid = false;
						
						//errorMsg = "Campos con valores no permitidos.";
						//$msg.text(errorMsg).addClass("errorMsg");
						
						removeCursorToWait();
						
					}
								
			} //if(areRequiredFieldsOk(...
			else {
				
				allDataValid = false;
				
				$msg.html("Los campos con [*] son requeridos.").addClass("errorMsg");
				
				removeCursorToWait();
			}
	
			return allDataValid;
			
	} //funcion(isFormDataValid(...

	///////////////////////////////////////////////////////////////////////////////////////////////////

	function fillUnassignedItems(assignedItemsSelector, unassignedItemsSelector, orginalItems){
	
	
			var newAssignedItems = [];
			
			// Llenamos el arreglo de items asignados
			$(assignedItemsSelector).each(function(){
				newAssignedItems.push($(this).val()); 
			});
										
			$(unassignedItemsSelector).empty();
			
			// Buscamos en el arreglo de items asignados si alguno de los items asignados originales fue desasignado
			// Si es así, lo agregamos al componente de items desasignados, para que se elimien al hacer el submit, de la base de datos.
			$.each(orginalItems, function(index, id) {
			
				//alert( "Id proyecto originalmente asignado = " + id );
				if($.inArray(id, newAssignedItems) < 0){	
					//alert('Id proyecto desasignado = ' + id);		
					$(unassignedItemsSelector).append($('<option>').val(id).attr('selected','selected'));
					
				}
			
			});	
	
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////

		function savePlanVisibleStatus(id_plan, value){
			
				var visible = (value == true) ? 1 : 0;
							
				$.get("ajax/savePlanVisibleStatus.php", {'id_plan': id_plan, 'visible': visible}).done(function(){					
				
					window.location.reload();
					
				});
		}

	///////////////////////////////////////////////////////////////////////////////////////////////////

	$(document).ready(function() {
				
		///////////////////////////////////////////////////////////////////////////////////////////////////

		$('div#servicios .servicio').click(function(){
		
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");			
			}
			
			$('div#servicios .todos').removeClass("selected");
		
		});

		$('div#servicios .todos').click(function(){
		
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");			
			}
			
			$('div#servicios .servicio').removeClass("selected");
		
		});

		///////////////////////////////////////////////////////////////////////////////////////////////////
		
		$('div#btn_filtrar').click(function(){
			
				if(($('div#servicios .servicio.selected').length == 0) && ($('div#servicios .todos.selected').length == 0)){
					
					alert("Por favor, selecciona al menos un servicio.");
				
				} else {
					
					if($('div#servicios .servicio.selected').length > 0){
					
						var servicios = Array();
						
						$('div#servicios .servicio.selected').each(function(index){
						
							//alert(index + " - " + $(this).attr('id') + " - " + $(this).text());
							servicios.push($(this).attr('id'));
						
						});

						var FiltroEstado = $('#ListaEstados').val();
						var FiltroEmpresas = $('#ListaEmpresas').val();
						$.redirect("planes.php", {"servicios" : servicios, "FiltroEstado": FiltroEstado, "FiltroEmpresas": FiltroEmpresas});  
					
					} else {
						var FiltroEstado = $('#ListaEstados').val();
						var FiltroEmpresas = $('#ListaEmpresas').val();
						$.redirect("planes.php", {"servicios" : "todos", "FiltroEstado": FiltroEstado, "FiltroEmpresas": FiltroEmpresas}); 
					
					}
				}		
			
		});	
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		
		$('#frm_plan').on('submit',(function(e) {
		
				e.preventDefault();
	
				$msg = $('td.msg');
				
				changeCursorToWait();
				
				if(IsFormDataValid()){
					
					//Antes de enviar el post del formulario, hacemos el paso de datos del campo mas_datos_aux a mas_datos (qué es el que finalmente se insertará en la base de datos).
					$mas_datos.val($mas_datos_aux.val()); 
				
					$.ajax({
						url: "ajax/savePlanData.php", 		// Url to which the request is send
						type: "POST",             			// Type of request to be send, called as method
						data: new FormData(this), 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       			// The content type used when sending data to the server.
						cache: false,             			// To unable request pages to be cached
						processData: false,       			// To send DOMDocument or non processed data file it is set to false
						success: function(data)   			// A function to be called if request succeeds
						{	console.log(data);
							removeCursorToWait();
							$('div#formPlanWindow').fadeOut();
							alert("Tu plan se guardo con Exito!");
							location.reload();						
							//$msg.html(data);
						}
					});
				
				}
			
		}));
		
		///////////////////////////////////////////////////////////////////////////////////////////////////

		$('#frm_planCelulares').on('submit',(function(e) {
		
				e.preventDefault();
					
				changeCursorToWait();
				
				//if(IsFormCelularesDataValid()){
				
					$.ajax({
						url: "ajax/savePlanCelularesData.php", 		// Url to which the request is send
						type: "POST",             			// Type of request to be send, called as method
						data: new FormData(this), 			// Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       			// The content type used when sending data to the server.
						cache: false,             			// To unable request pages to be cached
						processData: false,       			// To send DOMDocument or non processed data file it is set to false
						success: function(data)   			// A function to be called if request succeeds
						{
							removeCursorToWait();
							$('div#formPlanCelularesWindow').fadeOut();
						}
					});
				
				//}
			
		}));
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
	
		/*$("input[type=button]#edit").click(function(){
			
				//alert($(this).offset().top);
				$("div#formPlanWindow").offset({"top": $(this).offset().top});							
		
		});*/
	
		// para ocultar o mostrar los inputs de tipo boleano.
		$('select.mainData').change(function(){
			
			var tipoDato = $(this).find('option:selected').attr("type");
			
			if(tipoDato == "boolean"){
				
				$("input[name=" + $(this).attr("input") + "]").fadeOut().val(1);
						
			} else {
				$("input[name=" + $(this).attr("input") + "]").val("").fadeIn();
			}
			
		});
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		
		// Construimos el editor wysiwyg sobre el textarea auxiliar.		
		$('#mas_datos_aux').ckeditor();
		
		///////////////////////////////////////////////////////////////////////////////////////////////////

		
											
	}); //$(document).ready();
	function exportDB(){
		var FiltroEstado = $('#ListaEstados').val();
		window.open("ajax/exportCSV.php?estado="+FiltroEstado,"_blank");
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////

</script>

<?php require 'Templates/headTemplate.php'; ?>

<!-- START CONTENT -->

<table class="identification" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Administrador de Planes</h2></td>
  </tr>
</table>

<table class="newItemLink" border="0" cellspacing="0" cellpadding="0">
    <td><h3>Selecciona un plan o da de alta uno <a href="#" onclick="showPopupWindow(this, 'INSERT');">Nuevo</a></h3></td>
  </tr>
</table>

<div id="servicios">
  <?php while($row_servicios = mysql_fetch_assoc($servicios)){ ?>
    <div id="<?php echo $row_servicios['id_tipoServicio']; ?>" class="servicio <?php if(in_array($row_servicios['id_tipoServicio'], $_POST['servicios'])){ echo "selected"; } ?>"><img src="../uploads/servicios/<?php echo $row_servicios['id_tipoServicio'] . "/" . $row_servicios['icono']; ?>" /><?php echo $row_servicios['nombre']; ?></div>
  <?php }?>
  <!--Filtro de estado-->
  <div id="todos" class="todos <?php if($_POST['servicios'] == "todos"){ echo "selected"; } ?>">Todos</div>
	<div>
	  <div id="FiltroEstado" class="FiltroEstado">
	  	<label for="sel1">Lista de estados (seleccione uno):</label>
	      <select class="" id="ListaEstados">
	      <?php 
	        echo "<option value='0'>Todos los estados</option>";
	      	while($row_estados = mysql_fetch_assoc($ListaFiltroEstados)){
	      		echo "<option value=".$row_estados['id_estado'].">".$row_estados['nombre']."</option>";
	      	}
	      ?>
	      </select>
	      <?php 
	      	if($_POST['FiltroEstado']>0){
		  		echo "<script>$('#ListaEstados').val(".$_POST['FiltroEstado'].") </script>";
		  	}
	      ?>
	  </div>
	  <div id="FiltroEmpresas" class="FiltroEmpresas">
	  	<label for="sel1">Lista de Empresas (seleccione una):</label>
	      <select class="" id="ListaEmpresas">
	      <?php 
	        echo "<option value='0'>Todas las empresas</option>";
	      	while($row_empresas = mysql_fetch_assoc($ListaFiltroEmpresas)){
	      		echo "<option value=".$row_empresas['id_empresa'].">".$row_empresas['nombre']."</option>";
	      	}
	      ?>
	      </select>
	      <?php 
	      	if($_POST['FiltroEmpresas']>0){
		  		echo "<script>$('#ListaEmpresas').val(".$_POST['FiltroEmpresas'].") </script>";
		  	}
	      ?>
	  </div>
	  <div><button type="button" id="exportCSV" class="exportCSV" onclick="exportDB()">Exportar Base de datos</button></div>
	</div>
<br>

  <div id="btn_filtrar">MOSTRAR PLANES</div>
  <div class="clearfix"></div>
</div>
                    
<table class="itemsList" border="0" cellspacing="0" cellpadding="0"> 
  <tr class="headers nodrop nodrag">
  	<td width="10%">Visible</td>
    <td width="12%">Empresa</td>
    <td width="20%">Nombre</td>
    <td width="10%">Precio</td>
    <td width="12%"></td><!-- Boton Asignar celulares -->
    <td width="12%"></td><!-- Boton Editar -->
    <td width="12%"></td><!-- Boton Duplicar -->
    <td width="12%"></td><!-- Boton Eliminar -->

  </tr>
  <?php while($row_planes = mysql_fetch_assoc($planes)){ ?>
    
  <tr>
    <!--td style='background-color:< ?php echo $row_planes['empresa_color']; ? >'>< ?php echo $row_planes['empresa']; ? ></td-->
    <td class="center">
    	<input type="checkbox" name="isVisible" id="isVisible" onclick="savePlanVisibleStatus(<?php echo $row_planes['id_plan']; ?>, this.checked);" <?php if($row_planes['visible'] == 1){ echo "checked"; } ?>>
    </td>
    <td><?php echo $row_planes['empresa']; ?></td>
    <td><?php echo $row_planes['nombre']; ?></td>
    <td>$<?php echo $row_planes['precio']; ?></td>
    <td class="button">
    <?php if( $row_planes['telMovil'] > 0){ ?>
      <input type="button" id="asig_celulares" name="asig_celulares" value="Asig. Celulares" onclick="changeCursorToWait(); showPopupWindow2(this, <?php echo $row_planes['id_plan']; ?>, '<?php echo $row_planes['nombre']; ?>');" /> 
		<?php } ?>
    </td>
    <td class="button">
      <input type="button" id="edit" name="edit" value="Editar" onclick="changeCursorToWait(); showPopupWindow(this, 'UPDATE', <?php echo $row_planes['id_plan']; ?>);" /> 
    </td>
    <td class="button">
      <input type="button" id="edit" name="edit" value="Duplicar" onclick="changeCursorToWait(); showPopupWindow(this, 'DUPLICATE', <?php echo $row_planes['id_plan']; ?>);" /> 
    </td>
    <td class="button">
      <form name="deleteItemForm" method="post" onsubmit="return confirm('¿Está seguro que desea eliminar el plan <?php echo $row_planes['nombre']; ?>?\n\nSe eliminarán todos los registros y archivos relacionados.\n\nEsta acción es irreversible.'); changeCursorToWait();">
        <input type="hidden" name="id_plan" value="<?php echo $row_planes['id_plan']; ?>" />
        <input type="submit" value="Eliminar" />
        <?php if($_POST['servicios'] == "todos"){	?>
        	<input type="hidden" name="servicios" value="todos">
        <?php } else { 		
								foreach($_POST['servicios'] as $servicio){ ?>
                  <input type="hidden" name="servicios[]" value="<?php echo $servicio; ?>">
        <?php		}
				 			} ?>
        <input type="hidden" name="MM_delete" value="deleteItemForm">
      </form>      
    </td>
  </tr>
  
  <?php } //while($row_planes... ?>
</table>

        
<div id="formPlanWindow" class="popUpWindow">

  <form id="frm_plan" action="" method="post" enctype="multipart/form-data">
  
  		<input type="hidden" name="transaccion" id="transaccion" value="">
      <input type="hidden" name="id_plan" id="id_plan" value=""><!-- Para UPDATE -->
      <input type="hidden" name="mas_datos" id="mas_datos" value="" /><!-- El contenido de este input es el que se insertará a la base de datos "mas_datos_aux" sirve de auxiliar para el manejo de ckeditor -->
                                       
      <table class="form" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td id="title" colspan="3" class="center"></td>
        </tr>
        <tr>
          <td class="msg center" colspan="3">Los campos con [*] son requeridos.</td>
        </tr>
        <tr>
          <td width="20%" class="label">empresa *:</td>
          <td width="40%">
						<select name="id_empresa" id="id_empresa" >
            <?php while($row_empresas = mysql_fetch_assoc($empresas)){ ?>
              <option value="<?php echo $row_empresas['id_empresa']; ?>"><?php echo $row_empresas['nombre']; ?></option>
            <?php } ?> 
            </select>          
          </td>
          <td width="40%">&nbsp;</td>
        </tr>
        <tr>
          <td class="label">Nombre *:</td>
          <td><input type="text" id="nombre" name="nombre" value=""/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="label">Precio *:</td>
          <td><input type="text" id="precio" name="precio" value=""/></td>
          <td>&nbsp;</td>
        </tr>
				<?php
        mysql_data_seek($servicios, 0);
        createMultipleSelect($servicios, "Servicios", "id_tipoServicio", "services", "unassignedServices");
        ?>
        <tr>
        	<td colspan="3">&nbsp;</td>
        </tr>
        <?php
					//createMainDataInput($tipoDatosServicios, "id_tipoDato_principal_1", "dato_principal_1", "Dato principal 1:");
					//createMainDataInput($tipoDatosServicios, "id_tipoDato_principal_2", "dato_principal_2", "Dato principal 2:");
					//createMainDataInput($tipoDatosServicios, "id_tipoDato_principal_3", "dato_principal_3", "Dato principal 3:");
					//createMainDataInput($tipoDatosServicios, "id_tipoDato_principal_4", "dato_principal_4", "Dato principal 4:");
					createMainDataInputNEW($tipoDatosServicios);
				?>
        <tr>
        	<td>M&aacute;s datos:</td>
        	<td colspan="2"><textarea id="mas_datos_aux" name="mas_datos_aux"></textarea></td>
        </tr>
        <?php	
					createMultipleSelect($estados, "Estados", "id_estado", "states", "unassignedStates");
    			createMultipleSelect($redesSociales, "Redes Sociales", "id_redSocial", "redesSociales", "unassignedRedesSociales");
    			//createMultipleSelect($celulares, "Celulares m&aacute;s populares", "id_celular", "celulares", "unassignedCelulares");
				?>
        <tr>
        	<td>PDF celulares:</td>
        	<td><input type="file" id="pdf_celulares" name="pdf_celulares" value=""></td>
        	<td><input type="text" id="pdf_celulares_current" name="pdf_celulares_current" readonly="readonly" class="readonly" val=""/></td>
        </tr>
        <tr>
        	<td>PDF canales TV:</td>
        	<td><input type="file" id="pdf_canalesTV" name="pdf_canalesTV" value=""></td>
        	<td><input type="text" id="pdf_canalesTV_current" name="pdf_canalesTV_current" readonly="readonly" class="readonly" val=""/></td>
        </tr>
        <tr>
        	<td>Visible en Sitio:</td>
        	<td><input type="checkbox" id="visible" name="visible" value="1"></td>
        	<td>&nbsp;</td>
        </tr>
      </table>
      
      <table class="buttons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" class="button">
            <input type="button" value="Cancelar" onClick="$('div#formPlanWindow').fadeOut(); location.reload();" />
          </td>
          <td width="50%" class="button"><input id="saveData" name="saveData" type="submit" value=""></td>
        </tr>
      </table>
  
  </form>

</div><!-- #formPlanWindow -->        



<div id="formPlanCelularesWindow" class="popUpWindow">

  <form id="frm_planCelulares" action="" method="post">
  
  		<input type="hidden" name="transaccion" id="transaccion" value="">
      <input type="hidden" name="id_plan" id="id_plan" value="">
                                       
      <table class="form" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td id="title" colspan="3" class="center"></td>
        </tr>
        <?php
					createCelularInput($celulares, "id_celular_1", "Celular 1:");
					createCelularInput($celulares, "id_celular_2", "Celular 2:");
					createCelularInput($celulares, "id_celular_3", "Celular 3:");
					createCelularInput($celulares, "id_celular_4", "Celular 4:");
				?>
      </table>
      
      <table class="buttons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" class="button">
            <input type="button" value="Cancelar" onClick="$('div#formPlanCelularesWindow').fadeOut();" />
          </td>
          <td width="50%" class="button"><input id="saveData2" name="saveData2" type="submit" value=""></td>
        </tr>
      </table>
  
  </form>

</div><!-- #formPlanCelularesWindow -->        


 
<!-- CONTENT END -->

<?php 
    require ('Templates/footerTemplate.php'); 
?>