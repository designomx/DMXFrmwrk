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
	$rowsPerPage = 20;
	//Iniciamos en pagina 1
	$pageNum= 1;
	//$_SESSION['pageNum']=1;
	//Comprobamos si están solicitando un número de página en especial 
	if(isset($_GET['page'])) {
        sleep(1);
        $pageNum = $_GET['page'];
        //$_SESSION['pageNum'] = $_GET['page'];
        //echo "alert(".$_SESSION['pageNum'].")";
    }

    $offset = ($pageNum - 1) * $rowsPerPage;
    $total_paginas = ceil($num_row / $rowsPerPage);
    //$_SESSION['total_paginas']= ceil($num_row / $rowsPerPage);

    /* obtener el array asociativo */
    $consultaPaginacion = "SELECT nombre, email, usuario_admin, edad, sexo FROM usuarios ORDER by nombre ASC LIMIT ".$offset.", ".$rowsPerPage."";
    $resultadoPaginacion = mysqli_query($dbConn, $consultaPaginacion);
    //$i=1;
    echo("<br /><br /><br />");
    echo("	<div class='table-responsive' id='lista_usuarios'>");
	echo("        <table class='table table-hover'>");
	echo("              <thead>");
	echo("                <tr>");
	echo("                  <!-- <th>#</th> -->");
	echo("                  <th>Nombre</th>");
	echo("                  <th>Sexo</th>");
	echo("                  <th>Edad</th>");
	echo("                  <th>Email</th>");
	echo("                  <th>Tipo de Usuario</th>");
	echo("                  <th></th>");
	echo("                  <th></th>");
	echo("                </tr>");
	echo("              </thead>");
	echo("			<tbody id='tabla_usuarios'>");
    while ($fila = mysqli_fetch_row($resultadoPaginacion)) {
		echo("				<tr>");
	    //echo("<td>".$i."</td>");
	   	echo("					<td>".$fila[0]."</td>");
	    echo("					<td><img src='img/avatar_".$fila[4].".png' alt='user' width='70' class='img-circle' alt='Responsive image'></td>");
	    echo("					<td>".$fila[3]."</td>");
	    echo("					<td>".$fila[1]."</td>");
	    if($fila[4]==0){
			echo("				<td>Usuario</td>");
	    }else{
	   		echo("				<td>Administrador</td>");
	   	}
	    echo("
	    							<td>
	    								<a class='btn btn-primary btn-lg btn-block' data-registro='".$fila[1]."'>Editar</a>
	    							</td>");
	   	echo("
							    	<td>
							    		<a id='BotonEliminar' class='btn btn-primary btn-lg btn-block' href='php/eliminar.php?email=".$fila[1]."'>X</a>
							    	</td>");
	    echo("				</tr>");

	}    
    echo("			</tbody>");
    echo("        </table>");
    echo("   </div><!--table-responsive-->");
    //$_SESSION['i']+=1;
    mysqli_free_result($resultado);
    mysqli_free_result($resultadoPaginacion);

	echo("	<center>");
	echo("		<div class='pagination' id='pagination'>");
    if ($total_paginas > 1) {
					    echo '<ul>';
					    if ($pageNum != 1){
					        echo '<li class="previous"><a data-id="'.($pageNum-1).'" class="fui-arrow-left"></a></li>';
					    }
				        for ($i=1;$i<=$total_paginas;$i++) {
				            if ($pageNum == $i){
				                //si muestro el índice de la página actual, no coloco enlace
				                echo '<li class="active"><a>'.$i.'</a></li>';
				            }else{
				                //si el índice no corresponde con la página mostrada actualmente,
				                //coloco el enlace para ir a esa página
				                echo '<li><a data-id="'.$i.'">'.$i.'</a></li>';
				            }
				         }
				         if ($pageNum != $total_paginas){
				             echo '<li class="next"><a data-id="'.($pageNum+1).'" class="fui-arrow-right"></a></li>';
				         }
				         echo '</ul>';
					}
					

		echo(	"</div><!--pagination-->");
		echo("	</center>");
}

?>