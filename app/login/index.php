<?php
ob_start("ob_gzhandler");
require_once '../../config.php';
require_once(CONNECT);
include_once(FUNCTIONS);
?>
<?php
//** inicializa a sessão se não existir **
if (!isset($_SESSION)) {
	session_start();
}
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
	$_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['matricula'])) {
	//** variaveis **
	$hiperServe_email = $_POST['matricula'];
	$hiperServe_pw = $_POST['password'];
	$hiperServe_fldUserAuthorization = "";
	$hiperServe_redirectLoginSuccess = BASEURL . "app/movConta";
	$hiperServe_redirectLoginFailed = BASEURL . "app/login/?msg=1";
	$hiperServe_redirecttoReferer = true;

	//** query banco **
	$user_query = "SELECT * FROM gqu_usuarios WHERE matricula_usu=\"" . $hiperServe_email . "\" AND pw_usu=md5(\"" . $hiperServe_pw . "\")";

	$user_exec = $link_conexao->query($user_query);
	$numFoundUser = $user_exec->num_rows;

	if ($numFoundUser) {
		$user_dados = $user_exec->fetch_object();
		$loginStrGroup = "";
		$hiperServe_email = $user_dados->matricula_usu;
		$hiperServe_id = $user_dados->id_usu;
		$hiperServe_nivel = $user_dados->nivel_usu;
		$hiperServe_turma = $user_dados->turma_usu;

		//declarar variáveis de sessão e atribui valores
		$_SESSION['hiperServe_email'] = $hiperServe_email;
		$_SESSION['hiperServe_id'] = $hiperServe_id;
		$_SESSION['hiperServe_nivel'] = $hiperServe_nivel;
		$_SESSION['hiperServe_turma'] = $hiperServe_turma;
		$_SESSION['fData'] = "";

		if (isset($_SESSION['PrevUrl']) && true) {
			//$hiperServe_redirectLoginSuccess = $_SESSION['PrevUrl'];
		}
		header("Location: " . $hiperServe_redirectLoginSuccess);
	} else {
		error_log("User or Password Mismatch: $hiperServe_email:$hiperServe_pw");
		header("Location: " . $hiperServe_redirectLoginFailed);
	}
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
	$_SESSION['fData'] = NULL;
	unset($_SESSION['hiperServe_email']);
	unset($_SESSION['hiperServe_id']);
	unset($_SESSION['hiperServe_nivel']);
	unset($_SESSION['hiperServe_turma']);
	unset($_SESSION['PrevUrl']);
	unset($_SESSION['fData']);

	$logoutGoTo = BASEURL;
	if ($logoutGoTo) {
		header("Location: $logoutGoTo");
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br" data-ng-app="app">

<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta name="description" content="" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASEURL; ?>images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASEURL; ?>images/iconeAlmeidaMori_noBg.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASEURL; ?>images/iconeAlmeidaMori_noBg.png">
	<link rel="mask-icon" href="<?php echo BASEURL; ?>images/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#bbbfbe">

	<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=3" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>bower_components/animate.css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/font.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/app.css" type="text/css" />
</head>

<body>
	<div class="app" style="height: 100%; background-image: url(../../images/predios.jpg)">
		<div class="banner col-sm-12">

			<!-- <video autoplay muted loop>
				<source src="<?php echo BASEURL; ?>images/video.mp4" type="video/mp4">
			</video> -->


			<div class="content">
				<div class="col-sm-6">
					<div style="background-color: #FFF;padding: 10px;border-radius: 20px;width: 500px;" class="container w-xxl w-auto-xs ng-scope" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
						<a href="" class="navbar-brand block m-t"><img style=" width: 700px;  max-width: 100%;max-height: 100%;" src="<?php echo BASEURL; ?>images/logo_AlmeidaMori.jpeg" alt=""></a>
						<div class="m-b-lg">
							<div class="wrapper text-center"><strong style="font-size: 20px;">Iniciar sessão</strong></div>
							<form name="form" class="form-validation" method="post" action="?atualiza=1" enctype="multipart/form-data">
								<div class="list-group list-group-sm card-content-area">
									<div style="background-color: transparent;border-color: transparent;" class="list-group-item">
										<input name="matricula" type="text" class="form-control no-border" placeholder="Login" required autocomplete="off">
									</div>
									<div style="margin-top: 8px;" class="list-group list-group-sm">
										<div style="background-color: transparent;border-color: transparent;" class="list-group-item">
											<div class="input-group ">
												<input id="pass" name="password" type="password" placeholder="Senha" class="form-control no-border" required autocomplete="off">
												<span id="olho" class="input-group-addon" style="background:transparent;border:none">
													<a class="fa fa-eye" style="background:transparent;border:none"></a>
												</span>
											</div>
										</div>
									</div>
								</div>
								<button style="border-radius: 30px;background-color:#0373a5;" type="submit" class="btn btn-lg btn-primary btn-block">Iniciar sessão</button>

								<!-- <div class="text-center m-t m-b">&nbsp;</div>
								<div class="line line-dashed"></div>
								
								<p class="text-center"><small>Não tem conta? Entre em contato com o responsável, através do e-mail: <b>Teste@teste.com</b><br>Através do contato:<b>(35)9 9999-9999</b> </small></p> -->
							</form>
							<!--	<div style="margin-top: 1px;" class="text-center">
								<a style="text-align: center; color: #4bb1cf;font-size: 18px;" href="../../../iniciosite">Voltar para o Site</a>
							</div> -->
						</div>
						<!--<div class="text-center">
							<a href="" class="navbar-brand block m-t"><img style="width: 170px;height: 40px;  max-width: 100%;max-height: 100%;" src="<?php echo BASEURL; ?>images/logo_site.png" alt=""></a>
							<p><small class="text-muted">Sistema desenvolvido por <br> © 2020 - <?php echo $empresa; ?></small></p>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script>
		document.getElementById('olho').addEventListener('mousedown', function() {
			document.getElementById('pass').type = 'text';
		});

		document.getElementById('olho').addEventListener('mouseup', function() {
			document.getElementById('pass').type = 'password';
		});

		// Para que o password não fique exposto apos mover a imagem.
		document.getElementById('olho').addEventListener('mousemove', function() {
			document.getElementById('pass').type = 'password';
		});
	</script>
	<script src="<?php echo BASEURL; ?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo BASEURL; ?>bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="<?php echo BASEURL; ?>js/ui-load.js"></script>
	<script src="<?php echo BASEURL; ?>js/ui-jp.config.js"></script>
	<script src="<?php echo BASEURL; ?>js/ui-jp.js"></script>
	<script src="<?php echo BASEURL; ?>js/ui-nav.js"></script>
	<script src="<?php echo BASEURL; ?>js/ui-toggle.js"></script>

</body>

</html>
<style>
	.card-content-area input {

		margin-top: 10px;

		padding: 0 5px;

		background-color: transparent;

		border: none;

		border-bottom: 2px solid #e1e1e1;

		outline: none;

		color: #000000;
		font-size: 16px;

	}

	body {
		margin: 0;
		padding: 0;
	}

	.banner {
		width: 100%;
		height: 100vh;
		overflow: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.banner video {
		position: fixed;
		top: 0;
		left: 0;
		object-fit: cover;
		width: 100%;
		height: 100%;
	}

	.banner .content {
		position: relative;
		z-index: 1;
		max-width: 1000px;
		margin: 0 auto;
		text-align: center;
	}

	.banner .content h1 {
		margin: 0;
		padding: 0;
		font-size: 3.5em;
		text-transform: uppercase;
		color: #ffff;
	}
</style>