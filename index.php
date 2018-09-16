<?php
?>
<html>
<head>
<style>
html {
	background-image: url("Imagens/bg4.jpg");
	background-repeat: no-repeat;
	background-attachment: fixed;
}
body{
font-size: 20px;
margin-top:20%;
color:white;
}
</style>
<link rel="shortcut icon" href="Imagens/box.png" /> 
<title>Login</title>
</head>
<body>
	<center>
		<form action="log.php" method="post">
			Login: <br><input type="text" name="login" id="login" size="35px" /><br><br>
			Senha: <br><input type="password" name="senha" id="senha" size="35px" /><br><br>
			<input type="submit" value="Entrar" width="60px"/>
		</form><br>
		<a href="cadastro.php" style="color:white; font-size:17px;" >Registrar-se</a>
	</center>
</body>
</html>