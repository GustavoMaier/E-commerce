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
	
	//PEGANDO DADOS DE COMPRA
	
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
location.href="finalizar.php"
}
</script>
 <script>  
    function b(){  
      var i = document.f.forma.selectedIndex;  
      alert(document.f.forma[i].text);  
    }  
  </script> 
</head>
<body><center>
		<h2>
			<b>Finalizar Compra</b>
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
	$total = number_format($total, 2, ',', '.');
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
	         <td align="center"><?php echo 'R$ '.$total ?></td>
	    </tr>
	
 	    <?php 
        	if (!empty($_SESSION['carrinho'])){
       
        	}
        	$sql = mysql_query("SELECT * FROM ecommerce.usuarios WHERE login = '".$logado."' ");

        	$row = mysql_num_rows($sql);
        	
        	if ($row >0){
        		while ($linha = mysql_fetch_array($sql))	{
        			$id = $linha ['id'];
        			$nome = $linha ['nome'];
        			$cpf = $linha ['cpf'];
        			$email = $linha ['email'];
        			$telefone = $linha ['telefone'];
        			$endereco = $linha ['endereco'];
        			
        ?>
        </table>
        <h2>Dados Pesoais</h2>
        <center><form name"signup" method="post" action="pedido.php">

		Nome: <input type="text" size=60px name="nome" value="<?php echo $nome ?>" />
		CPF: <input type="text" size=40px name="cpf" value="<?php echo $cpf ?>" id="cpf" maxlength="14" onkeypress="return SomenteNumero(event)" onkeyup="formatar('###.###.###-##', this)"/><br></br>
		Email: <td><input type="text" size=60px name="email" value="<?php echo $email ?>" />	
		Telefone: <input type="text" size=35px name="telefone" id="telefone" value="<?php echo $telefone ?>" maxlength="12" onkeypress="return SomenteNumero(event)" onkeyup="formatar('## ####-####', this)" /><br></br> 
		<h2>Endereço de Entrega</h2>
		Endereço: <input type="text" size=60px name="endereco" value="<?php echo $endereco ?>" /><br/><br/>
		
		<a><input type="reset" value="Desfazer" /></a>

	</center>
	<br/><h2>Forma de Pagamento</h2>
	<select name="forma" onchange="b()"> 
	<option value="forma"></option>
	<option value="Boleto Bancário - 10% de Desconto">Boleto Bancário</option>
	<option value="Cartao de Crédito">Cartão de Crédito</option></select>
	<input type="submit" value="Comprar"/><br/><br/><br/><br/>
	</form>
</body>
</html><?php }}}
?>