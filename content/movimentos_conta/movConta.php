<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
$usu_query = "SELECT (SELECT sum(valor_movConta) from movconta where tipo_movConta = 'credito') as credito,
            (SELECT sum(valor_movConta) from movconta where tipo_movConta = 'debito') as debito, 
            (SELECT sum(valor_movConta) from movconta where tipo_movConta = 'Saque') as saque,
            (SELECT sum(valor_movConta) from movconta where categoria_movConta = 1) as mao_obra,
            (SELECT sum(valor_movConta) from movconta where categoria_movConta = 3) as servico, 
            (SELECT sum(valor_movConta) from movconta where categoria_movConta = 2) as material  FROM `movconta` LIMIT 1";
$usu_exec = $link_conexao->query($usu_query);
$usu_row = $usu_exec->num_rows;
if ($usu_row > 0) {
    while ($usu_dados = $usu_exec->fetch_object()) {
        $credito = $usu_dados->credito;
        $debito = $usu_dados->debito;
        $saque = $usu_dados->saque;
        $mao_obra = $usu_dados->mao_obra;
        $servico = $usu_dados->servico;
        $material = $usu_dados->material;
    };
} else {
    $credito = 0;
    $debito = 0;
    $saque = 0;
    $mao_obra = 0;
    $servico = 0;
    $material = 0;
}

?>
<?php
//-------------------------------------------------Filtro-----------------------------------------------------
$filtro2 = '';
$filtro1 = '';
if (isset($_GET['fData']) and !empty($_GET['fData'])) {
    $valor = $_GET['fData'];
    $_SESSION['fData'] = $valor;
    $datas  = $_SESSION['fData'];
    $datas = explode(" - ", $_SESSION['fData']);
    $d1 = date('Y-m-d', strtotime($datas[0]));
    $d2 = date('Y-m-d', strtotime($datas[1]));
    $filtro2 .= "AND DATE_FORMAT(data_movConta,'%Y-%m-%d') BETWEEN date('$d1') AND date('$d2')";
}
if (isset($_GET['fornecedor_movConta']) and !empty($_GET['fornecedor_movConta'])) {
    $status_filtro = $_GET['fornecedor_movConta'];
    $filtro1 .= "and nome_fornecedor = '$status_filtro'";
}

$sql3 = "SELECT *,sum(valor_movConta) as total_solicitacao FROM movConta left join fornecedores on id_fornecedor = fornecedor_movConta where tipo_movConta = 'Débito' and saldo_movConta <> 'Rateio' $filtro2 $filtro1";
$exec3 = $link_conexao->query($sql3);

if ($exec3->num_rows > 0) {
    while ($dados = $exec3->fetch_array()) {
        $total_solicitacao = $dados['total_solicitacao'];
    }
}
?>

<!--Modal Ler Extrato -->

<div class="modal fade" id="modalLerExtrato" tabindex="-1" role="dialog" aria-labelledby="modalLerExtratoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Ler Extrato</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="../../content/movimentos_conta/joao_leitor.php">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                            Enviar esse arquivo: <input name="userfile" type="file" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-offset-2">
                        <input type="submit" value="Enviar arquivo" name="insert" />
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Content--->

<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <!--<a href="<?php echo BASEURL; ?>app/movConta/novo" class="btn m-b-xs btn-success btn-addon pull-right btn-lg"><i class="fa fa-plus"></i> Adicionar</a> -->
            <button type="button" style="background-color: #adacac; margin-right: 15px; color:#fff;" class="btn btn-addon btn-lg pull-right " data-toggle="modal" data-target="#modalLerExtrato"><i class="fa fa-plus" style="color:#fff"></i>Ler Extrato</button>

            <h1 class="m-n font-thin h3 text-black">Movimentações - Conta</h1>

            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Resumo Conta</div>
                <div class="table-responsive">
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
                        <!--<div>
                            <h4><b>Saque:</b> <?php formatar($saque) ?></h4>
                        </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="wrapper-md">
            <!--FILTRO-->
            <div class="col-sm-12 row" style="margin:30px 0px 30px 0px;">
                <form class="form-inline col-sm-9" role="form" method="get">
                    <label class="font-bold" for="fData">Data</label>
                    <input required ui-jq="daterangepicker" value="<?php echo $_SESSION['fData']; ?>" ui-options="{locale: {applyLabel: 'Aplicar',cancelLabel: 'Limpar',fromLabel: 'De',toLabel: 'Até',customRangeLabel: 'Custom',daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S','S'],monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],firstDay: 1},format: 'DD-MM-YYYY'}" class="form-control" name="fData" id="fData" autocomplete="off" value="">
                    <label class="font-bold">Fornecedor</label>
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
                    <a href="<?php echo BASEURL; ?>app/movConta" value="<?php $_SESSION['fData'] = ''; ?>" class="btn btn-danger" style="margin-left: 2px;">Limpar</a>
                </form>

                <div style="margin-top: -14px;" class="col-sm-3">
                    <h3 class="font-bold">TOTAL: R$ <?php echo number_format($total_solicitacao, 2, ',', '.'); ?></h3>
                </div>
            </div>
            <!--FIM  FILTRO-->


            <div class="panel panel-default">
                <div class="panel-heading">Movimentos da Conta</div>
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
                                pageLength: 20,
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
                                <th>ID</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Fornecedor</th>
                                <th>Categoria</th>
                                <th>Responsável</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Saldo</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $usu_query = "SELECT 
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
                            WHERE saldo_movConta <> 'Rateio' $filtro2 $filtro1";
                            $usu_exec = $link_conexao->query($usu_query);
                            $usu_row = $usu_exec->num_rows;
                            if ($usu_row > 0) {
                                while ($usu_dados = $usu_exec->fetch_object()) {
                                    $c1 = $usu_dados->c1;
                                    $c2 = $usu_dados->c2;
                                    $c3 = $usu_dados->c3;
                                    $c4 = $usu_dados->c4;
                                    $c5 = $usu_dados->c5;
                                    $c6 = $usu_dados->c6;
                                    $c7 = $usu_dados->c7;
                                    $c8 = $usu_dados->c8;
                                    $c9 = $usu_dados->c9;

                            ?>
                                    <tr>
                                        <td><?php echo $c1 ?></td>
                                        <td><?php echo $c2 ?></td>
                                        <td><?php echo $c3 ?></td>
                                        <td><?php echo $c4 ?></td>
                                        <td><?php echo $c5 ?></td>
                                        <td><?php echo $c6 ?></td>
                                        <td><?php echo $c7 ?></td>
                                        <td><?php echo $c8 ?></td>
                                        <td><?php echo $c9 ?></td>
                                        <td><a class="btn m-b-xs btn-sm btn-info btn-addon" href="<?php echo BASEURL; ?>app/movConta/editar/?id=<?php echo $c1 ?>"><i class="fa fa-edit"></i>Editar</a></td>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th style="color:#fff; width: 13%;">Total: R$ <?php echo number_format($total_solicitacao, 2, ',', '.'); ?></th>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>