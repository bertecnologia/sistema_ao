<?php

$id_obra = $_GET['id'];

$usu_query = "SELECT (SELECT sum(valor_movConta) from movconta where tipo_movConta = 'Crédito' and responsavel_movConta = $id_obra) as credito,
(SELECT sum(valor_movConta)  from movconta where tipo_movConta = 'Débito' and responsavel_movConta = $id_obra) as debito,
(SELECT sum(valor_movConta) from movconta where tipo_movConta = 'Saque' and responsavel_movConta = $id_obra) as saque,
(SELECT sum(valor_movConta) from movconta where categoria_movConta = 1 and responsavel_movConta = $id_obra) as mao_obra,
(SELECT sum(valor_movConta) from movconta where categoria_movConta = 3 and responsavel_movConta = $id_obra) as servico, 
(SELECT sum(valor_movConta) from movconta where categoria_movConta = 2 and responsavel_movConta = $id_obra) as material,
(SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Crédito' and responsavel_movCaixa = $id_obra) as credito1,
(SELECT sum(valor_movCaixa)  from movcaixa where tipo_movCaixa = 'Débito' and responsavel_movCaixa = $id_obra) as debito1,
(SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Saque' and responsavel_movCaixa = $id_obra) as saque1,
(SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 1 and responsavel_movCaixa = $id_obra) as mao_obra1,
(SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 3 and responsavel_movCaixa = $id_obra) as servico1, 
(SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 2 and responsavel_movCaixa = $id_obra) as material1    
FROM `movConta`
left join obras on obras.id_obra=movConta.responsavel_movConta left join movCaixa on movCaixa.responsavel_movCaixa = obras.id_obra WHERE responsavel_movConta = $id_obra LIMIT 1";

$usu_exec = $link_conexao->query($usu_query);
$usu_row = $usu_exec->num_rows;

if ($usu_row > 0) {
    while ($usu_dados = $usu_exec->fetch_object()) {
        $credito = $usu_dados->credito + $usu_dados->credito1;
        $debito = $usu_dados->debito + $usu_dados->debito1;
        $saque = $usu_dados->saque + $usu_dados->saque1;
        $mao_obra = $usu_dados->mao_obra + $usu_dados->mao_obra1;
        $servico = $usu_dados->servico + $usu_dados->servico1;
        $material = $usu_dados->material + $usu_dados->material1;
    };
} else {
    $credito = 0;
    $debito = 0;
    $saque = 0;
    $mao_obra = 0;
    $servico = 0;
    $material = 0;
}

$usu_query = "SELECT * FROM obras WHERE id_obra = $id_obra";

$usu_exec = $link_conexao->query($usu_query);
$usu_row = $usu_exec->num_rows;

if ($usu_row > 0) {
    while ($usu_dados = $usu_exec->fetch_object()) {
        $cliente_obra = $usu_dados->cliente_obra;
        $inicio_obra = $usu_dados->inicio_obra;
        $prazo_obra = $usu_dados->prazo_obra;
        $endereco_obra = $usu_dados->endereco_obra;
        $valor_obra = $usu_dados->valor_obra;
    };
}

//-------------------------------------------------Filtro Conta-----------------------------------------------------
$filtro2 = '';

if (isset($_GET['fornecedor_movConta']) and !empty($_GET['fornecedor_movConta'])) {
    $status_filtro = $_GET['fornecedor_movConta'];
    $filtro2 .= "and nome_fornecedor = '$status_filtro'";
}

$sql3 = "SELECT *,sum(valor_movConta) as total_solicitacao FROM movConta left join fornecedores on id_fornecedor = fornecedor_movConta left join obras on id_obra = responsavel_movConta where tipo_movConta = 'Débito' and id_obra = $id_obra $filtro2";
$exec3 = $link_conexao->query($sql3);

if ($exec3->num_rows > 0) {
    while ($dados = $exec3->fetch_array()) {
        $totalConta = $dados['total_solicitacao'];
    }
}


//-------------------------------------------------Filtro Caixa-----------------------------------------------------
$filtro1 = '';

if (isset($_GET['fornecedor_movCaixa']) and !empty($_GET['fornecedor_movCaixa'])) {
    $status_filtro = $_GET['fornecedor_movCaixa'];
    $filtro1 .= "and nome_fornecedor = '$status_filtro'";
}

$sql3 = "SELECT *,sum(valor_movCaixa) as total_solicitacao FROM movCaixa left join fornecedores on id_fornecedor = fornecedor_movCaixa left join obras on id_obra = responsavel_movCaixa where tipo_movCaixa = 'Débito' and id_obra = $id_obra $filtro1";
$exec3 = $link_conexao->query($sql3);

if ($exec3->num_rows > 0) {
    while ($dados = $exec3->fetch_array()) {
        $total = $dados['total_solicitacao'];
    }
}

//-------------------------------------------------Caixa Anotações-----------------------------------------------------

if (($_POST) && (isset($_POST['anotacao']))) {
    $nota = $_POST['nota'];


    $sqlNotas = "SELECT * FROM notas_obra WHERE id_obra = $id_obra";
    $execNotas = $link_conexao->query($sqlNotas);

    if ($execNotas->num_rows > 0) {
        $up1_query = "UPDATE notas_obra SET nota = '" . $nota . "' WHERE id_obra= $id_obra";

        $up_exec = $link_conexao->query($up1_query);

        header('Location: ' . BASEURL . 'app/obras/detalhes/?id=' . $id_obra);
    } else {
        $up1_query = "INSERT INTO notas_obra VALUES (NULL, '" . $id_obra . "','" . $nota . "')";

        $up_exec = $link_conexao->query($up1_query);

        header('Location: ' . BASEURL . 'app/obras/detalhes/?id=' . $id_obra);
    }
};


$sqlNotas = "SELECT * FROM notas_obra WHERE id_obra = $id_obra";
$execNotas = $link_conexao->query($sqlNotas);

if ($execNotas->num_rows > 0) {
    while ($usu_dados = $execNotas->fetch_object()) {
        $anotacao = $usu_dados->nota;
    };
} else {
    $anotacao = "";
}




?>

<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3 text-black">Movimentações da Obra</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>

        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Detalhes da Obra</div>

                <div class="table-responsive">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div>
                                <h4><b>Cliente: </b> <?php echo $cliente_obra ?> </h4>
                            </div>
                            <div>
                                <h4><b>Endereço: </b> <?php echo $endereco_obra ?></h4>
                            </div>
                            <div>
                                <h4><b>Valor do Contrato: </b> R$ <?php echo $valor_obra ?></h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h4><b>Início da Obra: </b> <?php echo DATE('d/m/Y', strtotime($inicio_obra)) ?></h4>
                            </div>
                            <div>
                                <h4><b>Prazo: </b> <?php echo $prazo_obra ?> Dias </h4>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="line line-solid b-b line-sm pull-in"></div>
                        <div class="col-sm-6">
                            <div>
                                <h4><b>Mão-de-obra:</b> <?php formatar($mao_obra) ?></h4>
                            </div>
                            <div>
                                <h4><b>Serviços:</b> <?php formatar($servico) ?></h4>
                            </div>
                            <div>
                                <h4><b>Material:</b> <?php formatar($material) ?></h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div>
                                <h4><b>Crédito:</b> <?php formatar($credito) ?></h4>
                            </div>
                            <div>
                                <h4><b>Débito:</b> <?php formatar($debito) ?></h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



        <div class="app-content-body ">
            <div class="wrapper-md">
                <!--FILTRO-->
                <div class="col-sm-12 row" style="margin:30px 0px 30px 0px;">
                    <form class="form-inline col-sm-9" role="form" method="get">
                        <label class="font-bold">Fornecedor</label>
                        <input type="hidden" name="id" value="<?php echo $id_obra ?>">
                        <select class="form-control" name="fornecedor_movConta" id="fornecedor_movConta" required>
                            <option value="">Selecione</option>
                            <?php
                            $user_query = "select id_fornecedor, nome_fornecedor from fornecedores";
                            $end_result = null;
                            $user_exec = $link_conexao->query($user_query);
                            if ($user_exec->num_rows > 0) {
                                while ($user_dados = $user_exec->fetch_object()) {
                                    //echo $user_dados->id;
                            ?>
                                    <option value="<?php echo $user_dados->nome_fornecedor ?>"> <?php echo  $user_dados->nome_fornecedor; ?> </option>
                            <?php

                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="filtrar" class="btn btn-info" style="margin-left: 10px;">Aplicar</button>
                        <a href="<?php echo BASEURL ?>app/obras/detalhes/?id=<?php echo $id_obra ?>" value="" class="btn btn-danger" style="margin-left: 2px;">Limpar</a>
                    </form>

                    <div style="margin-top: -14px;" class="col-sm-3">
                        <h3 class="font-bold">TOTAL: R$ <?php echo number_format($totalConta, 2, ',', '.'); ?></h3>
                    </div>
                </div>
                <!--FIM  FILTRO-->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="margin: 5px; font-weight:400;">Movimentos em Conta</h3>
                    </div>
                    <div class="table-responsive">
                        <style>
                            .panel>.table-responsive {
                                margin: 20px;
                            }
                        </style>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#imports').DataTable({
                                    oLanguage: {
                                        oPaginate: {
                                            sNext: 'Próxima',
                                            sPrevious: 'Anterior'
                                        },
                                        sEmptyTable: 'Nenhum registro encontrado',
                                        sInfo: 'Total de _TOTAL_ registros (_START_ até _END_)',
                                        sInfoEmpty: 'Nenhum registro encontrado.',
                                        sInfoFiltered: ' - filtrados de _MAX_ registros',
                                        sLengthMenu: 'Mostrar _MENU_ registros',
                                        sLoadingRecords: 'Por favor aguarde, carregando...',
                                        sSearch: 'Localizar:',
                                        sZeroRecords: 'Nenhum registro para mostrar'
                                    },
                                    dom: 'Bfrtip',
                                    buttons: [{
                                            extend: 'excelHtml5',
                                            footer: true,
                                            exportOptions: {
                                                orthogonal: 'export'
                                            },

                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            footer: true,
                                            exportOptions: {
                                                orthogonal: 'export'
                                            },
                                        }
                                    ],
                                    pageLength: 10,
                                    bStateSave: true,
                                    fnStateSave: function(oSettings, oData) {
                                        localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
                                    },
                                    fnStateLoad: function(oSettings) {
                                        var data = localStorage.getItem('DataTables_' + window.location.pathname);

                                        return JSON.parse(data);
                                    }

                                });
                            });
                        </script>

                        <table id="imports" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Fornecedor</th>
                                    <th>Categoria</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $user_query = "SELECT 
                                id_movConta as c1,
                                DATE_FORMAT(data_movConta,'%d/%m/%Y') as c2,
                                descricao_movConta as c3, 
                                nome_fornecedor as c4,			
                                nome_categoria as c5,
                                cliente_obra as c6,
                                tipo_movConta as c7,
                                CONCAT('R$ ',FORMAT(valor_movConta,2,'de_DE')) as c8,
                                CONCAT('R$ ',FORMAT(saldo_movConta,2,'de_DE')) as c9		
                                FROM movconta 
                                LEFT JOIN fornecedores on id_fornecedor = fornecedor_movConta
                                LEFT JOIN categorias on id_categoria = categoria_movConta
                                LEFT JOIN obras on id_obra = responsavel_movConta
                                where responsavel_movConta = $id_obra $filtro2";
                                $usu_exec = $link_conexao->query($user_query);
                                $usu_row = $usu_exec->num_rows;
                                if ($usu_row > 0) {
                                    while ($usu_dados = $usu_exec->fetch_object()) {
                                        $c2 = $usu_dados->c2;
                                        $c3 = $usu_dados->c3;
                                        $c4 = $usu_dados->c4;
                                        $c5 = $usu_dados->c5;
                                        $c7 = $usu_dados->c7;
                                        $c8 = $usu_dados->c8;

                                ?>
                                        <tr>
                                            <td><?php echo $c2 ?></td>
                                            <td><?php echo $c3 ?></td>
                                            <td><?php echo $c4 ?></td>
                                            <td><?php echo $c5 ?></td>
                                            <td><?php echo $c7 ?></td>
                                            <td><?php echo $c8 ?></td>
                                        </tr>
                                <?php
                                    };
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th style="color:#fff; width: 13%;">Total: R$ <?php echo number_format($totalConta, 2, ',', '.'); ?></th>
                            </tfoot>
                        </table>



                    </div>
                </div>
            </div>
        </div>

        <div class="app-content-body ">
            <div class="wrapper-md">
                <!--FILTRO-->
                <div class="col-sm-12 row" style="margin:30px 0px 30px 0px;">
                    <form class="form-inline col-sm-9" role="form" method="get">
                        <label class="font-bold">Fornecedor</label>
                        <input type="hidden" name="id" value="<?php echo $id_obra ?>">
                        <select class="form-control" name="fornecedor_movCaixa" id="fornecedor_movCaixa" required>
                            <option value="">Selecione</option>
                            <?php
                            $user_query = "select id_fornecedor, nome_fornecedor from fornecedores";
                            $end_result = null;
                            $user_exec = $link_conexao->query($user_query);
                            if ($user_exec->num_rows > 0) {
                                while ($user_dados = $user_exec->fetch_object()) {
                                    //echo $user_dados->id;
                            ?>
                                    <option value="<?php echo $user_dados->nome_fornecedor ?>"> <?php echo  $user_dados->nome_fornecedor; ?> </option>
                            <?php

                                }
                            }
                            ?>
                        </select>
                        <button type="submit" name="filtrar" class="btn btn-info" style="margin-left: 10px;">Aplicar</button>
                        <a href="<?php echo BASEURL ?>app/obras/detalhes/?id=<?php echo $id_obra ?>" value="" class="btn btn-danger" style="margin-left: 2px;">Limpar</a>
                    </form>

                    <div style="margin-top: -14px;" class="col-sm-3">
                        <h3 class="font-bold">TOTAL: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>
                    </div>
                </div>
                <!--FIM  FILTRO-->


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="margin: 5px;">Movimentos em Caixa</h3>
                    </div>
                    <div class="table-responsive">
                        <style>
                            .panel>.table-responsive {
                                margin: 20px;
                            }
                        </style>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#import').DataTable({
                                    oLanguage: {
                                        oPaginate: {
                                            sNext: 'Próxima',
                                            sPrevious: 'Anterior'
                                        },
                                        sEmptyTable: 'Nenhum registro encontrado',
                                        sInfo: 'Total de _TOTAL_ registros (_START_ até _END_)',
                                        sInfoEmpty: 'Nenhum registro encontrado.',
                                        sInfoFiltered: ' - filtrados de _MAX_ registros',
                                        sLengthMenu: 'Mostrar _MENU_ registros',
                                        sLoadingRecords: 'Por favor aguarde, carregando...',
                                        sSearch: 'Localizar:',
                                        sZeroRecords: 'Nenhum registro para mostrar'
                                    },
                                    dom: 'Bfrtip',
                                    buttons: [{
                                            extend: 'excelHtml5',
                                            footer: true,
                                            exportOptions: {
                                                orthogonal: 'export'
                                            },

                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            footer: true,
                                            exportOptions: {
                                                orthogonal: 'export'
                                            },
                                        }
                                    ],
                                    pageLength: 10,
                                    bStateSave: true,
                                    fnStateSave: function(oSettings, oData) {
                                        localStorage.setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
                                    },
                                    fnStateLoad: function(oSettings) {
                                        var data = localStorage.getItem('DataTables_' + window.location.pathname);

                                        return JSON.parse(data);
                                    }
                                });
                            });
                        </script>

                        <table id="import" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Fornecedor</th>
                                    <th>Categoria</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $user_query = "SELECT 
                            id_movCaixa as c1,
                            DATE_FORMAT(data_movCaixa,'%d/%m/%Y') as c2,
                            descricao_movCaixa as c3, 
                            nome_fornecedor as c4,			
                            nome_categoria as c5,
                            cliente_obra as c6,
                            tipo_movCaixa as c7,
                            CONCAT('R$ ',FORMAT(valor_movCaixa,2,'de_DE')) as c8		
                            FROM movcaixa 
                            LEFT JOIN fornecedores on id_fornecedor = fornecedor_movCaixa
                            LEFT JOIN categorias on id_categoria = categoria_movCaixa
                            LEFT JOIN obras on id_obra = responsavel_movCaixa
                            where responsavel_movCaixa = $id_obra $filtro1";
                                $usu_exec = $link_conexao->query($user_query);
                                $usu_row = $usu_exec->num_rows;
                                if ($usu_row > 0) {
                                    while ($usu_dados = $usu_exec->fetch_object()) {
                                        $c2 = $usu_dados->c2;
                                        $c3 = $usu_dados->c3;
                                        $c4 = $usu_dados->c4;
                                        $c5 = $usu_dados->c5;
                                        $c7 = $usu_dados->c7;
                                        $c8 = $usu_dados->c8;

                                ?>
                                        <tr>
                                            <td><?php echo $c2 ?></td>
                                            <td><?php echo $c3 ?></td>
                                            <td><?php echo $c4 ?></td>
                                            <td><?php echo $c5 ?></td>
                                            <td><?php echo $c7 ?></td>
                                            <td><?php echo $c8 ?></td>
                                        </tr>
                                <?php
                                    };
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th style="color:#fff; width: 13%;">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></th>
                            </tfoot>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <!-- content -->
        <div class="app-content-body ">
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Anotações
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea name="nota" id="nota" rows="10" class="form-control"><?php echo $anotacao ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn m-b-xs btn-sm btn-primary btn-addon" name="anotacao"><i class="glyphicon glyphicon-floppy-saved"></i>Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>