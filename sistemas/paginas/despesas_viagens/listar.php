<?php
$tabela = 'despesas_viagens';
require_once("../../../conexao.php");

$id_empresa = $_POST['id_empresa'];

$data_inicial = @$_POST['data_inicial'];
$data_final = @$_POST['data_final'];
$status = @$_POST['status'];
$vencidas = @$_POST['vencidas'];

if($vencidas != ""){
	$query = $pdo->query("SELECT * FROM $tabela where data_venc_fat < curDate() order by data_venc_fat desc");
}else{
	$query = $pdo->query("SELECT * FROM $tabela where data_venc_fat >= '$data_inicial' and data_venc_fat <= '$data_final' order by id desc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr>
			<th class="esc">Num. Fatura</th>
			<th class="esc">Descrição</th>
			<th class="esc">Fornecedor</th>
			<th class="esc">Data Emissão</th>
			<th class="esc">Data Vencimento</th>
			<th class="esc">Data Pagamento</th>
			<th class="esc">Valor Fatura</th>
			<th>Anexo</th>
			<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;
for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$descricao_viagem = $res[$i]['descricao_viagem'];
$fornecedor = $res[$i]['fornecedor'];
$num_fatura = $res[$i]['num_fatura'];
$valor_fatura = $res[$i]['valor_fatura'];
$responsavel = $res[$i]['responsavel'];
$usuario = $res[$i]['usuario'];
$data_emiss_fat = $res[$i]['data_emiss_fat'];
$data_venc_fat = $res[$i]['data_venc_fat'];
$data_pgto_fat = $res[$i]['data_pgto_fat'];
$arquivo = $res[$i]['arquivo'];

$usuario_lanc = $res[$i]['usuario_lanc'];
//extensão do arquivo
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx'){
	$tumb_arquivo = 'word.png';
}else{
	$tumb_arquivo = $arquivo;
}

$valor_faturaF = number_format($valor_fatura, 2, ',', '.');
$data_emiss_fatF = implode('/', array_reverse(explode('-', $data_emiss_fat)));
$data_venc_fatF = implode('/', array_reverse(explode('-', $data_venc_fat)));
$data_pgto_fatF = implode('/', array_reverse(explode('-', $data_pgto_fat)));

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


$nome_format = 'Sem Referência!';
$nome_pessoa = 'Sem Referência!';

$query2 = $pdo->query("SELECT * FROM fornecedores where id = '$fornecedor'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = ''.$res2[0]['nome'];
	if(($pos = strpos($nome_pessoa, "'", 0)) !== false){
		$nome_format = str_replace("'", "\'", $nome_pessoa);
	}
	else{
		$nome_format = ''.$res2[0]['nome'];
	}
}

echo <<<HTML
<tr class="">
				<td class="esc">{$num_fatura}</td>
				<td class="esc">{$descricao_viagem}</td>
				<td class="esc">{$nome_pessoa}</td>
				<td class="esc">{$data_emiss_fatF}</td>
				<td class="esc">{$data_venc_fatF}</td>
				<td class="esc">{$data_pgto_fatF}</td>
				<td class="esc">R$ {$valor_faturaF}</td>
				<td><a href="images/contas/{$arquivo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				<td>
<!--					<big><a class="" href="#" onclick="editar('{$id}', '{$descricao_viagem}', '{$fornecedor}','{$num_fatura}','{$valor_fatura}','{$responsavel}','{$usuario}','{$data_emiss_fat}','{$data_venc_fat}','{$data_pgto_fat}','{$tumb_arquivo}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big> -->
					<big><a class="" href="#" onclick="arquivo('{$id}','{$num_fatura}')" title="Inserir Produtos/Serviços"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

					<big><a href="#" onclick="mostrar('{$id}','{$descricao_viagem}', '{$nome_format}','{$num_fatura}','{$valor_faturaF}','{$nome_responsavel}','{$nome_usuario}','{$data_emiss_fatF}','{$data_venc_fatF}','{$data_pgto_fatF}','{$tumb_arquivo}','{$nome_usu_lanc}','{$arquivo}') " title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

HTML;
echo <<<HTML

		<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>
			<ul class="dropdown-menu" style="margin-left:-230px;">
				<li>
					<div class="notification_desc2">
						<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
					</div>
				</li>										
			</ul>
		</li>
HTML;
}
echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
<br>


