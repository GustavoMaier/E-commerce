<?php
?>
<html>
<head>
<title>E-commerce Admin</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Imagens/box.png" /> 
</head>
<body>
		<div id='menu'>
			<ul>
				<li><a href='logoff.php' ><span>Logoff</span></a></li>
				<li><a href='#'><span>Cadastro</span></a>
					<ul>
						<li><a href='cadastro.php'><span>Cadastro de Usuários</span></a></li>
						<li><a href='cadastroproduto.php'><span>Cadastro de Produtos</span></a></li>
					</ul></li>
				<li class='has-sub'><a href='#'><span>Pesquisa</span></a>
					<ul>
						<li><a href='pesquisa.php'><span>Pesquisa de Usuários</span></a></li>
						<li><a href='pesquisaproduto.php'><span>Pesquisa de Produtos</span></a></li>
					</ul></li>
				<li><a href='carrinho.php?acao=up'><span>Carrinho de Compras</span></a></li>
				<li><a href='pedidos.php'><span>Pedidos</span></a></li>
				<li><a href='sobre.php'><span>Sobre</span></a></li>
			</ul>
		</div>

</body>
</html>