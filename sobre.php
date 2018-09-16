<?php
include "conexao.php";

session_start();
if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) ) {

	session_destroy();
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	unset ($_SESSION['cargo']);
	header('location:index.php');
}else {
$logado = $_SESSION['login'];
$cargo = $_SESSION['cargo'];

if ($cargo == 0){
	include "menu2.php";
	}
	else {
		include "menu.php";
	}
?>
<html>
<head>
<style>
html {
	background-image: url("Imagens/bg4.jpg");
	background-attachment: fixed;
}
h2 {
	color: white;
}
form {
	color: white;
	font-size: 17px;
}
body{
color:white;
}
table a{
color:black;
text-decoration:none;
}
</style>
<title>Sobre</title>
<link href="style.css" rel="stylesheet"  type="text/css"/>
</head>
<body>
	<center><h1>Sobre</h1></center><br>
	<center>
	E-commerce atualmente encontra-se na versão 4.3.0 com<br>
	todos direitos reservados aos desenvolvedores.<br><br>
	Trabalhamos em conjunto e com seriedade para garantir aos usuários uma<br>
	melhor experiência	ao utilizarem nossos serviços<br><br>
	Desenvolvedor do Sistema: Gustavo Maier Knewitz
	
	</center>

</body>
</html>
<?php }
?>