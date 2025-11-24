<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$porte = $_POST['porte'];
$inscricao_estadual = $_POST['inscricao_estadual'];
$inscricao_municipal = $_POST['inscricao_municipal'];
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
$id = $_POST['id'];
$id_empresa = $_POST['id_empresa'];

$senha = '123';
$senha_crip = md5($senha);


if($email == "" and $cpf == ""){
	echo 'Preencha o CPF ou o Email!';
	exit();
}

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
	logradouro = :logradouro, num_casa = :num_casa, complemento = :complemento, cep = :cep, bairro =:bairro, municipio =:municipio, uf =:uf"); 	

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, porte = :porte, titulo = :titulo,inscricao_estadual = :inscricao_estadual, inscricao_municipal = :inscricao_municipal,
	atividade_economica = :atividade_economica, natureza = :natureza, cpf = :cpf,  telefone = :telefone, email = :email, pessoa = '$pessoa',
	logradouro = :logradouro, num_casa = :num_casa, complemento = :complemento, cep = :cep, bairro =:bairro, municipio =:municipio, uf =:uf WHERE id = '$id' ");
	
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

$query->execute();


echo 'Salvo com Sucesso';
 ?>