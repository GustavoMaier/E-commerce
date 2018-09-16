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
<title>Pesquisa de Produtos</title>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida)
            documento.value += texto.substring(0,1);
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
<script language="Javascript">
function confirmacao(id) {
	var resposta = confirm("Deseja remover esse produto?");   
	if (resposta == true) { window.location.href = "excluindoproduto.php?id="+id} } 
</script> 
</head>
<body>
	<center>
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

		<center><table width="1150" border="1" >
			<tr>
				<td width="20"><center><b>Imagem</b></center></td>
				<td width="220"><center><b>Nome</b></center></td>
				<td width="150"><center><b>Autor</b></center></td>
				<td width="120"><center><b>Editora</b></center></td>
				<td width="80"><center><b>Genero</b></center></td>
				<td width="60"><center><b>Preço</b></center></td>
				<td width="25"><center><b>Quantidade</b></center></td>
				<?php if ($cargo == 1){ ?>
				<td width="25"><center><b>Editar</b></center></td>
				<?php }?>
				<td width="30"><center><b>Comprar</b></center></td>
			</tr>
			<?php 
				$sql = mysql_query("SELECT * FROM ecommerce.produto ORDER BY nome ");
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
				<td width="220"><center><?php echo $nome ?></center></td>
				<td width="150"><center><?php echo $autor ?></center></td>
				<td width="120"><center><?php echo $editora ?></center></td>
				<td width="80"><center><?php echo $genero ?></center></td>
				<td width="60"><center><?php echo 'R$ '.number_format($preco, 2, ',', '.').''; ?></center></td>
				<td width="25"><center><?php echo $quantidade ?></center></td>
				<?php if ($cargo == 1){?>
				<td width="30" align="center"><a href="alterarproduto.php?id=<?php echo $id ?>" ><img src="Imagens/edit.png" title="Editar" width="30" height="30"/></a></td>
				<?php } ?>
				<td width="30" align="center"><a href="carrinho.php?acao=add&id=<?php echo $id?>"><img src="Imagens/add.png" title="Comprar" width="60" height="60"/></a></td>
			</tr>
			<?php 
					}
			}
			?>
		
		</table></center><br/>
	
	
</body>
</html>