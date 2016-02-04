<?php
header("Access-Control-Allow-Origin: *");
require "dbConn.php"; 

//Variables del formulario de Registro
$email=$_GET['email'];

$queryEliminar="DELETE FROM usuarios WHERE email ='".$email."'";

if (mysqli_query($dbConn, $queryEliminar)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

$dbConn=null;

?>