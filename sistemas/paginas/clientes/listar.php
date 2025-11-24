<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM $tabela where empresa = '$id_empresa' order by id desc");
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
	<th class="esc">Pessoa</th>	
	<th class="esc">CPF / CNPJ</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
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
$data_cad = $res[$i]['data'];

$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));


$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);


//verificar se cliente tem conta vencida
$query2 = $pdo->query("SELECT * FROM receber where data_venc < curDate() and pago != 'Sim' and empresa = '$id_empresa' and pessoa = '$id' order by data_venc asc");
							$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
							$total_reg2 = @count($res2);
							if($total_reg2 > 0){
								 $conta_pendente = 'text-danger';
								}else{
									$conta_pendente = '';
								}


echo <<<HTML
<tr>
<td class="{$conta_pendente}">{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$pessoa}</td>
<td class="esc">{$cpf}</td>
<td>

<big><a href="#" onclick="editar('{$id}','{$nome}','{$email}','{$telefone}','{$porte}','{$titulo}','{$inscricao_estadual}','{$inscricao_municipal}','{$atividade_economica}',
								 '{$natureza}','{$pessoa}','{$cpf}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}',
								 '{$municipio}','{$uf}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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


<big><a href="#" onclick="mostrar('{$id}','{$nome}','{$email}','{$telefone}','{$porte}','{$titulo}','{$inscricao_estadual}','{$inscricao_municipal}','{$atividade_economica}',
								  '{$natureza}','{$pessoa}','{$cpf}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}',
								  '{$municipio}','{$uf}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=" target="_blank" title="Abrir Whatsapp" class="text-verde"><i class="fa fa-whatsapp text-verde"></i></a></big>




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
	function editar(id, nome, email, telefone,porte,titulo,inscricao_estadual,inscricao_municipal,atividade_economica,natureza,pessoa,cpf,logradouro,num_casa,complemento,
					cep,bairro,municipio,uf){
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
		$('#logradouro').val(logradouro);
		$('#num_casa').val(num_casa);
		$('#complemento').val(complemento);
		$('#cep').val(cep);
		$('#bairro').val(bairro);
		$('#municipio').val(municipio);
		$('#uf').val(uf);

		if(pessoa == ""){
			pessoa = 'Física';
		}		
		$('#pessoa').val(pessoa).change();

		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}



	function mostrar(id, nome, email, telefone, porte, titulo,inscricao_estadual,inscricao_municipal, atividade_economica, natureza, pessoa, cpf, data_cad, logradouro, num_casa,
					 complemento, cep, bairro, municipio, uf){
						
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
		
		$('#data_cad_dados').text(data_cad);
				
		$('#modalDados').modal('show');
		listarVendas(id);
		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');	
		$('#inscricao_estadual').val('');
		$('#inscricao_municipal').val('');
		$('#email').val('');
		$('#telefone').val('');
		$('#cpf').val('');		
		$('#pessoa').val('Física');
	}



//	function contas(id, nome){
//		$('#id_da_conta').val(id);
//		$('#titulo_contas').text(nome);		
//		$('#modalContas').modal('show');
//		listarContas(id);		
//	}

	

</script>