<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
if (isset($_GET['id']) and !empty($_GET['id'])) {
   $id_delete = $_GET['id'];
   $usu_exec = $link_conexao->query("DELETE FROM `movcaixa` WHERE `movcaixa`.`id_movCaixa` = $id_delete");
   header('Location: ' . BASEURL . 'app/movCaixa/');
}
$usu_query = "SELECT (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Crédito') as credito,
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Débito') as debito, 
            (SELECT sum(valor_movCaixa) from movcaixa where tipo_movCaixa = 'Saque') as saque,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 1) as mao_obra,
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 3) as servico, 
            (SELECT sum(valor_movCaixa) from movcaixa where categoria_movCaixa = 2) as material  FROM `movcaixa` LIMIT 1";
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
<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <a href="<?php echo BASEURL; ?>app/movCaixa/novo" class="btn m-b-xs btn-success btn-addon pull-right btn-lg"><i class="fa fa-plus"></i> Adicionar</a>
            <h1 class="m-n font-thin h3 text-black">Movimentações - Caixa</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Resumo Caixa</div>
                <div class="table-responsive">
                    <div class="col-sm-6">
                        <div>
                            <h4><b>Crédito:</b> <?php formatar($credito) ?></h4>
                        </div>
                        <div>
                            <h4><b>Débito:</b> <?php formatar($debito) ?></h4>
                        </div>
                        <div>
                            <h4><b>Saque:</b> <?php formatar($saque) ?></h4>
                        </div>
                    </div>
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
                </div>
                <div class="table-responsive">
                </div>
            </div>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Movimentos do Caixa</div>
                <div class="table-responsive">
                    <style>
                        .panel>.table-responsive {
                            margin: 20px;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#imports').DataTable({
                                ajax: '<?php echo BASEURL; ?>server/_movCaixa.php',
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
                                            return '<a style="margin:5px" class="btn m-b-xs btn-sm btn-info btn-addon" href=<?php echo BASEURL; ?>app/movCaixa/editar/?id=' + data.c1 + '><i class="fa fa-edit"></i>Editar</a>'+'<a style="margin:5px" class="btn m-b-xs btn-sm btn-danger btn-addon" href=<?php echo BASEURL; ?>app/movCaixa/?id=' + data.c1 + '><i class="fa fa-close"></i>Apagar</a>';
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