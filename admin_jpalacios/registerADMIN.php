<?php
  include "php/control.php";
  include "head.php";
?>
    <div class="container">
    	<br /><br /><br />

        <form class="form-horizontal" role="form" id="FormularioRegistroADMIN">
          <div class="login-form" style="width: 300px; margin: 0 auto;">
          <h6 style="text-align: center;"><strong>Registrar nuevo usuario</strong></h6>
          <br />
            <div class="row">
              <div class="col-xs-8 col-sm-8 col-md-16">
                <div class="form-group">
                  <input type="text" name="first_name" id="nombre" class="form-control input-sm fui-user" placeholder="Nombre Completo" required>
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-16">
                <div class="form-group">
                  <input type="number" name="last_name" id="edad" class="form-control input-sm" placeholder="Edad" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" required>
            </div>
            <!-- Para confirmar correo
            <div class="form-group">
              <input type="email" name="email" id="email_confirmation" class="form-control input-sm" placeholder="Confirmar Email">
            </div>
            -->
            <div class="row">
              <div class="form-group">
                <label class="col-xs-3 control-label">Genero</label>
                <div class="col-xs-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="sexo" value="1" /> Masculino
                        </label>
                        <label class="btn btn-default active">
                            <input type="radio" name="sexo" value="0"/> Femenino
                        </label>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <label class="col-xs-3 control-label">Administrador</label>
                <div class="col-xs-9">
                   <div class="checkbox">
                    <label>
                      <input id="usuario_admin" type="checkbox" value="1">
                    </label>
                  </div>
                </div>              
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <label class="col-xs-3 control-label">Autorizado</label>
                <div class="col-xs-9">
                   <div class="checkbox">
                    <label>
                      <input id="autorizado" type="checkbox" value="1" checked>
                    </label>
                  </div>
                </div>              
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirmar Password" required>
                </div>
              </div>
            </div>
            
            <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
            <a id='BotonCancelar' class='btn btn-primary btn-lg btn-block fui-cross' href="listado.php">Cancelar</a>
          </div>  
              </form>
        
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
