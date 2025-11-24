<?php
$tabela = 'pagar';
require_once("../../../conexao.php");

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$id_empresa = $_POST['id_empresa'];

$data_atual = date('Y-m-d');
$dia = date('d');
$mes = date('m');
$ano = date('Y');


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$i = 0;
$numero_documento = $res[$i]['numero_documento'];
$serie_nf = $res[$i]['serie_nf'];
$tipo_pagamento = $res[$i]['tipo_pagamento'];
$descricao_pgto = $res[$i]['descricao_pgto'];
$data_emiss = $res[$i]['data_emiss'];
$data_lanc = $res[$i]['data_lanc'];
$chave_nf = $res[$i]['chave_nf'];
$cod_aut = $res[$i]['cod_aut'];
$fornecedor = $res[$i]['fornecedor'];
$data_venc = $res[$i]['data_venc'];
$data_pgto = $res[$i]['data_pgto'];
$valor = $res[$i]['valor'];
$pessoa = $res[$i]['pessoa'];
$tag = $res[$i]['tag'];

$base_icms = $res[$i]['base_icms'];
$valor_icms = $res[$i]['valor_icms'];
$valor_prod = $res[$i]['valor_prod'];
$valor_seguro = $res[$i]['valor_seguro'];
$valor_frete = $res[$i]['valor_frete'];
$desconto = $res[$i]['desconto'];
$valor_ipi = $res[$i]['valor_ipi'];
$valor_nota = $res[$i]['valor_nota'];

$usuario_lanc = $res[$i]['usuario_lanc'];
$usuario_pgto = $res[$i]['usuario_pgto'];
$frequencia = $res[$i]['frequencia'];
$compensacao = $res[$i]['compensacao'];
$centro_de_custo = $res[$i]['centro_de_custo'];
$sub_centro = $res[$i]['sub_centro'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];
$saida = $res[$i]['saida'];

if($data_pgto == '0000-00-00'){
	$pdo->query("UPDATE $tabela set usuario_pgto = '$id_usuario', pago = 'Sim', data_pgto = curDate() where id = '$id'");
	$pdo->query("UPDATE detalhes_nota set data_pgto = curDate() where numero_documento_ref = '$numero_documento' and id_ref = '$id'");
}
else{
	$pdo->query("UPDATE $tabela set usuario_pgto = '$id_usuario', pago = 'Sim' where id = '$id'");
	$pdo->query("UPDATE detalhes_nota set data_pgto = '$data_pgto' where numero_documento_ref = '$numero_documento' and id_ref = '$id'");
}


//CRIAR A PRÓXIMA CONTA A PAGAR CASO EXISTA RECORRENCIA / FREQUENCIA
	$dias_frequencia = $frequencia;

	if($dias_frequencia == 30 || $dias_frequencia == 31){		
		$nova_data_vencimento = date('Y/m/d', strtotime("+1 month",strtotime($data_venc)));

	}else if($dias_frequencia == 90){
		$nova_data_vencimento = date('Y/m/d', strtotime("+3 month",strtotime($data_venc)));

	}else if($dias_frequencia == 180){ 
		$nova_data_vencimento = date('Y/m/d', strtotime("+6 month",strtotime($data_venc)));

	}else if($dias_frequencia == 360){
		$nova_data_vencimento = date('Y/m/d', strtotime("+1 year",strtotime($data_venc)));

	}else{		
		$nova_data_vencimento = date('Y/m/d', strtotime("+$dias_frequencia days",strtotime($data_venc))); 
	}


	if(@$dias_frequencia > 0){
		$pdo->query("INSERT INTO $tabela set empresa = '$id_empresa', tipo_pagamento = '$tipo_pagamento',data_emiss = '$data_emiss', data_lanc = curDate(), descricao_pgto = '$descricao_pgto', fornecedor = '$fornecedor', data_venc = '$nova_data_vencimento', valor = '$valor', base_icms = '$base_icms', valor_icms = '$valor_icms',
		valor_prod = '$valor_prod', valor_seguro = '$valor_seguro', valor_frete = '$valor_frete', desconto = '$desconto', valor_ipi = '$valor_ipi', valor_nota = '$valor_nota', pessoa = '$pessoa', frequencia = '$frequencia',compensacao = '$compensacao',centro_de_custo = '$centro_de_custo',sub_centro = '$sub_centro', usuario_lanc = '$id_usuario', arquivo = '$arquivo', tag = '$tag', pago = 'Não'");
						
	}



echo 'Baixado com Sucesso';
 ?>