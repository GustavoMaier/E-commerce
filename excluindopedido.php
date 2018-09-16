<?php
include 'conexao.php';

$idvenda = $_GET['idvenda'];

$sql = mysql_query("DELETE FROM ecommerce.pedidos WHERE idvenda = '$idvenda'");
$sqli = mysql_query("DELETE FROM ecommerce.itenspedidos WHERE idvenda = '$idvenda'");
header('Location:pedidos.php');
?>