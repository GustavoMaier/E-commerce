<?php
$host = "us-cdbr-iron-east-01.cleardb.net";
$user = "b27e60e2fd0f83";
$pass = "cd549ecd";
$banco = "ad_d5175bc9b657c47";
$conexao = mysql_connect ( $host, $user, $pass ) or die ( mysql_error () );
mysql_select_db ( $banco ) or die ( mysql_error () );
?>
