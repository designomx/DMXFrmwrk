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
      colores amarillo: F2E000
      color amarillo hoover, active, etc: #FFF042
    <![endif]-->
  </head>
  <body>

    <div class="container">
    	<br /><br /><br />
        
		<div class="login-form" style="width: 300px; margin: 0 auto;">
			<h6 style="text-align: center;"><strong>Benjamin Palacios</strong></h6>
			<br />
            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="Usuario" id="login-name">
              <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control login-field" value="" placeholder="Password" id="login-pass">
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            
            <div class="text-center terminos">
            <label >
              <input id="AceptaTerminos" type="checkbox" value="1" required>
              Acepto Términos y Condiciones
            </label>
          </div>

            <a class="btn btn-primary btn-lg btn-block" id="BotonLogin">Entrar</a>
            <a class="btn btn-primary btn-lg btn-block" href="register.php">Registrar</a>

        </div>
        
    </div>
    <!-- /.container -->

    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed 
    <script src="../dist/js/vendor/video.js"></script>-->
    <script src="js/flat-ui.min.js"></script>
    <script src="js/application.js"></script>
    <script src="js/benjaminpalacios.js"></script>


  </body>
</html>
