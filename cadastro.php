<?php
include "conexao.php";
error_reporting(null);

session_start();

	$cargo = $_SESSION['cargo'];

	if ($cargo == 1){
		include "menu.php";
	}else{
		echo '<br></br><center><a href="index.php" style="color: white; font-size: 17px;">Voltar</a></center>';
	}
?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style >
html{
background-image: url("Imagens/bg4.jpg");
background-repeat: no-repeat;
background-attachment: fixed;
}
h2{
color: white; 
}
form{
color: white;
font-size: 17px;
}
</style>
<title>Cadastro de Usuários</title>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>
</head>
<body>
	<center><h2><b> Cadastro de Usuários</b></h2></center><br></br>
	
	<center><form name"signup" method="post" action="cadastrando.php">


		
		Nome: <input type="text" size=60px name="nome" />
		CPF: <input type="text" size=40px name="cpf" id="cpf" maxlength="14" onkeypress="return SomenteNumero(event)" onkeyup="formatar('###.###.###-##', this)"/><br></br>
		Email: <td><input type="text" size=60px name="email" />	
		Telefone: <input type="text" size=35px name="telefone" id="telefone" maxlength="12" onkeypress="return SomenteNumero(event)" onkeyup="formatar('## ####-####', this)" /><br></br>
		Login: <input type="text" size=40px name="login" />
		Senha: <input type="password" size=30px name="senha" /><br></br>
		Endereço: <td><input type="text" size=60px name="endereco" /><br></br><br> 	
		<a><input type="submit" value="Cadastrar" />  <input type="reset" value="Limpar" /></a>

	</form></center>


</body>
</html>
