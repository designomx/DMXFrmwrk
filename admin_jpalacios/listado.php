<?php 
include "php/control.php";
include "head.php";
?>
    <div class="container">
    	<br /><br /><br />
    	<div class="table-responsive" id="lista_usuarios">
	        <table class="table table-hover">
	              <thead>
	                <tr>
	                  <!-- <th>#</th> -->
	                  <th>Nombre</th>
	                  <th>Sexo</th>
	                  <th>Edad</th>
	                  <th>Email</th>
	                  <th>Tipo de Usuario</th>
	                  <th></th>
	                  <th></th>
	                </tr>
	              </thead>
	              <tbody id="tabla_usuarios">
	                <!--
	                	php $_SESSION['i']=1;
	                	Por jQuery y ajax, llamo al archico BenjaminPalaciosADMIN.php, que carga los datos. (Puede hacerse directamente aca)
	                -->
	                <?php
	                	require "php/BenjaminPalaciosADMIN.php";
	                ?>
	              </tbody>
	            </table>
            </div><!--table-responsive-->
			<center>
				<div class="pagination" id="pagination">
				<?php
				
					if ($_SESSION['total_paginas'] > 1) {
					    echo '<ul>';
					    if ($_SESSION['pageNum'] != 1){
					        echo '<li class="previous"><a data="'.($_SESSION['pageNum']-1).'" class="fui-arrow-left"></a></li>';
					    }
				        for ($i=1;$i<=$_SESSION['total_paginas'];$i++) {
				            if ($_SESSION['pageNum'] == $i){
				                //si muestro el índice de la página actual, no coloco enlace
				                echo '<li class="active"><a>'.$i.'</a></li>';
				            }else{
				                //si el índice no corresponde con la página mostrada actualmente,
				                //coloco el enlace para ir a esa página
				                echo '<li><a data-id="'.$i.'">'.$i.'</a></li>';
				            }
				         }
				         if ($_SESSION['pageNum'] != $_SESSION['total_paginas']){
				             echo '<li class="next"><a data-id="'.($_SESSION['pageNum']+1).'" class="fui-arrow-right"></a></li>';
				         }
				         echo '</ul>';
					}
					
				?>
				<!--
				    <ul>
				      <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
				      <li class="active"><a href="#fakelink">1</a></li>
				      <li><a href="#fakelink">2</a></li>
				      <li><a href="#fakelink">3</a></li>
				      <li><a href="#fakelink">4</a></li>
				      <li><a href="#fakelink">5</a></li>
				      <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
				    </ul>
				-->
				</div><!--pagination-->
			</center>
    </div>
    <!-- /.container -->


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed 
    <script src="../dist/js/vendor/video.js"></script>-->
    <script src="js/flat-ui.min.js"></script>
    <script src="js/application.js"></script>
    <script src="js/benjaminpalaciosADMIN.js"></script>


  </body>
</html>
