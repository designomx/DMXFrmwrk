<?php
/*
Archivos PHP para el registro de usuario de la aplicacion de BenjaminPalacios
*/

require "dbConn.php"; 

$consulta = "SELECT nombre, email, usuario_admin, edad, sexo FROM usuarios ORDER by nombre";

if ($resultado = mysqli_query($dbConn, $consulta)) {

    /* obtener el array asociativo */
    $i=1;
    while ($fila = mysqli_fetch_row($resultado)) {
		print_r("<tr>");
	    print_r("<td>".$i."</td>");
	    print_r("<td><img src='img/avatar_".$fila[4].".png' alt='user' width='70' class='img-circle' alt='Responsive image'></td>");
	    print_r("<td>".$fila[0]."</td>");
	    print_r("<td>".$fila[3]."</td>");
	    print_r("<td>".$fila[1]."</td>");
	    if($fila[4]==0){
			print_r("<td>Usuario</td>");
	    }else{
	   		print_r("<td>Administrador</td>");
	   	}
	    print_r("
	    	<td>
	    		<a class='btn btn-primary btn-lg btn-block' href='editar.php?email=".$fila[1]."'>Editar</a>
	    	</td>");
	   	print_r("
	    	<td>
	    		<a class='btn btn-primary btn-lg btn-block' href='eliminar.php?email=".$fila[1]."'>Eliminar</a>
	    	</td>");

	    print_r("</tr>");
	    $i+=1;
    }

    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}

?>