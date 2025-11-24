<?php 
$pag = 'receber';

//verificar se ele tem a permissão de estar nessa página
if(@$receber == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));
$data_amanha = date('Y-m-d', strtotime("+1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";

if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
    $dia_final_mes = '30';
}else if($mes_atual == '2'){
    $dia_final_mes = '28';
}else{
    $dia_final_mes = '31';
}

$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;

$query = $pdo->query("SELECT * FROM config WHERE empresa = '$id_empresa'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$access_token = $res[0]['token_pix'];



$query = $pdo->query("SELECT * FROM receber where pago != 'Sim' and ref_pix != '' and empresa = '$id_empresa' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
for($i=0; $i < $total_reg; $i++){	
$ref_pix = @$res[$i]['ref_pix'];
	 require('pix_cobranca/consultar_pagamento.php');
	}
}

 ?>

 


<div class="row">
	<div class="col-md-12">
		
		<div style="float:left; margin-right:35px">
			<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Conta</a>
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo $data_inicio_mes ?>" required onchange="listar()">
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:30px">
			<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo $data_final_mes ?>" required onchange="listar()">
		</div>


		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca" onchange="listar()">
				<option value="">Pendentes / Pagas</option>
				<option value="Não">Pendentes</option>
				<option value="Sim">Pagas</option>
				
			</select>
		</div>

		<div style="margin-top:5px;"> 
		<small >
			<a title="Contas à Receber Vencidas" class="text-muted" href="#" onclick="listarContasVencidas('Vencidas')"><span>Vencidas</span></a> / 
			<a title="Contas à Receber Hoje" class="text-muted" href="#" onclick="alterarData('<?php echo $data_hoje ?>', '<?php echo $data_hoje ?>')"><span>Hoje</span></a> / 
			<a title="Contas à Receber Amanhã" class="text-muted" href="#" onclick="alterarData('<?php echo $data_amanha ?>', '<?php echo $data_amanha ?>')"><span>Amanhã</span></a> /
			<a title="Contas à Receber Mês" class="text-muted" href="#" onclick="alterarData('<?php echo $data_inicio_mes ?>', '<?php echo $data_final_mes ?>')"><span>Mês</span></a>
		</small>
		</div>

		
	</div>

	
</div>



<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Descrição</label> 
								<input type="text" class="form-control" name="descricao" id="descricao"> 
							</div>						
						</div>

						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Cliente</label> 
								<select class="form-control sel2" name="pessoa" id="pessoa" style="width:100%;"> 

									<option value="">Selecione um Cliente</option>

									<?php 
									$query = $pdo->query("SELECT * FROM clientes where empresa = '$id_empresa' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){		
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div>

						


					</div>


					<div class="row">

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Valor</label> 
								<input type="text" class="form-control" name="valor" id="valor" required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Vencimento</label> 
								<input type="date" class="form-control" name="data_venc" id="data_venc" required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Frequência</label> 
								<select class="form-control" name="frequencia" id="frequencia" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM frequencias where empresa = '$id_empresa' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['dias'] ?>"><?php echo $res[$i]['frequencia'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div>




					</div>

					

					<div class="row">						

						<div class="col-md-7">						
							<div class="form-group"> 
								<label>Arquivo</label> 
								<input type="file" class="form-control" name="arquivo" onChange="carregarImg();" id="arquivo">
							</div>						
						</div>
						<div class="col-md-5">
							<div id="divImg">
								<img src="images/contas/sem-foto.png"  width="100px" id="target">									
							</div>
						</div>

					</div>				
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<input type="hidden" name="id_usuario" id="id_usuario">
					<input type="hidden" name="id_empresa" id="id_empresa">
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>



			</form>

		</div>
	</div>
</div>






<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">			



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Cliente: </b></span>
						<span id="pessoa_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Valor: </b></span>
						<span id="valor_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Lançamento: </b></span>
						<span id="lanc_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Data Vencimento: </b></span>
						<span id="venc_mostrar"></span>
					</div>
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data PGTO: </b></span>
						<span id="pgto_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Usuário Cadastro: </b></span>
						<span id="usu_lanc_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Usuário Baixa: </b></span>
						<span id="usu_pgto_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Frequência: </b></span>
						<span id="freq_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-6">							
						<span><b>Pago: </b></span>
						<span id="pago_mostrar"></span>
					</div>
				</div>





				<div class="row">
					<div class="col-md-12" align="center">		
						<a id="link_arquivo" target="_blank"><img  width="200px" id="target_mostrar"></a>	
					</div>
				</div>



			</div>


		</div>
	</div>
</div>







<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_arquivo"></span></h4>
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
								<label>Foto</label>
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








<!-- Modal Arquivos -->
<div class="modal fade" id="modalParcelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Parcelar Conta R$ <span id="valor_conta"></span></h4>
				<button id="btn-fechar-arquivo" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<form id="form-parcelar">		
			<div class="modal-body">

			<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Parcelas</label>
								<input type="number" class="form-control" id="parcelas" name="parcelas" placeholder="Parcelas" required="" value="">
							</div> 
						</div>



					<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Frequência</label>
									<select class="form-control" name="frequencia" id="" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM frequencias where empresa = '$id_empresa' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['dias'] ?>"><?php echo $res[$i]['frequencia'] ?></option>

									<?php } ?>

								</select>
							</div> 
						</div>
					</div>	
				
					<input type="hidden" name="id" id="id_parcelar">
					<input type="hidden" name="id_usuario" id="id_usuario_parcelar">
					<input type="hidden" name="id_empresa" id="id_empresa_parcelar">

					<small><div id="mensagem-parcelar" align="center"></div></small>

				
					
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


<script type="text/javascript">
	function listar(){

	var id_usuario = localStorage.id_usu;
	var id_empresa = localStorage.id_empresa;
	var data_inicial = $("#data-inicial").val();
	var data_final = $("#data-final").val();
	var status = $("#status-busca").val();
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {id_usuario, data_inicial, data_final, status, id_empresa},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
            $('#mensagem-excluir').text('');
        }
    });
}
</script>


<script type="text/javascript">
	function listarContasVencidas(vencidas){
		var id_usuario = localStorage.id_usu;
	var id_empresa = localStorage.id_empresa;
			$.ajax({
				url: 'paginas/' + pag + "/listar.php",
				method: 'POST',
				data: {vencidas, id_usuario, id_empresa},
				dataType: "html",

				success:function(result){
					$("#listar").html(result);
				}
			});
		}
</script>


<script type="text/javascript">
	function alterarData(data1, data2){
		$("#data-inicial").val(data1)
		$("#data-final").val(data2)
		listar();
	}
</script>







<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
	$("#form-parcelar").submit(function () {
		
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/parcelar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				//alert(mensagem)

				$('#mensagem-parcelar').removeClass()

				if (mensagem.trim() == "Parcelado com Sucesso") {

					$('#mensagem-parcelar').addClass('text-success')

					$('#btn-fechar-parcelar').click();
					window.location = "index.php?pagina="+pag;

				} else {

					$('#mensagem-parcelar').addClass('text-danger')
				}

				$('#mensagem-parcelar').text(mensagem)

			},

			cache: false,
			contentType: false,
			processData: false,

		});
	});
</script>