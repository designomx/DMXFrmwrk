<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Benjamin Palacios | Admin v1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="#">Benjamin Palacios</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="register.html">Registrar Nuevo Usuario</a></li>
            <li><a href="select.html">Lista de Usuarios</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<?php
require "php/dbConn.php";
$consulta = "SELECT nombre, email, usuario_admin, edad, sexo, password FROM usuarios WHERE email='".$_GET['email']."'";

if ($resultado = mysqli_query($dbConn, $consulta)) {
  $fila = mysqli_fetch_row($resultado);
  $nombre=$fila[0];
  $email=$fila[1];
  $usuario_admin=$fila[2];
  $edad=$fila[3];
  $sexo=$fila[4];
  $password=md5($fila[5]);
}
else{
  echo "<script> alert('no entra')</script>";
}


?>
 <div class="container">
      <br /><br /><br />

        <form class="form-horizontal" role="form" id="FormularioRegistro">
          <div class="login-form" style="width: 300px; margin: 0 auto;">
          <h6 style="text-align: center;"><strong>Benjamin Palacios</strong></h6>
          <br />
            <div class="row">
              <div class="col-xs-8 col-sm-8 col-md-16">
                <div class="form-group">
                  <input type="text" name="first_name" id="nombre" class="form-control input-sm fui-user" placeholder="Nombre Completo"
                  value="<?php echo $nombre;?>">
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-16">
                <div class="form-group">
                  <input type="number" name="edad" id="edad" class="form-control input-sm" placeholder="Edad" value="<?php echo $edad;?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" value="<?php echo $email;?>">
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
                        <label class="btn btn-default <?php if($sexo==1){ echo "active";} ?>">
                            <input type="radio" name="gender" value="male"/> Male
                        </label>
                        <label class="btn btn-default <?php if($sexo==0){ echo "active";} ?>">
                            <input type="radio" name="gender" value="female"/> Female
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
                      <input id="usuario_admin" type="checkbox" value="1"  <?php if($usuario_admin==1){ echo "checked";} ?> >
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" value="<?php echo $password;?>">
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirmar Password"  value="<?php echo $password;?>">
                </div>
              </div>
            </div>
            
            <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
          </div>  
              </form>
        
    </div>
    <!-- /.container -->
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