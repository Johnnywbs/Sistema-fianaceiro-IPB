<?php 
$tabela = 'detalhes_nota';
require_once("../../../conexao.php");

$id_empresa = $_POST['id_empresa'];
$ano = $_POST['ano_busca'];
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>SUB-CENTRO</th>
	<th class="esc">JANEIRO</th>
	<th class="esc">FEVEREIRO</th>
	<th class="esc">MARÇO</th>
	<th class="esc">ABRIL</th>
    <th class="esc">MAIO</th>
	<th class="esc">JUNHO</th>	
	<th class="esc">JULHO</th>	
    <th class="esc">AGOSTO</th>
	<th class="esc">SETEMBRO</th>
	<th class="esc">OUTUBRO</th>
    <th class="esc">NOVEMBRO</th>	
	<th>DEZEMBRO</th>
	</tr> 
	</thead> 
	<tbody>
HTML;
// Lista de contas mês a mês para o centro de custo: Administrativo

$sub_centro = array();
$query2 = $pdo->query("SELECT * FROM sub_centros where centro_de_custo = 'Centro de Simulação'  order by nome");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

foreach ($res2 as $row) {
	$sub_centro[] = $row;
}



for($i = 0; $i < @count($sub_centro); $i++){
	$nome_sub_centro = $sub_centro[$i]['nome'];

	$query = $pdo->query("SELECT * FROM $tabela where  data_pgto != '' and YEAR(data_pgto) = $ano and sub_centro = '$nome_sub_centro'  order by data_pgto desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

	$janeiro = array(); $fevereiro = array(); $marco = array(); $abril = array(); $maio = array(); $junho = array();
	$julho = array(); $agosto = array(); $setembro = array(); $outubro = array(); $novembro = array();
	$dezembro = array();
	foreach ($res as $row) {
		if (date('m', strtotime($row['data_pgto'])) == '01') {
			$janeiro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '02') {
			$fevereiro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '03') {
			$marco[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '04') {
			$abril[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '05') {
			$maio[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '06') {
			$junho[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '07') {
			$julho[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '08') {
			$agosto[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '09') {
			$setembro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '10') {
			$outubro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '11') {
			$novembro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
		if (date('m', strtotime($row['data_pgto'])) == '12') {
			$dezembro[] = $row['valor_unitario']*$row['quantidade'] - $row['desconto'];
		}
	}


	if(@count($janeiro) < 1){
		$contas_jan = '';
	}else{
		$contas_jan = array_sum($janeiro);
		$contas_jan = 'R$ '.str_replace('.', ',', $contas_jan);
	}

	if(@count($fevereiro) < 1){
		$contas_fev = '';
	}else{
		$contas_fev = number_format(array_sum($fevereiro), 2, ',', '.');
		$contas_fev = 'R$ '.str_replace('', '', $contas_fev);
	}

	if(@count($marco) < 1){
		$contas_mar = '';
	}else{
		$contas_mar = array_sum($marco);
		$contas_mar = 'R$ '.str_replace('.', ',', $contas_mar);
	}

	if(@count($abril) < 1){
		$contas_abr ='';
	}else{
		$contas_abr = array_sum($abril);
		$contas_abr = 'R$ '.str_replace('.', ',', $contas_abr);
	}

	if(@count($maio) < 1){
		$contas_mai ='';
	}else{
		$contas_mai = array_sum($maio);
		$contas_mai = 'R$ '.str_replace('.', ',', $contas_mai);
	}

	if(@count($junho) < 1){
		$contas_jun ='';
	}else{
		$contas_jun = array_sum($junho);
		$contas_jun = 'R$ '.str_replace('.', ',', $contas_jun);
	}

	if(@count($julho) < 1){
		$contas_jul ='';
	}else{
		$contas_jul = array_sum($julho);
		$contas_jul = 'R$ '.str_replace('.', ',', $contas_jul);
	}

	if(@count($agosto) < 1){
		$contas_ago ='';
	}else{
		$contas_ago = array_sum($agosto);
		$contas_ago = 'R$ '.str_replace('.', ',', $contas_ago);
	}

	if(@count($setembro) < 1){
		$contas_set ='';
	}else{
		$contas_set = array_sum($setembro);
		$contas_set = 'R$ '.str_replace('.', ',', $contas_set);
	}

	if(@count($outubro) < 1){
		$contas_out ='';
	}else{
		$contas_out = array_sum($outubro);
		$contas_out = 'R$ '.str_replace('.', ',', $contas_out);
	}
	
	if(@count($novembro) < 1){
		$contas_nov ='';
	}else{
		$contas_nov = array_sum($novembro);
		$contas_nov = 'R$ '.str_replace('.', ',', $contas_nov);
	}

	if(@count($dezembro) < 1){
		$contas_dez ='';
	}else{
		$contas_dez = array_sum($dezembro);
		$contas_dez = 'R$ '.str_replace('.', ',', $contas_dez);
	}


echo <<<HTML
	<tr style="">
	<th class="esc">{$nome_sub_centro}</th>
	<td class="esc">{$contas_jan}</td>
	<td class="esc">{$contas_fev}</td>
	<td class="esc">{$contas_mar}</td>
	<td class="esc">{$contas_abr}</td>
	<td class="esc">{$contas_mai}</td>
	<td class="esc">{$contas_jun}</td>
	<td class="esc">{$contas_jul}</td>
	<td class="esc">{$contas_ago}</td>
	<td class="esc">{$contas_set}</td>
	<td class="esc">{$contas_out}</td>
	<td class="esc">{$contas_nov}</td>
	<td class="esc">{$contas_dez}</td>
HTML;
}