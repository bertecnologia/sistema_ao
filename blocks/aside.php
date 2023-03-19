<aside id="aside" class="app-aside hidden-xs bg-white">
    <!--aside id="aside" class="app-aside hidden-xs bg-light dker b-r"-->
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- user -->
            <div class="clearfix hidden-xs text-center hide" id="aside-user">
                <div class="dropdown wrapper">
                    <a href="<?php echo BASEURL; ?>app/pessoa/usuario/">
                        <span class="thumb-lg w-auto-folded avatar m-t-sm"><img src="<?php echo BASEURL; ?>images/<?php echo $foto_usu; ?>.jpg" class="img-full" alt="..."></span>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                        <span class="clear"><span class="block m-t-sm">
                                <strong class="font-bold text-lt"><?php echo $nome_usu; ?></strong><b class="caret"></b></span>
                            <span class="text-muted text-xs block"><?php echo $tipo_usu; ?></span></span>
                    </a>
                    <!-- dropdown -->
                    <ul class="dropdown-menu fadeInRight w hidden-folded">
                        <li class="wrapper b-b m-b-sm bg-primary m-t-n-xs">
                            <span class="arrow top hidden-folded arrow-info"></span>
                            <div>
                                <p><?php echo $empresa; ?></p>
                            </div>
                        </li>
                        <li><a href="<?php echo $logoutAction ?>">Sair</a></li>
                    </ul>
                    <!-- / dropdown -->
                </div>
                <div class="line dk hidden-folded"></div>
            </div>
            <!-- / user -->

            <!-- nav -->
            <?php
            include_once(ABSPATH . '/blocks/nav_1.php');

            ?>
            <!-- nav -->
        </div>
    </div>
</aside>