<?php 
$tabela = 'detalhes_nota';
require_once("../../../conexao.php");
$id_arquivo = $_POST['id_arquivo'];
$id_ref = $_POST['id_ref'];
$chave = $_POST['numero_documento_ref'];
$descricao_prod = $_POST['descricao_prod'];
$quantidade = $_POST['quantidade'];
$valor_desconto = $_POST['valor_desconto'];
$valor_desconto = str_replace('.', '', $valor_desconto);
$valor_desconto = str_replace(',', '.', $valor_desconto);
$valor_desconto = str_replace('R$', '', $valor_desconto);
$valor_unit = $_POST['valor_unit'];
$valor_unit = str_replace('.', '', $valor_unit);
$valor_unit = str_replace(',', '.', $valor_unit);
$valor_unit = str_replace('R$', '', $valor_unit);
$classificacao_prod = $_POST['classificacao_prod'];
$centro_de_custo = $_POST['centro_de_custo_prod'];
$sub_centro = $_POST['sub_centro_prod'];
$id_empresa = $_POST['id_empresa'];
$data_pgto = $_POST['data_pgto_produto'];
if($id_arquivo == ''){
    $query = $pdo->prepare("INSERT INTO $tabela SET  id_ref = '$id_ref', descricao = '$descricao_prod', numero_documento_ref = '$chave', quantidade = '$quantidade', centro_de_custo = '$centro_de_custo', sub_centro = '$sub_centro',classificacao = '$classificacao_prod', valor_unitario = :valor_unit, desconto = :valor_desconto, data_pgto = '$data_pgto'"); 
    $query->bindValue(":valor_unit", "$valor_unit");
    $query->bindValue(":valor_desconto", "$valor_desconto");
    $query->execute();
}
else{
    $query = $pdo->prepare("UPDATE $tabela SET  id_ref = '$id_ref', descricao = '$descricao_prod', numero_documento_ref = '$chave', quantidade = '$quantidade', centro_de_custo = '$centro_de_custo', sub_centro = '$sub_centro',classificacao = '$classificacao_prod', valor_unitario = :valor_unit, desconto = :valor_desconto, data_pgto = '$data_pgto' where id = '$id_arquivo'"); 
    $query->bindValue(":valor_unit", "$valor_unit");
    $query->bindValue(":valor_desconto", "$valor_desconto");
    $query->execute();
}
echo 'Salvo com Sucesso';
?>