<?php
include 'conexao.php';

$id = $_GET['id'];
$nome = $_POST ['nome'];
$autor = $_POST ['autor'];
$editora = $_POST ['editora'];
$genero = $_POST ['genero'];
$codigo = $_POST ['codigo'];
$preco = $_POST ['preco'];
$quantidade = $_POST ['quantidade'];

$sql = mysql_query("DELETE FROM ecommerce.produto WHERE id = '$id'");
header('Location:pesquisaproduto.php');
?>