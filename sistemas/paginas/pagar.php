<?php 
$pag = 'pagar';

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
			<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo(a) Custo / Despesa</a>
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


		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:15px">
			<select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca" onchange="listar()">
				<option value="">Pendentes / Pagas</option>
				<option value="Não">Pendentes</option>
				<option value="Sim">Pagas</option>
				
			</select>
		</div>

		<div style="margin-top:5px;"> 
		<small>
			<a title="Contas à Pagar Vencidas" class="text-muted" href="#" onclick="listarContasVencidas('Vencidas')"><span>Vencidas</span></a> / 
			<a title="Contas à Pagar Hoje" class="text-muted" href="#" onclick="alterarData('<?php echo $data_hoje ?>', '<?php echo $data_hoje ?>')"><span>Hoje</span></a> / 
			<a title="Contas à Pagar Amanhã" class="text-muted" href="#" onclick="alterarData('<?php echo $data_amanha ?>', '<?php echo $data_amanha ?>')"><span>Amanhã</span></a> /
			<a title="Contas à Pagar Mês" class="text-muted" href="#" onclick="alterarData('<?php echo $data_inicio_mes ?>', '<?php echo $data_final_mes ?>')"><span>Mês</span></a>
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
				<h4 class="modal-title"><span id="">Cadastrar Nova Conta</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">			
							<label>Descrição</label> 
							<input type="text" class="form-control" name="descricao_pgto" id="descricao_pgto"> 					
						</div>	
						<div class="col-md-3">						
							<label>Tipo</label>
								<select class="form-control" name="tipo_pagamento" id="tipo_pagamento" onchange="toggleEnable()" style="width:100%;">
									<option value=""></option>
									<option value="Boleto">Boleto</option>
									<option value="DARF">DARF</option>
									<option value="Doação">Doação</option>
									<option value="Fatura">Fatura</option>
									<option value="Fatura - Viagem">Fatura - Viagem</option>
									<option value="Folha de Pagamento">Folha de Pagamento</option>
									<option value="Nota do Fornecedor">Nota do Fornecedor</option>
									<option value="Nota de Serviço">Nota de Serviço</option>
									<option value="Recibo">Recibo</option>
									<option value="RPA">RPA</option>
								</select>
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
						<div class="col-md-4">			
							<label>Tag</label> 
							<input type="text" class="form-control" name="tag" id="tag"> 					
						</div>
					</div>
					<div class="row">
						<h4 class="modal-title" id="exampleModalLabel"><span id="">Dados</span></h4>
						<div class="col-md-3">						
								<label>Emissão</label> 
								<input type="date" class="form-control" name="data_emiss" id="data_emiss" required>					
						</div>

						<div class="col-md-3">						
							<label>Vencimento</label>
							<input type="date" class="form-control" name="data_venc" id="data_venc"> 					
						</div>

						<div class="col-md-3">						
							<label>Data de Pagamento</label>
							<input type="date" class="form-control" name="data_pgto" id="data_pgto"> 					
						</div>
						<div class="col-md-3">			
							<label>Valor</label> 
							<input type="text" class="form-control" name="valor" id="valor" required> 					
						</div>
						<div class="col-md-3">
							<label>Número Doc.</label> 
							<input type="text" class="form-control" name="numero_documento" id="numero_documento">
						</div>
						<div class="col-md-2">						
							<label>Série(NF)</label> 
							<input type="text" class="form-control" name="serie_nf" id="serie_nf" readonly oninput="mask()">
						</div>
						
						<div class="col-md-7">			
							<label>Chave de Acesso (NF)</label> 
							<input type="text" class="form-control" name="chave_nf" id="chave_nf" readonly oninput="mask()">
						</div>
						<div class="col-md-4">
							<div class="form-group"> 
								<label>Código de Autenticidade</label> 
								<input type="text" class="form-control" name="cod_aut"  id="cod_aut" readonly oninput="mask()">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group"> 
								<label>Anexo</label> 
								<input type="file" class="form-control" name="arquivo" onChange="carregarImg();" id="arquivo">
							</div>
						</div>

					</div>


						<div class="row">
							<h4 class="modal-title" id="exampleModalLabel"><span id="">Cálculo dos impostos</span></h4>
							<div class="col-md-3">
								<label>Base de Calc. ICMS</label> 
								<input type="text" class="form-control" name="base_icms" id="base_icms">
							</div>
							<div class="col-md-3">
								<label>ICMS</label> 
								<input type="text" class="form-control" name="valor_icms" id="valor_icms">
							</div>
							
							<div class="col-md-3">
									<label>Seguro</label> 
									<input type="text" class="form-control" name="valor_seguro" id="valor_seguro">					
							</div>

							<div class="col-md-3">
									<label>Total Bruto</label> 
									<input type="text" class="form-control" name="valor_bruto" id="valor_bruto">					
							</div>

							<div class="col-md-3">
									<label>IPI</label> 
									<input type="text" class="form-control" name="valor_ipi" id="valor_ipi">					
							</div>
							<div class="col-md-3">
									<label>PIS/PASEP</label> 
									<input type="text" class="form-control" name="pis_pasep" id="pis_pasep">					
							</div>

							<div class="col-md-3">
									<label>COFINS</label> 
									<input type="text" class="form-control" name="cofins" id="cofins">					
							</div>

							<div class="col-md-3">
									<label>CSLL</label> 
									<input type="text" class="form-control" name="csll" id="csll">					
							</div>

							<div class="col-md-3">
									<label>IRRF</label> 
									<input type="text" class="form-control" name="irrf" id="irrf">					
							</div>
							
							<div class="col-md-3">
									<label>ISS</label> 
									<input type="text" class="form-control" name="iss" id="iss">					
							</div>

							<div class="col-md-3">
									<label>Valor Frete</label> 
									<input type="text" class="form-control" name="valor_frete" id="valor_frete">					
							</div>

							<div class="col-md-3">
									<label>Desconto</label> 
									<input type="text" class="form-control" name="desconto" id="desconto">					
							</div>

							<div class="col-md-3">
									<label>Valor Líquido</label> 
									<input type="text" class="form-control" name="valor_nota" id="valor_nota">					
							</div>
						</div>

							<div class="row">
							<h4 class="modal-title" id="exampleModalLabel"><span id="">Outros</span></h4>
								<div class="col-md-3">
									<label>Compensação</label> 
									<select class="form-control" name="compensacao" id="compensacao">
										<option value="Não">Não</option>
										<option value="Sim">Sim</option>
									</select>
								</div>
								<div class="col-md-3">
									<label>Reembolso</label> 
									<select class="form-control" name="reembolso" id="reembolso">
										<option value="Não">Não</option>
										<option value="Sim">Sim</option>
									</select>
								</div>
								<div class="col-md-3">						
									<label>Frequência</label> 
									<select class="form-control" name="frequencia" id="frequencia" style="width:100%;"> 
										<?php 
										$query = $pdo->query("SELECT * FROM frequencias where empresa = $id_empresa order by id asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>	
											<option value="<?php echo $res[$i]['dias'] ?>"><?php echo $res[$i]['frequencia'] ?></option>

										<?php } ?>

									</select>					
								</div>
								<div class="col-md-3">
									<div class="form-group"> 
										<label>Classificação</label> 
										<select class="form-control" name="classificacao" id="classificacao">
											<option value="Despesa Variável">Despesa Variável</option>
											<option value="Despesa Fixa">Despesa Fixa</option>
											<option value="Custo Variável">Custo Variável</option>
											<option value="Custo Fixo">Custo Fixo</option>
										</select>
									</div>
								</div>
								<div class="col-md-5">						
									<label>Selecione um Centro de Custo</label> 
									<select class="form-control sel2" name="centro_de_custo" id="centro_de_custo" style="width:100%;" onChange = "changeSelect();"> 
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

								<div class="col-md-6">					
									<div class="form-group"> 
										<label>Selecione um Sub-Centro</label> 
										<select class="form-control sel2" name="sub_centro" id="sub_centro" style="width:100%;"> 
											<option value="">Selecione um Sub-Centro</option>
										</select>
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



