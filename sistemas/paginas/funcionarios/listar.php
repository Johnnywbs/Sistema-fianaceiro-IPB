<?php
@session_start();
$tabela = 'usuarios';
require_once("../../../conexao.php");

$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM $tabela where empresa = '$id_empresa' and nivel != 'Administrador' order by nome asc");
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
	<th class="esc">Função</th>
	<th class="esc">Data de Nascimento</th>
	<th>Contrato</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$email = $res[$i]['email'];
$pessoa = $res[$i]['pessoa'];
$telefone = $res[$i]['telefone'];
$cpf_cnpj = $res[$i]['cpf_cnpj'];
$nivel = $res[$i]['nivel'];
$logradouro = $res[$i]['logradouro'];
$num_casa = $res[$i]['num_casa'];
$complemento = $res[$i]['complemento'];
$cep = $res[$i]['cep'];
$bairro = $res[$i]['bairro'];
$municipio = $res[$i]['municipio'];
$uf = $res[$i]['uf'];
$ativo = $res[$i]['ativo'];
$data_cad = $res[$i]['data'];
$nome_banco = $res[$i]['nome_banco'];
$numero_banco = $res[$i]['numero_banco'];
$agencia_usuario = $res[$i]['agencia_usuario'];
$tipo_conta = $res[$i]['tipo_conta'];
$numero_conta = $res[$i]['numero_conta'];
$chave_pix = $res[$i]['chave_pix'];
$data_nascimento = $res[$i]['data_nascimento'];
$contrato = $res[$i]['contrato'];


$senha = '********';

//extensão do arquivo
$ext = pathinfo($contrato, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx'){
	$tumb_arquivo = 'word.png';
}else{
	$tumb_arquivo = $contrato;
}
	
$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
$data_nascimentoF = implode('/', array_reverse(explode('-', $data_nascimento)));

if($ativo == 'Sim'){
	$icone = 'fa-check-square';
	$titulo_link = 'Desativar Item';
	$acao = 'Não';
	$classe_ativo = '';
}else{
	$icone = 'fa-square-o';
	$titulo_link = 'Ativar Item';
	$acao = 'Sim';
	$classe_ativo = '#c4c4c4';
}

	

echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$nivel}</td>
<td class="esc">{$data_nascimentoF}</td>
<td><a href="images/contas/{$contrato}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
<td>

