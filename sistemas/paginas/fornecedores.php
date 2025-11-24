<?php 
$pag = 'fornecedores';

//verificar se ele tem a permissão de estar nessa página
if(@$fornecedores == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

 <a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Fornecedor / Prestador de Serviço</a>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal Inserir/Editar -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="">Fornecedores/Prestadores de Serviços</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Informações Básicas</span></h4>
					<div class="row">
						<div class="col-md-9">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>							
						</div>
						<div class="col-md-3">							
								<label>Porte</label>
								<input type="text" class="form-control" id="porte" name="porte" placeholder="Porte">
						</div>
						<div class="col-md-6">							
								<label>Título do Estabelecimento</label>
								<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Estabelecimento">							
						</div>
						<div class="col-md-3">							
								<label>Inscrição Estadual</label>
								<input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual" placeholder="Insc. Estadual" >							
						</div>
						<div class="col-md-3">							
								<label>Inscrição Municipal</label>
								<input type="text" class="form-control" id="inscricao_municipal" name="inscricao_municipal" placeholder="Insc. Municipal" >							
						</div>
						<div class="col-md-3">							
								<label>Pessoa</label>
								<select class="form-control" name="pessoa" id="pessoa" onchange="mudarPessoa()">
									<option value="Física">Física</option>
									<option value="Jurídica">Jurídica</option>
								</select>						
						</div>
						<div class="col-md-4">							
								<label><span id="label-pessoa">CPF</span></label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="" required>							
						</div>
						<div class="col-md-5">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Email" >							
						</div>	
						<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" >							
						</div>
						<div class="col-md-8">							
								<label>Atividade Economica Principal</label>
								<input type="text" class="form-control" id="atividade_economica" name="atividade_economica" placeholder="Atividade Economica Principal" >							
						</div>
						<div class="col-md-12">							
								<label>Natureza Jurídica</label>
								<input type="text" class="form-control" id="natureza" name="natureza" placeholder="Natureza Jurídica" >
						</div>
					</div>

							
					<div class="row">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Endereço</span></h4>
					</div>
					<div class="row">
						<div class="col-md-5">							
								<label>Logradouro</label>
								<input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro" >						
						</div>
						<div class="col-md-2">							
								<label>Número</label>
								<input type="text" class="form-control" id="num_casa" name="num_casa" placeholder="Número" >
						</div>
						<div class="col-md-5">							
								<label>Complemento</label>
								<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" >
						</div>
						<div class="col-md-3">							
								<label>CEP</label>
								<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP">
						</div>
						<div class="col-md-4">							
								<label>Bairro</label>
								<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
						</div>
						<div class="col-md-3">							
								<label>Município</label>
								<input type="text" class="form-control" id="municipio" name="municipio" placeholder="Município" >
						</div>
						<div class="col-md-2">							
								<label>UF</label>
								<input type="text" class="form-control" id="uf" name="uf" placeholder="UF" >
						</div>
					</div>


					<div class="row">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados Bancários</span></h4>
					</div>

					<div class="row">
						<div class="col-md-3">							
								<label>Nome do Banco</label>
								<input type="text" class="form-control" id="nome_banco" name="nome_banco" placeholder="Nome do Banco" >							
						</div>
						<div class="col-md-3">							
								<label>Número do Banco</label>
								<input type="text" class="form-control" id="numero_banco" name="numero_banco" placeholder="Número do Banco" >							
						</div>
						<div class="col-md-3">							
								<label>Agência</label>
								<input type="text" class="form-control" id="agencia_fornecedor" name="agencia_fornecedor" placeholder="Agência" >							
						</div>
						<div class="col-md-3">							
								<label>Tipo de Conta</label>
								<select class="form-control" name="tipo_conta" id="tipo_conta">
									<option value="">-------------</option>
									<option value="Conta Corrente">Conta Corrente</option>
									<option value="Conta Poupança">Conta Poupança</option>
								</select>								
						</div>
						<div class="col-md-4">							
								<label>Conta Bancária</label>
								<input type="text" class="form-control" id="numero_conta" name="numero_conta" placeholder="Número da Conta" >							
						</div>
						<div class="col-md-8">							
								<label>Chave Pix</label>
								<input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix" >							
						</div>

					</div>

					<input type="hidden" name="id" id="id">
					<input type="hidden" name="id_empresa" id="id_empresa">
				

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>






<!-- Modal Inserir/Editar -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel"><span id="nome_dados_titulo"></span></h3>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>			
			<div class="modal-body">	
					
					<div class="row" style="margin-top: 0px">

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Nome: </b></span><span id="nome_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Porte: </b></span><span id="porte_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Título: </b></span><span id="titulo_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Inscrição Estadual: </b></span><span id="inscricao_estadual_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Inscrição Municipal: </b></span><span id="inscricao_municipal_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Atividade Economica: </b></span><span id="atividade_economica_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Natureza: </b></span><span id="natureza_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Email: </b></span><span id="email_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Pessoa: </b></span><span id="pessoa_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>CPF / CNPJ </b></span><span id="cpf_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_cad_dados"></span>
					</div>

					<div class="row">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Endereço</span></h4>
					</div>


					<div class="col-md-9" style="margin-bottom: 5px">
						<span><b>Logradouro: </b></span><span id="logradouro_dados"></span>
					</div>

					<div class="col-md-3" style="margin-bottom: 5px">
						<span><b>Número: </b></span><span id="num_casa_dados"></span>
					</div>

					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>Complemento: </b></span><span id="complemento_dados"></span>
					</div>

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>CEP: </b></span><span id="cep_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Bairro: </b></span><span id="bairro_dados"></span>
					</div>

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>Município: </b></span><span id="municipio_dados"></span>
					</div>

					<div class="col-md-2" style="margin-bottom: 5px">
						<span><b>UF: </b></span><span id="uf_dados"></span>
					</div>


					<div class="row">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados Bancários</span></h4>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Nome do Banco: </b></span><span id="nome_banco_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Número Banco: </b></span><span id="numero_banco_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Agência: </b></span><span id="agencia_fornecedor_dados"></span>
					</div>

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>Tipo de Conta: </b></span><span id="tipo_conta_dados"></span>
					</div>

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>Conta: </b></span><span id="numero_conta_dados"></span>
					</div>

					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>Chave Pix: </b></span><span id="chave_pix_dados"></span>
					</div>


				</div>	
			</div>	

			

		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function mudarPessoa(){
		var pessoa = $('#pessoa').val();

		if(pessoa.trim() == 'Física'){
			$('#label-pessoa').text('CPF');
			$('#cpf').mask('000.000.000-00');
		}else{
			$('#label-pessoa').text('CNPJ');
			$('#cpf').mask('00.000.000/0000-00');
		}
		
	}
	function mask(){
		$('cep').mask('00000-000')
	}
</script>