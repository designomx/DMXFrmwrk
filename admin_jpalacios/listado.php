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
	                  <th>#</th>
	                  <th>Sexo</th>
	                  <th>Nombre</th>
	                  <th>Edad</th>
	                  <th>Email</th>
	                  <th>Tipo de Usuario</th>
	                  <th></th>
	                  <th></th>
	                </tr>
	              </thead>
	              <tbody id="tabla_usuarios">
	                <!--
	                	Por jQuery y ajax, llamo al archico BenjaminPalaciosADMIN.php, que carga los datos. (Puede hacerse directamente aca)
	                -->
	              </tbody>
	            </table>
            </div><!--table-responsive-->
            <button type="button" class="btn btn-primary btn-lg btn-block">Aplicar</button>
			<center>
				<div class="pagination">
				    <ul>
				      <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
				      <li class="active"><a href="#fakelink">1</a></li>
				      <li><a href="#fakelink">2</a></li>
				      <li><a href="#fakelink">3</a></li>
				      <li><a href="#fakelink">4</a></li>
				      <li><a href="#fakelink">5</a></li>
				      <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
				    </ul>
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
