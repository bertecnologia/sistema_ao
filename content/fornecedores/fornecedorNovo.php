<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (($_POST) && (isset($_POST['Insert']))) {

    $nome_fornecedor = $_POST['nome_fornecedor'];
    $fone_fornecedor = $_POST['fone_fornecedor'];
    $doc_fornecedor = $_POST['doc_fornecedor'];
    $conta_fornecedor = $_POST['conta_fornecedor'];

    $up1_query = "INSERT INTO fornecedores VALUES (NULL, '" . $nome_fornecedor . "','" . $fone_fornecedor .  "','" . $doc_fornecedor .  "','" . $conta_fornecedor . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/fornecedores/');
};
?>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">


        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3">Cadastro de Novo Fornecedor</h1>
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
                            <label class="col-sm-1 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nome_fornecedor" name="nome_fornecedor" placeholder="Nome Profissional/Empresa" required />
                            </div>
                            <label class="col-sm-1 control-label">Telefone</label>
                            <div class="col-sm-2">
                                <input type="text" class="fone form-control" placeholder="(00) 00000-0000" id="fone" name="fone_fornecedor" />
                            </div>
                            <label class="col-sm-1 control-label">Documento</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="CPF/CNPJ" name="doc_fornecedor" id="cpfcnpj" />
                            </div>




                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label conta ">Tipo Conta</label>
                            <div class="col-sm-2">
                                <input type="radio" onclick="tipoconta('pix')" class="tipo_conta" id="tipo_conta" name="tipo_conta" value="pix" />
                                <label class="control-label" style="margin-right: 25px;">PIX</label>
                                <input type="radio" onclick="tipoconta('conta')" class="tipo_conta" id="tipo_conta" name="tipo_conta" value="conta" />
                                <label class="control-label">Conta</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="dados_conta" name="conta_fornecedor" />
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/fornecedores/" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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
    $('.fone').mask('(00) 00000-0000');

    function tipoconta(valor) {
        if (valor == 'pix') {
            document.getElementById("dados_conta").type = "text";
            document.getElementsByName('dados_conta')[0].placeholder = 'Chave PIX';

        } else {
            document.getElementById("dados_conta").type = "text";
            document.getElementsByName('dados_conta')[0].placeholder = 'Agência e Conta';
        }
    }

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