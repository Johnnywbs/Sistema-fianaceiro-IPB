<?php
$tabela = 'pagar';
require_once("../../../conexao.php");

function formatacao($valor){
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    $valor = str_replace('R$', '', $valor);
    return $valor;
}

$numero_documento = $_POST['numero_documento'];
$serie_nf = @$_POST['serie_nf'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$data_emiss = $_POST['data_emiss'];
$descricao_pgto = $_POST['descricao_pgto'];
$fornecedor = $_POST['fornecedor'];
$chave_nf = $_POST['chave_nf'];
$cod_aut = $_POST['cod_aut'];
$data_venc = $_POST['data_venc'];
$data_pgto = $_POST['data_pgto'];
$valor = $_POST['valor'];
$valor = formatacao($valor);

$tag = $_POST['tag'];
$base_icms = $_POST['base_icms'];
$base_icms = formatacao($base_icms);

$valor_icms = $_POST['valor_icms'];
$valor_icms = formatacao($valor_icms);

$valor_prod = $_POST['valor_prod'];
$valor_prod = formatacao($valor_prod);

$valor_seguro = $_POST['valor_seguro'];
$valor_seguro = formatacao($valor_seguro);

$valor_frete = $_POST['valor_frete'];
$valor_frete = formatacao($valor_frete);

$desconto = $_POST['desconto'];
$desconto = formatacao($desconto);

$valor_ipi = $_POST['valor_ipi'];
$valor_ipi = formatacao($valor_ipi);

$valor_nota = $_POST['valor_nota'];
$valor_nota = formatacao($valor_nota);

$compensacao = $_POST['compensacao'];
$frequencia = $_POST['frequencia'];
$centro_de_custo = $_POST['centro_de_custo'];
$sub_centro = $_POST['sub_centro'];
$reembolso = $_POST['reembolso'];
$classificacao = $_POST['classificacao'];

$id_usuario = $_POST['id_usuario'];
$id = $_POST['id'];

$id_empresa = $_POST['id_empresa'];

$pessoa = '0';

$new_data = date('Y-m-d',strtotime("+5 days",strtotime($data_emiss)));

//$cargo = $usuario = @$_SESSION['nivel'];
//if(strtotime($data_venc) < strtotime($new_data) and $cargo != 'Administrador' or strtotime($data_venc) < strtotime($new_data) and $cargo != 'Diretoria Financeira' or 
//strtotime($data_venc) < strtotime($new_data) and $cargo != 'Gerência Técnica-Administrativa-Financeira'){
//	echo 'Notas com o vencimento inferior a 5 dias após a data de emissão não podem ser cadastradas!';
//		exit();
//}

$query = $pdo->query("SELECT * FROM $tabela where chave_nf != '' and chave_nf = '$chave_nf' and id != '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $id == ''){
	echo 'Esta nota já foi Cadastrada';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela where cod_aut != '' and cod_aut = '$cod_aut' and id != '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $id == ''){
	echo 'Esta nota já foi Cadastrada';
	exit();
}

if($fornecedor != ""){
	$pessoa = $fornecedor;
}

if($pessoa == ""){
	echo 'Escolha uma Empresa!';
	exit();
}


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['arquivo'];
}else{
	$foto = 'sem-foto.png';
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['arquivo']['tmp_name']; 

if(@$_FILES['arquivo']['name'] != "" or @$_FILES['arquivo_xml']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'pdf'){ 

		if (@$_FILES['arquivo']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.png"){
				@unlink('../../images/contas/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		$nome_img_xml = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo_xml']['name'];
		$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img_xml);
		$caminho = '../../images/contas/' .$nome_img;
		
		$imagem_temp = @$_FILES['arquivo_xml']['tmp_name'];
		$ext = pathinfo($nome_img, PATHINFO_EXTENSION);
			if($ext == 'xml'){
		
				if (@$_FILES['arquivo']['name'] != ""){
		
					//EXCLUO A FOTO ANTERIOR
					if($foto != "sem-foto.png"){
						@unlink('../../images/contas/'.$foto);
					}
		
					$foto = $nome_img;
				}
				move_uploaded_file($imagem_temp, $caminho);
			}else{
				echo 'Extensão de Imagem não permitida!';
				exit();
			}
		}
	}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET empresa = '$id_empresa', numero_documento = '$numero_documento', serie_nf = '$serie_nf',tipo_pagamento = '$tipo_pagamento',data_emiss = '$data_emiss', data_lanc = curDate(), descricao_pgto = '$descricao_pgto', fornecedor = '$fornecedor', chave_nf = '$chave_nf',cod_aut = '$cod_aut', data_venc = '$data_venc', data_pgto = '$data_pgto', valor = :valor, base_icms = :base_icms, valor_icms = :valor_icms,
													valor_prod = :valor_prod, valor_seguro = :valor_seguro, valor_frete = :valor_frete, desconto = :desconto, valor_ipi = :valor_ipi, valor_nota = :valor_nota, pessoa = '$pessoa', frequencia = '$frequencia',compensacao = '$compensacao',centro_de_custo = '$centro_de_custo',sub_centro = '$sub_centro',reembolso = '$reembolso', classificacao = '$classificacao', usuario_lanc = '$id_usuario', arquivo = '$foto', tag = '$tag', pago = 'Não'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET  numero_documento = '$numero_documento',serie_nf = '$serie_nf',tipo_pagamento = '$tipo_pagamento',data_emiss = '$data_emiss', data_lanc = curDate(), descricao_pgto = '$descricao_pgto', fornecedor = '$fornecedor', chave_nf = '$chave_nf',cod_aut = '$cod_aut', data_venc = '$data_venc', data_pgto = '$data_pgto', valor = :valor, base_icms = :base_icms, valor_icms = :valor_icms,
												valor_prod = :valor_prod, valor_seguro = :valor_seguro, valor_frete = :valor_frete, desconto = :desconto, valor_ipi = :valor_ipi, valor_nota = :valor_nota, pessoa = '$pessoa', frequencia = '$frequencia',compensacao = '$compensacao',centro_de_custo = '$centro_de_custo',sub_centro = '$sub_centro',reembolso = '$reembolso', classificacao = '$classificacao', usuario_lanc = '$id_usuario', arquivo = '$foto',tag = '$tag' where id = '$id'");
	
}

$query->bindValue(":valor", "$valor");
$query->bindValue(":base_icms", "$base_icms");
$query->bindValue(":valor_icms", "$valor_icms");
$query->bindValue(":valor_prod", "$valor_prod");
$query->bindValue(":valor_seguro", "$valor_seguro");
$query->bindValue(":valor_frete", "$valor_frete");
$query->bindValue(":desconto", "$desconto");
$query->bindValue(":valor_ipi", "$valor_ipi");
$query->bindValue(":valor_nota", "$valor_nota");

$query->execute();
$ult_id = $pdo->lastInsertId();


echo 'Salvo com Sucesso';
 ?>