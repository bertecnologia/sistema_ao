<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}

$id_move = $_GET['id'];
if (($_POST) && (isset($_POST['Editar']))) {
    $id_movConta = $_GET['id'];
    $responsavel_movConta = $_POST['responsavel_movConta'];
    $controle = $_POST['controle'];
    $novo = '';
    $cont = 0;
    foreach ($responsavel_movConta as $separado) {
        if ($controle != 0) {
            $novo = $separado;
            $tipo_movConta = $_POST['tipo_movConta'];
            $valor_movConta = $_POST['valor_movConta'][$cont];
            $data_movConta = $_POST['data_movConta'];
            $descricao_movConta = $_POST['descricao_movConta'];
            $fornecedor_movConta = $_POST['fornecedor_movConta'];
            $categoria_movConta = $_POST['categoria_movConta'];
            $fitid = $_POST['fitid'];
            if ($cont == 0) {
                $up1_query = "UPDATE movconta SET descricao_movConta = '" . $descricao_movConta . "',
                                             fornecedor_movConta = '" . $fornecedor_movConta . "',
                                             categoria_movConta = '" . $categoria_movConta . "', 
                                             responsavel_movConta = '" . -1 . "'
                                             WHERE id_movConta= $id_movConta";

                $up_exec = $link_conexao->query($up1_query);
            }

            $up1_query = "INSERT INTO movconta VALUES (NULL, '" . $data_movConta . "','" . $descricao_movConta . "',
    '" . $fornecedor_movConta . "', '" . $categoria_movConta . "','" . $novo . "','" . $tipo_movConta . "','" . $valor_movConta . "','" . 'Rateio' . "','" . $fitid . "')";

            $up_exec = $link_conexao->query($up1_query);
        } else {
            $novo = $separado;
            $tipo_movConta = $_POST['tipo_movConta'];
            $valor_movConta = $_POST['valor_movConta'];
            $data_movConta = $_POST['data_movConta'];
            $descricao_movConta = $_POST['descricao_movConta'];
            $fornecedor_movConta = $_POST['fornecedor_movConta'];
            $categoria_movConta = $_POST['categoria_movConta'];
            $fitid = $_POST['fitid'];

            $up1_query = "UPDATE movconta SET descricao_movConta = '" . $descricao_movConta . "',
                                             fornecedor_movConta = '" . $fornecedor_movConta . "',
                                             categoria_movConta = '" . $categoria_movConta . "', 
                                             responsavel_movConta = '" . $novo . "'
                                             WHERE id_movConta= $id_movConta";

            $up_exec = $link_conexao->query($up1_query);
        }

        $cont++;
    }
    header('Location: ' . BASEURL . 'app/movconta/');
};
if (($_GET) && (isset($_GET['delete']))) {
    $id = $_GET['id'];
    $idconta = $_GET['delete'];
    $up1_query = "DELETE FROM `movconta` WHERE `movconta`.`id_movConta` = $idconta";

    $up_exec = $link_conexao->query($up1_query);
}
$vazio = -2;
$id_ch = "";
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id_movConta = $_GET['id'];
    //pega usuário
    $usu_query = "SELECT * FROM movconta WHERE id_movConta=$id_movConta";
    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;
    if ($usu_row == 1) {
        while ($usu_dados = $usu_exec->fetch_object()) {

            $id_movConta = $usu_dados->id_movConta;
            $data_movConta = $usu_dados->data_movConta;
            $descricao_movConta = $usu_dados->descricao_movConta;
            $fornecedor_movConta = $usu_dados->fornecedor_movConta;
            $categoria_movConta = $usu_dados->categoria_movConta;
            $responsavel_movConta = $usu_dados->responsavel_movConta;
            $tipo_movConta = $usu_dados->tipo_movConta;
            $valor_movConta = $usu_dados->valor_movConta;
            $saldo_movConta = $usu_dados->saldo_movConta;
            $fitid = $usu_dados->fitid;
            $credito = '';
            $debito = '';
            $saque = '';
            $sel = '';


            $fornecedor_movConta;
            $categoria_movConta;
            $responsavel_movConta;
            
            $usu_query1 = "SELECT * FROM fornecedores WHERE id_fornecedor=$fornecedor_movConta";
            $usu_exec1 = $link_conexao->query($usu_query1);
            $usu_row1 = $usu_exec1->num_rows;
            if ($usu_row1 == 1) {
                while ($usu_dados1 = $usu_exec1->fetch_object()) {
                    $nomeFornecedor = $usu_dados1->nome_fornecedor;
                }
            }else{
                $nomeFornecedor = "Selecione";
            }

            $usu_query2 = "SELECT * FROM categorias WHERE id_categoria=$categoria_movConta";
            $usu_exec2 = $link_conexao->query($usu_query2);
            $usu_row2 = $usu_exec2->num_rows;
            if ($usu_row2 == 1) {
                while ($usu_dados2 = $usu_exec2->fetch_object()) {
                   $nomeCategoria= $usu_dados2->nome_categoria;
                }
            }else{
                $nomeCategoria = "Selecione";
            }
            $usu_query3 = "SELECT * FROM obras WHERE id_obra=$responsavel_movConta";
            $usu_exec3 = $link_conexao->query($usu_query3);
            $usu_row3 = $usu_exec3->num_rows;
            if ($usu_row3 == 1) {
                while ($usu_dados3 = $usu_exec3->fetch_object()) {
                    $nomeObra = $usu_dados3->cliente_obra;
                }
            }else{
                $nomeObra = "Selecione";
            }
        };
    } else {
        header('Location: ' . BASEURL);
    }
} else {
    header('Location: ' . BASEURL);
}



