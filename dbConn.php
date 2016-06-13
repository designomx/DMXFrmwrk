<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
header('Content-Type: text/html; charset=UTF-8'); 

$hostname = "localhost";
$database = "db600436593UTF8";
$username = "dbo600436593";
$password = "20eligefacil15#";
$dbConn = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES 'utf8'");


?>