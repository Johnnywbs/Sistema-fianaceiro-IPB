<?php 
$pag = 'funcionarios';

//verificar se ele tem a permissão de estar nessa página
if(@$funcionarios == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

 <a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Colaborador</a>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal Inserir/Editar -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id=""><span id="">Adicionar Colaborador</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Email" >							
						</div>
					</div>


					<div class="row">

						<div class="col-md-3">							
								<label>Pessoa</label>
								<select class="form-control" name="pessoa" id="pessoa" onchange="mudarPessoa()">
									<option value="Física">Física</option>
									<option value="Jurídica">Jurídica</option>
								</select>						
						</div>

						<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" >							
						</div>

						<div class="col-md-4">							
								<label><span id="label-pessoa">CPF/CNPJ</span></label>
								<input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="">							
						</div>

					</div>

					<div class="row">
						
						<div class="col-md-3">							
								<label>Data de Nascimento</label>
								<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento" >						
						</div>
						<div class="col-md-9">														
								<label>Cargo</label>
								<select class="form-control" name="nivel" id="nivel" style="width:100%;">							
									<?php 
									$query = $pdo->query("SELECT * FROM cargos_ipb where empresa = '$id_empresa' and nome != 'Administrador' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
											?>	
										<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>

								</select>											
						</div>
					</div>

					<div class="row">						

					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Contrato</label> 
							<input type="file" class="form-control" name="contrato" onChange="carregarImg();" id="contrato">
						</div>						
					</div>
					<div class="col-md-4">
						<div id="divImg">
							<img src="images/contas/sem-foto.png"  width="100px" id="target">									
						</div>
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
								<input type="text" class="form-control" id="agencia_usuario" name="agencia_usuario" placeholder="Agência" >							
						</div>
						<div class="col-md-3">							
								<label>Tipo de Conta</label>
								<select class="form-control" name="tipo_conta" id="tipo_conta">
									<option value="">-------------</option>
									<option value="Conta Corrente">Conta Corrente</option>
									<option value="Conta Poupança">Conta Poupança</option>
									<option value="Conta Salário">Conta Salário</option>
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
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>			
			<div class="modal-body">	
					
					<div class="row" style="margin-top: 0px">
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>CPF: </b></span><span id="cpf_cnpj_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Email: </b></span><span id="email_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data de Nascimento: </b></span><span id="data_nascimento_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Função: </b></span><span id="nivel_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>
					<div class="col-md-12" style="margin-bottom: 5px">
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
						<span><b>Agência: </b></span><span id="agencia_usuario_dados"></span>
					</div>

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>Tipo de Conta: </b></span><span id="tipo_conta_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Conta: </b></span><span id="numero_conta_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Chave Pix: </b></span><span id="chave_pix_dados"></span>
					</div>


				</div>
					
			</div>	

			

		</div>
	</div>
</div>

<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_arquivo">Documentos</span></h4>
				<button id="btn-fechar-arquivo" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<form id="form-arquivos">		
			<div class="modal-body">	
				<div class="row">
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome_arquivo" name="nome" placeholder="Nome do Arquivo" required>							
						</div>

						<div class="col-md-6">							
								<label>Data Validade</label>
								<input type="date" class="form-control" id="data_validade" name="data_validade"  >							
						</div>
					</div>	



						<div class="row">
						<div class="col-md-6">							
								<label>Documentos</label>
								<input type="file" class="form-control" id="foto-arquivos" name="foto" value="" onchange="carregarImgArquivos()">							
						</div>

						<div class="col-md-6">								
							<img src=""  width="80px" id="target-arquivos">								
							
						</div>

						
					</div>

					<input type="hidden" name="id_usuario" id="id_usuario_arquivo">
					<input type="hidden" name="id_empresa" id="id_empresa_arquivo">
					<input type="hidden" name="id_arquivo" id="id_arquivo">

					<small><div id="mensagem-arquivo" align="center"></div></small>

					<hr>

					<div id="listar-arquivos"></div>
					
			</div>	

			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>	
			</form>		

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
						$('#cpf_cnpj').mask('000.000.000-00');
					}else{
						$('#label-pessoa').text('CNPJ');
						$('#cpf_cnpj').mask('00.000.000/0000-00');
					}
					
			}
			function mask(){
				$('#cep').mask('00000-000');
			}
		</script>

		<script type="text/javascript">
			function carregarImg() {
				var target = document.getElementById('target');
    			var file = document.querySelector("#arquivo").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);



				if(resultado[1] === 'pdf'){
					$('#target').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target').attr('src', "images/xml.png");
					return;
				}



				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>





		<script type="text/javascript">
			function carregarImgArquivos() {
				
				var target = document.getElementById('target-arquivos');
    			var file = document.querySelector("#foto-arquivos").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);



				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}



				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>





 <script type="text/javascript">
	
$("#form-arquivos").submit(function () {
	var id_empresa = $('#id_arquivo').val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/inserir-arquivo.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-arquivo').click();
                limparArquivos();
                listarArquivos(id_empresa);          

            } else {

                $('#mensagem-arquivo').addClass('text-danger')
                $('#mensagem-arquivo').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>


<script type="text/javascript">
	function listarArquivos(id){
	var id_usuario = localStorage.id_usu;
    $.ajax({
        url: 'paginas/' + pag + "/listar-arquivos.php",
        method: 'POST',
        data: {id_usuario, id},
        dataType: "html",

        success:function(result){
            $("#listar-arquivos").html(result);           
        }
    });
}



function excluirArquivo(id){
	var id_usuario = localStorage.id_usu;
	var id_empresa = $('#id_arquivo').val();
    $.ajax({
        url: 'paginas/' + pag + "/excluir-arquivo.php",
        method: 'POST',
        data: {id, id_usuario},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {
                listarArquivos(id_empresa);
            } 
        }
    });
}

</script>


<script type="text/javascript">
	$(document).ready(function() {
    $('.sel2').select2({
    	dropdownParent: $('#modalForm')
    });
});
</script>
