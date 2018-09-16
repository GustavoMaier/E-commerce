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
	var resposta = confirm("Deseja remover esse produto?");   
	if (resposta == true) { window.location.href = "excluindoproduto.php?id="+id} } 
</script> 
<meta/>
<title>Resultados de Pesquisa</title>
</head>

<body><center>
		<h2>
			<b> Pesquisa de Produtos</b>
		</h2>
	</center>
	</br>
	</br>
	
	<center><form name="search_form" method="post" action="resultsproduto.php">
		Nome: <input type="text" size=60px name="buscarnome" /> 
		Autor: <input type="text" size=40px name="buscarautor" /><br><br>
		Editora: <input type="text" size=40px name="buscareditora" />
		Genero: <input type="text" size=40px name="buscargenero" /><br><br>
		<a><input type="submit" value="Pesquisar" id=button /> <input type="reset" value="Limpar"/></a>
	</form><br /></center></center><br />

		<center><table width="1200" border="1" >
			<tr>
				<td width="20"><center><b>Imagem</b></center></td>
				<td width="250"><center><b>Nome</b></center></td>
				<td width="150"><center><b>Autor</b></center></td>
				<td width="150"><center><b>Editora</b></center></td>
				<td width="100"><center><b>Genero</b></center></td>
				<td width="30"><center><b>Preço</b></center></td>
				<td width="30"><center><b>Quantidade</b></center></td>
				<td width="30"><center><b>Comprar</b></center></td>
			</tr>
<?php
	$buscarnome = $_POST['buscarnome'];
	$buscarautor = $_POST['buscarautor'];
	$buscareditora = $_POST['buscareditora'];
	$buscargenero = $_POST['buscargenero'];
	$sql = mysql_query("SELECT * FROM ecommerce.produto WHERE nome LIKE '%".$buscarnome."%'and autor like '%".$buscarautor."%' and editora like '%".$buscareditora."%' and genero like '%".$buscargenero."%' ");
	$row = mysql_num_rows($sql);
	
	if ($row >0){
		while ($linha = mysql_fetch_array($sql))	{
			$id = $linha ['id'];
			$imagem = $linha ['imagem'];
			$nome = $linha ['nome'];
			$autor = $linha ['autor'];
			$editora = $linha ['editora'];
			$genero = $linha ['genero'];
			$preco = $linha ['preco'];
			$quantidade = $linha ['quantidade'];

?>
			
			<tr>
				<td width="20" height="70"><center><img src="<?php echo "$imagem" ?>" title="Imagem" width="55" height="60"/></center></td>
				<td width="250"><?php echo "$nome" ?></td>
				<td width="150"><?php echo "$autor" ?></td>
				<td width="150"><?php echo "$editora" ?></td>
				<td width="110"><?php echo "$genero" ?></td>
				<td width="30"><?php echo "$preco" ?></td>
				<td width="30"><?php echo "$quantidade" ?></td>
				<td width="30" align="center"><a href="carrinho.php?acao=add&id=<?php echo $id?>"><img src="Imagens/add.png" title="Comprar" width="60" height="60"/></a></td>
				
				</tr>
			<?php 
						}
	}else{
	echo '<script>alert("Desculpe, nenhum produto foi encontrado com essas características!");</script>';
	echo '<meta http-equiv="refresh" content="0; url=pesquisaproduto.php">';
}
			?>
		</table></center><br/>
</p>
</body>

</html>
<?php }
?>