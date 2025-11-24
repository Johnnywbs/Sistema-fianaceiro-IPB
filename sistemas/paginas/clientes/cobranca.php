<?php
require_once("../../../conexao.php");

$texto = $_POST['texto'];
$id_empresa = $_POST['empresa'];
$cliente = $_POST['tel'];
$id_conta = $_POST['id'];

$link_pgto = $url_sistema.'pagar/'.$id_conta;

$query = $pdo->query("SELECT * FROM config WHERE empresa = '$id_empresa'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$token = $res[0]['token'];
$token_pix = $res[0]['token_pix'];
$chave_pix_sistema = $res[0]['chave_pix_sistema'];
$instancia = $res[0]['instancia'];
$nome_empresa = $res[0]['nome_sistema'];

$mensagem = '*_'.mb_strtoupper($nome_empresa).'_*%0A%0A';
$mensagem .= $texto.'%0A%0A';

if($token_pix == ""){
	$mensagem .= '*Chave Pix Abaixo*%0A';
	$mensagem .= $chave_pix_sistema.'%0A%0A';
	$mensagem .= '_Assim que efetuar o pagamento, nos encaminho o comprovante!_';
}else{
	$mensagem .= '*Link para Pagamento Pix*%0A';
	$mensagem .= $link_pgto;
}

require('../../../api/texto.php');

 ?>