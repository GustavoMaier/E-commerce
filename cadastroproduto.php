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

if ($cargo == 1){
	include "menu.php";
	
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
<title>Cadastro de Produtos</title>
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
<script>
	function moeda(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas números
	v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
	v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")	//coloca virgula antes dos últimos 2 digitos
		z.value = v;
	}
</script>
</head>
<body>
	<center><h2><b> Cadastro de Produtos</b></h2></center><br></br>
	
	<center><form name"signup" method="post" action="cadastrandoproduto.php">


		Nome: <input type="text" size=60px name="nome" />
		Autor: <input type="text" size=40px name="autor" /><br><br>
		Editora: <input type="text" size=40px name="editora" />
		Genero: <input type="text" size=40px name="genero" /><br><br>
		Imagem: <input type="text" size=50px name="imagem" />
		Preço: <input type="text" size=15px name="preco" id="preco" maxlength="8" onkeypress="return SomenteNumero(event)" onkeyup="moeda(this)"/>
		Quantidade: <input type="text" size=10px name="quantidade" id="quantidade" maxlength="4" onkeypress="return SomenteNumero(event)" /><br></br> 

		<a><input type="submit" value="Cadastrar" />  <input type="reset" value="Limpar" /></a>

	</form></center>


</body>
</html>
<?php }else {
		echo '<meta http-equiv="refresh" content="0; url=logoff.php">';
}}
?>