<?php 
$pag = 'clientes';

//verificar se ele tem a permissão de estar nessa página
if(@$clientes == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Cliente</a>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal Inserir/Editar -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
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
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>							
						</div>
						<div class="col-md-5">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Email" required>							
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
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_dados_titulo"></span></h4>
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

				<hr>				
				<div id="listar-vendas"></div>
					
			</div>	

			

		</div>
	</div>
</div>




<!-- Modal Contas
<div class="modal fade" id="modalContas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_contas"></span> <small></small></h4>
				<button id="btn-fechar-conta" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
					
			<div class="modal-body">
					<div>
						<select class="form-control form-control-sm" id="buscar_contas" onchange="buscar()">
							<option value="">Filtrar Todas</option>
							<option value="Vencidas">Contas Vencidas</option>
							<option value="Pendentes">Contas Pendentes</option>
							<option value="Pagas">Contas Pagas</option>

						</select>
					</div>
					<div id="listar-contas" style="margin-top: 10px"></div>

					<input type="hidden" id="id_da_conta">
					
			</div>	

				

		</div>
	</div>
</div> -->


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



function listarContas(id){
	pag = 'clientes';
	var id_usuario = localStorage.id_usu;
	var id_empresa = localStorage.id_empresa;
	var busca =  $("#buscar_contas").val();    
    $.ajax({
        url: 'paginas/' + pag + "/listar-contas.php",
        method: 'POST',
        data: {id_usuario, id, id_empresa, busca},
        dataType: "html",

        success:function(result){
            $("#listar-contas").html(result);           
        }
    });
}


function listarVendas(id){
	pag = 'clientes';
	var id_usuario = localStorage.id_usu;
	var id_empresa = localStorage.id_empresa;
    $.ajax({
        url: 'paginas/' + pag + "/listar-vendas.php",
        method: 'POST',
        data: {id_usuario, id, id_empresa},
        dataType: "html",

        success:function(result){
            $("#listar-vendas").html(result);           
        }
    });
}

</script>




<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

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
	function buscar(){
		var id_conta = $('#id_da_conta').val();
		listarContas(id_conta);
	}

</script>