if (($_POST) && (isset($_POST['InsertFornecedor']))) {

    $nome_fornecedor = $_POST['nome_fornecedor'];
    $fone_fornecedor = $_POST['fone_fornecedor'];
    $doc_fornecedor = $_POST['doc_fornecedor'];
    $conta_fornecedor = $_POST['conta_fornecedor'];

    $up1_query = "INSERT INTO fornecedores VALUES (NULL, '" . $nome_fornecedor . "','" . $fone_fornecedor .  "','" . $doc_fornecedor .  "','" . $conta_fornecedor . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movconta/editar/?id=' . $id_move);
};

if (($_POST) && (isset($_POST['InsertCategoria']))) {

    $nome_categoria = $_POST['nome_categoria'];
    $descricao_categoria = $_POST['descricao_categoria'];


    $up1_query = "INSERT INTO categorias VALUES (NULL, '" . $nome_categoria . "','" . $descricao_categoria . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movconta/editar/?id=' . $id_move);
};

?>

<!-- Modal Fornecedor-->
<div class="modal fade" id="modalFornecedorAdd" tabindex="-1" role="dialog" aria-labelledby="modalFornecedorAddTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Adicionar Novo Fornecedor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nome_fornecedor" name="nome_fornecedor" placeholder="Nome do Fornecedor" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telefone:</label>
                        <div class="col-sm-4">
                            <input type="text" class="fone form-control" placeholder="(00) 00000-0000" id="fone" name="fone_fornecedor" />
                        </div>

                        <label class="col-sm-2 control-label">Documento:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="CPF/CNPJ" name="doc_fornecedor" id="cpfcnpj" />
                        </div>
                    </div>

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
                </div>
                <div class="modal-footer">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn m-b-xs btn-sm btn-primary btn-addon" name="InsertFornecedor"><i class="glyphicon glyphicon-floppy-saved"></i>Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Categoria-->
