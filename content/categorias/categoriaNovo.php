<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $nome_categoria = $_POST['nome_categoria'];
    $descricao_categoria = $_POST['descricao_categoria'];


    $up1_query = "INSERT INTO categorias VALUES (NULL, '" . $nome_categoria . "','" . $descricao_categoria . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/categorias/');
};
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Cadastro de Nova Categoria</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Informações
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">


                        <div class="form-group">
                            <label class="col-sm-1 control-label">Nome Categoria</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" placeholder="Nome da categoria" required />
                            </div>
                            <label class="col-sm-1 control-label">Descrição</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="descricao_categoria" name="descricao_categoria" placeholder="Descrição da categoria" />
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/categorias/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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