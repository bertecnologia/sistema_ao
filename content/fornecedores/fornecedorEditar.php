<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Editar']))) {
    $id_fornecedor = $_GET['id'];
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $fone_fornecedor = $_POST['fone_fornecedor'];
    $doc_fornecedor = $_POST['doc_fornecedor'];
    $conta_fornecedor = $_POST['conta_fornecedor'];

    $up1_query = "UPDATE fornecedores SET nome_fornecedor = '" . $nome_fornecedor . "',
                                             fone_fornecedor = '" . $fone_fornecedor . "',
                                             doc_fornecedor = '" . $doc_fornecedor . "', 
                                             conta_fornecedor = '" . $conta_fornecedor . "'
                                             WHERE id_fornecedor= $id_fornecedor";

    $up_exec = $link_conexao->query($up1_query);

    header('Location: ' . BASEURL . 'app/fornecedores/');
};


$id_ch = "";
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id_fornecedor = $_GET['id'];
    //pega usuário
    $usu_query = "SELECT * FROM fornecedores WHERE id_fornecedor=$id_fornecedor";
    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;
    if ($usu_row == 1) {
        while ($usu_dados = $usu_exec->fetch_object()) {
            $id_fornecedor = $usu_dados->id_fornecedor;
            $nome_fornecedor = $usu_dados->nome_fornecedor;
            $fone_fornecedor = $usu_dados->fone_fornecedor;
            $doc_fornecedor = $usu_dados->doc_fornecedor;
            $conta_fornecedor = $usu_dados->conta_fornecedor;
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
            <h1 class="m-n font-thin h3">Editar fornecedor</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Informações do Fornecedor
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nome_fornecedor" name="nome_fornecedor" value="<?php echo $nome_fornecedor ?>" placeholder="Nome Profissional/Empresa" required />
                            </div>
                            <label class="col-sm-1 control-label">Telefone</label>
                            <div class="col-sm-2">
                                <input type="text" class="fone form-control" placeholder="(00) 00000-0000" id="fone" name="fone_fornecedor" value="<?php echo $fone_fornecedor ?>" />
                            </div>
                            <label class="col-sm-1 control-label">Documento</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="cpfcnpj" name="doc_fornecedor" value="<?php echo $doc_fornecedor ?>" />
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Dados Bancários</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="conta_fornecedor" name="conta_fornecedor" value="<?php echo $conta_fornecedor ?>" />
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/fornecedores" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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

<script>
    $('.fone').mask('(00) 00000-0000');

    var maskCpfOuCnpj = IMask(document.getElementById('cpfcnpj'), {
        mask: [{
                mask: '000.000.000-00',
                maxLength: 11
            },
            {
                mask: '00.000.000/0000-00'
            }
        ]
    });
</script>