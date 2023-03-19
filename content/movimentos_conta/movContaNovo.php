<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $data_movConta = $_POST['data_movConta'];
    $tipo_movConta = $_POST['tipo_movConta'];
    $valor_movConta = $_POST['valor_movConta'];
    $saldo_movConta = $_POST['saldo_movConta'];
    $vazio = '';


    $up1_query = "INSERT INTO movconta VALUES (NULL, '" . $data_movConta . "','" . $vazio . "',
    '" . $vazio . "', '" . $vazio . "','" . $vazio . "','" . $tipo_movConta . "','" . $valor_movConta . "','" . $saldo_movConta . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movConta/');
};
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Novo Movimento da Conta</h1>
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
                                <input type="date" class="form-control" id="data_movConta" name="data_movConta" required />
                            </div>

                            <label class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="tipo_movConta" id="tipo_movConta">
                                    <option value="Crédito">Crédito</option>
                                    <option value="Débito">Débito</option>
                                    <option value="Saque">Saque</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">Valor</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="dvalot_movConta" name="valor_movConta" required />
                            </div>

                            <label class="col-sm-1 control-label">Saldo</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="saldo_movConta" name="saldo_movConta" required />
                            </div>
                        </div>



                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/movconta/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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