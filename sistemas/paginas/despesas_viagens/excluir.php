<?php
$tabela = 'despesas_viagens';
require_once("../../../conexao.php");

$id = $_POST['id'];
$id_usuario = $_POST['id_usuario'];
$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['arquivo'];
$fatura = $res[0]['num_fatura'];
if($foto != "sem-foto.png"){
	@unlink('../../images/contas/'.$foto);
}

$pdo->query("DELETE FROM $tabela where id = '$id'");
$pdo->query("DELETE FROM detalhes_viagem where num_fatura = '$fatura'");
echo 'Excluído com Sucesso';
 ?>