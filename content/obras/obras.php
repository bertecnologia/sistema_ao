<?php
if ($_SESSION['hiperServe_nivel'] < 1) {
    header("Location: $logoutAction");
    exit;
}
?>
<div id="content" class="app-content" role="main">
    <!-- Trigger the modal with a button -->

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <a href="<?php echo BASEURL; ?>app/obras/novo" class="btn m-b-xs btn-success btn-addon pull-right btn-lg"><i class="fa fa-plus"></i> Adicionar</a>
            <h1 class="m-n font-thin h3 text-black">Obras Cadastradas</h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <style>
                        .panel>.table-responsive {
                            margin: 20px;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#imports').DataTable({
                                ajax: '<?php echo BASEURL; ?>server/_obras.php',
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
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a class="btn m-b-xs btn-sm btn-info btn-addon" href=<?php echo BASEURL; ?>app/obras/editar/?id=' + data.c1 + '>Editar</a>';
                                        }

                                    },
                                    {
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a class="btn m-b-xs btn-sm btn-success btn-addon" href=<?php echo BASEURL; ?>app/obras/detalhes/?id=' + data.c1 + '>Visualizar</a>';
                                        }

                                    },
                                    /*{
                                        data: null,
                                        bSortable: false,
                                        render: function(data, type, full) {
                                            return '<a class="btn m-b-xs btn-sm btn-warning btn-addon" href=<?php echo BASEURL; ?>app/obras/controle/?id=' + data.c1 + '>Controle</a>';
                                        }
                                        
                                    }*/
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
                                <th>Obra</th>
                                <th>Início</th>
                                <th>Prazo</th>
                                <th>Valor</th>
                                <th>Editar</th>
                                <th>Visualizar</th>
                                <!--<th>Controle</th>-->
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>