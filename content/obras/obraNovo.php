<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $id_obra = $_POST['id_obra'];
    $cliente_obra = $_POST['cliente_obra'];
    $inicio_obra = $_POST['inicio_obra'];
    $prazo_obra = $_POST['prazo_obra'];
    $valor_obra = $_POST['valor_obra'];
    //$valor_obra = clear_text($valor_obra);
    $pagamento_obra = $_POST['pagamento_obra'];
    $endereco_obra = $_POST['endereco_obra'];

    $up1_query = "INSERT INTO obras VALUES (NULL, '" . $cliente_obra . "','" . $inicio_obra . "','" . $prazo_obra . "','" . $valor_obra . "','" . $endereco_obra . "','" . $pagamento_obra . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/obras/');
};
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Cadastro de Obra</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Informações
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Cliente</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="cliente_obra" name="cliente_obra" placeholder="Número obra - Cliente" required />
                            </div>
                            <label class="col-sm-1 control-label">Início</label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control" id="inicio_obra" name="inicio_obra" required />
                            </div>
                            <label class="col-sm-1 control-label">Prazo</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="prazo_obra" name="prazo_obra" placeholder="Prazo em Dias" required />
                            </div>
                        </div>


                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Valor Contratual</label>
                            <div class="col-sm-2">
                                <input type="text" class="dinheiro form-control" id="dinheiro" name="valor_obra" placeholder="R$ 00.000,00" required />
                            </div>

                            <label class="col-sm-1 control-label">Forma de Pagamento</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="pagamento_obra" name="pagamento_obra" placeholder="Ex: Pagamento em 5x via PIX" required />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Endereço</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="endereco_obra" name="endereco_obra" placeholder="Rua, N°" required />
                            </div>
                        </div>




                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/obras/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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