<big><a href="#" onclick="editar('{$id}','{$nome}','{$email}','{$pessoa}','{$telefone}','{$cpf_cnpj}','{$nivel}','{$data_nascimento}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}','{$municipio}','{$uf}','{$nome_banco}','{$numero_banco}','{$agencia_usuario}','{$tipo_conta}','{$numero_conta}','{$chave_pix}','{$tumb_arquivo}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
HTML;
if(@$_SESSION['nivel'] == 'Administrador' or @$_SESSION['nivel'] == 'Gerência Técnica-Administrativa-Financeira' or @$_SESSION['nivel'] == 'Gerência Gerência Administrativa'){
echo <<< HTML

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
echo <<< HTML

<big><a href="#" onclick="arquivo('{$id}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

<big><a href="#" onclick="mostrar('{$nome}','{$email}','{$pessoa}','{$telefone}','{$cpf_cnpj}','{$ativo}','{$data_cadF}', '{$nivel}','{$data_nascimentoF}','{$logradouro}','{$num_casa}','{$complemento}','{$cep}','{$bairro}','{$municipio}','{$uf}','{$nome_banco}','{$numero_banco}','{$agencia_usuario}','{$tipo_conta}','{$numero_conta}','{$chave_pix}','{$tumb_arquivo}','{$contrato}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>





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
	function editar(id, nome, email, pessoa, telefone, cpf_cnpj, nivel, data_nascimento,logradouro,num_casa,complemento,cep,bairro,municipio,uf,nome_banco, numero_banco, agencia_usuario,tipo_conta, numero_conta, chave_pix, contrato){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#pessoa').val(pessoa).change();
		$('#telefone').val(telefone);
		$('#cpf_cnpj').val(cpf_cnpj);
		$('#data_nascimento').val(data_nascimento);
		$('#nivel').val(nivel).change();
		$('#logradouro').val(logradouro);
		$('#num_casa').val(num_casa);
		$('#complemento').val(complemento);
		$('#cep').val(cep);
		$('#bairro').val(bairro);
		$('#municipio').val(municipio);
		$('#uf').val(uf);
		$('#nome_banco').val(nome_banco);
		$('#numero_banco').val(numero_banco);
		$('#agencia_usuario').val(agencia_usuario);
		$('#tipo_conta').val(tipo_conta);
		$('#numero_conta').val(numero_conta);
		$('#chave_pix').val(chave_pix);	
		$('#data_nascimento').val(data_nascimento);
	
		
		$('#titulo_inserir').text('Editar Colaborador');
		$('#modalForm').modal('show');

		$('#contrato').val('');
		$('#mensagem').text('');
    	
        $('#target').attr('src','images/contas/' + contrato);	
		
	}



	function mostrar(nome, email, pessoa, telefone, cpf_cnpj, ativo, data_cad, nivel, data_nascimento,logradouro,num_casa,complemento,cep,bairro,municipio,uf,nome_banco, numero_banco, agencia_usuario,tipo_conta, numero_conta, chave_pix, cpntrato){
		
		$('#titulo_dados').text(nome);
		$('#email_dados').text(email);
		$('#pessoa_dados').text(pessoa,);
		$('#telefone_dados').text(telefone);
		$('#cpf_cnpj_dados').text(cpf_cnpj);
		
		$('#nivel_dados').text(nivel);
		$('#ativo_dados').text(ativo);	
		$('#data_cad_dados').text(data_cad);
		$('#logradouro_dados').text(logradouro);
		$('#num_casa_dados').text(num_casa);
		$('#complemento_dados').text(complemento);
		$('#cep_dados').text(cep);	
		$('#bairro_dados').text(bairro);
		$('#municipio_dados').text(municipio);
		$('#uf_dados').text(uf);
		$('#nome_banco_dados').text(nome_banco);
		$('#numero_banco_dados').text(numero_banco);
		$('#agencia_usuario_dados').text(agencia_usuario);
		$('#tipo_conta_dados').text(tipo_conta);
		$('#numero_conta_dados').text(numero_conta);
		$('#chave_pix_dados').text(chave_pix);

		$('#data_nascimento_dados').text(data_nascimento);
				
		$('#modalDados').modal('show');
		
		$('#link_arquivo').attr('href','images/contas/' + link);
		$('#modalMostrar').modal('show');		
		$('#target_mostrar').attr('src','images/contas/' + contrato);			
        	
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');	
		$('#email').val('');
		$('#telefone').val('');
		$('#cpf_cnpj').val('');	
		$('#logradouro').val('');
		$('#num_casa').val('');
		$('#complemento').val('');
		$('#cep').val('');
		$('#bairro').val('');
		$('#municipio').val('');
		$('#uf').val('');
		$('#nome_banco').val('');		
		$('#contrato').val('');
		$('#numero_banco').val('');
		$('#agencia_usuario').val('');
		$('#tipo_conta').val('');
		$('#numero_conta').val('');
		$('#chave_pix').val('');
	}

	function arquivo(id, nome){
		
		$('#titulo_arquivo').text(nome);		
		$('#id_arquivo').val(id);	
		$('#id_usuario_arquivo').val(localStorage.id_usu);	
		$('#id_empresa_arquivo').val(localStorage.id_empresa);	
		$('#target-arquivos').attr("src", "images/arquivos/sem-foto.png");			
		$('#id_arquivo').val(id);				
		$('#modalArquivos').modal('show');
		listarArquivos(id);
		limparArquivos();
	}

	function limparArquivos(){
		$('#nome_arquivo').val('');
		$('#data_validade').val('');
		$('#foto-arquivos').val('');
		$('#target').attr("src", "images/arquivos/sem-foto.png");
	}

</script>

