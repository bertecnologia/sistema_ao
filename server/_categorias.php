<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

$end_result = null;

$user_query = "SELECT 
		id_categoria as c1,
		nome_categoria as c2,
		descricao_categoria as c3		
		FROM categorias WHERE id_categoria > 3";

$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
