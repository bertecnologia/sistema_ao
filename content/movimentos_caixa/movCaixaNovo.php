<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {
    $valor_movCaixa = str_replace(',', '.', str_replace('.', '', $_POST['valor_movCaixa']));
    $saldo_movCaixa = str_replace(',', '.', str_replace('.', '', $_POST['saldo_movCaixa']));
    $data_movCaixa = $_POST['data_movCaixa'];
    $descricao_movCaixa = $_POST['descricao_movCaixa'];
    $fornecedor_movCaixa = $_POST['fornecedor_movCaixa'];
    $categoria_movCaixa = $_POST['categoria_movCaixa'];
    $responsavel_movCaixa = $_POST['responsavel_movCaixa'];
    $tipo_movCaixa = $_POST['tipo_movCaixa'];
    //$valor_movCaixa = $_POST['valor_movCaixa'];
    //$saldo_movCaixa = $_POST['saldo_movCaixa'];
    $vazio = '';


    $up1_query = "INSERT INTO movCaixa VALUES (NULL, '" . $data_movCaixa . "','" . $descricao_movCaixa . "',
    '" . $fornecedor_movCaixa . "', '" . $categoria_movCaixa . "','" . $responsavel_movCaixa . "','" . $tipo_movCaixa . "','" . $valor_movCaixa . "','" . $saldo_movCaixa . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movCaixa/');
};
?>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Novo Movimento no Caixa</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Dados do Movimento
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Data</label>
                            <div class="col-lg-2">
                                <input type="date" class="form-control" id="data_movCaixa" name="data_movCaixa" required />
                            </div>

                            <label class="col-sm-1 control-label">Descrição</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="descricao_movCaixa" name="descricao_movCaixa" required>
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Fornecedor</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="fornecedor_movCaixa" id="fornecedor_movCaixa" required>
                                    <option value="0">Selecione</option>
                                    <?php
                                    $user_query = "select id_fornecedor, nome_fornecedor from fornecedores";
                                    $end_result = null;
                                    $user_exec = $link_conexao->query($user_query);
                                    if ($user_exec->num_rows > 0) {
                                        while ($user_dados = $user_exec->fetch_object()) {
                                            //echo $user_dados->id;
                                    ?>
                                            <option value="<?php echo $user_dados->id_fornecedor ?>"> <?php echo  $user_dados->nome_fornecedor; ?> </option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">Categoria</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="categoria_movCaixa" id="categoria_movCaixa" required>
                                    <option value="0">Selecione</option>
                                    <?php
                                    $user_query = "select id_categoria, nome_categoria from categorias";
                                    $end_result = null;
                                    $user_exec = $link_conexao->query($user_query);
                                    if ($user_exec->num_rows > 0) {
                                        while ($user_dados = $user_exec->fetch_object()) {
                                            //echo $user_dados->id;
                                    ?>
                                            <option value="<?php echo $user_dados->id_categoria ?>"> <?php echo  $user_dados->nome_categoria; ?> </option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">Responsável</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="responsavel_movCaixa" id="responsavel_movCaixa" required>
                                    <option value="0">Selecione</option>
                                    <?php
                                    $user_query = "select id_obra, cliente_obra from obras where id_obra <> -1";
                                    $end_result = null;
                                    $user_exec = $link_conexao->query($user_query);
                                    if ($user_exec->num_rows > 0) {
                                        while ($user_dados = $user_exec->fetch_object()) {
                                            //echo $user_dados->id;
                                    ?>
                                            <option value="<?php echo $user_dados->id_obra ?>"> <?php echo  $user_dados->cliente_obra; ?> </option>
                                    <?php

                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="tipo_movCaixa" id="tipo_movCaixa">
                                    <option value="Crédito">Crédito</option>
                                    <option value="Débito">Débito</option>
                                    <option value="Saque">Saque</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">Valor</label>
                            <div class="col-lg-2">
                                <input type="text" class="dinheiro form-control" id="dinheiro" name="valor_movCaixa" required />
                            </div>

                            <label class="col-sm-1 control-label">Saldo</label>
                            <div class="col-lg-2">
                                <input type="text" class="dinheiro form-control" id="dinheiro" name="saldo_movCaixa" required />
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/movCaixa/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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
<script>
    $('.dinheiro').mask('#.##0,00', {
        reverse: true
    });
</script>