<?php
require_once '../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);
header('Content-Type: application/json');

    $end_result = null;

	$user_query = "SELECT 
		id_usu as c1,
		nome_usu as c2,
		matricula_usu as c3, 
		cpf_usu as c4,			
		email_usu as c5,
		CASE 
			WHEN ativo_usu = 1 THEN 'Ativo' ELSE 'Desativado' END as c7,		
			 concat(
		'<button class=\"btn m-b-xs btn-sm btn-info btn-addon\" onclick=\"window.location.href=\'".BASEURL."app/pessoa/usuarios/editar/?id=',id_usu,'\'\"><i class=\"fa  fa-edit\"></i>Editar</button>') as btn
		
		FROM gqu_usuarios";

    $user_exec = $link_conexao->query($user_query);
    if ($user_exec->num_rows > 0){
        while($user_dados = $user_exec->fetch_object()){
            $end_result[] = $user_dados;
        }
        echo '{ "data": '.json_encode($end_result).' }';
    } else {
        echo json_encode(array('data'=>''));
    };
