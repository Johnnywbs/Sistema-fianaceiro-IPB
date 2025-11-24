<?php
@session_start();
$tabela = 'pagar';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');
$data_de_vencimento = date('Y-m-d', strtotime($data_hoje . ' + 5 days'));

$id_empresa = $_POST['id_empresa'];

$data_inicial = @$_POST['data_inicial'];
$data_final = @$_POST['data_final'];
$status = @$_POST['status'];
$vencidas = @$_POST['vencidas'];

if($vencidas != ""){
	$query = $pdo->query("SELECT * FROM $tabela where data_venc < curDate() and pago != 'Sim' and empresa = '$id_empresa' order by data_venc desc");
}else{
	$query = $pdo->query("SELECT * FROM $tabela where data_venc >= '$data_inicial' and data_venc <= '$data_final' and pago LIKE '%$status%' and empresa = '$id_empresa' order by id desc");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th></th>				
				<th class="esc">Nº Documento</th>
				<th class="esc">Tp Doc.</th>
				<th class="esc">Valor</th>
				<th class="esc">Emissão</th>
				<th class="esc">Vencimento</th>	
				<th class="esc">Fornecedor</th>
				<th class="esc">Sub Centro</th>
				<th class="esc">Descrição</th>
				<th class="esc">TAG</th>
				<th>Anexo</th>				
				<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;
$pendentesF = 0;
$recebidasF = 0;
$vencidasF = 0;
$pendentes = 0;
$recebidas = 0;
$vencidas = 0;
for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
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
$valor_bruto = $res[$i]['valor_bruto'];
$valor_seguro = $res[$i]['valor_seguro'];
$pis_pasep = $res[$i]['pis_pasep'];
$cofins = $res[$i]['cofins'];
$csll = $res[$i]['csll'];
$irrf = $res[$i]['irrf'];
$iss = $res[$i]['iss'];
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
$classificacao = $res[$i]['classificacao'];
$reembolso = $res[$i]['reembolso'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];
$saida = $res[$i]['saida'];

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

$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_emissF = implode('/', array_reverse(explode('-', $data_emiss)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_pgto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_pgto = $res2[0]['nome'];
}else{
	$nome_usu_pgto = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM frequencias where dias = '$frequencia'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_frequencia = $res2[0]['frequencia'];
}else{
	$nome_frequencia = 'Indefinida';
}

$nome_format = 'Sem Referência!';
$nome_pessoa = 'Sem Referência!';
$pix_pessoa = 'Sem Referência!';

$query2 = $pdo->query("SELECT * FROM fornecedores where id = '$pessoa'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = ''.$res2[0]['nome'];
	if(($pos = strpos($nome_pessoa, "'", 0)) !== false){
		$nome_format = str_replace("'", "\'", $nome_pessoa);
	}
	else{
		$nome_format = ''.$res2[0]['nome'];
		$pix_pessoa = $res2[0]['chave_pix'];
	}
}



if($pago == 'Sim'){
	$classe_pago = 'text-verde';
	if(@$_SESSION['nivel'] != 'Administrador' and @$_SESSION['nivel'] != 'Gerência Técnica' and @$_SESSION['nivel'] != 'Gerência Financeira'){
		$ocultar = 'ocultar';
	}
	else{
		$ocultar = '';
	}
	$ocultar_usuario_comum = 'ocultar';
	$recebidas += $valor;
}else{
	$classe_pago = 'text-danger';
	$ocultar = '';	
	$pendentes += $valor;
	$ocultar_usuario_comum = '';
}

if($data_vencF == '00/00/0000'){
	$data_vencF = '';
}

$classe_debito = '';
if(strtotime($data_venc) < strtotime($data_hoje) and $data_venc != '0000-00-00' and $pago != 'Sim'){
	$classe_debito = 'text-danger';
	$vencidas += $valor;
}



$recebidasF = number_format($recebidas, 2, ',', '.');
$pendentesF = number_format($pendentes, 2, ',', '.');
$vencidasF = number_format($vencidas, 2, ',', '.');

echo <<<HTML
<tr class="{$classe_debito}">
<td><i class="fa fa-square {$classe_pago} mr-1"></i></td>
				<td class="esc">{$numero_documento}</td>
				<td class="esc">{$tipo_pagamento}</td>
				<td class="esc">R$ {$valorF}</td>
				<td class="esc">{$data_emissF}</td>
				<td class="esc">{$data_vencF}</td>
				<td class="esc">{$nome_pessoa}</td>
				<td class="esc">{$sub_centro}</td>
				<td class="esc">{$descricao_pgto}</td>
				<th class="esc">{$tag}</th>
				<td><a href="images/contas/{$arquivo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				<td>
					<big><a class="{$ocultar}" href="#" onclick="editar('{$id}', '{$numero_documento}', '{$serie_nf}','{$tipo_pagamento}','{$descricao_pgto}','{$data_emiss}','{$data_venc}','{$pessoa}','{$chave_nf}','{$cod_aut}','{$data_pgto}','{$valor}','{$base_icms}','{$valor_icms}','{$valor_bruto}','{$valor_seguro}','{$pis_pasep}','{$cofins}','{$csll}','{$irrf}','{$iss}','{$valor_frete}','{$desconto}','{$valor_ipi}','{$valor_nota}','{$compensacao}','{$frequencia}','{$centro_de_custo}','{$sub_centro}','{$classificacao}','{$reembolso}','{$tumb_arquivo}', '{$tag}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>
					
					<big><a class="{$ocultar}" href="#" onclick="arquivo('{$id}','{$numero_documento}','{$id}')" title="Inserir / Ver Serviços"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

					<big><a href="#" onclick="mostrar('{$id}', '{$numero_documento}', '{$serie_nf}','{$tipo_pagamento}','{$descricao_pgto}','{$data_emissF}','{$data_vencF}','{$nome_format}','{$chave_nf}','{$cod_aut}','{$data_lancF}','{$data_pgtoF}','{$valor}','{$base_icms}','{$valor_icms}','{$valor_bruto}','{$valor_seguro}','{$pis_pasep}','{$cofins}','{$csll}','{$irrf}','{$iss}','{$valor_frete}','{$desconto}','{$valor_ipi}','{$valor_nota}','{$compensacao}','{$nome_frequencia}','{$centro_de_custo}','{$sub_centro}','{$classificacao}','{$reembolso}','{$tumb_arquivo}','{$nome_usu_lanc}','{$nome_usu_pgto}','{$pago}','{$arquivo}', '{$tag}') " title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

HTML;
echo <<<HTML

		<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle {$ocultar}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>
			<ul class="dropdown-menu" style="margin-left:-230px;">
				<li>
					<div class="notification_desc2">
						<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
					</div>
				</li>										
			</ul>
		</li>
HTML;
echo <<<HTML

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle {$ocultar_usuario_comum}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square text-verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p style="color:#000">Confirmar Baixa da Conta? <a href="#" onclick="baixar('{$id}')"><span class="text-verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>
		
					

					<big><a href="../rel_sistema/recibo.php?id={$id}&imp=Não"  title="Ver Recibo" target="_blank"><i class="fa fa-file-pdf-o" style="color:red"></i></a></big>

				</td>  
</tr>
HTML;
}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
<br>
<div align="right">
<span style="margin-right: 25px">Contas Vencidas: <span class="text-danger">R$ {$vencidasF}</span></span> 
<span style="margin-right: 25px">Contas Pendentes: <span class="text-danger">R$ {$pendentesF}</span></span> 
<span style="margin-right: 25px">Contas Pagas: <span class="text-verde">R$ {$recebidasF}</span></span> 
</div>

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
			"stateSave": true,
    	});
    $('#tabela_filter label input').focus();
} );
</script>




