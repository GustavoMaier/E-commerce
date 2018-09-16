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

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM ecommerce.produto WHERE id ='$id' ");
$linha = mysql_fetch_array($sql);
$imagem = $linha['imagem'];
$nome = $linha ['nome'];
$autor = $linha ['autor'];
$editora = $linha ['editora'];
$genero = $linha ['genero'];
$preco = $linha ['preco'];
$quantidade = $linha ['quantidade'];


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
table a{
color:black;
text-decoration:none;
}
</style>
<title>Alteração de Produtos</title>
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
	<center>
		<h2>
			<b> Alteração de Produtos</b>
		</h2>
	</center>
	</br>
	</br>
	
	<center><form name"signup" method="post" action="alterandoproduto.php?id=<?php echo $id ?>">

		Nome: <input type="text" size=60px name="nome" value="<?php echo $nome ?>" />
		Autor: <input type="text" size=40px name="autor" value="<?php echo $autor ?>"/><br></br>
		Editora: <td><input type="text" size=40px name="editora" value="<?php echo $editora ?>" />	
		Genero: <input type="text" size=40px name="genero" value="<?php echo $genero ?>" /><br></br>
		Imagem: <input type="text" size=50px name="imagem" value="<?php echo $imagem ?>" />
		Preço: <input type="text" size=15px name="preco" id="preco" maxlength="8" value="<?php echo $preco ?>" onkeyup="moeda(this)"/>
		Quantidade: <input type="text" size=10px name="quantidade" id="quantidade" value="<?php echo $quantidade ?>" maxlength="4" onkeypress="return SomenteNumero(event)" /><br></br> 
		
		<a><input type="submit" value="Alterar" />  <input type="reset" value="Limpar" /></a>

	</form></center><br/><br />
	
		<center><table width="1150" border="1" >
			<tr>
				<td width="20"><center><b>Imagem</b></center></td>
				<td width="220"><center><b>Nome</b></center></td>
				<td width="150"><center><b>Autor</b></center></td>
				<td width="120"><center><b>Editora</b></center></td>
				<td width="80"><center><b>Genero</b></center></td>
				<td width="60"><center><b>Preço</b></center></td>
				<td width="25"><center><b>Quantidade</b></center></td>
				<td width="30"><center><b>Editar</b></center></td>
				<td width="30"><center><b>Excluir</b></center></td>
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
				<td width="30" align="center"><a href="alterarproduto.php?id=<?php echo $id ?>" ><img src="Imagens/edit.png" title="Editar" width="30" height="30"/></a></td>
				<td width="30" align="center"><a href="javascript:func()" onclick="confirmacao(<?php echo $id ?>)" ><img src="Imagens/trash.png" title="Excluir" width="35" height="35"/></a></td>
			</tr>
			<?php 
				}
			?>
		</table></center><br/>
	
	
</body>
</html>
<?php }else {
		echo '<meta http-equiv="refresh" content="0; url=logoff.php">';
}}
?>