</small>
HTML;

}else{
	echo '<small>Não possui registros cadastrados!</small>';
}

 ?>




 <script type="text/javascript">
	$(document).ready( function () {
    $('#tabela').DataTable({
    		"ordering": false,
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>




<script type="text/javascript">
	function formatarReal(valor) {
		var valorFormatado = valor.replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
		return 'R$ ' + valorFormatado;
	}
	function editar(id, descricao_viagem, fornecedor,num_fatura,valor_fatura,responsavel,usuario,
	data_emiss_fat, data_venc_fat,data_pgto_fat,arquivo){

		
		$('#id').val(id);
		$('#descricao_viagem').val(descricao_viagem);
		$('#fornecedor').val(fornecedor).change();
		$('#num_fatura').val(num_fatura);
		$('#valor_fatura').val(formatarReal(valor_fatura));
		$('#responsavel').val(responsavel).change();
		$('#usuario').val(usuario).change();
		$('#data_emiss_fat').val(data_emiss_fat);
		$('#data_venc_fat').val(data_venc_fat);
		$('#data_pgto_fat').val(data_pgto_fat);
		$('#id_usuario').val(localStorage.id_usu);

		if(fornecedor == 0){
			$('#fornecedor').val('').change();
		}
			

		$('#arquivo').val('');
		

		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
    	
        $('#target').attr('src','images/contas/' + arquivo);			
        		
	}



	function mostrar(id, descricao_viagem, fornecedor,num_fatura,valor_fatura,responsavel,usuario,
	data_emiss_fat, data_venc_fat,data_pgto_fat,arquivo, usuario_lanc,link){

		
		if(data_pgto_fat == "00/00/0000" || data_pgto_fat == ""){
			data_pgto_fat = 'Pagamento nâo efetuado';
		}


		$('#id_fatura_mostrar').text(id);
		$('#descricao_viagem_mostrar').text(descricao_viagem);
		$('#fornecedor_mostrar').text(fornecedor);
		$('#usuario_mostrar').text(usuario);
		$('#num_fatura_mostrar').text(num_fatura);
		$('#valor_fatura_mostrar').text(valor_fatura);
		$('#data_emiss_fat_mostrar').text(data_emiss_fat);
		$('#data_venc_fat_mostrar').text(data_venc_fat);
		$('#data_pgto_fat_mostra').text(data_pgto_fat);

		$('#usu_lanc_mostrar').text(usuario_lanc);

		$('#responsavel_mostrar').text(responsavel);

		$('#mostrar_titulo').text(num_fatura);


		$('#link_arquivo').attr('href','images/contas/' + link);
		$('#modalMostrar').modal('show');		
		$('#target_mostrar').attr('src','images/contas/' + arquivo);

        listarArquivos(id,num_fatura);
	}

	function limparCampos(){
		$('#id').val('');
		$('#descricao_viagem').val('');
		$('#fornecedor').val('').change();
		$('#num_fatura').val('');
		$('#valor_fatura').val('');
		$('#responsavel').val('').change();
		$('#usuario').val('').change();
		$('#data_emiss_fat').val('');
		$('#data_venc_fat').val('');
		$('#data_pgto_fat').val('');

		$('#arquivo').val('');
		$('#target').attr('src','images/contas/sem-foto.png');
	}



	function arquivo(id,num_fatura){
		
		$('#titulo_arquivo').text(num_fatura);
		$('#id_arquivo').val(id);
		$('#id_usuario_arquivo').val(localStorage.id_usu);
		$('#num_fatura_det').val(num_fatura);
		$('#id_empresa_arquivo').val(localStorage.id_empresa);
		$('#target-arquivos').attr("src", "images/arquivos/sem-foto.png");	
		$('#modalArquivos').modal('show');
		listarArquivos(id,num_fatura);
		limparArquivos();
	}

	function limparArquivos(){
		$('#nome_arquivo').val('');
		$('#data_validade').val('');
		$('#foto-arquivos').val('');
		$('#descricao_prod').val('');
		$('#quantidade').val('');
		$('#valor_unit').val('');
		$('#valor_desconto').val('');
		$('#target').attr("src", "images/arquivos/sem-foto.png");
	}


	

</script>