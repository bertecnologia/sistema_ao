<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Editar']))) {
    $id_usu = $_GET['id'];
    $nome_usu = $_POST['nome_usu'];
    $matricula_usu = $_POST['matricula_usu'];
    $cpf_usu = $_POST['cpf_usu'];
    $email_usu = $_POST['email_usu'];
    $nivel_usu = $_POST['turma_usu'];
    $pw_usu = $_POST['pw_usu'];
    $ativo_usu = $_POST['ativo_usu'];
    $turma_usu = $_POST['turma_usu'];

    $up1_query = "UPDATE gqu_usuarios SET nome_usu = '" . $nome_usu . "',
                                             matricula_usu = '" . $matricula_usu . "', 
                                             cpf_usu = '" . $cpf_usu . "', 
                                             email_usu = '" . $email_usu . "', 
                                             nivel_usu = '" . $nivel_usu . "', 
                                             pw_usu = '" . MD5($pw_usu) . "', 
                                             ativo_usu = '" . $ativo_usu . "',
                                             turma_usu = '" . $turma_usu . "'
                                             WHERE id_usu = $id_usu";

    $up2_query = "UPDATE gqu_usuarios SET nome_usu = '" . $nome_usu . "',
                                             matricula_usu = '" . $matricula_usu . "', 
                                             cpf_usu = '" . $cpf_usu . "', 
                                             email_usu = '" . $email_usu . "', 
                                             nivel_usu = '" . $nivel_usu . "',
                                             ativo_usu = '" . $ativo_usu . "',
                                             turma_usu = '" . $turma_usu . "'
                                             WHERE id_usu = $id_usu";

    if ($pw_usu == '') {
        $up_exec = $link_conexao->query($up2_query);
    } else {
        $up_exec = $link_conexao->query($up1_query);
    }

    header('Location: ' . BASEURL . 'app/pessoa/usuarios/');
};


$id_ch = "";
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id_usu = $_GET['id'];
    //pega usuário
    $usu_query = "SELECT * FROM gqu_usuarios WHERE id_usu=$id_usu";
    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;
    if ($usu_row == 1) {
        while ($usu_dados = $usu_exec->fetch_object()) {
            $id_usu = $usu_dados->id_usu;
            $nome_usu = $usu_dados->nome_usu;
            $matricula_usu = $usu_dados->matricula_usu;
            $cpf_usu = $usu_dados->cpf_usu;
            $email_usu = $usu_dados->email_usu;
            $nivel_usu = $usu_dados->nivel_usu;
            //$pw_usu = ($usu_dados->pw_usu);
            $ativo_usu = $usu_dados->ativo_usu;
            $turma_usu = $usu_dados->turma_usu;
        };
    } else {
        header('Location: ' . BASEURL);
    }
} else {
    header('Location: ' . BASEURL);
}
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Editar usuário número <?php echo $id_ch; ?></h1>
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
                                <input type="hidden" class="form-control" id="id_usu" name="id_usu" value="<?php echo $id_usu ?>" disabled />
                            </div>
                            <label class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-7 <?php if ($nome_usu == '') {
                                                        echo " has-error";
                                                    }; ?>">
                                <input type="text" class="form-control" id="nome_usu" name="nome_usu" value="<?php echo $nome_usu ?>" />
                            </div>
                            <label class="col-sm-1 control-label">Login</label>
                            <div class="col-sm-2 <?php if ($matricula_usu == '') {
                                                        echo " has-error";
                                                    }; ?>">
                                <input type="text" class="form-control" id="matricula_usu" name="matricula_usu" value="<?php echo $matricula_usu ?>" />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">CPF</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="cpf_usu" name="cpf_usu" value="<?php echo $cpf_usu ?>" />
                            </div>
                            <label class="col-sm-1 control-label">E-mail</label>
                            <div class="col-sm-4 <?php if ($email_usu == '') {
                                                        echo " has-error";
                                                    }; ?>">
                                <input type="text" class="form-control" id="email_usu" name="email_usu" value="<?php echo $email_usu ?>" />
                            </div>

                            <label class="col-sm-1 control-label">Senha</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control" id="pw_usu" name="pw_usu" value="" />
                            </div>

                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Status</label>
                            <div class="col-sm-2 <?php if ($ativo_usu == '') {
                                                        echo " has-error";
                                                    }; ?>">
                                <select class="form-control" name="ativo_usu">
                                    <optgroup label="Status">
                                        <option value="1" <?php if ($ativo_usu == '1') {
                                                                echo " selected";
                                                            }; ?>>Ativo
                                        </option>
                                        <option value="0" <?php if ($ativo_usu == '0') {
                                                                echo " selected";
                                                            }; ?>>Desativado
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Turma</label>
                            <div class="col-sm-2 <?php if ($turma_usu == '') {
                                                        echo " has-error";
                                                    }; ?>">
                                <select class="form-control" name="turma_usu">
                                    <optgroup label="Turma do usuário">
                                        <?php
                                        $tipo_query = "SELECT * FROM gqu_usuarios where id_usu = $id_usu ";
                                        $tipo_exec = $link_conexao->query($tipo_query);
                                        $tipo_row = $tipo_exec->num_rows;
                                        if ($tipo_row >= 1) {
                                            while ($tipo_dados = $tipo_exec->fetch_object()) {
                                                $nivel_usu = $tipo_dados->nivel_usu;
                                                if ($nivel_usu == 0) {
                                                    $v = "Usuário";
                                                } elseif ($nivel_usu == 1) {
                                                    $v = "ADM";
                                                } else {
                                                    $v = "Manutenção";
                                                }
                                                echo "<option value=\"$nivel_usu\">$v</option>";
                                            };
                                        }
                                        ?>
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
                                <button type="submit" class="btn m-b-xs btn-sm btn-primary btn-addon" name="Editar"><i class="glyphicon glyphicon-floppy-saved"></i>Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- / content -->