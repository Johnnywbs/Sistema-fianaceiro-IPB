<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id_pessoa = $_POST['id'];
$id_empresa = $_POST['id_empresa'];

$res = $pdo->query("SELECT * FROM $tabela where pessoa = '$id_pessoa' and empresa = '$id_empresa' order by id desc limit 1");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) == 0){
	echo '<small>Este Cliente ainda não possui nenhuma compra!</small>';
	exit();
}
$id = @$dados[0]['id'];
$id_empresa = @$dados[0]['empresa'];
$hora = @$dados[0]['hora'];
$total_venda = @$dados[0]['valor'];
$valor_recebido = @$dados[0]['valor_recebido'];
$tipo_pgto = @$dados[0]['saida'];
$status = @$dados[0]['pago'];
$troco = @$dados[0]['troco'];
$data = @$dados[0]['data_lanc'];
$desconto = @$dados[0]['desconto'];
$operador = @$dados[0]['usuario_lanc'];
$cliente = @$dados[0]['pessoa'];
$acrescimo = @$dados[0]['acrescimo'];
$vendedor = @$dados[0]['vendedor'];
$data_pgto = @$dados[0]['data_venc'];
$garantia = @$dados[0]['garantia'];

$res = $pdo->query("SELECT * from usuarios where id = '$vendedor' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) > 0){
	$nome_vendedor = $dados[0]['nome'];
}else{
	$nome_vendedor = 'Sem Lançamento';
}


$res = $pdo->query("SELECT * from config where empresa = '$id_empresa' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

if(@count($dados) > 0){
	$nome_sistema = $dados[0]['nome_sistema'];
	$telefone_sistema = $dados[0]['telefone_sistema'];
	$endereco_sistema = $dados[0]['endereco_sistema'];
	$cnpj_sistema = $dados[0]['cnpj_sistema'];
	$tipo_desconto = $dados[0]['tipo_desconto'];
}

$data2 = implode('/', array_reverse(explode('-', $data)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));

$nome_pgto = $tipo_pgto;


if($tipo_desconto == '%'){
	$descontoF = number_format($desconto , 0, ',', '').'%';			
}else{
	$descontoF = 'R$ '.number_format($desconto , 2, ',', '.');
}


$garantia_dias = date('Y-m-d', strtotime("+$garantia days",strtotime($data))); 
$garantia_diasF = implode('/', array_reverse(explode('-', $garantia_dias)));



$res = $pdo->query("SELECT * from itens_venda where venda = '$id' order by id asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

echo '<div class="row">
<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados de Recebimentos</span></h4>
</div>

<div class="col-md-6"><b>Data da última Transação: </b> '.$data2.'</div> 
<div class="col-md-6" align="right"><b>Total em Serviços: </b>'.$total_venda.' </div>';