<?php 
$tabela = 'detalhes_nota';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id = $_POST['id'];
$numero_documento_ref = $_POST['chave'];
$id_ref = $_POST['id_ref'];

$query = $pdo->query("SELECT * FROM $tabela where numero_documento_ref = '$numero_documento_ref' and id_ref = '$id_ref' order by id desc");
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
$chave_ref = $res[$i]['numero_documento_ref'];
$descricao_prod = $res[$i]['descricao'];
$quantidade = $res[$i]['quantidade'];
$valor_desconto = $res[$i]['desconto'];
$valor_unit = $res[$i]['valor_unitario'];
$classificacao_prod = $res[$i]['classificacao'];
$centro_de_custo = $res[$i]['centro_de_custo'];
$sub_centro = $res[$i]['sub_centro'];

echo <<<HTML
<tr>
	<td>{$descricao_prod}</td>
	<td class="esc">{$quantidade}</td>
	<td class="esc">{$valor_unit}</td>
	<td class="esc">{$valor_desconto}</td>
	<td class="esc">{$centro_de_custo}</td>
	<td class="esc">{$sub_centro}</td>
	<td class="esc">{$classificacao_prod}</td>
</tr>
HTML;
if($data_pgto == '0000-00-00'){
}

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