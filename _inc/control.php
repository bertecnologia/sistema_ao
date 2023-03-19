<?php
// ** inicializa a sessão se não existir **
if (!isset($_SESSION)) {
	session_start();
}
$authorizedUsers = "";
$donotCheckaccess = "true";
$restrictGoTo = BASEURL . "app/login/";

// ** verifica se o usuário logado tem acesso a página **
if (!((isset($_SESSION['hiperServe_email'])) && (isAuthorized("", $authorizedUsers, $_SESSION['hiperServe_email'], "")))) {
	$qsChar = "?";
	$referer = $_SERVER['PHP_SELF'];
	if (strpos($restrictGoTo, "?"))
		$AqsChar = "&";
	if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
		$referrer .= "?" . $QUERY_STRING;
	$restrictGoTo = $restrictGoTo . $qsChar . "accesscheck=" . urlencode($referer);
	header("Location: " . $restrictGoTo);
	exit;
}
?>
<?php
// ** efetua logout **
$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
	$logoutAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

// ** limpando totalmente os dados do usuário logado
if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
	$_SESSION['hiperServe_email'] = NULL;
	$_SESSION['hiperServe_id'] = NULL;
	$_SESSION['hiperServe_nivel'] = NULL;
	$_SESSION['hiperServe_turma'] = NULL;
	$_SESSION['PrevUrl'] = NULL;
	unset($_SESSION['hiperServe_email']);
	unset($_SESSION['hiperServe_id']);
	unset($_SESSION['hiperServe_nivel']);
	unset($_SESSION['hiperServe_turma']);
	unset($_SESSION['PrevUrl']);
	$logoutGoTo = BASEURL;
	if ($logoutGoTo) {
		header("Location: $logoutGoTo");
		exit;
	}
}
?>
<?php
// ** captura os dados do usuário **
$hiperServe_email = $_SESSION['hiperServe_email'];
$hiperServe_nivel = $_SESSION['hiperServe_nivel'];
$hiperServe_turma = $_SESSION['hiperServe_turma'];
$tipo_usu = "";
$foto_usu = "";
$nome_usu = "";
switch ($hiperServe_nivel) {
	case 0:
	case 1:
	case 2:
		$hiperServe_id = $_SESSION['hiperServe_id'];
		$user_query = "SELECT * FROM gqu_usuarios WHERE id_usu=\"" . $hiperServe_id . "\" AND matricula_usu=\"" . $hiperServe_email . "\"";
		$user_exec = $link_conexao->query($user_query);
		$user_dados = $user_exec->fetch_object();
		$user_row = $user_exec->num_rows;
		if ($user_row > 0) {
			$foto_usu =  "92";
			$nome_usu =  $user_dados->nome_usu;
		} else {
			header("Location: $logoutAction");
			exit;
		}
		break;
}


?>