<?php 
$tabela = 'centros_custo';
require_once("../../../conexao.php");
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$orcamento = $_POST['orcamento'];
$despesas = $_POST['despesas'];
$tipo = $_POST['tipo'];


//validar cpf
if($cpf != ""){
	$query = $pdo->query("SELECT * from $tabela where cpf = '$cpf'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'CPF já Cadastrado, escolha outro!!';
		exit();
	}
}


//validar email
if($email != ""){
	$query = $pdo->query("SELECT * from $tabela where email = '$email'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'Email já Cadastrado, escolha outro!!';
		exit();
	}
}


if($id == ""){
	$query = $pdo->prepare("INSERT into $tabela SET empresa = '$id_empresa', nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, ativo = 'Sim', data = curDate(), endereco = :endereco, nivel = '$nivel', foto = 'sem-foto.jpg', senha = '123', senha_crip = '$senha_crip' "); 	

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, ativo = 'Sim', endereco = :endereco, nivel = '$nivel' WHERE id = '$id' ");
	
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":endereco", "$endereco");
$query->execute();


echo 'Salvo com Sucesso';
 ?>