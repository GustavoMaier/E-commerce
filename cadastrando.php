<?php 
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
$host = "localhost";
$user = "root";
$pass = "";
$banco = "ecommerce";
$conexao = mysql_connect ( $host, $user, $pass ) or die ( mysql_error () );
mysql_select_db ( $banco ) or die ( mysql_error () );
?>

<?php
$login = $_POST ['login'];
$senha = $_POST ['senha'];
$nome = $_POST ['nome'];
$cpf = $_POST ['cpf'];
$email = $_POST ['email'];
$telefone = $_POST ['telefone'];
$endereco = $_POST ['endereco'];
	
	if ($login==null || $senha==null || $nome==null ||$cpf==null ||$email==null ||$telefone==null||$endereco==null){
		echo '<script>alert("Preencha todos os campos");</script>';
		echo '<meta http-equiv="refresh" content="0; url=cadastro.php">';
	}else {
		$teste = mysql_query("SELECT * FROM ecommerce.usuarios WHERE cpf = '".$cpf."'");
		$row = mysql_num_rows($teste);
	if ($row >0){
		echo "<br>";
		echo '<script>alert("CPF já cadastrado, por favor insira outro CPF");</script>';
		echo '<meta http-equiv="refresh" content="0; url=cadastro.php">';
	}else{
		$sql = mysql_query("INSERT INTO ecommerce.usuarios (login, senha, cargo, nome, cpf, email, telefone, endereco)
		VALUES ('$login','$senha','0', '$nome', '$cpf', '$email','$telefone', '$endereco')");
		echo "<br>";
		echo ('<script>alert("Cadastro Concluído com sucesso!");</script>');
		echo '<meta http-equiv="refresh" content="0; url=cadastro.php">';
}
}	


?>

</body>
</html>