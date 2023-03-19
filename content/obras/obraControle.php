<?php

$id_obra = $_GET['id'];

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

?>


<div id="content" class="app-content" role="main">

    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3 text-black">Controle de Despesas: <?php echo $cliente_obra ?></h1>
            <small class="text-muted"><?php echo $empresa; ?></small>
        </div>

        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Movimentos do Caixa</div>

                <div class="table-responsive">
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
            </div>
        </div>

        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="margin: 5px; font-weight:400;">Mão-de-obra | Serviços | Material</h3>
                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="info">
                                    <td>Descrição</td>
                                    <td>Janeiro</td>
                                    <td>Fevereiro</td>
                                    <td>Março</td>
                                    <td>Abril</td>
                                    <td>Maio</td>
                                    <td>Junho</td>
                                    <td>Julho</td>
                                    <td>Agosto</td>
                                    <td>Setembro</td>
                                    <td>Outubro</td>
                                    <td>Novembro</td>
                                    <td>Dezembro</td>
                                    <td>Total</td>
                                    <td>%</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="active">
                                    <td>Mão-de-obra</td>
                                </tr>

                                <tr class="active">
                                    <td>Serviços</td>
                                </tr>

                                <tr class="active">
                                    <td>Materiais</td>
                                </tr>

                                <tr class="active">
                                    <td>Adicional</td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr class="info">
                                    <td>Receita</td>
                                </tr>
                                <tr class="info">
                                    <td>Despesa</td>
                                </tr>
                                <tr class="success">
                                    <td>Saldo</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
    table {
        width: 100%;
    }
</style>