<div class="modal fade" id="modalArquivoXML" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir">NF-e</span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form_xml">
				<div class="modal-body">

					<div class="row">						

						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Arquivo</label> 
								<input type="file" class="form-control" name="arquivo_xml" onChange="carregarImg();" id="arquivo_xml">
							</div>						
						</div>
						<div class="col-md-4">
							<div id="divImg">
								<img src="images/contas/sem-foto.png"  width="100px" id="target">									
							</div>
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
						<span><b>Valor: </b></span>
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
						<span><b>Base de Cálc. ICMS:</b></span>
						<span id="base_icms_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Valor do ICMS:  </b></span>
						<span id="valor_icms_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Valor do Seguro:  </b></span>
						<span id="valor_seguro_mostrar"></span>
					</div>

				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">
						<span><b>Valor Total Bruto: </b></span>
						<span id="valor_bruto_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Valor IPI:  </b></span>
						<span id="valor_ipi_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Pis/Pasep:  </b></span>
						<span id="pis_pasep_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">
						<span><b>Cofins:  </b></span>
						<span id="cofins_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>CSLL: </b></span>
						<span id="csll_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>IRRF:  </b></span>
						<span id="irrf_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">
						<span><b>ISS:  </b></span>
						<span id="iss_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Valor do Frete:  </b></span>
						<span id="valor_frete_mostrar"></span>
					</div>
					<div class="col-md-4">
						<span><b>Desconto: </b></span>
						<span id="desconto_mostrar"></span>
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">
						<span><b>Valor Líquido:  </b></span>
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





