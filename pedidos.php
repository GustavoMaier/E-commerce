<?php
include "conexao.php";
error_reporting(null);

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
<title>Pedidos</title>
<script language="Javascript">
function confirmacao(idvenda) {
	var resposta = confirm("Deseja remover esse pedido?");   
	if (resposta == true) { window.location.href = "excluindopedido.php?idvenda="+idvenda} } 
</script> 
</head>
<body>
	<center>
		<h2>
			<b> Pedidos Feitos</b>
		</h2>
	</center>
	</br>
	</br>
		<center><table width="1100" border="1" >
			<tr>
				<td width="20"><center><b>Código do Pedido</b></center></td>
				<td width="220"><center><b>Produtos</b></center></td>
				<td width="60"><center><b>Preço Unitario</b></center></td>
				<td width="25"><center><b>Quantidade</b></center></td>
				<td width="50"><center><b>Total</b></center></td>
				<?php if ($cargo == 1){ ?>
				<td width="25"><center><b>Excluir</b></center></td>
				<?php }?>
			</tr>
			<?php 
			$desconto = 0;
			$total = 0;
			$sqlu = mysql_query("SELECT * FROM ecommerce.usuarios WHERE login = '".$logado."' ");
					$row = mysql_num_rows($sqlu);
					if ($row >0){
						while ($linha = mysql_fetch_array($sqlu))	{
							$idlogado = $linha ['id'];
					}
				
			if ($cargo == 0){
				$sql = mysql_query("SELECT * FROM ecommerce.pedidos WHERE idcliente = '$idlogado' ");
				while ($linha = mysql_fetch_array($sql))	{
						
					$idvenda = $linha ['idvenda'];
					
					$sqli = mysql_query("SELECT * FROM ecommerce.itenspedidos WHERE idvenda = '$idvenda'");
					while ($linhai = mysql_fetch_array($sqli))	{
							
						$idproduto = $linhai ['idproduto'];
						$quantidade = $linhai ['quantidade'];
						$preco = $linhai ['preco'];
						$total = $preco * $quantidade;
						
						$sqlf = mysql_query("SELECT * FROM ecommerce.pedidos WHERE idcliente = '$idlogado' AND formadepagamento = 'Boleto Bancário - 10% de Desconto' AND  idvenda = '$idvenda'");
						$rowf = mysql_num_rows($sqlf);
						if ($rowf >= 1){
							$desconto = ($total/100)*10 ;
						} else {
							$total = $preco * $quantidade;
							$desconto=0;
							$totall = $total;
						}
						$totall = $total - $desconto;
							
						$sqlp = mysql_query("SELECT * FROM ecommerce.produto WHERE id = '$idproduto'");
						while ($linhap = mysql_fetch_array($sqlp))	{
								
							$produto = $linhap ['nome'];
						}
						?>
									<tr>
										<td width="20"><center><?php echo $idvenda ?></center></td>
										<td width="220"><center><?php echo $produto ?></center></td>
										<td width="60"><center><?php echo 'R$ '.$preco ?></center></td>
										<td width="25"><center><?php echo $quantidade ?></center></td>
										<td width="50"><center><?php echo 'R$ '.$totall ?></center></td>
										<?php if ($cargo == 1){?>
										<td width="30" align="center"><a href="excluirpedido.php?id=<?php echo $idvenda ?>" ><img src="Imagens/trash.png" title="Excluir" width="30" height="30"/></a></td>
										<?php } ?>
									</tr>
									<?php 
									}
									?>
<?php 
					}
				}
			}if($cargo == 1) {
				$sql = mysql_query("SELECT * FROM ecommerce.pedidos ");
				while ($linha = mysql_fetch_array($sql))	{
					
					$idvenda = $linha ['idvenda'];
					$forma = $linha ['formadepagamento'];
			
				$sqli = mysql_query("SELECT * FROM ecommerce.itenspedidos WHERE idvenda = '$idvenda'");
				while ($linhai = mysql_fetch_array($sqli))	{
							
					$idproduto = $linhai ['idproduto'];
					$quantidade = $linhai ['quantidade'];
					$preco = $linhai ['preco'];
					$total = $preco * $quantidade;
					
					$sqlf = mysql_query("SELECT * FROM ecommerce.pedidos WHERE formadepagamento = 'Boleto Bancário - 10% de Desconto' AND  idvenda = '$idvenda'");
					$rowf = mysql_num_rows($sqlf);
					if ($rowf >= 1){
						$desconto = ($total/100)*10 ;
					} else {
						$total = $preco * $quantidade;
						$desconto=0;
						$totall = $total;
					}
					$totall = $total - $desconto;
			
				$sqlp = mysql_query("SELECT * FROM ecommerce.produto WHERE id = '$idproduto'");
				while ($linhap = mysql_fetch_array($sqlp))	{
							
					$produto = $linhap ['nome'];
				}
			?>
			<tr>
				<td width="20"><center><?php echo $idvenda ?></center></td>
				<td width="220"><center><?php echo $produto ?></center></td>
				<td width="60"><center><?php echo 'R$ '.$preco ?></center></td>
				<td width="25"><center><?php echo $quantidade ?></center></td>
				<td width="50"><center><?php echo 'R$ '.$totall ?></center></td>
				<?php if ($cargo == 1){?>
				<td width="30" align="center"><a  href="javascript:func()" onclick="confirmacao(<?php echo $idvenda ?>)"  ><img src="Imagens/trash.png" title="Excluir" width="30" height="30"/></a></td>
				<?php } ?>
			</tr>
			<?php }}}
			}
			?>
		
		</table></center><br/>
	
	
</body>
</html>