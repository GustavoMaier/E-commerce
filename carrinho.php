<?php
	error_reporting(null);

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
	
	session_start();
	
	if(isset($_GET['acao'])){
	
		//ADICIONAR CARRINHO
		if($_GET['acao'] == 'add'){
			$id = intval($_GET['id']);
			
		if (!isset($_SESSION['carrinho'])) {
			$_SESSION['carrinho'] = array();
			
		}if (empty($_SESSION['carrinho'][$id])) {
			$_SESSION['carrinho'] [$id] = 1;
		}else{
				$_SESSION['carrinho'][$id] +1;
			}
		}
	}
	//ALTERAR QUANTIDADE
	if($_GET['acao'] == 'up'){
		if(is_array($_POST['prod'])){
			foreach($_POST['prod'] as $id => $qtd){
				$id  = intval($id);
				$qtd = intval($qtd);
				if(!empty($qtd) || $qtd <> 0){
					$_SESSION['carrinho'][$id] = $qtd;
				}else{
					unset($_SESSION['carrinho'][$id]);
				}
			}
		}
	}
	
	//REMOVER CARRINHO
	if($_GET['acao'] == 'del'){
		$id = intval($_GET['id']);
		if(isset($_SESSION['carrinho'][$id])){
			unset($_SESSION['carrinho'][$id]);
		}
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
<title>Carrinho</title>
<script type="text/javascript">
function continua(){
location.href="pesquisaproduto.php"
}
</script>
<script type="text/javascript">
function finaliza(){
location.href="checkout.php"
}
</script>
</head>
<body><center>
		<h2>
			<b> Carrinho de Compras</b>
		</h2>
	</center><br/><br/>
<center> <table width="800" border="1">
			<tr>
				<td width="20"><center><b>Imagem</b></center></td>
				<td width="150"><center><b>Produto</b></center></td>
				<td width="30"><center><b>Quantidade</b></center></td>
				<td width="40"><center><b>Preço Unitario</b></center></td>
				<td width="40"><center><b>Sub Total</b></center></td>
				<td width="30"><center><b>Excluir</b></center></td>
			</tr>
	<form action="?acao=up" method="post">
	
<?php 
if(count($_SESSION['carrinho']) == 0){
	echo '<tr><td colspan="6"><b style="font-size:17px; color: black; ">Não há produtos no carrinho</b></td></tr>';
}

$total = 0;
foreach ($_SESSION['carrinho'] as $id=>$qtd){

	$sql   = "SELECT * FROM produto  WHERE id= '$id'";
	$qr    = mysql_query($sql) or die(mysql_error());
	$ln    = mysql_fetch_assoc($qr);
	
	$imagem  = $ln['imagem'];
	$nome  = $ln['nome'];
	$total += $ln['preco']* $qtd;
	$preco = 'R$ '.number_format($ln['preco'], 2, ',', '.');
	$sub   = 'R$ '.number_format($ln['preco'] * $qtd, 2, ',', '.');
?>			
				<tr>
				<td width="20" height="70"><center><img src="<?php echo $imagem ?>" title="Imagem" width="55" height="60"/></center></td>
				<td width="150"><center><?php echo $nome ?></center></td>
				<td width="30"><center><center><input type="text" maxlength="3" size="3" name="prod[<?php echo $id ?>]" value="<?php echo $qtd ?>" /></center></center></td>
				<td width="40"><center><?php echo $preco ?></center></td>
				<td width="40"><center><?php echo $sub ?></center></td>
				<td width="30"><center><a href="?acao=del&id=<?php echo $id ?>"><center><img src="Imagens/Trash.png" title="Remover" /></center></a></center></td>		
				</tr>
<?php 
}
?>
		<tr>
			 <td colspan="3"><br /></td>
	         <td align="center"><b>Total </b></td>
	         <td align="center"><?php echo 'R$ '.$total ?></td>
	         <td><br></td>
	    </tr>
 		<tr>
            <td colspan="2" align="center"><input type="submit" value="Atualizar Carrinho" /></td>
            <td colspan="4" align="center"><input type="button" value="Continuar Comprando" onclick="continua();"/></td>
        </tr>
        <?php 
        	if (!empty($_SESSION['carrinho'])){
        ?>
        <tr>
        	<td colspan="6" align="center"><input type="button" value="Finalizar Compra" onclick="finaliza();"/></td>
        </tr>
        <?php 
        	}
        ?>
</body>
</html><?php }
?>