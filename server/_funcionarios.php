<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

$end_result = null;

$user_query = "SELECT 
		id_funcionario as c1,
		nome_funcionario as c2,
		doc_funcionario as c3, 
		fone_funcionario as c4,			
		endereco_funcionario as c5,
		bairro_funcionario as c6,
		cidade_funcionario as c7,
		adicional_funcionario as c8		
		FROM funcionarios";

$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
