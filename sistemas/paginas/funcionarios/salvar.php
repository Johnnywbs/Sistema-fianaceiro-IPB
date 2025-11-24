<?php 
$tabela = 'usuarios';
require_once("../../../conexao.php");
$nome = $_POST['nome'];
$email = $_POST['email'];
$pessoa = $_POST['pessoa'];
$telefone = $_POST['telefone'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$data_nascimento= $_POST['data_nascimento'];
$nivel = $_POST['nivel'];
$logradouro = $_POST['logradouro'];
$num_casa = $_POST['num_casa'];
$complemento = $_POST['complemento'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$municipio = $_POST['municipio'];
$uf = $_POST['uf'];
$nome_banco = $_POST['nome_banco'];
$numero_banco = $_POST['numero_banco'];
$agencia_usuario = $_POST['agencia_usuario'];
$tipo_conta = $_POST['tipo_conta'];
$numero_conta = $_POST['numero_conta'];
$chave_pix = $_POST['chave_pix'];

$id = $_POST['id'];
$id_empresa = $_POST['id_empresa'];

$senha = '123';
$senha_crip = md5($senha);


//validar cpf
//if($cpf_cnpj != ""){
//	$query = $pdo->query("SELECT * from $tabela where cpf_cnpj = '$cpf_cnpj' ");
//	$res = $query->fetchAll(PDO::FETCH_ASSOC);
//	if(@count($res) > 0 and $id != $res[0]['id']){
//		echo 'CPF já Cadastrado, escolha outro!!';
//		exit();
//	}
//}


//validar email
if($email != ""){
	$query = $pdo->query("SELECT * from $tabela where email = '$email'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'Email já Cadastrado, escolha outro!!';
		exit();
	}
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['contrato'];
}else{
	$foto = 'sem-foto.png';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['contrato']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['contrato']['tmp_name']; 

if(@$_FILES['contrato']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx'){ 

		if (@$_FILES['contrato']['name'] != ""){

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

if($id == ""){
	$query = $pdo->prepare("INSERT into $tabela SET empresa = '$id_empresa', nome = :nome, email = :email, pessoa = :pessoa, telefone = :telefone, cpf_cnpj = :cpf_cnpj,
													ativo = 'Sim', data = curDate(), nivel = '$nivel', logradouro = :logradouro,
													num_casa = :num_casa, complemento = :complemento, cep = :cep, bairro = :bairro, municipio = :municipio, uf = :uf,
													foto = 'sem-foto.jpg', senha = '123', senha_crip = '$senha_crip', nome_banco = :nome_banco, numero_banco = :numero_banco,
													agencia_usuario = :agencia_usuario, tipo_conta = :tipo_conta, numero_conta = :numero_conta, chave_pix = :chave_pix, data_nascimento= '$data_nascimento', contrato = '$foto' "); 	

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, pessoa = :pessoa, telefone = :telefone, cpf_cnpj = :cpf_cnpj, ativo = 'Sim', nivel = '$nivel',
												logradouro = :logradouro, num_casa = :num_casa, complemento = :complemento, cep = :cep,  bairro = :bairro, municipio = :municipio, uf = :uf,
												nome_banco = :nome_banco, numero_banco = :numero_banco, agencia_usuario = :agencia_usuario, tipo_conta = :tipo_conta, numero_conta = :numero_conta,
												chave_pix = :chave_pix, data_nascimento = '$data_nascimento', contrato = '$foto'  WHERE id = '$id' ");
	
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":pessoa", "$pessoa");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cpf_cnpj", "$cpf_cnpj");
$query->bindValue(":logradouro", "$logradouro");
$query->bindValue(":num_casa", "$num_casa");
$query->bindValue(":complemento", "$complemento");
$query->bindValue(":cep", "$cep");
$query->bindValue(":bairro", "$bairro");
$query->bindValue(":municipio", "$municipio");
$query->bindValue(":uf", "$uf");
$query->bindValue(":nome_banco", "$nome_banco");
$query->bindValue(":numero_banco", "$numero_banco");
$query->bindValue(":agencia_usuario", "$agencia_usuario");
$query->bindValue(":tipo_conta", "$tipo_conta");
$query->bindValue(":numero_conta", "$numero_conta");
$query->bindValue(":chave_pix", "$chave_pix");
$query->execute();


echo 'Salvo com Sucesso';
 ?>