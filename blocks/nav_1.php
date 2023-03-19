<nav ui-nav="" class="navi clearfix">
    <ul class="nav">
        <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
            <span>Navegação</span>
        </li>
        <?php
        if ($hiperServe_nivel == 1) {
            //Administrador

        ?>
            <li>
                <a href="" class="auto">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="glyphicon glyphicon-edit icon text-success-dker"></i>
                    <span class="font-bold">Cadastros</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li class="nav-sub-header">
                        <a href=""><span>Cadastros</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/clientes"><span>Clientes</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/pessoa/usuarios"><span>Usuarios</span></a>
                    </li>
                </ul>
            </li>
        <?php
        } elseif ($hiperServe_nivel == 2) {
            //Manutenção
        ?>

            <li>
                <a href="" class="auto">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="glyphicon glyphicon-usd icon text-primary-dker"></i>
                    <span class="font-bold">Movimentações</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li class="nav-sub-header">
                        <a href=""><span>Movimentações</span></a>
                    </li>
                    <!--
                    <li>
                        <a href="<?php echo BASEURL; ?>app/geral"><span>Geral</span></a>
                    </li>
                        -->
                    <li>
                        <a href="<?php echo BASEURL; ?>app/movConta"><span>Conta</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/movCaixa"><span>Caixa</span></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="" class="auto">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="	glyphicon glyphicon-paste icon text-danger-dker"></i>
                    <span class="font-bold">Obras</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li class="nav-sub-header">
                        <a href=""><span>Obras</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/obras"><span>Obras</span></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="" class="auto">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="glyphicon glyphicon-th-list icon text-success-dker"></i>
                    <span class="font-bold">Cadastros</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li class="nav-sub-header">
                        <a href=""><span>Cadastros</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/clientes"><span>Clientes</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/fornecedores"><span>Fornecedores</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/categorias"><span>Categorias</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="" class="auto">
                    <span class="pull-right text-muted">
                        <i class="fa fa-fw fa-angle-right text"></i>
                        <i class="fa fa-fw fa-angle-down text-active"></i>
                    </span>
                    <i class="glyphicon glyphicon glyphicon-cog icon text-body-dker"></i>
                    <span class="font-bold">Sistema</span>
                </a>
                <ul class="nav nav-sub dk">
                    <li class="nav-sub-header">
                        <a href=""><span>Cadastros</span></a>
                    </li>

                    <li>
                        <a href="<?php echo BASEURL; ?>app/backups"><span>Backups</span></a>
                    </li>

                </ul>
            </li>


        <?php
        } elseif ($hiperServe_nivel == 0) {
            //Cliente
        ?>
            <li>
                <a href="<?php echo BASEURL; ?>app/site/  " class="auto">
                    <i class="glyphicon glyphicon-check icon text-danger-dker"></i>
                    <span class="font-bold">Pedido</span>
                </a>
            </li>
        <?php
        }
        ?>

    </ul>
</nav>