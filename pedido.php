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
.escondida {
    display:none;
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
location.href="finalizar.php"
}
</script>
</head>
<body><center>
		<h2>
			<b>Pedido Finalizado !</b>
		</h2>
	</center><br/><br/>
<center> <table width="800" border="1">
			<tr>
				<td width="20"><center><b>Imagem</b></center></td>
				<td width="150"><center><b>Produto</b></center></td>
				<td width="30"><center><b>Quantidade</b></center></td>
				<td width="40"><center><b>Preço Unitario</b></center></td>
				<td width="40"><center><b>Sub Total</b></center></td>
			</tr>
	<form action="?acao=up" method="post">
	
<?php 
$total = 0;
$desconto = 0;
foreach ($_SESSION['carrinho'] as $id=>$qtd){

	$sql   = "SELECT * FROM produto  WHERE id= '$id'";
	$qr    = mysql_query($sql) or die(mysql_error());
	$ln    = mysql_fetch_assoc($qr);
	
	$imagem  = $ln['imagem'];
	$nome  = $ln['nome'];
	$total += $ln['preco']* $qtd;
	$preco = 'R$ '.number_format($ln['preco'], 2, ',', '.');
	$sub   = 'R$ '.number_format($ln['preco'] * $qtd, 2, ',', '.');
	$forma = $_POST ['forma'];
	if ($forma =="Boleto Bancário - 10% de Desconto") {
		$desconto = ($total/100)*10 ;
	}
	$totall = $total - $desconto;
?>			
				<tr>
				<td width="20" height="70"><center><img src="<?php echo $imagem ?>" title="Imagem" width="55" height="60"/></center></td>
				<td width="150"><center><?php echo $nome ?></center></td>
				<td width="30"><center><?php echo $qtd ?></center></center></td>
				<td width="40"><center><?php echo $preco ?></center></td>
				<td width="40"><center><?php echo $sub ?></center></td>
				</tr>
<?php 
}
?>
    <tr>
	    	<td colspan="3"><br></td>
	    	<td align="center"><b>Frete</b></td>
	    	<td align="center"><b>Frete Gratis</b></td>
	    </tr>
		<tr>
			 <td colspan="3"><br /></td>
	         <td align="center"><b>Total </b></td>
	         <td align="center"><?php echo 'R$ '.$totall ?></td>
	    </tr>
	
 	    <?php 
        	
        	$nome = $_POST ['nome'];
			$cpf = $_POST ['cpf'];
			$email = $_POST ['email'];
			$telefone = $_POST ['telefone'];
			$endereco = $_POST ['endereco'];
			$forma = $_POST ['forma'];
		?>
        </table>
        <h2>Dados Pesoais</h2>
        <center>

		Nome: <?php echo $nome ?><br/>
		CPF: <?php echo $cpf ?><br/>
		Email: <?php echo $email ?><br/>
		Telefone: <?php echo $telefone ?> 
		
		<h2>Endereço de Entrega</h2>
		Endereço: <?php echo $endereco ?>
		<?php 
		/////////////////////// Warning Tretas
		
		$data = date("d/m/y");

		///// pesquisa e seleciona o usuario que efetuou a compra
		$sqlu = mysql_query("SELECT * FROM ecommerce.usuarios WHERE login = '".$logado."' ");
		$row = mysql_num_rows($sqlu);
		if ($row >0){
			while ($linha = mysql_fetch_array($sqlu))	{
				$idcliente = $linha ['id'];
		}
		
		$sqlo = mysql_query("SELECT * FROM produto  WHERE id= '$id'");
		$lin    = mysql_fetch_array($sqlo);
		$preco = $lin ['preco'];
		$total = $preco * $qtd;
		
		////// insere nos pedidos usuario, data, pagamento e total
		$sql = mysql_query("INSERT INTO ecommerce.pedidos (idcliente, data, formadepagamento, precototal) VALUES ('$idcliente', '$data', '$forma', '$totall')");
		
		///// busca pelo usuario as compras feitas
		$sqlpe = mysql_query("SELECT * FROM ecommerce.pedidos WHERE idcliente = '$idcliente' ");
		$rowe = mysql_num_rows($sqlpe);
		if ($rowe >0){
			while ($rowe = mysql_fetch_array($sqlpe))	{
				$idvenda = $rowe ['idvenda'];
			}
			///// estoque
			foreach ($_SESSION['carrinho'] as $id=>$qtd){
			$sqlpq = mysql_query("SELECT * FROM produto  WHERE id= '$id'");
			$ln    = mysql_fetch_array($sqlpq);
				
				$qtdeinicial = $ln['quantidade'];
				$qtdefinal = $qtdeinicial - $qtd ;
				$idproduto = $ln ['id'];
				$preco = $ln ['preco'];
				$sqlpr = mysql_query("UPDATE ecommerce.produto SET quantidade = '$qtdefinal' WHERE id = '$id'");
				
// 				$idproduto = $id;
				$sqli = mysql_query("INSERT INTO ecommerce.itenspedidos (idvenda, idproduto, quantidade, preco) VALUES ('$idvenda', '$idproduto', '$qtd', '$preco')");
			
		}}}
		?>
	</center>
	<br/><h2>Forma de Pagamento</h2>
		<?php 
		$forma = $_POST ['forma'];
		echo $forma
		?>
	<br/><br/></body>
</html><?php 
if ( isset($_SESSION['carrinho'])){
	unset ($_SESSION['carrinho']);
}
}
?>