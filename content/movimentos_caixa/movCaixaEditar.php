<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
$id_move = $_GET['id'];
if (($_POST) && (isset($_POST['Editar']))) {

    $id_movCaixa = $_GET['id'];
    $data_movCaixa = $_POST['data_movCaixa'];
    $descricao_movCaixa = $_POST['descricao_movCaixa'];
    $fornecedor_movCaixa = $_POST['fornecedor_movCaixa'];
    $categoria_movCaixa = $_POST['categoria_movCaixa'];
    $responsavel_movCaixa = $_POST['responsavel_movCaixa'];
    $tipo_movCaixa = $_POST['tipo_movCaixa'];
    $valor_movCaixa = str_replace(',', '.', str_replace('.', '', $_POST['valor_movCaixa']));
    $saldo_movCaixa = str_replace(',', '.', str_replace('.', '', $_POST['saldo_movCaixa']));

    $up1_query = "UPDATE movCaixa SET descricao_movCaixa = '" . $descricao_movCaixa . "',
                                             fornecedor_movCaixa = '" . $fornecedor_movCaixa . "',
                                             categoria_movCaixa = '" . $categoria_movCaixa . "',
                                             tipo_movCaixa = '" . $tipo_movCaixa . "',  
                                             valor_movCaixa = '" . $valor_movCaixa . "', 
                                             saldo_movCaixa = '" . $saldo_movCaixa . "',  
                                             responsavel_movCaixa = '" . $responsavel_movCaixa . "'
                                             WHERE id_movCaixa= $id_movCaixa";

    $up_exec = $link_conexao->query($up1_query);


    header('Location: ' . BASEURL . 'app/movCaixa/');
};