<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="">Detalhes da Conta</span></h4>
				<button id="btn-fechar-arquivo" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
			<form id="form-arquivos">		
			<div class="modal-body">

				<div class="row">
						<div class="col-md-12">							
								<label>Descrição do Produto / Serviço</label>
								<input type="text" class="form-control" id="descricao_prod" name="descricao_prod" placeholder="Descrição" required>							
						</div>

						<div class="col-md-2">							
								<label>Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade"  >							
						</div>
						<div class="col-md-3">							
								<label>Valor Unitário</label>
								<input type="text" class="form-control" id="valor_unit" name="valor_unit"  >							
						</div>
						<div class="col-md-3">							
								<label>Valor do Desconto</label>
								<input type="text" class="form-control" id="valor_desconto" name="valor_desconto"  >							
						</div>
						<div class="col-md-4">
							<div class="form-group"> 
								<label>Classificação</label> 
								<select class="form-control" name="classificacao_prod" id="classificacao_prod">
									<option value="Despesa Variável">Despesa Variável</option>
									<option value="Despesa Fixa">Despesa Fixa</option>
									<option value="Custo Variável">Custo Variável</option>
									<option value="Custo Fixo">Custo Fixo</option>
								</select>
							</div>
						</div>

				</div>
				<div class="row">
					<div class="col-md-5">						
						<label>Selecione um Centro de Custo</label> 
						<select class="form-control sel2" name="centro_de_custo_prod" id="centro_de_custo_prod" style="width:100%;" onChange = "changeSelectProd();"> 
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

					<div class="col-md-6">					
						<div class="form-group"> 
							<label>Selecione um Sub-Centro</label> 
							<select class="form-control sel2" name="sub_centro_prod" id="sub_centro_prod" style="width:100%;"> 

								<option value="">Selecione um Sub-Centro</option>

							</select>
						</div>						
					</div>
				</div>

					<input type="hidden" name="id_usuario" id="id_usuario_arquivo">
					<input type="hidden" name="id_empresa" id="id_empresa_arquivo">
					<input type="hidden" name="id_ref" id="id_ref">					
					<input type="hidden" name="numero_documento_ref" id="numero_documento_ref">
					<input type="hidden" name="data_pgto_produto" id="data_pgto_produto">
					<input type="hidden" name="id_arquivo" id="id_arquivo">

					<small><div id="mensagem-arquivo" align="center"></div></small>

					<hr>

					<div id="listar-produtos"></div>
					
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	<script type="text/javascript">
			$("#cod_aut").on("input", function() {
			$(this).val($(this).val().toUpperCase());
			});
			$("#tag").on("input", function() {
			$(this).val($(this).val().toUpperCase());
			});
			function mask(){
				$('#chave_nf').mask('0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000 0000');
				$('#serie_nf').mask('000');
			}
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
				$('#valor_bruto').maskMoney({
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
				$('#pis_pasep').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#cofins').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#csll').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#irrf').maskMoney({
					prefix: 'R$ ',
					allowNegative: true,
					thousands: '.',
					decimal: ',',
					affixesStay: true
				});
				$('#iss').maskMoney({
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
			function toggleEnable(){
				var input = $('#tipo_pagamento').val();

				if(input != 'Nota de Serviço' && input != 'Nota do Fornecedor') {
					var campo = document.querySelector("#chave_nf");
					campo.readOnly = true;
					var campo = document.querySelector("#serie_nf");
					campo.readOnly = true;
					var campo = document.querySelector("#cod_aut");
					campo.readOnly = true;
				}
				else{
					var campo = document.querySelector("#chave_nf");
					campo.readOnly = false;
					var campo = document.querySelector("#serie_nf");
					campo.readOnly = false;
					var campo = document.querySelector("#cod_aut");
					campo.readOnly = false;
				}
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
	function inserirArquivo(){
		$('#id_usuario').val(localStorage.id_usu);
		$('#id_empresa').val(localStorage.id_empresa);
		$('#mensagem').text('');
		$('#titulo_inserir').text('Inserir Registro');
		$('#modalArquivoXML').modal('show');
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

	function changeSelectProd(){

	var select = document.getElementById('centro_de_custo_prod');
	var selectSetor = document.getElementById('sub_centro_prod');

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
