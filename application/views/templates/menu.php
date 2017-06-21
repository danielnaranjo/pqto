<?
/* variables */
$nivel = $this->session->userdata('level');
?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="nav-item start">
                <a href="<?php echo site_url() ?>/user/" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=site_url() ?>/package/all" class="nav-link">
                    <i class="fa fa-truck"></i>
                    <span class="title">Mis envios</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=site_url() ?>/comment/all" class="nav-link">
                    <i class="fa fa-comments"></i>
                    <span class="title">Comentarios</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase"></h3>
            </li>
            <li class="nav-item">
                <a href="<?=site_url() ?>/package/explorer" class="nav-link">
                    <i class="fa fa-globe"></i>
                    <span class="title">Explorar</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=site_url() ?>/vote/explorer" class="nav-link">
                    <i class="fa fa-thumbs-o-up"></i>
                    <span class="title">Ranking</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase"></h3>
            </li>
            <li class="nav-item">
                <a href="<?=site_url() ?>/user/me" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Perfil</span>
                    <span class="arrow"></span>
                </a>
            </li>

            <!-- todos -->
            <li class="heading">
                <h3 class="uppercase"></h3>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url() ?>/user/logout" class="nav-link">
                    <i class="icon-logout"></i>
                    <span class="title">Cerrar sesión</span>
                </a>
            </li>
            <!--  todos -->


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
