<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

$end_result = null;

$user_query = "SELECT 
		id_cliente as c1,
		nome_cliente as c2,
		doc_cliente as c3, 
		fone_cliente as c4,			
		endereco_cliente as c5,
		bairro_cliente as c6,
		cidade_cliente as c7		
		FROM clientes";

$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
