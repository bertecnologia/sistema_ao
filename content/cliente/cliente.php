<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
?>

<!--Deletar Cliente-->
<?php
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
?>

    <!-- Modal Deletar Cliente-->
    <div class="modal fade" id="modalDeletarCliente" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Apagar Item: <?php echo $id; ?></h3>
                </div>
                <div class="modal-body">
                    <h4>Tem certeza que deseja apagar este Cliente?</h4>
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button name="sim" type="submit" class="btn btn-success">Sim</button>
                        <button name="nao" type="submit" class="btn btn-danger">Não</button>
                    </form>
                    <?php
                    if (($_POST) && (isset($_POST['sim']))) {
                        $sql = "DELETE FROM clientes WHERE id_cliente = $id";
                        $link_conexao->query($sql);
                        header('Location: ' . BASEURL . "app/clientes");
                    }
                    if (($_POST) && (isset($_POST['nao']))) {
                        header('Location: ' . BASEURL . "app/clientes");
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#modalDeletarCliente").modal();
        });
    </script>
<?php
}
?>
<!--FIM - Deletar Cliente-->

<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <a href="<?php echo BASEURL; ?>app/clientes/novo" class="btn m-b-xs btn-success btn-addon pull-right btn-lg"><i class="fa fa-plus"></i> Adicionar</a>
            <h1 class="m-n font-thin h3 text-black">Clientes Cadastrados</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Clientes</div>
                <div class="table-responsive">
                    <style>
                        .panel>.table-responsive {
                            margin: 20px;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#imports').DataTable({
                                ajax: '<?php echo BASEURL; ?>server/_clientes.php',
                                columns: [{
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
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a class="btn m-b-xs btn-sm btn-info btn-addon" href=<?php echo BASEURL; ?>app/clientes/editar/?id=' + data.c1 + '><i class="fa fa-edit"></i>Editar</a>';
                                        }
                                    },
                                    {
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a href="<?php echo BASEURL ?>app/clientes/?id=' + data.c1 + '" class="btn m-b-xs btn-sm btn-danger btn-addon"' + data.c1 + '><i class="fa fa-trash"></i>Deletar</a>';
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
                                <th>Nome</th>
                                <th>Documento</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>