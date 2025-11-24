<?php 
$tabela = 'detalhes_viagem';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id = $_POST['id'];
$num_fatura_det = $_POST['num_fatura_det'];

$query = $pdo->query("SELECT * FROM $tabela where num_fatura = '$num_fatura_det' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
<small><small>
	<table class="table table-hover">
	<thead> 
	<tr> 
	<th>Id Viagem</th>
	<th class="esc">Alteração</th>
	<th class="esc">Usuário</th>
	<th class="esc">Valor Aereo</th>
	<th class="esc">Valor Hospedagem</th>
    <th class="esc">Sub Centro</th>
	<th class="esc">Data Ida</th>
    <th class="esc">Data Volta</th>
	<th class="esc">Ações</th>

	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$id_viagem = $res[$i]['id_viagem'];
$num_fatura = $res[$i]['num_fatura'];
$centro_de_custo = $res[$i]['centro_de_custo'];
$sub_centro = $res[$i]['sub_centro'];
$trecho_voo = $res[$i]['trecho_voo'];
$data_ida = $res[$i]['data_ida'];
$responsavel = $res[$i]['responsavel'];
$usuario = $res[$i]['usuario'];
$companhia_aerea = $res[$i]['companhia_aerea'];
$loc_cia = $res[$i]['loc_cia'];
$data_volta = $res[$i]['data_volta'];
$valor_aereo = $res[$i]['valor_aereo'];
$valor_tarifa_aereo = $res[$i]['valor_tarifa_aereo'];
$valor_alt_voo = $res[$i]['valor_alt_voo'];
$taxa_du_rav = $res[$i]['taxa_du_rav'];
$taxa_embarque = $res[$i]['taxa_embarque'];
$taxa_assento = $res[$i]['taxa_assento'];
$alteracao_voo = $res[$i]['alteracao_voo'];
$alteracao_hosp = $res[$i]['alteracao_hosp'];
$alteracao = $res[$i]['alteracao'];
$taxa_alteracao = $res[$i]['taxa_alteracao'];
$taxa_voo = $res[$i]['taxa_voo'];
$credito = $res[$i]['credito'];
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
$cancelado_voo = $res[$i]['cancelado_voo'];
$cancelado_hosp= $res[$i]['cancelado_hosp'];
$reembolso = $res[$i]['reembolso'];
$utilizado = $res[$i]['utilizado'];
$transfer = $res[$i]['transfer_voo'];
$taxa_transfer = $res[$i]['taxa_transfer'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$total_transfer = $res[$i]['total_transfer'];
$valor_alimentacao = $res[$i]['valor_alimentacao'];
$valor_trans_terrestre = $res[$i]['valor_trans_terrestre'];
$observacoes = $res[$i]['observacoes'];
$reembolso_TA = $res[$i]['reembolso_TA'];

$data_idaF = implode('/', array_reverse(explode('-', $data_ida)));
$data_voltaF = implode('/', array_reverse(explode('-', $data_volta)));
$valor_aereoF = number_format($valor_aereo, 2, ',', '.');
$total_hospedagemF = number_format($total_hospedagem, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
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
<td class="esc">{$id_viagem}</td>
<td class="esc">{$alteracao}</td>
<td class="esc">{$usuario}</td>
<td class="esc">R$ {$valor_aereoF}</td>
<td class="esc">R$ {$total_hospedagemF}</td>
<td class="esc">{$sub_centro}</td>
<td class="esc">{$data_idaF}</td>
<td class="esc">{$data_voltaF}</td>
<td>
HTML;
echo <<< HTML
	<li class="dropdown head-dpdn2" style="display: inline-block;">
	<big><a href="#" onclick="mostrar_detalhes('{$id}','{$id_viagem}', '{$num_fatura}','{$responsavel}','{$usuario}','{$centro_de_custo}','{$sub_centro}','{$companhia_aerea}','{$loc_cia}','{$trecho_voo}','{$data_ida}','{$data_volta}','{$valor_aereo}','{$valor_tarifa_aereo}','{$valor_alt_voo}','{$taxa_du_rav}','{$taxa_embarque}','{$taxa_assento}','{$alteracao_voo}','{$taxa_alteracao}','{$taxa_voo}','{$credito}','{$data_emiss_fat}','{$data_venc_fat}','{$data_pgto_fat}','{$fatura_hospedagem}','{$tarifa_hospedagem}','{$hospedagem}','{$all_inclusive}','{$valor_hospedagem}','{$taxa_hospedagem}','{$data_check_in}','{$data_check_out}','{$total_hospedagem}','{$agendado}','{$cancelado_voo}','{$cancelado_hosp}','{$reembolso}','{$utilizado}','{$alteracao_hosp}','{$transfer}','{$taxa_transfer}','{$total_transfer}','{$valor_alimentacao}','{$valor_trans_terrestre}','{$observacoes}','{$reembolso_TA}','{$nome_usu_lanc}') " title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

			<ul class="dropdown-menu" style="margin-left:-230px;">
			<li>
			<div class="notification_desc2">
			<p>Confirmar Exclusão? <a href="#" onclick="excluirArquivo('{$id}')"><span class="text-danger">Sim</span></a></p>
			</div>
			</li>										
			</ul>
	</li>
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


<script type="text/javascript">
function formatarReal(valor) {
    var valorFormatado = valor.replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    return 'R$ ' + valorFormatado;
}
function mostrar_detalhes(id, id_viagem,num_fatura,responsavel,usuario, centro_de_custo, sub_centro,companhia_aerea,loc_cia, trecho_voo, data_ida, data_volta, valor_aereo,valor_tarifa_aereo,valor_alt_voo,taxa_du_rav,taxa_embarque,taxa_assento,alteracao_voo, taxa_alteracao, taxa_voo,credito,
data_emiss_fat, data_venc_fat,data_pgto_fat,fatura_hospedagem,tarifa_hospedagem,hospedagem,all_inclusive,valor_hospedagem,taxa_hospedagem,data_check_in,data_check_out,total_hospedagem,agendado,cancelado_voo,cancelado_hosp,reembolso,utilizado,alteracao_hosp,transfer,taxa_transfer,total_transfer,valor_alimentacao,valor_trans_terrestre,observacoes,reembolso_TA,usuario_lanc){

	
	if(data_pgto_fat == "00/00/0000" || data_pgto_fat == ""){
		data_pgto_fat = 'Pagamento nâo efetuado';
	}


		$('#id').val(id);
		$('#id_viagem').val();
		$('#num_fatura').val(num_fatura);
		$('#responsavel_viagem').val(responsavel).change();
		$('#usuario_viagem').val(usuario);
		$('#centro_de_custo_viagem').val(centro_de_custo).change();
		$('#sub_centro_viagem').val(sub_centro).change();
		$('#companhia_aerea').val(companhia_aerea);
		$('#loc_cia').val(loc_cia);
		$('#trecho_voo').val(trecho_voo);
		$('#data_ida').val(data_ida);
		$('#data_volta').val(data_volta);
		$('#valor_tarifa_aereo').val(formatarReal(valor_tarifa_aereo));
		$('#valor_aereo').val(formatarReal(valor_aereo));
		$('#valor_alt_voo').val(formatarReal(valor_alt_voo));
		$('#taxa_du_rav').val(formatarReal(taxa_du_rav));
		$('#taxa_embarque').val(formatarReal(taxa_embarque));
		$('#taxa_assento').val(formatarReal(taxa_assento));
		$('#alteracao_voo').val(alteracao_voo);
		$('#taxa_alt_percent').val(((parseFloat(taxa_du_rav)/parseFloat(valor_tarifa_aereo))*100).toFixed(2));
		$('#taxa_alteracao').val(formatarReal(taxa_alteracao));
		$('#taxa_voo').val(formatarReal(taxa_voo));
		$('#credito').val(formatarReal(credito));
		$('#fatura_hospedagem').val(fatura_hospedagem);
		$('#tarifa_hospedagem').val(formatarReal(tarifa_hospedagem));
		$('#hospedagem').val(hospedagem);
		$('#all_inclusive').val(formatarReal(all_inclusive));
		$('#valor_hospedagem').val(formatarReal(valor_hospedagem));
		$('#taxa_hospedagem').val(formatarReal(taxa_hospedagem));
		$('#total_hospedagem').val(formatarReal(total_hospedagem));
		$('#hospedagem_percent').val(((parseFloat(taxa_hospedagem)/parseFloat(valor_hospedagem))*100).toFixed(2));
		$('#alteracao_hosp').val(alteracao_hosp);
		$('#data_check_in').val(data_check_in);
		$('#data_check_out').val(data_check_out);
		$('#agendado').val(agendado);
		$('#cancelado_voo').val(cancelado_voo);
		$('#cancelado_hosp').val(cancelado_hosp);
		$('#reembolso').val(reembolso);
		$('#utilizado').val(utilizado);
		$('#transfer_voo').val(formatarReal(transfer));
		$('#taxa_transfer').val(formatarReal(taxa_transfer));
		$('#transfer_percent').val(((parseFloat(taxa_transfer)/parseFloat(transfer))*100).toFixed(2));
		$('#total_transfer').val(formatarReal(total_transfer));
		$('#valor_alimentacao').val(formatarReal(valor_alimentacao));
		$('#valor_trans_terrestre').val(formatarReal(valor_trans_terrestre));
		$('#observacoes').val(observacoes);
		$('#reembolso_TA').val(reembolso_TA);
		$('#id_usuario').val(localStorage.id_usu);
		

}

function limparCamposDetalhes(){
		$('#id').val('');
		$('#id_viagem').val('');
		$('#num_fatura').val('');
		$('#responsavel_viagem').val('').change();
		$('#usuario_viagem').val('');
		$('#centro_de_custo_viagem').val('').change();
		$('#sub_centro_viagem').val('').change();
		$('#companhia_aerea').val('');
		$('#loc_cia').val('');
		$('#trecho_voo').val('');
		$('#data_ida').val('');
		$('#data_volta').val('');
		$('#valor_tarifa_aereo').val('');
		$('#valor_aereo').val('');
		$('#valor_alt_voo').val('');
		$('#taxa_du_rav').val('');
		$('#taxa_embarque').val('');
		$('#taxa_assento').val('');
		$('#alteracao_voo').val('Não');
		$('#taxa_alteracao').val('');
		$('#taxa_voo').val('');
		$('#credito').val('');
		$('#taxa_alt_percent').val('');
		$('#data_emiss_fat').val('');
		$('#data_venc_fat').val('');
		$('#data_pgto_fat').val('');
		$('#fatura_hospedagem').val('');
		$('#tarifa_hospedagem').val('');
		$('#hospedagem').val('');
		$('#all_inclusive').val('');
		$('#valor_hospedagem').val('');
		$('#taxa_hospedagem').val('');
		$('#total_hospedagem').val('');
		$('#hospedagem_percent').val('');
		$('#alteracao_hosp').val('Não');
		$('#data_check_in').val('');
		$('#data_check_out').val('');
		$('#agendado').val('Não');
		$('#reembolso').val('Não');
		$('#cancelado_voo').val('Não');
		$('#cancelado_hosp').val('Não');
		$('#transfer_voo').val('');
		$('#taxa_transfer').val('');
		$('#total_transfer').val('');
		$('#transfer_percent').val('');
		$('#valor_alimentacao').val('');
		$('#valor_trans_terrestre').val('');
		$('#observacoes').val('');
		$('#reembolso_TA').val('Não');
		$('#id_usuario').val(localStorage.id_usu);
	}
</script>