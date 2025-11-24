<?php 
$tabela = 'detalhes_nota';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id = $_POST['id'];
$numero_documento_ref = $_POST['chave'];
$id_ref = $_POST['id_ref'];

$query = $pdo->query("SELECT * FROM $tabela where id_ref = '$id_ref' order by id desc");
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
$data_pgto = $res[$i]['data_pgto'];

$valor_descontoF = number_format($valor_desconto, 2, ',', '.');
$valor_unitF = number_format($valor_unit, 2, ',', '.');
echo <<<HTML
<tr>
<td>{$descricao_prod}</td>
<td class="esc">{$quantidade}</td>
<td class="esc">R$ {$valor_unitF}</td>
<td class="esc">R$ {$valor_descontoF}</td>
<td class="esc">{$centro_de_custo}</td>
<td class="esc">{$sub_centro}</td>
<td class="esc">{$classificacao_prod}</td>
<td>
<big><a class="" href="#" onclick="editar_produtos('{$id}','{$chave_ref}','{$descricao_prod}','{$quantidade}','{$valor_desconto}','{$valor_unit}','{$classificacao_prod}','{$centro_de_custo}','{$sub_centro}','{$data_pgto}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>
HTML;
echo <<< HTML
	<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

			<ul class="dropdown-menu" style="margin-left:-230px;">
			<li>
			<div class="notification_desc2">
			<p>Confirmar Exclusão? <a href="#" onclick="excluirArquivo('{$id}','{$chave_ref}')"><span class="text-danger">Sim</span></a></p>
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
function editar_produtos(id,chave_ref,descricao_prod,quantidade,valor_desconto,valor_unit,classificacao_prod,centro_de_custo,sub_centro,data_pgto){

		
		$('#id_arquivo').val(id);
		$('#numero_documento_ref').val(chave_ref);
		$('#descricao_prod').val(descricao_prod);
		$('#quantidade').val(quantidade);
		$('#valor_desconto').val(formatarReal(valor_desconto));
		$('#valor_unit').val(formatarReal(valor_unit));
		$('#classificacao_prod').val(classificacao_prod);
		$('#centro_de_custo_prod').val(centro_de_custo).change();
		$('#sub_centro_prod').val(sub_centro).change();
		$('#data_pgto_produto').val(data_pgto);
		$('#id_usuario').val(localStorage.id_usu);

			
		

		$('#titulo_inserir').text('Editar Registro');
		$('#mensagem').text('');			
        		
	}
</script>