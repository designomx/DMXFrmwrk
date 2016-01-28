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

        <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed 
    <script src="../dist/js/vendor/video.js"></script>-->
    <script src="js/flat-ui.min.js"></script>
    <script src="js/application.js"></script>
    <script src="js/benjaminpalacios.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
  <?php 
  if(isset($_SESSION['tipo_usuario'])){
    if($_SESSION['tipo_usuario']=="1"){
  	echo '<!-- Static navbar -->
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  	  <div class="container">
  	    <div class="navbar-header">
  	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  	        <span class="sr-only">Toggle navigation</span>
  	      </button>
  	      <a class="navbar-brand" href="#">Benjamin Palacios</a>
          <small>Hola,'.$_SESSION["user"].'</small>
  	    </div>
  	    <div class="navbar-collapse collapse">
  	      <ul class="nav navbar-nav navbar-right">
            <li><a href="registerADMIN.php">Registrar Nuevo Usuario</a></li>
            <li><a href="listado.php">Lista de Usuarios</a></li>
            <li><a href="php/cerrar_sesion.php">Salir</a></li>
  	      </ul>
  	    </div><!--/.nav-collapse -->
  	  </div>
  	</div>
    ';
    }
  }
    ?>
