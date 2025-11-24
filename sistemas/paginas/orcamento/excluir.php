<?php
$tabela = 'pagar';
$tabela2 = 'detalhes_nota';
require_once("../../../conexao.php");

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['arquivo'];
$numero_documento = $res[0]['numero_documento'];
if($foto != "sem-foto.png"){
	@unlink('../../images/contas/'.$foto);
}

$pdo->query("DELETE FROM $tabela where id = '$id'");
$pdo->query("DELETE FROM $tabela2 where numero_documento_ref = '$numero_documento'");
echo 'Excluído com Sucesso';
 ?>