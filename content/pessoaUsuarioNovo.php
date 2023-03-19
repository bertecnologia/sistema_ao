<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $nome_usu = $_POST['nome_usu'];
    $matricula_usu = $_POST['matricula_usu'];
    $cpf_usu = $_POST['cpf_usu'];
    $email_usu = $_POST['email_usu'];
    $nivel_usu = $_POST['turma_usu'];
    $pw_usu = $_POST['pw_usu'];
    $ativo_usu = $_POST['ativo_usu'];
    $turma_usu = $_POST['turma_usu'];

    $up1_query = "INSERT INTO gqu_usuarios VALUES (NULL, '" . $nome_usu . "','" . $matricula_usu . "',
    '" . $cpf_usu . "', '" . $email_usu . "','" . $nivel_usu . "','" . MD5($pw_usu) . "','" . $turma_usu . "','" . $ativo_usu . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/pessoa/usuarios/');
};
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Cadastro de Usuários</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Informações do Usuário
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" class="form-control" id="id_usu" name="id_usu" value="" disabled />
                            </div>
                            <label class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-7 ">
                                <input type="text" class="form-control" id="nome_usu" name="nome_usu" value="" required />
                            </div>

                            <label class="col-sm-1 control-label">Login</label>
                            <div class="col-sm-2 ">
                                <input type="text" class="form-control" id="matricula_usu" name="matricula_usu" value="" required />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">CPF</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="cpf_usu" name="cpf_usu" value="" required />
                            </div>
                            <label class="col-sm-1 control-label">E-mail</label>
                            <div class="col-sm-4 ">
                                <input type="email" class="form-control" id="email_usu" name="email_usu" value="" required />
                            </div>
                            <label class="col-sm-1 control-label">Senha</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control" id="pw_usu" name="pw_usu" value="" required />
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Status</label>
                            <div class="col-sm-2 ">
                                <select class="form-control" name="ativo_usu" required>
                                    <optgroup label="Status">
                                        <option value="1" selected>Ativo
                                        </option>
                                        <option value="0">Desativado
                                        </option>
                                    </optgroup>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Tipo de usuário</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="turma_usu">
                                    <optgroup label="Usuário">
                                     <option value="0">Usuário</option>
                                     <option value="1">ADM</option>
                                     <option value="2">Manutenção</option>
                                    </optgroup>
                                </select>
                            </div>

                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/pessoa/usuarios/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
                                <button type="submit" class="btn m-b-xs btn-sm btn-primary btn-addon" name="Insert"><i class="glyphicon glyphicon-floppy-saved"></i>Salvar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- / content -->