<?php 
$tabela = 'detalhes_viagem';
require_once("../../../conexao.php");
function formatacao($valor){
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    $valor = str_replace('R$', '', $valor);
    return $valor;
}

$id_viagem = $_POST['id_viagem'];
$responsavel = $_POST['responsavel_viagem'];
$usuario = $_POST['usuario_viagem'];
$centro_de_custo = $_POST['centro_de_custo_viagem'];
$sub_centro = $_POST['sub_centro_viagem'];
$num_fatura_det = $_POST['num_fatura_det'];
$trecho_voo = $_POST['trecho_voo'];
$companhia_aerea = $_POST['companhia_aerea'];
$loc_cia = $_POST['loc_cia'];
$data_ida = $_POST['data_ida'];
$data_volta = $_POST['data_volta'];
$valor_aereo = $_POST['valor_aereo'];
$valor_aereo = formatacao($valor_aereo);


$valor_tarifa_aereo = $_POST['valor_tarifa_aereo'];
$valor_tarifa_aereo = formatacao($valor_tarifa_aereo);


$valor_alt_voo = $_POST['valor_alt_voo'];
$valor_alt_voo = formatacao($valor_alt_voo);


$taxa_du_rav = $_POST['taxa_du_rav'];
$taxa_du_rav = formatacao($taxa_du_rav);


$taxa_embarque = $_POST['taxa_embarque'];
$taxa_embarque = formatacao($taxa_embarque);

$taxa_assento = $_POST['taxa_assento'];
$taxa_assento = formatacao($taxa_assento);

$alteracao_voo = $_POST['alteracao_voo'];

$taxa_voo = $_POST['taxa_voo'];
$taxa_voo = formatacao($taxa_voo);

$credito = $_POST['credito'];
$credito = formatacao($credito);

$fatura_hospedagem = $_POST['fatura_hospedagem'];
$hospedagem = $_POST['hospedagem'];

$all_inclusive = $_POST['all_inclusive'];
$all_inclusive = formatacao($all_inclusive);


$valor_hospedagem = $_POST['valor_hospedagem'];
$valor_hospedagem = formatacao($valor_hospedagem);


$taxa_hospedagem = $_POST['taxa_hospedagem'];
$taxa_hospedagem = formatacao($taxa_hospedagem);


$total_hospedagem = $_POST['total_hospedagem'];
$total_hospedagem = formatacao($total_hospedagem);


$data_check_in = $_POST['data_check_in'];
$alteracao_hosp = $_POST['alteracao_hosp'];


$data_check_out = $_POST['data_check_out'];

$agendado = $_POST['agendado'];
$cancelado_voo = $_POST['cancelado_voo'];
$cancelado_hosp = $_POST['cancelado_hosp'];
$reembolso = $_POST['reembolso'];
$utilizado = $_POST['utilizado'];

$transfer_voo = $_POST['transfer_voo'];
$transfer_voo = formatacao($transfer_voo);

$taxa_transfer = $_POST['taxa_transfer'];
$taxa_transfer = formatacao($taxa_transfer);


$valor_alimentacao = $_POST['valor_alimentacao'];
$valor_alimentacao = formatacao($valor_alimentacao);


$total_transfer = $_POST['total_transfer'];
$total_transfer = formatacao($total_transfer);


$valor_trans_terrestre = $_POST['valor_trans_terrestre'];
$valor_trans_terrestre = formatacao($valor_trans_terrestre);


$observacoes = $_POST['observacoes'];
$reembolso_TA = $_POST['reembolso_TA'];

$id_usuario = $_POST['id_usuario'];
if($alteracao_hosp == 'Sim' or $alteracao_voo == 'Sim'){
    $alteracao = 'Sim';
}else{
    $alteracao = 'Não';
}


if($id_viagem == ''){
	$query = $pdo->query("SELECT * FROM detalhes_viagem order by id_viagem desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0){
		$id_viagem = $res[0]['id_viagem'] + 1;
	}else{
		$id_viagem = 1;
	}
}


$query = $pdo->prepare("INSERT into $tabela SET  trecho_voo = '$trecho_voo',id_viagem = '$id_viagem',usuario = '$usuario',responsavel = '$responsavel',centro_de_custo = '$centro_de_custo',sub_centro = '$sub_centro',num_fatura = '$num_fatura_det', data_ida = '$data_ida', data_volta = '$data_volta',companhia_aerea = '$companhia_aerea',loc_cia = '$loc_cia', valor_aereo = :valor_aereo,valor_tarifa_aereo = :valor_tarifa_aereo, valor_alt_voo = :valor_alt_voo,taxa_du_rav = :taxa_du_rav,taxa_embarque = :taxa_embarque,taxa_assento = :taxa_assento,  taxa_voo = :taxa_voo, credito = :credito, alteracao_voo = '$alteracao_voo',fatura_hospedagem = '$fatura_hospedagem', hospedagem = '$hospedagem',
                        all_inclusive = :all_inclusive, valor_hospedagem = :valor_hospedagem, taxa_hospedagem = :taxa_hospedagem,total_hospedagem = :total_hospedagem, data_check_in = '$data_check_in', data_check_out = '$data_check_out', agendado = '$agendado',cancelado_voo = '$cancelado_voo' ,cancelado_hosp = '$cancelado_hosp', reembolso = '$reembolso', utilizado = '$utilizado',alteracao_hosp = '$alteracao_hosp',transfer_voo = :transfer_voo,taxa_transfer = :taxa_transfer, total_transfer = :total_transfer, valor_alimentacao = :valor_alimentacao, valor_trans_terrestre = :valor_trans_terrestre, usuario_lanc = '$id_usuario', observacoes = '$observacoes',reembolso_TA = '$reembolso_TA', alteracao = '$alteracao'"); 
$query->bindValue(":valor_aereo", "$valor_aereo");
$query->bindValue(":valor_alt_voo", "$valor_alt_voo");
$query->bindValue(":valor_hospedagem", "$valor_hospedagem");
$query->bindValue(":valor_alimentacao", "$valor_alimentacao");
$query->bindValue(":valor_trans_terrestre", "$valor_trans_terrestre");
$query->bindValue(":valor_tarifa_aereo", "$valor_tarifa_aereo");
$query->bindValue(":taxa_du_rav", "$taxa_du_rav");
$query->bindValue(":taxa_embarque", "$taxa_embarque");
$query->bindValue(":taxa_assento", "$taxa_assento");
$query->bindValue(":taxa_voo", "$taxa_voo");
$query->bindValue(":credito", "$credito");
$query->bindValue(":taxa_hospedagem", "$taxa_hospedagem");
$query->bindValue(":all_inclusive", "$all_inclusive");
$query->bindValue(":total_hospedagem", "$total_hospedagem");
$query->bindValue(":transfer_voo", "$transfer_voo");
$query->bindValue(":taxa_transfer", "$taxa_transfer");
$query->bindValue(":total_transfer", "$total_transfer");
$query->execute();

echo 'Salvo com Sucesso';
?>