<div class="modal fade" id="modalCategoriaAdd" tabindex="-1" role="dialog" aria-labelledby="modalCategoriaAddTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Adicionar Nova Categoria</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" placeholder="Nome da Categoria" required />
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Descrição</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="descricao_categoria" name="descricao_categoria" placeholder="Descrição da Categoria" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn m-b-xs btn-sm btn-primary btn-addon" name="InsertCategoria"><i class="glyphicon glyphicon-floppy-saved"></i>Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">

            <h1 class="m-n font-thin h3 pull-right"> <b>Valor:</b> R$ <?php echo number_format($valor_movConta, 2, ',', '.') ?> </h1>

            <h1 class="m-n font-thin h3">Editar Movimento <?php echo $id_ch; ?></h1>
            <small class="text-muted"><?php echo $empresa; ?></small>

        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    Dados do Movimento
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="">
                        <input type="hidden" name="data_movConta" value="<?php echo $data_movConta; ?>" />
                        <input type="hidden" name="descricao_movConta" value="<?php echo $descricao_movConta; ?>" />
                        <input type="hidden" name="tipo_movConta" value="<?php echo $tipo_movConta; ?>" />
                        <input type="hidden" name="fitid" value="<?php echo $fitid; ?>" />
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Data</label>
                            <div class="col-sm-2">
                                <h5> <?php echo $data_movConta ?></h5>
                            </div>

                            <label class="col-sm-1 control-label">Descrição</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="descricao_movConta" name="descricao_movConta" value="<?php echo $descricao_movConta ?>" placeholder="Descrição do movimento" required />
                            </div>

                            <label class="col-sm-1 control-label">Fornecedor</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="fornecedor_movConta" id="fornecedor_movConta" required>
                                    <option value="<?php echo $fornecedor_movConta ?>"><?php echo $nomeFornecedor ?></option>
                                    <?php
                                    $user_query = "select id_fornecedor, nome_fornecedor from fornecedores where id_fornecedor <> $fornecedor_movConta";
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
                            <div class="col-sm-1">
                                <button type="button" style="background-color: #adacac;" class="btn btn-sm" data-toggle="modal" data-target="#modalFornecedorAdd"><i class="fa fa-plus" style="color:#fff"></i></button>
                            </div>

                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">

                            <?php if ($responsavel_movConta <> -1) { ?>
                                <input type="hidden" name="controle" value="0" />
                                <label class="col-sm-1 control-label">Responsável</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="responsavel_movConta[]" id="responsavel_movConta" required>
                                        <option value="<?php echo $responsavel_movConta ?>"><?php echo $nomeObra ?></option>
                                        <?php
                                        $user_query = "select id_obra, cliente_obra from obras where id_obra <> $responsavel_movConta and id_obra <> -1";
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

                                <div class="col-lg-2">
                                    <input type="hidden" class="dinheiro form-control" id="dinheiro" name="valor_movConta[]" placeholder="R$" required />
                                </div>

                                <div class="col-sm-2">
                                    <button onclick=add() type="button" class="btn m-b-xs btn-sm btn-warning btn-addon" name="rateio"><i class="fa fa-plus"></i>+ Rateio</button>
                                </div>
                            <?php } else { ?>
                                <div class="col-sm-7">
                                    <button onclick=adicionar() type="button" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i> Adicionar</button>
                                </div>
                            <?php } ?>

                            <label class="col-sm-1 control-label">Categoria</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="categoria_movConta" id="categoria_movConta" required>
                                    <option value="<?php echo $categoria_movConta ?>"><?php echo $nomeCategoria ?></option>
                                    <?php
                                    $user_query = "select id_categoria, nome_categoria from categorias where id_categoria <> $categoria_movConta";
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
                            <div class="col-sm-1">
                                <button type="button" style="background-color: #adacac;" class="btn btn-sm" data-toggle="modal" data-target="#modalCategoriaAdd"><i class="fa fa-plus" style="color:#fff"></i></button>
                            </div>

                        </div>

                        <div add_container>
                            <?php if ($responsavel_movConta == -1) {
                                $usu_query = "SELECT * FROM movconta left join obras on id_obra = responsavel_movConta WHERE responsavel_movConta <> -1 and fitid=$fitid";
                                $usu_exec = $link_conexao->query($usu_query);
                                $usu_row = $usu_exec->num_rows;
                                if ($usu_row > 0) {
                                    while ($usu_dados = $usu_exec->fetch_object()) {
                                        $id_conta = $usu_dados->id_movConta;
                                        $id_obras = $usu_dados->id_obra;
                                        $nome_responsavel = $usu_dados->cliente_obra;
                                        $valor = $usu_dados->valor_movConta;
                            ?>
                                        <div class="form-group">
                                            <input type="hidden" name="controle" value="1" />
                                            <label class="col-sm-1 control-label">Obra</label>
                                            <div class="col-sm-2">
                                                <input disabled type="text" class="form-control" id="" value="<?php echo $nome_responsavel ?>" name="" placeholder="" required />
                                            </div>


                                            <div class="col-lg-2">
                                                <input type="text" value="<?php echo $valor ?>" class="dinheiro form-control" id="dinheiro" name="" placeholder="R$" required disabled />
                                            </div>


                                            <div class="col-sm-2">
                                                <a class="btn btn-danger" href="<?php echo BASEURL ?>app/movConta/editar/?id=<?php echo $id_movConta ?>&delete=<?php echo $id_conta ?>" type="button">Remover</a>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">

                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/movconta" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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


    function add() {
        document.getElementById("dinheiro").type = "text";
        const valoe = 1
        const container = document.querySelector('[add_container]')
        container.insertAdjacentHTML('beforeend', `        
        <div class="form-group">
        <input type="hidden" name="controle" value="1"/>
        <label class="col-sm-1 control-label">Obra</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="responsavel_movConta[]" id="responsavel_movConta">
                                    <option value="#">Selecione</option>

                                    <?php
                                    $user_query = "select id_obra, cliente_obra from obras WHERE id_obra <> -1";
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

                        
                            <div class="col-lg-2">
                                <input type="text" class="dinheiro form-control" id="dinheiro" name="valor_movConta[]" placeholder="R$" required />
                            </div>
                            
                              
            <div class="col-sm-2">
                <button class="btn btn-danger" onclick="remover(event)" type="button">Remover</button>
            </div>
        </div>`)


    }

    function adicionar() {
        const valoe = 1
        const container = document.querySelector('[add_container]')
        container.insertAdjacentHTML('beforeend', `        
        <div class="form-group">
        <input type="hidden" name="controle" value="1"/>
        <label class="col-sm-1 control-label">Obra</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="responsavel_movConta[]" id="responsavel_movConta">
                                    <option value="#">Selecione</option>

                                    <?php
                                    $user_query = "select id_obra, cliente_obra from obras WHERE id_obra <> -1";
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

                        
                            <div class="col-lg-2">
                                <input type="text" class="dinheiro form-control" id="dinheiro" name="valor_movConta[]" placeholder="R$" required />
                            </div>
                            
                              
            <div class="col-sm-2">
                <button class="btn btn-danger" onclick="remover(event)" type="button">Remover</button>
            </div>
        </div>`)


    }

    function remover(event) {
        event.target.parentNode.parentNode.remove()
        document.getElementById("dinheiro").type = "hidden";
    }
</script>