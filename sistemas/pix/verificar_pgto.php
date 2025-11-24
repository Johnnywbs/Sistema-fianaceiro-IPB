<?php
require_once('../../conexao.php');
//$ref_api = '58970903187';

$id_empresa = $_POST['id_empresa'];

$query = $pdo->query("SELECT * FROM config WHERE empresa = '$id_empresa'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_sistema = $res[0]['nome_sistema'];
$access_token = $res[0]['token_pix'];

$ref_api = $_POST['ref'];
$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$ref_api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'content-type: application/json',
        'Authorization: Bearer '.$access_token
    ),
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
curl_close($curl);
//echo $resultado->status;
$status_api = $resultado->status;
//var_dump($resultado);

if($status_api == 'approved'){
    echo 'Pagamento Aprovado!';
}else{
    echo 'Pagamento Pendente!';
}
?>