$id_ch = "";
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id_movCaixa = $_GET['id'];
    //pega usuário
    $usu_query = "SELECT * FROM movCaixa WHERE id_movCaixa=$id_movCaixa";
    $usu_exec = $link_conexao->query($usu_query);
    $usu_row = $usu_exec->num_rows;
    if ($usu_row == 1) {
        while ($usu_dados = $usu_exec->fetch_object()) {
            $id_movCaixa = $usu_dados->id_movCaixa;
            $data_movCaixa = $usu_dados->data_movCaixa;
            $descricao_movCaixa = $usu_dados->descricao_movCaixa;
            $fornecedor_movCaixa = $usu_dados->fornecedor_movCaixa;
            $categoria_movCaixa = $usu_dados->categoria_movCaixa;
            $responsavel_movCaixa = $usu_dados->responsavel_movCaixa;
            $tipo_movCaixa = $usu_dados->tipo_movCaixa;
            $valor_movCaixa = $usu_dados->valor_movCaixa;
            $saldo_movCaixa = $usu_dados->saldo_movCaixa;
            $credito = '';
            $debito = '';
            $saque = '';
            $sel = '';
            if ($tipo_movCaixa == 'Crédito') {
                $credito = "selected";
            } elseif ($tipo_movCaixa == 'Débito') {
                $debito = "selected";
            } elseif ($tipo_movCaixa == 'Saque') {
                $saque = "selected";
            } else {
                $sel = 'selected';
            }
            
            $usu_query1 = "SELECT * FROM fornecedores WHERE id_fornecedor=$fornecedor_movCaixa";
            $usu_exec1 = $link_conexao->query($usu_query1);
            $usu_row1 = $usu_exec1->num_rows;
            if ($usu_row1 == 1) {
                while ($usu_dados1 = $usu_exec1->fetch_object()) {
                    $nomeFornecedor = $usu_dados1->nome_fornecedor;
                }
            }else{
                $nomeFornecedor = "Selecione";
            }

            $usu_query2 = "SELECT * FROM categorias WHERE id_categoria=$categoria_movCaixa";
            $usu_exec2 = $link_conexao->query($usu_query2);
            $usu_row2 = $usu_exec2->num_rows;
            if ($usu_row2 == 1) {
                while ($usu_dados2 = $usu_exec2->fetch_object()) {
                   $nomeCategoria= $usu_dados2->nome_categoria;
                }
            }else{
                $nomeCategoria = "Selecione";
            }
            $usu_query3 = "SELECT * FROM obras WHERE id_obra=$responsavel_movCaixa";
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
    $adicional_fornecedor = $_POST['adicional_fornecedor'];


    $up1_query = "INSERT INTO fornecedores VALUES (NULL, '" . $nome_fornecedor . "','" . $fone_fornecedor . "','" . $adicional_fornecedor . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movCaixa/editar/?id=' . $id_movCaixa);
};

if (($_POST) && (isset($_POST['InsertCategoria']))) {

    $nome_categoria = $_POST['nome_categoria'];
    $descricao_categoria = $_POST['descricao_categoria'];


    $up1_query = "INSERT INTO categorias VALUES (NULL, '" . $nome_categoria . "','" . $descricao_categoria . "')";

    $up_exec = $link_conexao->query($up1_query);
    header('Location: ' . BASEURL . 'app/movCaixa/editar/?id=' . $id_movCaixa);
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
                        <label class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nome_fornecedor" name="nome_fornecedor" placeholder="Nome do Fornecedor" required />
                        </div>
                        <label class="col-sm-2 control-label">Telefone</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="fone_fornecedor" name="fone_fornecedor" placeholder="(00) 00000-0000" />
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Adicional</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="adicional_fornecedor" name="adicional_fornecedor" placeholder="Informação Adicional" />
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
            <h1 class="m-n font-thin h3">Editar Movimento <?php echo $id_movCaixa; ?></h1>
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
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="data_movCaixa" name="data_movCaixa" value="<?php echo $data_movCaixa ?>" />
                            </div>

                            <label class="col-sm-1 control-label">Descrição</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="descricao_movCaixa" name="descricao_movCaixa" value="<?php echo $descricao_movCaixa ?>" placeholder="Descrição do movimento" required />
                            </div>

                            <label class="col-sm-1 control-label">Fornecedor</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="fornecedor_movCaixa" id="fornecedor_movCaixa" required>
                                    <option value="<?php echo $fornecedor_movCaixa ?>"><?php echo $nomeFornecedor ?></option>
                                    <?php
                                    $user_query = "select id_fornecedor, nome_fornecedor from fornecedores where id_fornecedor <> $fornecedor_movCaixa";
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



                            <label class="col-sm-1 control-label">Responsável</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="responsavel_movCaixa" id="responsavel_movCaixa">
                                    <option value="<?php echo $responsavel_movCaixa ?>"><?php echo $nomeObra ?></option>
                                    <?php
                                    $user_query = "select id_obra, cliente_obra from obras where id_obra <> $responsavel_movCaixa and id_obra <> -1";
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

                            <label class="col-sm-1 control-label">Tipo</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="tipo_movCaixa" id="tipo_movCaixa" required>
                                    <option <?php echo $sel ?>value="#">Selecione</option>
                                    <option <?php echo $credito ?> value="Crédito">Crédito</option>
                                    <option <?php echo $debito ?> value="Débito">Débito</option>
                                    <option <?php echo $saque ?> value="Saque">Saque</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">Categoria</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="categoria_movCaixa" id="categoria_movCaixa" required>
                                    <option value="<?php echo $categoria_movCaixa ?>"><?php echo $nomeCategoria ?></option>
                                    <?php
                                    $user_query = "select id_categoria, nome_categoria from categorias where id_categoria <> $categoria_movCaixa";
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

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">

                            <label class="col-sm-1 control-label">Valor</label>
                            <div class="col-sm-2">
                                <input type="text" class="dinheiros form-control" id="dinheiros" name="valor_movCaixa" value="<?php echo $valor_movCaixa ?>" />
                            </div>

                            <label class="col-sm-1 control-label">Saldo</label>
                            <div class="col-sm-2">
                                <input type="text" class="dinheiros form-control" id="dinheiros" name="saldo_movCaixa" value="<?php echo $saldo_movCaixa ?>" />
                            </div>


                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-1">
                                <a href="<?php echo BASEURL; ?>app/movCaixa" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="glyphicon glyphicon-remove"></i>Cancelar</a>
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
    $('.dinheiros').mask('#.##0,00', {
        reverse: true
    });
</script>