<?php
require_once '../../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
include_once(CONTROL);

/*BACKUP DO DB ANTERIOR*/
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$data_hora = date('d_m_Y_H-i-s');
$output = shell_exec('C:\wamp64\bin\mysql\mysql5.7.36\bin\mysqldump -u root sistema_ao categorias clientes fornecedores gqu_usuarios movcaixa movconta notas_obra obras > ../../backups/' . $data_hora . '.sql');

$up_exec = $link_conexao->query("INSERT INTO backups (id_bkp, nome_bkp, data_bkp, hora_bkp) VALUES (NULL, '$data_hora', '$data', '$hora')");


/*UPLOAD*/
$uploaddir = dirname(__FILE__) . "/upload/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$extensao = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . 'extrato.' . $extensao)) {
    echo "Enviado";
} else {
    echo "ERRO";
}



/*LEITURA E ENVIO PRO DB*/
require_once 'Ofx.php';
$ofx = new Ofx('upload/extrato.ofx');
$saldo = $ofx->getBalance();



foreach ($ofx->getTransactions() as $transaction) :
    $saldo_query = "SELECT saldo_movConta from movconta WHERE saldo_movConta <> 'Rateio' ";
    $saldo_exec = $link_conexao->query($saldo_query);
    $saldo_row = $saldo_exec->num_rows;
    if ($saldo_row > 0) {
        while ($usu_dados = $saldo_exec->fetch_object()) {
            $saldo_anterior = $usu_dados->saldo_movConta;
        };
    }


    $data_movConta = date("Y-m-d", strtotime(substr($transaction->DTPOSTED, 0, 8)));
    $descricao_movConta = $transaction->NAME;
    $valor_movConta = ltrim($transaction->TRNAMT, "-");
    $cod_movConta = $transaction->FITID;
    $tipo_movConta = $transaction->TRNTYPE;
    if ($tipo_movConta == "CREDIT") {
        $tipo_movConta = "Crédito";
        $valor_saldo = $saldo_anterior + $valor_movConta;
    } elseif ($tipo_movConta == "DEBIT") {
        $tipo_movConta = "Débito";
        $valor_saldo = $saldo_anterior - $valor_movConta;
    }


    $vazio = 0;


    $usu_query = "SELECT * FROM movconta WHERE fitid = $cod_movConta";

    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;

    if ($usu_row == 0) {
        $up1_query = "INSERT INTO movconta VALUES (NULL, '" . $data_movConta . "','" . $descricao_movConta . "',
        '" . $vazio . "', '" . $vazio . "','" . $vazio . "','" . $tipo_movConta . "','" . $valor_movConta . "','" . $valor_saldo . "','" . $cod_movConta . "')";

        $up_exec = $link_conexao->query($up1_query);
    }


endforeach;
header('Location: ' . BASEURL . 'app/movConta/');
/*HEADER*/
