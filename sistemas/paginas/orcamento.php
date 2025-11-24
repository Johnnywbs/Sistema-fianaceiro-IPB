<?php 
$pag = 'orcamento';

//verificar se ele tem a permissão de estar nessa página
if(@$orcamento == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));
$data_amanha = date('Y-m-d', strtotime("+1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$anos = range($ano_atual - 4, $ano_atual);
$anos = array_reverse($anos);
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";
if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
    $dia_final_mes = '30';
}else if($mes_atual+1 == '2'){
    $dia_final_mes = '28';
}else{
    $dia_final_mes = '31';
}
$inicio_ano = '0000'."-".'00'."-".'00';
$final_ano = $ano_atual."-".'12'."-".'31';
$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;
 ?>




<div class="row">
	<div class="col-md-12">
		
		<div style="float:left; margin-right:30px">
			<a class="btn btn-primary" onclick="criar_orcamento()" class="btn btn-primary btn-flat btn-pri"><i class="" aria-hidden="true"></i> Criar Novo Orçamento</a>
		</div>
		<div style="float:left; margin-right:30px">
			<a class="btn btn-primary" onclick="editar_orcamento()" class="btn btn-primary btn-flat btn-pri"><i class="" aria-hidden="true"></i> Editar Orçamento</a>
		</div>

		<!--<div style="float:left; margin-right:30px">
			<a class="btn btn-primary disabled" aria-disabled="true" onclick="inserirArquivo()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true" ></i> Nota Fiscal .xml</a>
		</div> -->

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo $inicio_ano ?>" required onchange="listar()">
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:25px">
			<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo $data_final_mes ?>" required onchange="listar()">
		</div>
		
	</div>

	
</div>



<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal -->
<div class="modal fade" id="modalCriar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="">Criar Novo Orçamento</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-criar-orcamento">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">			
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome_orcamento" id="nome_orcamento"> 					
						</div>
						<div class="col-md-3">
									<label>Ano</label> 
									<select class="form-control" name="ano" id="ano">
										<?php foreach ($anos as $ano): ?>
										<option value="<?= $ano ?>"><?= $ano ?></option>
										<?php endforeach; ?>
									</select>
						</div>
						<div class="col-md-4">
									<label>Departamento</label> 
									<select class="form-control" name="departamento" id="departamento">
										<option value="PRE">Presidência</option>
										<option value="SEC">Secretaria</option>
										<option value="FIN">Financeiro</option>
										<option value="ADM">Administração</option>
										<option value="GGER">Gerência Geral</option>
										<option value="GTEC">Gerência Tecnica</option>
										<option value="SUP">Suporte</option>
										<option value="COM">Comunicação</option>
										<option value="DIR">Diretoria</option>
										<option value="CONSAD">Conselho Administrativo</option>
									</select>
						</div>
						<div class="col-md-12">			
							<label>Descrição</label> 
							<input type="text" class="form-control" name="descricao_orcamento" id="descricao_orcamento"> 					
						</div>						
						
					</div>		

					<br>
					<input type="hidden" name="id" id="id"> 
					<input type="hidden" name="id_usuario" id="id_usuario">
					<input type="hidden" name="id_empresa" id="id_empresa">
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Criar</button>
				</div>

			</div>
		</form>

		</div>
	</div>
</div>



<div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir">Edição</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-edicao">
				<div class="modal-body">

					<div class="row">						
					<div class="col-md-3">
							<label>Ano</label> 
							<select class="form-control" name="ano_edicao" id="ano_edicao">
								<?php foreach ($anos as $ano): ?>
								<option value="<?= $ano ?>"><?= $ano ?></optio>
								<?php endforeach; ?>
							</select>
					</div>
					<div class="col-md-5">

						<label>Orçamento</label> 
						<select class="form-control sel2" name="centro_de_custo_prod" id="centro_de_custo_prod" style="width:100%;" onChange = "changeSelectProd();"> 
							<option value="">Selecione um Orçamento</option>

							<?php
							$ano_edicao = 0;
							$query = $pdo->query("SELECT * FROM orcamento where ano = '$ano_edicao' order by nome asc");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							for($i=0; $i < @count($res); $i++){		
									?>	
								<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

							<?php } ?>
						</select>				
					</div>
					</div>				

					<br>
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>
				<input type="hidden" name="id" id="id"> 
				<input type="hidden" name="id_usuario" id="id_usuario">
				<input type="hidden" name="id_empresa" id="id_empresa">
				<small><div id="mensagem" align="center" class="mt-3"></div></small>

				<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Abrir</button>
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
				<h4 class="modal-title" id="tituloModal"><span id="">Detalhes da Conta: </span><span id="mostrar_titulo"></span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Resumo</span></h4>
				</div>		
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Descrição: </b></span>
						<span id="descricao_pgto_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-7">							
						<span><b>Fornecedor / Prestador de Serviço: </b></span>
						<span id="pessoa_mostrar"></span>
					</div>
					<div class="col-md-5">
						<span><b>Nº do Documento:</b></span>
						<span id="numero_documento_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-5">
						<span><b>Data de Lançamento: </b></span>
						<span id="data_lanc_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Tipo de Pag:</b></span>
						<span id="tipo_pagamento_mostrar"></span>
					</div>
					<div class="col-md-3">
						<span><b>Tag:</b></span>
						<span id="tag_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-5">
						<span><b>Data de Emissão:</b></span>
						<span id="emiss_mostrar"></span>
					</div>
					<div class="col-md-5">
						<span><b>Data de Venc.: </b></span>
						<span id="venc_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-5">
						<span><b>Data de Pag.: </b></span>
						<span id="pgto_mostrar"></span>
					</div>
					<div class="col-md-5">
						<span><b>Valor: R$</b></span>
						<span id="valor_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">
						<span><b>Série: </b></span>
						<span id="serie_nf_mostrar"></span>
					</div>
					<div class="col-md-9">
						<span><b>Chave: </b></span>
						<span id="chave_nf_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-8">
						<span><b>Cód. de Autenticidade: </b></span>
						<span id="cod_aut_mostrar"></span>
					</div>
				</div>


				<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados de Tributos</span></h4>
				</div>		
				
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Base de Cálc. ICMS:R$  </b></span>
						<span id="base_icms_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Valor do ICMS:R$  </b></span>
						<span id="valor_icms_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Valor Total Bruto:R$ </b></span>
						<span id="valor_prod_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Valor do Seguro:R$  </b></span>
						<span id="valor_seguro_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Valor do Frete:R$  </b></span>
						<span id="valor_frete_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Desconto:R$ </b></span>
						<span id="desconto_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Valor IPI:R$  </b></span>
						<span id="valor_ipi_mostrar"></span>
					</div>
					<div class="col-md-6">							
						<span><b>Valor Líquido:R$  </b></span>
						<span id="valor_nota_mostrar"></span>
					</div>
				</div>
				<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Outros Dados</span></h4>
				</div>	
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Usuário Lançamento: </b></span>
						<span id="usu_lanc_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Usuário Baixa: </b></span>
						<span id="usu_pgto_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Frequência: </b></span>
						<span id="freq_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Centro de Custo: </b></span>
						<span id="centro_de_custo_mostrar"></span>							
					</div>

					<div class="col-md-6">							
						<span><b>Sub Centro: </b></span>
						<span id="sub_centro_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Classificacao: </b></span>
						<span id="classificacao_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Reembolso: </b></span>
						<span id="reembolso_mostrar"></span>
					</div>
					<div class="col-md-3">							
						<span><b>Compensação: </b></span>
						<span id="compensacao_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Pago: </b></span>
						<span id="pago_mostrar"></span>
					</div>
				</div>
				<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Produtos / Serviços</span></h4>
				</div>	
				<div class="row">
					<div id="listar-produtos-mostrar"></div>
				</div>
			</div>


		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>

<script src="js/ajax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	<script type="text/javascript">
			$(function() {
				$('#valor').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#base_icms').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_icms').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_prod').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_seguro').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_frete').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#desconto').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_ipi').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_nota').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_unit').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#valor_desconto').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
			});
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

 $("#form-criar-orcamento").submit(function () {
	var id_orcamento = $('#id').val();
	var id_ref = $('#id_ref').val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/criar_orcamento.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-arquivo').click();
                limparArquivos();
                listarArquivos(id_orcamento,chave,id_ref);

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

$("#form-edicao").submit(function () {
	var id_empresa = $('#id_arquivo').val();
	var chave = $('#numero_documento_ref').val();
	var id_ref = $('#id_ref').val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/inserir-produtos.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                //$('#btn-fechar-arquivo').click();
                limparArquivos();
                listarArquivos(id_empresa,chave,id_ref);

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
	function listarArquivos(id,chave,id_ref){
	var id_usuario = localStorage.id_usu;
    $.ajax({
        url: 'paginas/' + pag + "/listar-produtos.php",
        method: 'POST',
        data: {id_usuario, id, chave, id_ref},
        dataType: "html",

        success:function(result){
            $("#listar-produtos").html(result);
			$("#listar-produtos-mostrar").html(result);
        }
    });
}



function excluirArquivo(id,chave,id_ref){
	var id_usuario = localStorage.id_usu;
	var id_empresa = $('#id_arquivo').val();
	var chave = $('#numero_documento_ref').val();
	var id_ref = $('#id_ref').val();
    $.ajax({
        url: 'paginas/' + pag + "/excluir-produtos.php",
        method: 'POST',
        data: {id, id_usuario},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {
                listarArquivos(id_empresa,chave,id_ref);
            } 
        }
    });
}

</script>


<script type="text/javascript">
	$(document).ready(function() {
    $('.sel2').select2({
    	dropdownParent: $('#modalForm')
		dropdownParent: $('#modalArquivos')
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
	function editar_orcamento(){
		$('#id_usuario').val(localStorage.id_usu);
		$('#id_empresa').val(localStorage.id_empresa);
		$('#mensagem').text('');
		$('#titulo_inserir').text('Inserir Registro');
		$('#modalEdicao').modal('show');
		limparCampos();
	}
	function criar_orcamento(){
		$('#id_usuario').val(localStorage.id_usu);
		$('#id_empresa').val(localStorage.id_empresa);
		$('#mensagem').text('');
		$('#modalCriar').modal('show');
		limparCampos();
	}

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

<script type="text/javascript">
	function changeSelect(){

	var select = document.getElementById('centro_de_custo');
	var selectSetor = document.getElementById('sub_centro');

	var value = select.options[select.selectedIndex].value;

	//remove itens
	var length = selectSetor.options.length;        
	var i;
	for(i = selectSetor.options.length-1 ; i>=0 ; i--)
	{
		selectSetor.remove(i);
	}


	if(value == 'Centro de Simulação') {
		<?php 
		$query = $pdo->query("SELECT * FROM sub_centros where centro_de_custo = 'Centro de Simulação' order by nome asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		for($i=0; $i < @count($res); $i++){		
				?>
		var option = document.createElement('option');
		option.value = '<?php echo $res[$i]['nome'] ?>';
		option.text = '<?php echo $res[$i]['nome'] ?>';
		selectSetor.add(option);
		<?php } ?>

	} else if (value == 'Administração Central'){

		<?php 
		$query = $pdo->query("SELECT * FROM sub_centros where centro_de_custo = 'Administração Central' order by nome asc");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		for($i=0; $i < @count($res); $i++){		
				?>
		var option = document.createElement('option');
		option.value = '<?php echo $res[$i]['nome'] ?>';
		option.text = '<?php echo $res[$i]['nome'] ?>';
		selectSetor.add(option);
		<?php } ?>
	}  else{
		var option = document.createElement('option');
		option.value = '';
		option.text = 'Selecione um Sub Centro';
		selectSetor.add(option);
	}
	}
</script>
