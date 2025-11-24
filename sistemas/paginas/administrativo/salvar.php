<?php 
$tabela = 'centros_custo';
require_once("../../../conexao.php");
$nome = 'administrativo';
$descricao = $_POST['descricao'];
$orcamento = $_POST['orcamento'];
$orcamento = str_replace(',', '.', $orcamento);
$tipo = $_POST['tipo'];

$query = $pdo->prepare("UPDATE $tabela SET descricao = :decricao, orcamento = :orcamento, tipo = '$tipo' WHERE nome = '$nome' ");

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":orcamento", "$orcamento");
$query->execute();


echo 'Salvo com Sucesso';
?>