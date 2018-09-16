<html>
<head>
<style>
html {
	background-image: url("Imagens/bg4.jpg");
}
body{
font-size: 20px;
margin-top:20%;
color:white;
}
</style>
<title>Login</title>
</head>
<body>
	<center>
		<form action="log.php" method="post">
			Login: <br><input type="text" name="hue5" id="hue" size="35px" /><br><br>
			Senha: <br><input type="password" name="hu4" id="hue2" size="35px" /><br><br>
			<input type="submit" value="Entrar" width="60px"/>
		</form>
	</center>
	<br><br><br><br><br><br><br><br><br><br>
</body>
</html>
<?PHP
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];
 
//Conexão mysql
$host = "localhost";
$user = "root";
$pass = "";
$banco = "ecommerce";
$conexao = mysql_connect ( $host, $user, $pass ) or die ( mysql_error () );
mysql_select_db ( $banco ) or die ( mysql_error () );
 
//Comando SQL de verificação de autenticação
$sql = "SELECT *FROM ecommerce.usuarios WHERE login = '$login' AND senha = '$senha'";
$resultado = mysql_query($sql,$conexao) or die ("Usuário incorreto");
if (mysql_num_rows ($resultado) > 0) {
	$qr    = mysql_query($sql) or die(mysql_error());
	$ln    = mysql_fetch_assoc($qr);
	$cargo = $ln['cargo'];
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    $_SESSION['cargo'] = $cargo;
    header('location:pesquisaproduto.php');
}
else {
	echo '<meta http-equiv="refresh" content="0; url=index.php">';
	echo '<script>alert("Login Invalido");</script>';
    session_destroy();
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    unset ($_SESSION['cargo']);
}
?>
