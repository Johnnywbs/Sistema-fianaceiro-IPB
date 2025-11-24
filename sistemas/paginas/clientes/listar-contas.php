<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_hoje = date('Y-m-d');

$id_pessoa = $_POST['id'];
$id_empresa = $_POST['id_empresa'];
$busca = $_POST['busca'];

$query = $pdo->query("SELECT * FROM config WHERE empresa = '$id_empresa'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$token = $res[0]['token'];
$token_pix = $res[0]['token_pix'];
$chave_pix_sistema = $res[0]['chave_pix_sistema'];

if($busca == 'Vencidas'){
	$query = $pdo->query("SELECT * FROM $tabela where pessoa = '$id_pessoa' and empresa = '$id_empresa' and pago != 'Sim' and data_venc < '$data_hoje' order by id asc");

}else if ($busca == 'Pendentes'){
	$query = $pdo->query("SELECT * FROM $tabela where pessoa = '$id_pessoa' and empresa = '$id_empresa' and pago != 'Sim' order by id asc");

}else if ($busca == 'Pagas'){
	$query = $pdo->query("SELECT * FROM $tabela where pessoa = '$id_pessoa' and empresa = '$id_empresa' and pago = 'Sim' order by id asc");
}else{
	$query = $pdo->query("SELECT * FROM $tabela where  pessoa = '$id_pessoa' and empresa = '$id_empresa' order by id desc");
}




$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

if($total_reg > 10){
	$nome_dataTable = 'tabela2';
}else{
	$nome_dataTable = '';
}



echo <<<HTML
<small><small>
	<table class="table table-hover" id="tabela2">
	<thead> 
	<tr> 
	<th>Descrição</th>
	<th class="esc">Valor</th> 
	<th class="esc">Vencimento</th>
	<th class="esc">Arquivo</th>
	<th>Baixar</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

$pendentesF = 0;
$recebidasF = 0;
$vencidasF = 0;
$pendentes = 0;
$recebidas = 0;
$vencidas = 0;
for($i=0; $i < $total_reg; $i++){	
$id = $res[$i]['id'];
$descricao = $res[$i]['descricao'];
$pessoa = $res[$i]['pessoa'];
$valor = $res[$i]['valor'];
$data_lanc = $res[$i]['data_lanc'];
$data_venc = $res[$i]['data_venc'];
$data_pgto = $res[$i]['data_pgto'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$usuario_pgto = $res[$i]['usuario_pgto'];
$frequencia = $res[$i]['frequencia'];
$saida = $res[$i]['saida'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];

//extensão do arquivo
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx'){
	$tumb_arquivo = 'word.png';
}else{
	$tumb_arquivo = $arquivo;
}

$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');


if($pago == 'Sim'){
	$classe_pago = 'text-verde';
	$ocultar = 'ocultar';
	$recebidas += $valor;
	$classe_ocultar = 'ocultar';
}else{
	$classe_pago = 'text-danger';
	$ocultar = '';	
	$pendentes += $valor;
	$classe_ocultar = '';
}



$recebidasF = number_format($recebidas, 2, ',', '.');
$pendentesF = number_format($pendentes, 2, ',', '.');
$vencidasF = number_format($vencidas, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM clientes where id = '$id_pessoa'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res2[0]['telefone'];
$nome_cliente = $res2[0]['nome'];

$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);


$text = '';
$botao_whats = 'text-verde';
$classe_debito = '';
if(strtotime($data_venc) < strtotime($data_hoje) and $pago != 'Sim'){
	$classe_debito = 'text-danger';
	$vencidas += $valor;
	$botao_whats = 'text-danger';

	$text = 'Olá *'.$nome_cliente.'*, sua conta no valor *'.$valorF.'* venceu dia *'.$data_vencF.'*, ainda não consta como paga, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}else{
	$text = 'Olá *'.$nome_cliente.'*, sua conta no valor *'.$valorF.'* vai vencer no dia *'.$data_vencF.'*, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}

if(strtotime($data_venc) == strtotime($data_hoje) and $pago != 'Sim'){
	$text = 'Olá *'.$nome_cliente.'*, sua conta no valor *'.$valorF.'* vai vencer hoje  *'.$data_vencF.'*, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}



if(strtotime($data_venc) < strtotime($data_hoje) and $pago != 'Sim'){
	$textF = 'Olá <b>'.$nome_cliente.'</b>, sua conta no valor <b>'.$valorF.'</b> venceu dia <b>'.$data_vencF.'</b>, ainda não consta como paga, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}else{
	$textF = 'Olá <b>'.$nome_cliente.'</b>, sua conta no valor <b>'.$valorF.'</b> vai vencer no dia <b>'.$data_vencF.'</b>, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}

if(strtotime($data_venc) == strtotime($data_hoje) and $pago != 'Sim'){
	$textF = 'Olá <b>'.$nome_cliente.'</b>, sua conta no valor <b>'.$valorF.'</b> vai vencer hoje  <b>'.$data_vencF.'</b>, caso já tenha efetuado o pagamento favor ignorar essa mensagem!';
}



$classe_w = 'ocultar';
$classe_w2 = '';
if($token == ""){
	$classe_w = '';
	$classe_w2 = 'ocultar';
}

echo <<<HTML
<tr class="{$classe_debito}">
<td><i class="fa fa-square {$classe_pago} mr-1"></i> {$descricao} </td> 
					<td class="esc">R$ {$valorF}</td>	
				<td class="esc">{$data_vencF}</td>
				<td class="esc"><a href="images/contas/{$arquivo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="20px" height="20px"></a></td>
				
<td>


<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle {$ocultar}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square text-verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p style="color:#000">Confirmar Baixa da Conta? <a href="#" onclick="baixar('{$id}', 'receber', '{$id_pessoa}')"><span class="text-verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>


<big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=$text" target="_blank" title="Cobrar Whatsapp" class="text-danger {$classe_ocultar} {$classe_w}"><i class="fa fa-whatsapp {$botao_whats}"></i></a></big>



<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Gerar Cobrança" href="#" class="dropdown-toggle {$classe_ocultar} {$classe_w2}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-whatsapp {$botao_whats}"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p style="color:#000">Confirmar Envio da Cobrança? <a href="#" onclick="cobranca('{$text}', '{$whats}', '{$id_empresa}', '{$id}')"><span class="text-verde">Sim</span></a> <br><br><small> {$textF}</small></p>
		</div>
		</li>										
		</ul>
</li>


</td>
</tr>
HTML;
}

echo <<<HTML
</tbody>
</table>
<div style='margin-top: 5px; font-size:13px' align="right">
Pagas: <span style='color:green'>R$ {$recebidasF} </span>/ Pendentes:<span style='color:red'> R$ {$pendentesF}</span> / Vencidas: <span style='color:red'>R$ {$vencidasF}</span>
</div>
HTML;

}else{
	echo '<small>Não encontramos contas!</small>';
}

 ?>



 <script type="text/javascript">
	$(document).ready( function () {
    $('#<?=$nome_dataTable?>').DataTable({
    		"ordering": false,
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>


<script type="text/javascript">
	function cobranca(texto, tel, empresa, id){
		 $.ajax({
	        url: 'paginas/' + pag + "/cobranca.php",
	        method: 'POST',
	        data: {texto, tel, empresa, id},
	        dataType: "html",

	        success:function(result){         
	           alert('Cobrança Efetuada!');       
	        }
	    });
	}
</script>