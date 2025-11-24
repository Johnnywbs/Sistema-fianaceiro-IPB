<?php 
$tabela = 'detalhes_viagem';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id_viagem = $_POST['id_viagem'];

$query = $pdo->query("SELECT * FROM detalhes_viagem where id_viagem = '$id_viagem' and alteracao = 'Não' order by id_viagem asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

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
$valor_aereo = number_format($valor_aereo, 2, ',', '.');

$valor_tarifa_aereo = $res[$i]['valor_tarifa_aereo'];
$valor_tarifa_aereo = number_format($valor_tarifa_aereo, 2, ',', '.');

$valor_alt_voo = $res[$i]['valor_alt_voo'];
$valor_alt_voo = number_format($valor_alt_voo, 2, ',', '.');

$taxa_du_rav = $res[$i]['taxa_du_rav'];
$taxa_du_rav = number_format($taxa_du_rav, 2, ',', '.');

$taxa_embarque = $res[$i]['taxa_embarque'];
$taxa_embarque = number_format($taxa_embarque, 2, ',', '.');

$taxa_assento = $res[$i]['taxa_assento'];
$taxa_assento = number_format($taxa_assento, 2, ',', '.');

$alteracao_voo = $res[$i]['alteracao_voo'];
$alteracao_hosp = $res[$i]['alteracao_hosp'];
$alteracao = $res[$i]['alteracao'];

$taxa_alteracao = $res[$i]['taxa_alteracao'];
$taxa_alteracao = number_format($taxa_alteracao, 2, ',', '.');

$taxa_voo = $res[$i]['taxa_voo'];
$taxa_voo = number_format($taxa_voo, 2, ',', '.');

$credito = $res[$i]['credito'];
$credito = number_format($credito, 2, ',', '.');

$data_emiss_fat = $res[$i]['data_emiss_fat'];
$data_venc_fat = $res[$i]['data_venc_fat'];
$data_pgto_fat = $res[$i]['data_pgto_fat'];
$fatura_hospedagem = $res[$i]['fatura_hospedagem'];

$tarifa_hospedagem = $res[$i]['tarifa_hospedagem'];
$tarifa_hospedagem = number_format($tarifa_hospedagem, 2, ',', '.');

$hospedagem = $res[$i]['hospedagem'];

$all_inclusive = $res[$i]['all_inclusive'];
$all_inclusive = number_format($all_inclusive, 2, ',', '.');

$valor_hospedagem = $res[$i]['valor_hospedagem'];
$valor_hospedagem = number_format($valor_hospedagem, 2, ',', '.');

$taxa_hospedagem = $res[$i]['taxa_hospedagem'];
$taxa_hospedagem = number_format($taxa_hospedagem, 2, ',', '.');

$data_check_in = $res[$i]['data_check_in'];
$data_check_out = $res[$i]['data_check_out'];

$total_hospedagem = $res[$i]['total_hospedagem'];
$total_hospedagem = number_format($total_hospedagem, 2, ',', '.');

$agendado = $res[$i]['agendado'];
$cancelado_voo = $res[$i]['cancelado_voo'];
$cancelado_hosp= $res[$i]['cancelado_hosp'];
$reembolso = $res[$i]['reembolso'];
$utilizado = $res[$i]['utilizado'];

$transfer = $res[$i]['transfer_voo'];
$transfer = number_format($transfer, 2, ',', '.');

$taxa_transfer = $res[$i]['taxa_transfer'];
$taxa_transfer = number_format($taxa_transfer, 2, ',', '.');

$usuario_lanc = $res[$i]['usuario_lanc'];


$total_transfer = $res[$i]['total_transfer'];
$total_transfer = number_format($total_transfer, 2, ',', '.');

$valor_alimentacao = $res[$i]['valor_alimentacao'];
$valor_alimentacao = number_format($valor_alimentacao, 2, ',', '.');

$valor_trans_terrestre = $res[$i]['valor_trans_terrestre'];
$valor_trans_terrestre = number_format($valor_trans_terrestre, 2, ',', '.');

$observacoes = $res[$i]['observacoes'];
$reembolso_TA = $res[$i]['reembolso_TA'];


$transfer_percent = 0;
$transfer_percent = number_format($transfer_percent, 2, ',', '.');


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
}}}
 ?>
