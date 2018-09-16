<?php 
session_start();
if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) ) {

	session_destroy();
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	header('location:index.php');
}

$logado = $_SESSION['login'];

include 'menu.php';
?>
<html>
<head>
<style>
html{
background-image: url("Imagens/bg4.jpg");
background-repeat: no-repeat;
background-attachment: fixed;
}
body{
color: white;
font-size: 17px;
}
</style>
<title>Cadastrando ...</title>
</head>
<body>

<?php
include 'conexao.php';

$nome = $_POST ['nome'];
$autor = $_POST ['autor'];
$editora = $_POST ['editora'];
$genero = $_POST ['genero'];
$preco = $_POST ['preco'];
$quantidade = $_POST ['quantidade'];
$imagem = $_POST ['imagem'];
	
	if ($nome==null ||$autor==null ||$editora==null ||$genero==null || $preco==null || $quantidade==null|| $imagem==null){
		echo '<script>alert("Preencha todos os campos");</script>';
		echo '<meta http-equiv="refresh" content="0; url=cadastroproduto.php">';
	}else {
		$teste = mysql_query("SELECT * FROM ecommerce.produto WHERE nome = '".$nome."'");
		$row = mysql_num_rows($teste);
	if ($row >0){
		echo '<script>alert("Produto já cadastrado, por favor insira outro produto!");</script>';
		echo '<meta http-equiv="refresh" content="0; url=cadastroproduto.php">';
	}else{
		$sql = mysql_query("INSERT INTO ecommerce.produto (nome, autor, editora, genero, preco, quantidade, imagem)
		VALUES ('$nome', '$autor', '$editora','$genero','$preco', '$quantidade','$imagem')");
		echo '<script>alert("Cadastro concluido com sucesso!");</script>';
		echo '<meta http-equiv="refresh" content="0; url=cadastroproduto.php">';
}
}	


?>

</body>
</html>