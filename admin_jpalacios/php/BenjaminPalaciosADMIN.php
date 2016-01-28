<?php
/*
Archivos PHP para el registro de usuario de la aplicacion de BenjaminPalacios
*/

require "dbConn.php"; 

$consulta = "SELECT nombre FROM usuarios";

if ($resultado = mysqli_query($dbConn, $consulta)) {
	//Contamos la cantidad de usuarios para la paginación
	$num_row = mysqli_num_rows($resultado);
	//Numero de Registros por pagina
	$rowsPerPage = 1;
	//Iniciamos en pagina 1
	//$pageNum= 1;
	$_SESSION['pageNum']=1;
	//Comprobamos si están solicitando un número de página en especial 
	if(isset($_GET['page'])) {
        sleep(1);
        //$pageNum = $_GET['page'];
        $_SESSION['pageNum'] = $_GET['page'];
    }

    $offset = ($_SESSION['pageNum'] - 1) * $rowsPerPage;
    //$total_paginas = ceil($num_row / $rowsPerPage);
    $_SESSION['total_paginas']= ceil($num_row / $rowsPerPage);

    /* obtener el array asociativo */
    $consultaPaginacion = "SELECT nombre, email, usuario_admin, edad, sexo FROM usuarios ORDER by nombre ASC LIMIT ".$offset.", ".$rowsPerPage."";
    $resultadoPaginacion = mysqli_query($dbConn, $consultaPaginacion);
    //$i=1;
    while ($fila = mysqli_fetch_row($resultadoPaginacion)) {
		print_r("<tr>");
	    //print_r("<td>".$i."</td>");
	   	print_r("<td>".$fila[0]."</td>");
	    print_r("<td><img src='img/avatar_".$fila[4].".png' alt='user' width='70' class='img-circle' alt='Responsive image'></td>");
	    print_r("<td>".$fila[3]."</td>");
	    print_r("<td>".$fila[1]."</td>");
	    if($fila[4]==0){
			print_r("<td>Usuario</td>");
	    }else{
	   		print_r("<td>Administrador</td>");
	   	}
	    print_r("
	    	<td>
	    		<a class='btn btn-primary btn-lg btn-block' data-registro='".$fila[1]."'>Editar</a>
	    	</td>");
	   	print_r("
	    	<td>
	    		<a id='BotonEliminar' class='btn btn-primary btn-lg btn-block' href='php/eliminar.php?email=".$fila[1]."'>X</a>
	    	</td>");

	    print_r("</tr>");
	    //$_SESSION['i']+=1;
    }

    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
    mysqli_free_result($resultadoPaginacion);

}

?>