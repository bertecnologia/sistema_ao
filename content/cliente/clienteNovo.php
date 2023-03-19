<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $nome_cliente = $_POST['nome_cliente'];
    $doc_cliente = $_POST['doc_cliente'];
    $fone_cliente = $_POST['fone_cliente'];
    $endereco_cliente = $_POST['endereco_cliente'];
    $bairro_cliente = $_POST['bairro_cliente'];
    $cidade_cliente = $_POST['cidade_cliente'];


    $up1_query = "INSERT INTO clientes VALUES (NULL, '" . $nome_cliente . "','" . $doc_cliente . "',
    '" . $fone_cliente . "', '" . $endereco_cliente . "','" . $bairro_cliente . "','" . $cidade_cliente . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/clientes/');
};
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Cadastro de Cliente</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Informações do Cliente
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nome_usu" name="nome_cliente" placeholder="Nome Completo" required />
                            </div>
                            <label class="col-sm-1 control-label">Documento</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="cpfcnpj" name="doc_cliente" placeholder="CPF/CNPJ" required />
                            </div>
                            <label class="col-sm-1 control-label">Telefone</label>
                            <div class="col-sm-3">
                                <input type="tel" class="fone form-control" id="fone" name="fone_cliente" placeholder="(00) 00000-0000" required />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Cidade</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="cidade_cliente" name="cidade_cliente" placeholder="Cidade" required />
                            </div>
                            <label class="col-sm-1 control-label">Endereço</label>
                            <div class="col-sm-4">
                                <input type=" text" class="form-control" id="endereco_cliente" name="endereco_cliente" placeholder="Rua, N°" required />
                            </div>

                            <label class="col-sm-1 control-label">Bairro</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="bairro_cliente" name="bairro_cliente" placeholder="Bairro" required />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/clientes/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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


<!-- Máscaras -->
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