<?php
include 'conexao.php';

$id = $_GET['id'];
$nome = $_POST ['nome'];
$autor = $_POST ['autor'];
$editora = $_POST ['editora'];
$genero = $_POST ['genero'];
$preco = $_POST ['preco'];
$quantidade = $_POST ['quantidade'];
$imagem = $_POST ['imagem'];

	$sql = mysql_query("UPDATE ecommerce.produto SET nome = '$nome', autor = '$autor', editora = '$editora', genero = '$genero', preco = '$preco', quantidade = '$quantidade', imagem = '$imagem' WHERE id = '$id'");
	header('Location:pesquisaproduto.php');
?>