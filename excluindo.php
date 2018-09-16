<?php
include 'conexao.php';

$id = $_GET['id'];
$nome = $_POST ['nome'];
$cpf = $_POST ['cpf'];
$email = $_POST ['email'];
$telefone = $_POST ['telefone'];
$login = $_POST ['login'];
$senha = $_POST ['senha'];
$endereco = $_POST ['endereco'];

$sql = mysql_query("DELETE FROM ecommerce.usuarios WHERE id = '$id'");
header('Location:pesquisa.php');
?>