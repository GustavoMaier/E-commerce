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

if ($cargo == 0){
	include "menu2.php";
	}
	else {
		include "menu.php";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<style>
html {
	background-image: url("Imagens/bg4.jpg");
	background-repeat: no-repeat;
	background-attachment: fixed;
}
h2 {
	color: white;
}
form {
	color: white;
	font-size: 17px;
}
body{
color:white;
}
table a{
color:black;
text-decoration:none;
}
</style>
<script language="Javascript">
function confirmacao(id) {
	var resposta = confirm("Deseja remover esse cliente?");   
	if (resposta == true) { window.location.href = "excluindo.php?id="+id} } 
</script> 
<meta/>
<title>Resultados de Pesquisa</title>
</head>

<body><center>
		<h2>
			<b> Pesquisa de Usuários</b>
		</h2>
	</center>
	</br>
	</br>
	
	<center><form name="search_form" method="post" action="results.php">
		Nome: <input type="text" size=60px name="buscarnome" /> 
		CPF: <input	type="text" size=40px name="buscarcpf" id="cpf" maxlength="14" onkeypress="return SomenteNumero(event)" onkeyup="formatar('###.###.###-##', this)" /> <br></br>
		Email: <input type="text" size=60px name="buscaremail" /> 
		Telefone: <input type="text" size=35px name="buscartelefone" maxlength="12"	onkeypress="return SomenteNumero(event)" onkeyup="formatar('## ####-####', this)" /> <br></br>
		Login: <input type="text" size=40px name="buscarlogin" maxlength="15"/> 
		Senha: <input type="text" size=30px name="buscarsenha" maxlength="15"/> 
		Nível: <input type="text" size=10px name="buscarnivel" maxlength="1"/><br/><br/>
		Endereço: <input type="text" size=60px name="buscarendereco" /><br/><br/><br/>
		<a><input type="submit" value="Pesquisar" id=button /> <input type="reset" value="Limpar"/></a>
	</form><br /></center></center><br />

		<center><table width="1200" border="1" >
			<tr>
				<td width="20"><center><b>ID</b></center></td>
				<td width="150"><center><b>Nome</b></center></td>
				<td width="100"><center><b>CPF</b></center></td>
				<td width="170"><center><b>Email</b></center></td>
				<td width="110"><center><b>Telefone</b></center></td>
				<td width="80"><center><b>Login</b></center></td>
				<td width="50"><center><b>Senha</b></center></td>
				<td width="50"><center><b>Nível</b></center></td>
				<td width="110"><center><b>Endereço</b></center></td>
				<td width="40"><center><b>Editar</b></center></td>
				<td width="30"><center><b>Remover</b></center></td>
			</tr>
<?php
	$buscarnome =$_POST['buscarnome'];
	$buscarcpf =$_POST['buscarcpf'];
	$buscaremail =$_POST['buscaremail'];
	$buscartelefone =$_POST['buscartelefone'];
	$buscarlogin =$_POST['buscarlogin'];
	$buscarsenha =$_POST['buscarsenha'];
	$buscarnivel =$_POST['buscarnivel'];
	$buscarendereco =$_POST['buscarendereco'];
	$sql = mysql_query("SELECT * FROM ecommerce.usuarios WHERE nome LIKE '%".$buscarnome."%'AND cpf LIKE '%".$buscarcpf."%' AND email LIKE '%".$buscaremail."%' AND telefone LIKE '%".$buscartelefone."%' AND login LIKE'%".$buscarlogin."%' and senha LIKE'%".$buscarsenha."%' and cargo LIKE'%".$buscarnivel."%'AND endereco LIKE'%".$buscarendereco."%' ");
	$row = mysql_num_rows($sql);
	
	if ($row >0){
		while ($linha = mysql_fetch_array($sql))	{
			$id = $linha ['id'];
			$nome = $linha ['nome'];
			$cpf = $linha ['cpf'];
			$email = $linha ['email'];
			$telefone = $linha ['telefone'];
			$login = $linha ['login'];
			$senha = $linha ['senha'];
			$cargo = $linha ['cargo'];
			$endereco = $linha ['endereco'];

?>
			
			<tr>
				<td width="20"><?php echo $id ?></td>
				<td width="150"><?php echo $nome ?></td>
				<td width="100"><?php echo $cpf ?></td>
				<td width="170"><?php echo $email ?></td>
				<td width="80"><?php echo $telefone ?></td>
				<td width="60"><?php echo $login ?></td>
				<td width="50"><?php echo $senha ?></td>
				<td width="50"><?php echo $cargo ?></td>
				<td width="110"><?php echo $endereco ?></td>
				<td width="30" align="center"><a href="alterar.php?id=<?php echo $id ?>" ><img src="Imagens/edit.png" title="Editar" width="30" height="30"/></a></td>
				<td width="30" align="center"><a href="javascript:func()" onclick="confirmacao(<?php echo $id ?>)" ><img src="Imagens/trash.png" title="Excluir" width="35" height="35"/></a></td>
			</tr>
			<?php 
						}
	}else{
	echo '<script>alert("Desculpe, nenhum usuário foi encontrado com essas características!");</script>';
	echo '<meta http-equiv="refresh" content="0; url=pesquisa.php">';
}
			?>
		</table></center><br/>
</p>
</body>

</html>
<?php }
?>