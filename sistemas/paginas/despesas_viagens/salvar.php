<?php
$tabela = 'despesas_viagens';
require_once("../../../conexao.php");

function formatacao($valor){
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    $valor = str_replace('R$', '', $valor);
    return $valor;
}

$descricao_viagem = $_POST['descricao_viagem'];
$fornecedor = $_POST['fornecedor'];
$num_fatura = $_POST['num_fatura'];

$valor_fatura = $_POST['valor_fatura'];
$valor_fatura = formatacao($valor_fatura);

$data_emiss_fat = $_POST['data_emiss_fat'];
$data_venc_fat = $_POST['data_venc_fat'];
$data_pgto_fat = $_POST['data_pgto_fat'];

$id_usuario = $_POST['id_usuario'];
$id = $_POST['id'];

$id_empresa = $_POST['id_empresa'];


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['arquivo'];
}else{
	$foto = 'sem-foto.png';
}

$query = $pdo->query("SELECT * FROM $tabela where num_fatura = '$num_fatura'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $id == ""){
	echo 'Não é possível cadastrar faturas com númeração repetida!';
	exit();
}
elseif($num_fatura == '' or $num_fatura == '0'){
	echo 'Não é possível cadastrar viagens sem o numero da fatura!';
	exit();
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['arquivo']['tmp_name']; 

if(@$_FILES['arquivo']['name'] != ""){
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
	}
	}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET descricao_viagem = '$descricao_viagem', fornecedor = '$fornecedor',num_fatura = '$num_fatura',valor_fatura = :valor_fatura, data_emiss_fat = '$data_emiss_fat', data_venc_fat = '$data_venc_fat',data_pgto_fat = '$data_pgto_fat', usuario_lanc = '$id_usuario', arquivo = '$foto'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET  descricao_viagem = '$descricao_viagem', fornecedor = '$fornecedor',num_fatura = '$num_fatura',valor_fatura = :valor_fatura, data_emiss_fat = '$data_emiss_fat', data_venc_fat = '$data_venc_fat', data_pgto_fat = '$data_pgto_fat', usuario_lanc = '$id_usuario', arquivo = '$foto' where id = '$id'");
	
}

$query->bindValue(":valor_fatura", "$valor_fatura");

$query->execute();
$ult_id = $pdo->lastInsertId();


echo 'Salvo com Sucesso';
 ?>