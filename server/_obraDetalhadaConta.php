<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');
$id_obra = $_GET['id'];
$end_result = null;

$user_query = "SELECT 
id_movConta as c1,
DATE_FORMAT(data_movConta,'%d/%m/%Y') as c2,
descricao_movConta as c3, 
nome_fornecedor as c4,			
nome_categoria as c5,
cliente_obra as c6,
tipo_movConta as c7,
CONCAT('R$ ',FORMAT(valor_movConta,2,'de_DE')) as c8,
CONCAT('R$ ',FORMAT(saldo_movConta,2,'de_DE')) as c9		
FROM movconta 
LEFT JOIN fornecedores on id_fornecedor = fornecedor_movConta
LEFT JOIN categorias on id_categoria = categoria_movConta
LEFT JOIN obras on id_obra = responsavel_movConta
where responsavel_movConta = $id_obra";


$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