<script type="text/javascript">
	function formatarReal(valor) {
    var valorFormatado = valor.replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    return 'R$ ' + valorFormatado;
}
	function editar(id, numero_documento, serie_nf, tipo_pagamento,descricao_pgto, data_emiss, data_venc, pessoa, chave_nf,cod_aut, data_pgto, valor,base_icms, valor_icms,
					valor_bruto, valor_seguro,pis_pasep,cofins,csll,irrf,iss,valor_frete,desconto,valor_ipi,valor_nota,compensacao,frequencia,centro_de_custo,sub_centro,classificacao,reembolso,arquivo,tag){

		
		$('#id').val(id);
		$('#numero_documento').val(numero_documento);
		$('#serie_nf').val(serie_nf);
		$('#descricao_pgto').val(descricao_pgto);
		$('#tipo_pagamento').val(tipo_pagamento).change();
		$('#data_emiss').val(data_emiss);
		$('#data_venc').val(data_venc);
		$('#chave_nf').val(chave_nf);
		$('#cod_aut').val(cod_aut);
		$('#data_pgto').val(data_pgto);
		$('#valor').val(formatarReal(valor));
		$('#tag').val(tag);
		$('#base_icms').val(formatarReal(base_icms));
		$('#valor_icms').val(formatarReal(valor_icms));
		$('#valor_bruto').val(formatarReal(valor_bruto));
		$('#valor_seguro').val(formatarReal(valor_seguro));
		$('#pis_pasep').val(formatarReal(pis_pasep));
		$('#cofins').val(formatarReal(cofins));
		$('#csll').val(formatarReal(csll));
		$('#irrf').val(formatarReal(irrf));
		$('#iss').val(formatarReal(iss));
		$('#valor_frete').val(formatarReal(valor_frete));
		$('#desconto').val(formatarReal(desconto));
		$('#valor_ipi').val(formatarReal(valor_ipi));
		$('#valor_nota').val(formatarReal(valor_nota));
		$('#compensacao').val(compensacao).change();
		$('#frequencia').val(frequencia);
		$('#centro_de_custo').val(centro_de_custo).change();
		$('#sub_centro').val(sub_centro).change();
		$('#reembolso').val(reembolso);
		$('#classificacao').val(classificacao);
		$('#id_usuario').val(localStorage.id_usu);
						

		$('#funcionario').val("").change();
		$('#fornecedor').val(pessoa).change();
		
		if(pessoa == 0){
			$('#fornecedor').val('').change();
		}
			
			

		$('#arquivo').val('');
		

		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
    	
        $('#target').attr('src','images/contas/' + arquivo);			
        		
	}



	function mostrar(id, numero_documento, serie_nf, tipo_pagamento, descricao_pgto, data_emiss, data_venc, pessoa, chave_nf,cod_aut, data_lanc, data_pgto, valor,base_icms, valor_icms,
					valor_bruto, valor_seguro,pis_pasep,cofins,csll,irrf,iss,valor_frete,desconto,valor_ipi,valor_nota,compensacao,frequencia,centro_de_custo,sub_centro,classificacao,reembolso,arquivo, usuario_lanc, usuario_pgto, pago, link,tag){

		
		if(data_pgto == "00/00/0000" || data_pgto == ""){
			data_pgto = 'Pagamento nâo efetuado';
		}


		$('#numero_documento_mostrar').text(numero_documento);
		$('#serie_nf_mostrar').text(serie_nf);
		$('#tipo_pagamento_mostrar').text(tipo_pagamento);
		$('#descricao_pgto_mostrar').text(descricao_pgto);
		$('#emiss_mostrar').text(data_emiss);
		$('#venc_mostrar').text(data_venc);
		$('#pessoa_mostrar').text(pessoa);
		$('#chave_nf_mostrar').text(chave_nf);
		$('#cod_aut_mostrar').text(cod_aut);
		$('#data_lanc_mostrar').text(data_lanc);
		$('#pgto_mostrar').text(data_pgto);
		$('#valor_mostrar').text(formatarReal(valor));
		$('#base_icms_mostrar').text(formatarReal(base_icms));
		$('#valor_icms_mostrar').text(formatarReal(valor_icms));
		$('#valor_bruto_mostrar').text(formatarReal(valor_bruto));
		$('#valor_seguro_mostrar').text(formatarReal(valor_seguro));
		$('#pis_pasep_mostrar').text(formatarReal(pis_pasep));
		$('#cofins_mostrar').text(formatarReal(cofins));
		$('#csll_mostrar').text(formatarReal(csll));
		$('#irrf_mostrar').text(formatarReal(irrf));
		$('#iss_mostrar').text(formatarReal(iss));
		$('#valor_frete_mostrar').text(formatarReal(valor_frete));
		$('#desconto_mostrar').text(formatarReal(desconto));
		$('#valor_ipi_mostrar').text(formatarReal(valor_ipi));
		$('#valor_nota_mostrar').text(formatarReal(valor_nota));
		$('#usu_lanc_mostrar').text(usuario_lanc);	
		$('#usu_pgto_mostrar').text(usuario_pgto);	
		$('#freq_mostrar').text(frequencia);
		$('#centro_de_custo_mostrar').text(centro_de_custo);	
		$('#sub_centro_mostrar').text(sub_centro);
		$('#compensacao_mostrar').text(compensacao);
		$('#reembolso_mostrar').text(reembolso);
		$('#classificacao_mostrar').text(classificacao);
		$('#tag_mostrar').text(tag);

		$('#pago_mostrar').text(pago);
		$('#mostrar_titulo').text(numero_documento);
		$('#link_arquivo').attr('href','images/contas/' + link);
		$('#modalMostrar').modal('show');		
		$('#target_mostrar').attr('src','images/contas/' + arquivo);
		
		listarArquivos(id,numero_documento,id);
        	
	}

	function limparCampos(){
		$('#id').val('');
		$('#numero_documento').val('');
		$('#serie_nf').val('');
		$('#descricao_pgto').val('');
		$('#tipo_pagamento').val('');		
		$('#base_icms').val('');
		$('#valor_icms').val('');		
		$('#valor_bruto').val('');
		$('#numero_nota').val('');		
		$('#valor_seguro').val('');
		$('#pis_pasep').val('');
		$('#cofins').val('');		
		$('#csll').val('');
		$('#irrf').val('');		
		$('#iss').val('');	
		$('#valor_frete').val('');		
		$('#desconto').val('');
		$('#valor_ipi').val('');		
		$('#valor_nota').val('');	
		$('#valor').val('');
		$('#tag').val('');	
		$('#data_venc').val('<?=$data_de_vencimento?>');
		$('#data_emiss').val('<?=$data_hoje?>');
		$('#data_pgto').val('');
		$('#arquivo').val('');
		$('#fornecedor').val('').change();
		$('#target').attr('src','images/contas/sem-foto.png');
		$('#pessoa').val('').change();
		$('#centro_de_custo').val('').change();
		$('#sub_centro').val('').change();
		$('#frequencia').val('0').change();
		$('#compencacao').val('Não').change();
		$('#reembolso').val('Não').change();
		$('#classificacao').val('Despesa Variável');
		$('#chave_nf').val('');
		$('#cod_aut').val('');

	}



	function arquivo(id, numero_documento_ref,id_ref){
		
		$('#titulo_arquivo').text(numero_documento_ref);
		$('#id_arquivo').val(id);
		$('#id_usuario_arquivo').val(localStorage.id_usu);
		$('#numero_documento_ref').val(numero_documento_ref);
		$('#id_ref').val(id_ref);
		$('#id_empresa_arquivo').val(localStorage.id_empresa);
	
		$('#modalArquivos').modal('show');
		listarArquivos(id,numero_documento_ref,id_ref);
		limparArquivos();
	}

	function limparArquivos(){
		$('#nome_arquivo').val('');
		$('#data_validade').val('');
		$('#foto-arquivos').val('');
		$('#id_arquivo').val('');
		$('#numero_documento_ref').val('');
		$('#descricao_prod').val('');
		$('#quantidade').val('');
		$('#valor_desconto').val('');		
		$('#valor_unit').val('');
		$('#classificacao_prod').val('Despesa Variável').change();		
		$('#centro_de_custo_prod').val('').change();
		$('#sub_centro_prod').val('').change();		
		$('#target').attr("src", "images/arquivos/sem-foto.png");
	}


	

</script>