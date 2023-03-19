<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

$end_result = null;

$user_query = "SELECT 
		id_movCaixa as c1,
		DATE_FORMAT(data_movCaixa,'%d/%m/%Y') as c2,
		descricao_movCaixa as c3, 
		nome_fornecedor as c4,			
		nome_categoria as c5,
		cliente_obra as c6,
		tipo_movCaixa as c7,
		CONCAT('R$ ',FORMAT(valor_movCaixa,2,'de_DE'))  as c8,
		CONCAT('R$ ',FORMAT(saldo_movCaixa,2,'de_DE'))  as c9		
		FROM movcaixa
		LEFT JOIN fornecedores on id_fornecedor = fornecedor_movCaixa
		LEFT JOIN categorias on id_categoria = categoria_movCaixa
        LEFT JOIN obras on id_obra = responsavel_movCaixa";

$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
