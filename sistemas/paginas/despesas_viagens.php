<?php 
$pag = 'despesas_viagens';

//verificar se ele tem a permissão de estar nessa página
if(@$pagar == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));
$data_amanha = date('Y-m-d', strtotime("+1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = "0000"."-"."00"."00";

if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
    $dia_final_mes = '30';
}else if($mes_atual == '2'){
    $dia_final_mes = '28';
}else{
    $dia_final_mes = '31';
}
$inicio_ano = $ano_atual."-".'01'."-".'01';
$final_ano = $ano_atual."-".'12'."-".'31';
$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;
 ?>

 


<div class="row">
	<div class="col-md-12">
		
<!--		<div style="float:left; margin-right:30px">
			<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Viagem</a>
		</div> -->

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo $data_inicio_mes ?>"   onchange="listar()">
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:25px">
			<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo $data_final_mes ?>"   onchange="listar()">
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
				<h4 class="modal-title"><span id="">Cadastrar Nova Fatura</h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">
					<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Descrição da Viagem</span></h4>
						<div class="col-md-12">			
							<label>Descrição da Viagem</label> 
							<input type="text" class="form-control" name="descricao_viagem" id="descricao_viagem"> 					
						</div>	

						<div class="col-md-5">
						<label>Fornecedor</label> 
							<select class="form-control sel2" name="fornecedor" id="fornecedor" style="width:100%;"> 
								<option value="">Selecione um Fornecedor</option>
								<?php 
								$query = $pdo->query("SELECT * FROM fornecedores where empresa = '$id_empresa' order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
										?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Num. Fatura</label>
							<input type="text" class="form-control" name="num_fatura" id="num_fatura">
						</div>
						<div class="col-md-3">
							<label>Valor Fatura(R$)</label>
							<input type="text" class="form-control" name="valor_fatura" id="valor_fatura"  >
						</div>
						<div class="col-md-3">
							<label>Emissão da Fatura</label>
							<input type="date" class="form-control" name="data_emiss_fat" id="data_emiss_fat"  >
						</div>
						<div class="col-md-3">						
							<label>Vencimento da Fatura</label>
							<input type="date" class="form-control" name="data_venc_fat" id="data_venc_fat"  >
						</div>
						<div class="col-md-3">
							<label>Data do Pagamento</label>
							<input type="date" class="form-control" name="data_pgto_fat" id="data_pgto_fat"  >
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Anexo</label>
								<input type="file" class="form-control" name="arquivo" onChange="carregarImg();" id="arquivo">
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
				<h4 class="modal-title" id="tituloModal"><span id="">Detalhes da Fatura: </span><span id="mostrar_titulo"></span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados Fatura</span></h4>
				</div>		
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">
						<span><b>ID Fatura: </b></span>
						<span id="id_fatura_mostrar"></span>
					</div>
					<div class="col-md-9">							
						<span><b>Descrição da Viagem</b></span>
						<span id="descricao_viagem_mostrar"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Fornecedor:</span>
						<span id="fornecedor_mostrar"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Número Fatura:</b></span>
						<span id="num_fatura_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Valor da Fatura:</span>
						<span id="valor_fatura_mostrar"></span>							
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Data Emissão:</b></span>
						<span id="data_emiss_fat_mostrar"></span>
					</div>
					<div class="col-md-4">	
						<span><b>Data Vencimento: </b></span>
						<span id="data_venc_fat_mostrar"></span>
					</div>
					<div class="col-md-4">	
						<span><b>Data Pagamento: </b></span>
						<span id="data_pgto_fat_mostra"></span>							
					</div>
				</div>			
				
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Usuário Lançamento: </b></span>
						<span id="usu_lanc_mostrar"></span>
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
				<h4 class="modal-title" id="exampleModalLabel"><span id="">Detalhes da Fatura</span></h4>
				<button id="btn-fechar-arquivo" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px" onclick="limparCamposDetalhes()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<form id="form-arquivos">		
			<div class="modal-body">

				<div class="row">

					<div class="row">
						<div class="col-md-3">
							<label>ID Viagem</label> 
							<select class="form-control sel2" name="id_viagem" id="id_viagem" style="width:100%;" onclick = "carregarViagem()"> 
								<option value=""> Nova Viagem</option>
								<?php 
								$query = $pdo->query("SELECT * FROM detalhes_viagem order by id_viagem desc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$ids = [];
								
								for($i=0; $i < @count($res); $i++){
									if(in_array($res[$i]['id_viagem'],$ids) == False){
										array_push($ids, $res[$i]['id_viagem'])
										?>	
									<option value="<?php echo $res[$i]['id_viagem'] ?>"><?php echo $res[$i]['id_viagem'] ?></option>

								<?php }}?>
							</select>
						</div>
						<div class="col-md-4">
							<label>Selecione um Centro de Custo</label> 
							<select class="form-control sel2" name="centro_de_custo_viagem" id="centro_de_custo_viagem" style="width:100%;" onchange = "changeSelectViagem();"> 
								<option value="">Selecione um Centro de Custo</option>

								<?php 
								$query = $pdo->query("SELECT * FROM centros_custo order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
										?>	
									<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>
							</select>
						</div>

						<div class="col-md-5">
							<div class="form-group"> 
								<label>Selecione um Sub-Centro</label> 
								<select class="form-control sel2" name="sub_centro_viagem" id="sub_centro_viagem" style="width:100%;"> 
									<option value="">Selecione um Sub-Centro</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
								<label>Responsável</label> 
								<select class="form-control sel2" name="responsavel_viagem" id="responsavel_viagem" style="width:100%;"> 
									<option value="">Selecione um Usuário</option>
									<?php 
									$query = $pdo->query("SELECT * FROM usuarios where empresa = '$id_empresa' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){		
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>
								</select>
							</div>
							<div class="col-md-6">
								<label>Usuário</label> 
								<input type="text" class="form-control" name="usuario_viagem" id="usuario_viagem">
							</div>
					</div>

					<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados do Voo</span></h4>
					<div class="row">
						<div class="col-md-3">
							<label>Alteração Voo</label> 
							<select class="form-control" name="alteracao_voo" id="alteracao_voo" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
							</select>
						</div>
						<div class="col-md-3">
							<label>Valor Alt. Voo(R$)</label> 
							<input type="text" class="form-control" name="valor_alt_voo" id="valor_alt_voo"  >
						</div>
						<div class="col-md-3">
							<label>Taxa do Agente %</label> 
							<input type="text" class="form-control" name="taxa_alt_percent" id="taxa_alt_percent" readonly> 					
						</div>
						<div class="col-md-3">
							<label>Trecho de Voo</label>
							<input type="text" class="form-control" name="trecho_voo" id="trecho_voo" onclick="mask_trecho_voo()" >
						</div>
						<div class="col-md-3">
							<label>Companhia Aérea</label>
							<input type="text" class="form-control" name="companhia_aerea" id="companhia_aerea" >
						</div>
						<div class="col-md-3">
							<label>Loc. Cia</label>
							<input type="text" class="form-control" name="loc_cia" id="loc_cia">
						</div>
						<div class="col-md-3">						
							<label>Data da Ida</label> 
							<input type="date" class="form-control" name="data_ida" id="data_ida"  >					
						</div>
						<div class="col-md-3">
							<label>Data da Volta</label> 
							<input type="date" class="form-control" name="data_volta" id="data_volta"  >					
						</div>
						<div class="col-md-3">
							<label>Tarifa Aéreo(R$)</label> 
							<input type="text" class="form-control" name="valor_tarifa_aereo" id="valor_tarifa_aereo" oninput="mostrar_voo()" > 					
						</div>
						<div class="col-md-3">
							<label>Taxa DU/RAV</label> 
							<input type="text" class="form-control" name="taxa_du_rav" id="taxa_du_rav" oninput="mostrar_voo()" > 					
						</div>
						<div class="col-md-3">
							<label>Taxa Embarque</label> 
							<input type="text" class="form-control" name="taxa_embarque" id="taxa_embarque"  > 					
						</div>
						<div class="col-md-3">
							<label>Taxa Assento</label> 
							<input type="text" class="form-control" name="taxa_assento" id="taxa_assento"  >
						</div>
						<div class="col-md-3">
							<label>Crédito</label> 
							<input type="text" class="form-control" name="credito" id="credito"  >
						</div>
						<div class="col-md-3">
							<label>Outras Taxas</label> 
							<input type="text" class="form-control" name="taxa_voo" id="taxa_voo"  > 					
						</div>
						<div class="col-md-3">
							<label>Total Aéreo(R$)</label> 
							<input type="text" class="form-control" name="valor_aereo" id="valor_aereo"  > 					
						</div>
						<div class="col-md-3">
							<label>Voo Cancelado</label>
								<select class="form-control" name="cancelado_voo" id="cancelado_voo" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>
					</div>
					<h4 class="modal-title" id="exampleModalLabel"><span id="">Hospedagem</span></h4>
					<div class="row">
						<div class="col-md-3">
							<label>Alteração Hospedagem</label> 
							<select class="form-control" name="alteracao_hosp" id="alteracao_hosp" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
							</select>
						</div>
						<div class="col-md-3">
							<label>Reembolso Hosp.</label>
								<select class="form-control" name="reembolso" id="reembolso" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>
						<div class="col-md-3">
							<label> Fat. Hospedagem</label> 
							<input type="text" class="form-control" name="fatura_hospedagem" id="fatura_hospedagem"  >
						</div>
						<div class="col-md-3">
							<label>Nome Hosp.</label> 
							<input type="text" class="form-control" name="hospedagem" id="hospedagem"  >
						</div>
						<div class="col-md-3">
							<label>All Inclusive</label> 
							<input type="text" class="form-control" name="all_inclusive" id="all_inclusive"  >
						</div>
						
						<div class="col-md-3">
							<label>Tarifa Hosp.(R$)</label> 
							<input type="text" class="form-control" name="valor_hospedagem" id="valor_hospedagem" oninput="mostrar_hospedagem()" > 					
						</div>
						<div class="col-md-3">
							<label>Taxa de Hosp/VAT(R$)</label> 
							<input type="text" class="form-control" name="taxa_hospedagem" id="taxa_hospedagem" oninput="mostrar_hospedagem()" > 					
						</div>
						<div class="col-md-3">
							<label>Hospedagem %</label> 
							<input type="text" class="form-control" name="hospedagem_percent" id="hospedagem_percent" readonly> 					
						</div>
						<div class="col-md-3">
							<label>Total Hospedagem(R$)</label> 
							<input type="text" class="form-control" name="total_hospedagem" id="total_hospedagem"  > 					
						</div>
						<div class="col-md-3">
							<label>Check in</label> 
							<input type="date" class="form-control" name="data_check_in" id="data_check_in"  > 					
						</div>
						<div class="col-md-3">
							<label>Check Out</label> 
							<input type="date" class="form-control" name="data_check_out" id="data_check_out"  > 					
						</div>
						<div class="col-md-3">
							<label>Agendado</label>
								<select class="form-control" name="agendado" id="agendado" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>

						<div class="col-md-3">
							<label>Hosp Cancelada</label>
								<select class="form-control" name="cancelado_hosp" id="cancelado_hosp" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>

						<div class="col-md-3">
							<label>No-Show</label>
								<select class="form-control" name="utilizado" id="utilizado" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>

					</div>
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Alimentação e Transporte Terrestre</span></h4>
					<div class="row">
						<div class="col-md-3">
							<label>Tarifa Transfer</label> 
							<input type="text" class="form-control" name="transfer_voo" id="transfer_voo" >
						</div>
						<div class="col-md-3">
							<label>Taxa Transfer</label> 
							<input type="text" class="form-control" name="taxa_transfer" id="taxa_transfer"> 					
						</div>
						<div class="col-md-3">
							<label>Total Transfer</label> 
							<input type="text" class="form-control" name="total_transfer" id="total_transfer"  > 					
						</div>
						<div class="col-md-3">
							<label>Transfer %</label> 
							<input type="text" class="form-control" name="transfer_percent" id="transfer_percent"  readonly> 					
						</div>
						<div class="col-md-3">
							<label>Alimentação(R$)</label> 
							<input type="text" class="form-control" name="valor_alimentacao" id="valor_alimentacao"  > 					
						</div>
						<div class="col-md-3">
							<label>Transp. Terrestre</label> 
							<input type="text" class="form-control" name="valor_trans_terrestre" id="valor_trans_terrestre"  > 					
						</div>
						<div class="col-md-6">
							<label>Observações</label> 
							<input type="text" class="form-control" name="observacoes" id="observacoes"  > 					
						</div>
						<div class="col-md-3">
							<label>Reembolso Trans/Alim.</label>
								<select class="form-control" name="reembolso_TA" id="reembolso_TA" onchange="toggleEnable()" style="width:100%;">
									<option value="Não">Não</option>
									<option value="Sim">Sim</option>
								</select>
						</div>
					</div>
				</div>

					<input type="hidden" name="id_usuario" id="id_usuario_arquivo">
					<input type="hidden" name="id_empresa" id="id_empresa_arquivo">
					<input type="hidden" name="num_fatura_det" id="num_fatura_det">
					<input type="hidden" name="id_fatura" id="id_fatura">
					<input type="hidden" name="id_arquivo" id="id_arquivo">

					<small><div id="mensagem-arquivo" align="center"></div></small>

			</div>	

			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
					<div id="carregar-viagem"></div>
					<div id="listar-produtos"></div>
			</div>
			</form>		

		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	$(function() {
			$('#valor_fatura').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_aereo').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_alt_voo').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_tarifa_aereo').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_du_rav').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_embarque').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_assento').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_voo').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#credito').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#all_inclusive').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_hospedagem').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_hospedagem').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#total_hospedagem').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#transfer_voo').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#taxa_transfer').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#total_transfer').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_alimentacao').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
			$('#valor_trans_terrestre').maskMoney({
				prefix: 'R$ ',
				allowNegative: true,
				thousands: '.',
				decimal: ',',
				affixesStay: true
			});
		});
		function mask_trecho_voo(){
			$('#trecho_voo').mask('AAA/AAA/AAA/AAA/AAA/AAA/AAA');
			$('#trecho_voo').on("input", function() {
				$(this).val($(this).val().toUpperCase());
			});
		}
		$('#taxa_du_rav').focusout(function() {
			let valor = $('#taxa_du_rav').maskMoney('unmasked')[0];
			let valor2 =  $('#valor_tarifa_aereo').maskMoney("unmasked")[0];
			let campo = 'taxa_alt_percent';
			mostrar_porcentagem(valor,valor2,campo);
		});
		$('#taxa_hospedagem').focusout(function() {
			let valor = $('#taxa_hospedagem').maskMoney('unmasked')[0];
			let valor2 =  $('#valor_hospedagem').maskMoney("unmasked")[0];
			let campo = 'hospedagem_percent';
			mostrar_porcentagem(valor,valor2,campo);
		});
		$('#taxa_transfer').focusout(function() {
			let valor = $('#taxa_transfer').maskMoney('unmasked')[0];
			let valor2 =  $('#transfer_voo').maskMoney("unmasked")[0];
			let campo = 'transfer_percent';
			mostrar_porcentagem(valor,valor2,campo);
		});
		function mostrar_porcentagem(valor1,valor2,campo) {
    		let resultado = (valor1 / valor2) * 100;
    		document.getElementById(campo).value = resultado.toFixed(2);			
		}


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
	var num_fatura_det = $('#num_fatura_det').val();
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
                listarArquivos(id_empresa,num_fatura_det);

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
	function listarArquivos(id,num_fatura_det){
	var id_usuario = localStorage.id_usu;
    $.ajax({
        url: 'paginas/' + pag + "/listar-produtos.php",
        method: 'POST',
        data: {id_usuario, id, num_fatura_det},
        dataType: "html",

        success:function(result){
            $("#listar-produtos").html(result);
			$("#listar-produtos-mostrar").html(result);
        }
    });
}


function excluirArquivo(id,num_fatura_det){
	var id_usuario = localStorage.id_usu;
	var id_empresa = $('#id_arquivo').val();
	var num_fatura_det = $('#num_fatura_det').val();
    $.ajax({
        url: 'paginas/' + pag + "/excluir-produtos.php",
        method: 'POST',
        data: {id, id_usuario},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {
                listarArquivos(id_empresa,num_fatura_det);
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
		$("#data-inicial").val(data1);
		$("#data-final").val(data2);
		listar();
	}
</script>

<script type="text/javascript">
	function carregarViagem(){
		var valor = document.getElementById('id_viagem');
		var id_viagem = valor.options[valor.selectedIndex].value;
		var id_usuario = localStorage.id_usu;
    $.ajax({
        url: 'paginas/' + pag + "/carregar-viagem.php",
        method: 'POST',
        data: {id_usuario, id_viagem},
        dataType: "html",
		success:function(response){
					$("#carregar-viagem").html(response);
				}
    });

	}
	function changeSelectViagem(){

	var select = document.getElementById('centro_de_custo_viagem');
	var selectSetor = document.getElementById('sub_centro_viagem');

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