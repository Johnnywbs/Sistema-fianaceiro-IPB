<?php 
$tabela = 'fornecedores';
require_once("../../../conexao.php");
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$inscricao_estadual = $_POST['inscricao_estadual'];
$inscricao_municipal = $_POST['inscricao_municipal'];
$porte = $_POST['porte'];
$titulo = $_POST['titulo'];
$atividade_economica = $_POST['atividade_economica'];
$natureza = $_POST['natureza'];
$cpf = $_POST['cpf'];
$pessoa = $_POST['pessoa'];
$logradouro = $_POST['logradouro'];
$num_casa = $_POST['num_casa'];
$complemento = $_POST['complemento'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$municipio = $_POST['municipio'];
$uf = $_POST['uf'];
$nome_banco = $_POST['nome_banco'];
$numero_banco = $_POST['numero_banco'];
$agencia_fornecedor = $_POST['agencia_fornecedor'];
$tipo_conta = $_POST['tipo_conta'];
$numero_conta = $_POST['numero_conta'];
$id = $_POST['id'];
$id_empresa = $_POST['id_empresa'];
$chave_pix = $_POST['chave_pix'];


//validar cpf
if($cpf != ""){
	$query = $pdo->query("SELECT * from $tabela where cpf = '$cpf' and empresa = '$id_empresa'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'CPF já Cadastrado, escolha outro!!';
		exit();
	}
}


//validar email
if($email != ""){
	$query = $pdo->query("SELECT * from $tabela where email = '$email' and empresa = '$id_empresa'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'Email já Cadastrado, escolha outro!!';
		exit();
	}
}


if($id == ""){
	$query = $pdo->prepare("INSERT into $tabela SET empresa = '$id_empresa', nome = :nome,porte = :porte,titulo = :titulo,inscricao_estadual = :inscricao_estadual,inscricao_municipal = :inscricao_municipal,
													atividade_economica = :atividade_economica, natureza = :natureza, cpf = :cpf, telefone = :telefone,email = :email, data = curDate(), pessoa = '$pessoa',
													logradouro = :logradouro, num_casa = :num_casa, complemento = :complemento, cep = :cep, bairro =:bairro, municipio =:municipio, uf =:uf,nome_banco = :nome_banco,
													numero_banco = :numero_banco, agencia_fornecedor = :agencia_fornecedor, tipo_conta =:tipo_conta, numero_conta = :numero_conta,chave_pix = :chave_pix"); 	

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, porte = :porte, titulo = :titulo,inscricao_estadual = :inscricao_estadual, inscricao_municipal = :inscricao_municipal,
											atividade_economica = :atividade_economica, natureza = :natureza, cpf = :cpf,  telefone = :telefone, email = :email, pessoa = '$pessoa',
											logradouro = :logradouro, num_casa = :num_casa, complemento = :complemento, cep = :cep, bairro =:bairro, municipio =:municipio, uf =:uf, nome_banco = :nome_banco,
											numero_banco = :numero_banco, agencia_fornecedor = :agencia_fornecedor, tipo_conta =:tipo_conta, numero_conta = :numero_conta,chave_pix = :chave_pix WHERE id = '$id' ");
	
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":porte", "$porte");
$query->bindValue(":titulo", "$titulo");
$query->bindValue(":inscricao_estadual", "$inscricao_estadual");
$query->bindValue(":inscricao_municipal", "$inscricao_municipal");
$query->bindValue(":atividade_economica", "$atividade_economica");
$query->bindValue(":natureza", "$natureza");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":email", "$email");
$query->bindValue(":logradouro", "$logradouro");
$query->bindValue(":num_casa", "$num_casa");
$query->bindValue(":complemento", "$complemento");
$query->bindValue(":cep", "$cep");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":municipio", "$municipio");
$query->bindValue(":uf", "$uf");
$query->bindValue(":nome_banco", "$nome_banco");
$query->bindValue(":numero_banco", "$numero_banco");
$query->bindValue(":agencia_fornecedor", "$agencia_fornecedor");
$query->bindValue(":tipo_conta", "$tipo_conta");
$query->bindValue(":numero_conta", "$numero_conta");
$query->bindValue(":chave_pix", "$chave_pix");

$query->execute();


echo 'Salvo com Sucesso';
 ?>