<script type="text/javascript">

	
    if("<?php echo $data_pgto_fat; ?>" == "00/00/0000" || "<?php echo $data_pgto_fat; ?>" == ""){
        data_pgto_fat = 'Pagamento nâo efetuado';
    }


    $('#id').val("<?php echo $id?>");
    $('#num_fatura').val("<?php echo $num_fatura?>");
    $('#responsavel_viagem').val("<?php echo$responsavel?>").change();
    $('#usuario_viagem').val("<?php echo $usuario?>").change();
    $('#centro_de_custo_viagem').val("<?php echo $centro_de_custo?>").change();
    $('#sub_centro_viagem').val("<?php echo $sub_centro?>").change();
    $('#companhia_aerea').val("<?php echo $loc_cia?>");
    $('#loc_cia').val("<?php echo $companhia_aerea?>");
    $('#trecho_voo').val("<?php echo $trecho_voo?>");
    $('#data_ida').val("<?php echo $data_ida?>");
    $('#data_volta').val("<?php echo $data_volta?>");
    $('#valor_tarifa_aereo').val("<?php echo 'R$ '.$valor_tarifa_aereo?>");
    $('#valor_aereo').val("<?php echo 'R$ '.$valor_aereo?>");
    $('#valor_alt_voo').val("<?php echo 'R$ '.$valor_alt_voo?>");
    $('#taxa_du_rav').val("<?php echo 'R$ '.$taxa_du_rav?>");
    $('#taxa_embarque').val("<?php echo 'R$ '.$taxa_embarque?>");
    $('#taxa_assento').val("<?php echo 'R$ '.$taxa_assento?>");
    $('#alteracao_voo').val('Não');
    $('#taxa_alt_percent').val(((parseFloat(taxa_du_rav)/parseFloat(valor_tarifa_aereo))*100).toFixed(2));
    $('#taxa_alteracao').val("<?php echo 'R$ '.$taxa_alteracao?>");
    $('#taxa_voo').val("<?php echo 'R$ '.$taxa_voo?>");
    $('#credito').val("<?php echo 'R$ '.$credito?>");
    $('#fatura_hospedagem').val("<?php echo $fatura_hospedagem?>");
    $('#tarifa_hospedagem').val("<?php echo 'R$ '.$tarifa_hospedagem?>");
    $('#hospedagem').val("<?php echo $hospedagem?>");
    $('#all_inclusive').val("<?php echo 'R$ '.$all_inclusive?>");
    $('#valor_hospedagem').val("<?php echo 'R$ '.$valor_hospedagem?>");
    $('#taxa_hospedagem').val("<?php echo 'R$ '.$taxa_hospedagem?>");
    $('#total_hospedagem').val("<?php echo 'R$ '.$total_hospedagem?>");
    $('#hospedagem_percent').val(((parseFloat(taxa_hospedagem)/parseFloat(valor_hospedagem))*100).toFixed(2));
    $('#alteracao_hosp').val('Não');
    $('#data_check_in').val("<?php echo $data_check_in?>");
    $('#data_check_out').val("<?php echo $data_check_out?>");
    $('#agendado').val("<?php echo $agendado?>");
    $('#cancelado_voo').val("<?php echo $cancelado_voo?>");
    $('#cancelado_hosp').val("<?php echo $cancelado_hosp?>");
    $('#reembolso').val("<?php echo $reembolso?>");
    $('#utilizado').val("<?php echo $utilizado?>");
    $('#transfer_voo').val("<?php echo 'R$ '.$transfer?>");
    $('#taxa_transfer').val("<?php echo 'R$ '.$taxa_transfer?>");
    $('#transfer_percent').val("<?php echo $transfer_percent?>");
    $('#total_transfer').val("<?php echo 'R$ '.$total_transfer?>");
    $('#valor_alimentacao').val("<?php echo 'R$ '.$valor_alimentacao?>");
    $('#valor_trans_terrestre').val("<?php echo 'R$ '.$valor_trans_terrestre?>");
    $('#observacoes').val("<?php echo $observacoes?>");
    $('#reembolso_TA').val("<?php echo $reembolso_TA?>");
    $('#id_usuario').val(localStorage.id_usu);

</script>