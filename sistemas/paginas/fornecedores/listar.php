<?php 
$tabela = 'fornecedores';
require_once("../../../conexao.php");

$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM $tabela where empresa = '$id_empresa' order by nome asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Email</th>	
	<th class="esc">CPF / CNPJ</th>	
	<th class="esc">Natureza</th>
	<th class="esc">Atividade Economica</th>
	<th>Ações</th>
	</tr> 
	</thead>
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
$nome = $res[$i]["nome"];
$telefone = $res[$i]['telefone'];
$email = $res[$i]['email'];
$porte = $res[$i]['porte'];
$titulo = $res[$i]['titulo'];
$inscricao_estadual = $res[$i]['inscricao_estadual'];
$inscricao_municipal = $res[$i]['inscricao_municipal'];
$atividade_economica = $res[$i]['atividade_economica'];
$natureza = $res[$i]['natureza'];
$cpf = $res[$i]['cpf'];
$pessoa = $res[$i]['pessoa'];
$logradouro = $res[$i]['logradouro'];
$num_casa = $res[$i]['num_casa'];
$complemento = $res[$i]['complemento'];
$cep = $res[$i]['cep'];
$bairro = $res[$i]['bairro'];
$municipio = $res[$i]['municipio'];
$uf = $res[$i]['uf'];
$nome_banco = $res[$i]['nome_banco'];
$numero_banco = $res[$i]['numero_banco'];
$agencia_fornecedor = $res[$i]['agencia_fornecedor'];
$tipo_conta = $res[$i]['tipo_conta'];
$numero_conta = $res[$i]['numero_conta'];
$id = $res[$i]['id'];
$chave_pix = $res[$i]['chave_pix'];
$data_cad = $res[$i]['data'];

$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
if(($pos = strpos($nome, "'", 0)) !== false){
	$nome_format = str_replace("'", "\'", $nome);
}
else{
	$nome_format = $nome;
}

echo <<<HTML
<tr>
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$cpf}</td>
<td class="esc">{$natureza}</td>
<td class="esc">{$atividade_economica}</td>
<td>

<big><a href="#" onclick="editar('{$id}','{$nome_format}','{$email}','{$telefone}','{$porte}','{$titulo}','{$inscricao_estadual}','{$inscricao_municipal}','{$atividade_economica}',
								 '{$natureza}','{$cpf}','{$pessoa}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}',
								 '{$municipio}','{$uf}','{$nome_banco}','{$numero_banco}','{$agencia_fornecedor}','{$tipo_conta}','{$numero_conta}','{$chave_pix}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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


<big><a href="#" onclick="mostrar('{$nome_format}','{$email}','{$telefone}','{$porte}','{$titulo}','{$inscricao_estadual}','{$inscricao_municipal}','{$atividade_economica}',
								 '{$natureza}','{$cpf}','{$data_cadF}','{$pessoa}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}',
								 '{$municipio}','{$uf}','{$nome_banco}','{$numero_banco}','{$agencia_fornecedor}','{$tipo_conta}','{$numero_conta}','{$chave_pix}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>





</td>
</tr>
HTML;
}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
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
	function editar(id, nome, email, telefone,porte,titulo,inscricao_estadual,inscricao_municipal,atividade_economica, natureza,cpf,pessoa,logradouro,num_casa,complemento,
					cep,bairro,municipio,uf,nome_banco, numero_banco, agencia_fornecedor,tipo_conta, numero_conta, chave_pix){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#telefone').val(telefone);
		$('#porte').val(porte);
		$('#titulo').val(titulo);
		$('#inscricao_estadual').val(inscricao_estadual);
		$('#inscricao_municipal').val(inscricao_municipal);
		$('#atividade_economica').val(atividade_economica);
		$('#natureza').val(natureza);
		$('#cpf').val(cpf);	
		$('#pessoa').val(pessoa).change();
		$('#logradouro').val(logradouro);
		$('#num_casa').val(num_casa);
		$('#complemento').val(complemento);
		$('#cep').val(cep);
		$('#bairro').val(bairro);
		$('#municipio').val(municipio);
		$('#uf').val(uf);
		$('#nome_banco').val(nome_banco);
		$('#numero_banco').val(numero_banco);
		$('#agencia_fornecedor').val(agencia_fornecedor);
		$('#tipo_conta').val(tipo_conta);
		$('#numero_conta').val(numero_conta);
		$('#chave_pix').val(chave_pix);	

	
		
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}


	function mostrar(nome, email, telefone, porte, titulo,inscricao_estadual,inscricao_municipal, atividade_economica, natureza, cpf, data_cad, pessoa, logradouro, num_casa,
					 complemento, cep, bairro, municipio, uf,nome_banco, numero_banco, agencia_fornecedor,tipo_conta, numero_conta, chave_pix){
		
		$('#nome_dados_titulo').text(nome);
		$('#nome_dados').text(nome);
		$('#email_dados').text(email);
		$('#telefone_dados').text(telefone);
		$('#porte_dados').text(porte);
		$('#titulo_dados').text(titulo);
		$('#inscricao_estadual_dados').text(inscricao_estadual);
		$('#inscricao_municipal_dados').text(inscricao_municipal);
		$('#atividade_economica_dados').text(atividade_economica);
		$('#natureza_dados').text(natureza);
		$('#cpf_dados').text(cpf);
		$('#data_cad_dados').text(data_cad);
		$('#pessoa_dados').text(pessoa);

		$('#logradouro_dados').text(logradouro);
		$('#num_casa_dados').text(num_casa);
		$('#complemento_dados').text(complemento);
		$('#cep_dados').text(cep);
		$('#bairro_dados').text(bairro);
		$('#municipio_dados').text(municipio);
		$('#uf_dados').text(uf);

		$('#nome_banco_dados').text(nome_banco);
		$('#numero_banco_dados').text(numero_banco);
		$('#agencia_fornecedor_dados').text(agencia_fornecedor);
		$('#tipo_conta_dados').text(tipo_conta);
		$('#numero_conta_dados').text(numero_conta);
		$('#chave_pix_dados').text(chave_pix);
		
				
		$('#modalDados').modal('show');
		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');	
		$('#inscricao_estadual').val('');
		$('#inscricao_municipal').val('');
		$('#email').val('');
		$('#telefone').val('');
		$('#cpf').val('');		
		$('#numero_banco').val('');
		$('#agencia_fornecedor').val('');
		$('#numero_conta').val('');
		$('#chave_pix').val('');
	}

</script>