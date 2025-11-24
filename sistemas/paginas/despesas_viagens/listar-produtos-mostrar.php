<?php 
$tabela = 'detalhes_viagem';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id = $_POST['id'];
$num_fatura_det = $_POST['num_fatura_det'];

$query = $pdo->query("SELECT * FROM $tabela where num_fatura_det = '$num_fatura_det' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
<small><small>
	<table class="table table-hover">
	<thead> 
	<tr> 
	<th>Descrição do Produto</th>	
	<th class="esc">Quantidade</th>
	<th class="esc">Valor Unitário</th>
    <th class="esc">Valor Desconto</th>
	<th class="esc">Centro de Custo</th>
    <th class="esc">Sub Centro</th>
    <th class="esc">Classificação</th>
	<th>Excluir</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$id_viagem = $res[$i]['id_viagem'];
$num_fatura = $res[$i]['num_fatura'];
$trecho_voo = $res[$i]['trecho_voo'];
$data_ida = $res[$i]['data_ida'];
$data_volta = $res[$i]['data_volta'];
$valor_aereo = $res[$i]['valor_aereo'];
$valor_tarifa_aereo = $res[$i]['valor_tarifa_aereo'];
$valor_alt_voo = $res[$i]['valor_alt_voo'];
$taxa_du_rav = $res[$i]['taxa_du_rav'];
$taxa_embarque = $res[$i]['taxa_embarque'];
$taxa_assento = $res[$i]['taxa_assento'];
$alteracao_hosp = $res[$i]['alteracao_hosp'];
$alteracao_voo = $res[$i]['alteracao_voo'];
$taxa_alteracao = $res[$i]['taxa_alteracao'];
$taxa_voo = $res[$i]['taxa_voo'];
$data_emiss_fat = $res[$i]['data_emiss_fat'];
$data_venc_fat = $res[$i]['data_venc_fat'];
$data_pgto_fat = $res[$i]['data_pgto_fat'];
$fatura_hospedagem = $res[$i]['fatura_hospedagem'];
$tarifa_hospedagem = $res[$i]['tarifa_hospedagem'];
$hospedagem = $res[$i]['hospedagem'];
$all_inclusive = $res[$i]['all_inclusive'];
$valor_hospedagem = $res[$i]['valor_hospedagem'];
$taxa_hospedagem = $res[$i]['taxa_hospedagem'];
$data_check_in = $res[$i]['data_check_in'];
$data_check_out = $res[$i]['data_check_out'];
$total_hospedagem = $res[$i]['total_hospedagem'];
$agendado = $res[$i]['agendado'];
$transfer = $res[$i]['transfer_voo'];
$taxa_transfer = $res[$i]['taxa_transfer'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$total_transfer = $res[$i]['total_transfer'];
$valor_alimentacao = $res[$i]['valor_alimentacao'];
$valor_trans_terrestre = $res[$i]['valor_trans_terrestre'];
$observacoes = $res[$i]['observacoes'];

$data_idaF = implode('/', array_reverse(explode('-', $data_ida)));
$data_voltaF = implode('/', array_reverse(explode('-', $data_volta)));
$data_emiss_fatF = implode('/', array_reverse(explode('-', $data_emiss_fat)));
$data_venc_fatF = implode('/', array_reverse(explode('-', $data_venc_fat)));
$data_pgto_fatF = implode('/', array_reverse(explode('-', $data_pgto_fat)));
$data_check_inF = implode('/', array_reverse(explode('-', $data_check_in)));
$data_check_outF = implode('/', array_reverse(explode('-', $data_check_out)));
$valor_aereoF = number_format($valor_aereo, 2, ',', '.');
$valor_alt_vooF = number_format($valor_alt_voo, 2, ',', '.');
$valor_faturaF = number_format($valor_fatura, 2, ',', '.');
$valor_hospedagemF = number_format($valor_hospedagem, 2, ',', '.');
$valor_alimentacaoF = number_format($valor_alimentacao, 2, ',', '.');
$valor_trans_terrestreF = number_format($valor_trans_terrestre, 2, ',', '.');
$taxa_du_ravF = number_format($taxa_du_rav, 2, ',', '.');
$taxa_embarqueF = number_format($taxa_embarque, 2, ',', '.');
$taxa_assentoF = number_format($taxa_assento, 2, ',', '.');
$taxa_alteracaoF = number_format($taxa_alteracao, 2, ',', '.');
$taxa_vooF = number_format($taxa_voo, 2, ',', '.');
$taxa_hospedagemF = number_format($taxa_hospedagem, 2, ',', '.');
$transferF = number_format($transfer, 2, ',', '.');
$taxa_transferF = number_format($taxa_transfer, 2, ',', '.');
$total_transferF = number_format($total_transfer, 2, ',', '.');
$valor_tarifa_aereoF = number_format($valor_tarifa_aereo, 2, ',', '.');
$tarifa_hospedagemF = number_format($tarifa_hospedagem, 2, ',', '.');
$all_inclusiveF = number_format($all_inclusive, 2, ',', '.');
$total_hospedagemF = number_format($total_hospedagem, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usuario = $res2[0]['nome'];
}else{
	$nome_usuario = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$responsavel'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_responsavel = $res2[0]['nome'];
}else{
	$nome_responsavel = 'Sem Responsável';
}
echo <<<HTML
<tr>
<tr>
<td class="esc">{$nome_usuario}</td>
<td class="esc">{$valor_aereoF}</td>
<td class="esc">{$total_hospedagemF}</td>
<td class="esc">{$valor_desconto}</td>
<td class="esc">{$centro_de_custo}</td>
<td class="esc">{$sub_centro}</td>
</tr>
HTML;
echo <<< HTML
	<li class="dropdown head-dpdn2" style="display: inline-block;">
	<big><a href="#" onclick="mostrar('{$id}','{$id_viagem}', '{$num_fatura}','{$nome_responsavel}','{$nome_usuario}','{$centro_de_custo}','{$sub_centro}','{$trecho_voo}','{$data_idaF}','{$data_voltaF}','{$valor_aereoF}','{$valor_tarifa_aereoF}','{$valor_alt_vooF}','{$taxa_du_ravF}','{$taxa_embarqueF}','{$taxa_assentoF}','{$alteracao_voo}','{$taxa_alteracaoF}','{$taxa_vooF}','{$data_emiss_fatF}','{$data_venc_fatF}','{$data_pgto_fatF}','{$fatura_hospedagem}','{$tarifa_hospedagemF}','{$hospedagem}','{$all_inclusiveF}','{$valor_hospedagemF}','{$taxa_hospedagemF}','{$data_check_in}','{$data_check_out}','{$total_hospedagemF}','{$agendado}','{$transferF}','{$taxa_transferF}','{$total_transferF}','{$valor_alimentacaoF}','{$valor_trans_terrestreF}','{$observacoes}','{$nome_usu_lanc}') " title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>
HTML;
echo <<< HTML
</td>
</tr>
HTML;
}

echo <<<HTML
</tbody>
</table>
</small></small>
HTML;

}else{
	echo '<small>Não possui nenhum Produto/Serviço cadastrado!</small>';
}

 ?>