<header id="header" class="app-header navbar" role="menu">
    <!-- navbar header -->
    <div class="navbar-header bg-info dker">
        <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
            <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
            <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="<?php echo BASEURL; ?>app/movConta" class="navbar-brand text-lt">
            <img src="<?php echo BASEURL; ?>images/iconeAlmeidaMori_noBg.png" alt=".">
            <span class="hidden-folded m-l-xs">Almeida Mori</span>
        </a>
        <!-- / brand -->
    </div>
    <!-- / navbar header -->

    <!-- navbar collapse -->
    <div class="collapse pos-rlt navbar-collapse box-shadow bg-info dker">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
            <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
                <i class="fa fa-dedent fa-fw text"></i>
                <i class="fa fa-indent fa-fw text-active"></i>
            </a>
        </div>

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                        <img src="<?php echo BASEURL; ?>images/<?php echo $foto_usu; ?>.jpg" alt="..."> <i class="on md b-white bottom"></i> </span>
                    <span class="hidden-sm hidden-md"><?php echo $nome_usu ?></span> <b class="caret"></b> </a>
                <!-- dropdown -->
                <ul class="dropdown-menu fadeInRight w">
                    <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                        <div>
                            <p><?php echo $empresa; ?></p>
                        </div>
                    </li>
                    <li><a href="<?php echo $logoutAction ?>">Sair</a></li>
                </ul>
                <!-- / dropdown -->
            </li>
        </ul>
        <!-- / navbar right -->
    </div>
    <!-- / navbar collapse -->
</header>
<!-- / header -->