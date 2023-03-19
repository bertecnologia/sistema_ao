<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
$usu_query = "SELECT (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Crédito') as credito_caixa,
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Débito') as debito_caixa, 
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Saque') as saque_caixa,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 1) as mao_obra_caixa,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 2) as servico_caixa, 
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 3) as material_caixa  FROM `movcaixa` LIMIT 1";
$usu_exec = $link_conexao->query($usu_query);
$usu_row = $usu_exec->num_rows;
if ($usu_row > 0) {
    while ($usu_dados = $usu_exec->fetch_object()) {
        $credito_caixa = $usu_dados->credito_caixa;
        $debito_caixa = $usu_dados->debito_caixa;
        $saque_caixa = $usu_dados->saque_caixa;
        $mao_obra_caixa = $usu_dados->mao_obra_caixa;
        $servico_caixa = $usu_dados->servico_caixa;
        $material_caixa = $usu_dados->material_caixa;
    };
}

#---------------------------------------------------

$usu_query = "SELECT (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Crédito') as credito_conta,
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Débito') as debito_conta, 
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Saque') as saque_conta,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 1) as mao_obra_conta,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 2) as servico_conta, 
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 3) as material_conta  FROM `movconta` LIMIT 1";
$usu_exec = $link_conexao->query($usu_query);
$usu_row = $usu_exec->num_rows;
if ($usu_row > 0) {
    while ($usu_dados = $usu_exec->fetch_object()) {
        $credito_conta = $usu_dados->credito_conta;
        $debito_conta = $usu_dados->debito_conta;
        $saque_conta = $usu_dados->saque_conta;
        $mao_obra_conta = $usu_dados->mao_obra_conta;
        $servico_conta = $usu_dados->servico_conta;
        $material_conta = $usu_dados->material_conta;
    };
}

$credito = $credito_caixa + $credito_conta;
$debito = $debito_caixa + $debito_conta;
$saque = $saque_caixa + $saque_conta;
$mao_obra = $mao_obra_caixa + $mao_obra_conta;
$servico = $servico_caixa + $servico_conta;
$material = $material_caixa + $material_conta;

?>
<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <a href="<?php echo BASEURL; ?>app/movCaixa/novo" class="btn m-b-xs btn-success btn-addon pull-right btn-lg"><i class="fa fa-plus"></i> Adicionar</a>
            <h1 class="m-n font-thin h3 text-black">Movimentações - Geral</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Movimentos do Caixa</div>
                <div class="table-responsive">
                    <div class="col-sm-4">
                        <div>
                            <h4><b>Crédito:</b> <?php formatar($credito) ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div>
                            <h4><b>Débito:</b> <?php formatar($debito) ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div>
                            <h4><b>Saque:</b> <?php formatar($saque) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Movimentos</div>
                <div class="table-responsive">
                    <style>
                        .panel>.table-responsive {
                            margin: 20px;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#imports').DataTable({
                                ajax: '<?php echo BASEURL; ?>server/_movGeral.php',
                                columns: [{
                                        data: 'c1'
                                    },
                                    {
                                        data: 'c2'
                                    },
                                    {
                                        data: 'c3'
                                    },
                                    {
                                        data: 'c4'
                                    },
                                    {
                                        data: 'c5'
                                    },
                                    {
                                        data: 'c6'
                                    },
                                    {
                                        data: 'c7'
                                    },
                                    {
                                        data: 'c8'
                                    },
                                    {
                                        data: 'c9'
                                    },
                                    {
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a class="btn m-b-xs btn-sm btn-info btn-addon" href=<?php echo BASEURL; ?>app/movCaixa/editar/?id=' + data.c1 + '><i class="fa fa-edit"></i>Editar</a>';
                                        }
                                    }
                                ],
                                oLanguage: {
                                    oPaginate: {
                                        sNext: 'Próxima',
                                        sPrevious: 'Anterior'
                                    },
                                    sEmptyTable: 'Nenhum registro encontrado',
                                    sInfo: 'Total de _TOTAL_ registros (_START_ até _END_)',
                                    sInfoEmpty: 'Nenhum registro encontrado,',
                                    sInfoFiltered: ' - filtrados de _MAX_ registros',
                                    sLengthMenu: 'Mostrar _MENU_ registros',
                                    sLoadingRecords: 'Por favor aguarde, carregando...',
                                    sSearch: 'Localizar:',
                                    sZeroRecords: 'Nenhum registro para mostrar'
                                },
                                dom: 'Bfrtip',
                                buttons: [{
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            orthogonal: 'export'
                                        },

                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            orthogonal: 'export'
                                        },
                                    }
                                ],

                            });
                        });
                    </script>

                    <table ui-jq="dataTable" id="imports" class="table table-striped m-b-none" style="width:100%">
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
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>