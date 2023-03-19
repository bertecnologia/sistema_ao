<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {
    $id_categoria = $_GET['id'];
    $nome_categoria = $_POST['nome_categoria'];
    $descricao_categoria = $_POST['descricao_categoria'];


    $up1_query = "UPDATE categorias SET nome_categoria = '" . $nome_categoria . "',
                                             descricao_categoria = '" . $descricao_categoria . "'
                                             WHERE id_categoria= $id_categoria";

    $up_exec = $link_conexao->query($up1_query);

    header('Location: ' . BASEURL . 'app/categorias/');
};


$id_ch = "";
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id_categoria = $_GET['id'];
    //pega usuário
    $usu_query = "SELECT * FROM categorias WHERE id_categoria=$id_categoria";
    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;
    if ($usu_row == 1) {
        while ($usu_dados = $usu_exec->fetch_object()) {
            $id_categoria = $usu_dados->id_categoria;
            $nome_categoria = $usu_dados->nome_categoria;
            $descricao_categoria = $usu_dados->descricao_categoria;
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
            <h1 class="m-n font-thin h3">Editar Categoria</h1>
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
                                <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" placeholder="Nome da categoria" value="<?php echo $nome_categoria ?>" required />
                            </div>
                            <label class="col-sm-1 control-label">Descrição</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="descricao_categoria" name="descricao_categoria" placeholder="Descrição da categoria" value="<?php echo $descricao_categoria ?>" />
                            </div>
                        </div>

                        <div class=" line line-dashed b-b line-lg pull-in">
                        </div>
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