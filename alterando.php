<?php
include 'conexao.php';

$id = $_GET['id'];
$nome = $_POST ['nome'];
$cpf = $_POST ['cpf'];
$email = $_POST ['email'];
$telefone = $_POST ['telefone'];
$login = $_POST ['login'];
$senha = $_POST ['senha'];
$nivel = $_POST ['nivel'];
$endereco = $_POST ['endereco'];

	$sql = mysql_query("UPDATE ecommerce.usuarios SET nome = '$nome', cpf = '$cpf', email = '$email', telefone = '$telefone', login = '$login', senha = '$senha', cargo = '$nivel', endereco = '$endereco' WHERE id = '$id'");
	header('Location:pesquisa.php');
?>