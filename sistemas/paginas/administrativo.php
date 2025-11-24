<?php 
$pag = 'administrativo';

//verificar se ele tem a permissão de estar nessa página
if(@$administracao == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}


 ?>
<div class="row">
	<div class="col-md-12">

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-control" aria-label="Default select example" name="ano_busca" id="ano_busca" onchange="listar()">
				<option value="2024">2024</option>
				<option value="2023">2023</option>
				<option value="2022">2022</option>
				<option value="2021">2021</option>
				<option value="2020">2020</option>
				<option value="2019">2019</option>
				<option value="2018">2018</option>
				
			</select>
		</div>
		
	</div>

	
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>


<!-- Modal Inserir/Editar -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="nome"><span id="">Editar Dados</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">							
							<label>Descrição</label>
							<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" required>							
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Orçamento</label> 
							<input type="text" class="form-control" name="orcamento" id="orcamento" required> 
						</div>						
					</div>
					<div class="col-md-6">							
							<label>Tipo</label>
							<select class="form-control" name="tipo" id="tipo">
								<option value="Produtivo">Produtivo</option>
								<option value="Não Produtivo">Não Produtivo</option>
							</select>						
					</div>
				</div>
					
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


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function listar(){

	var id_usuario = localStorage.id_usu;
	var id_empresa = localStorage.id_empresa;
	var ano_busca = $("#ano_busca").val();
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {id_usuario, ano_busca, id_empresa},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
            $('#mensagem-excluir').text('');
        }
    });
}
</script>
