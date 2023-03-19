<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

$end_result = null;

$user_query = "SELECT 
		id_obra as c1,
		cliente_obra as c2,
		DATE_FORMAT(inicio_obra,'%d/%m/%Y') as c3, 
		CONCAT (prazo_obra, ' dias') as c4,
		CONCAT('R$ ', FORMAT(REPLACE(REPLACE(valor_obra, '.', ''), ',', '.'),2,'de_DE')) as c5
				
		FROM obras where cliente_obra <> 'Almeida Mori' and id_obra <> -1";

$user_exec = $link_conexao->query($user_query);
if ($user_exec->num_rows > 0) {
	while ($user_dados = $user_exec->fetch_object()) {
		$end_result[] = $user_dados;
	}
	echo '{ "data": ' . json_encode($end_result) . ' }';
} else {
	echo json_encode(array('data' => ''));
};
