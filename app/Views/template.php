<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/images/ub_icon.png')?>">
    <title><?= $title;?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url('public/assets/libs/chartist/dist/chartist.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/extra-libs/c3/c3.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/libs/morris.js/morris.css')?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('public/dist/css/style.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/extra-libs/css-chart/css-chart.css')?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<?php if($title == "Presensi Pegawai"){
    echo '<body onload="initMap()">';
}else{
    echo  '<body>';
}?>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?= base_url('')?>">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url('public/assets/images/logo-icon.png')?>" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url('public/assets/images/logo-light-icon.png')?>" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <h4 class="text-white mt-2">Sistem Presensi</h4>
                            <!-- dark Logo text -->
                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
                            <!-- Light Logo text -->
                            <!-- <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> -->
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar">
                                <i class="sl-icon-menu font-20"></i>
                            </a>
                        </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="<?= base_url('/logout')?>">
                                <i class="fas fa-fw fa-sign-out-alt font-16"></i> Logout
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <?= $this->include('sidebar') ?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- Main Content -->
            <?= $this->renderSection('content') ?>
            <!-- End Main Content -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Copyright &copy; BUNA UB 2020
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <?= $this->include('customizer') ?>

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url('public/assets/libs/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('public/assets/libs/popper.js/dist/umd/popper.min.js')?>"></script>
    <script src="<?= base_url('public/assets/libs/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!-- apps -->
    <script src="<?= base_url('public/dist/js/app.min.js')?>"></script>
    <script src="<?= base_url('public/dist/js/app.init.js')?>"></script>
    <script src="<?= base_url('public/dist/js/app-style-switcher.js')?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')?>"></script>
    <script src="<?= base_url('public/assets/extra-libs/sparkline/sparkline.js')?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('public/dist/js/waves.js')?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('public/dist/js/sidebarmenu.js')?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('public/dist/js/custom.min.js')?>"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?= base_url('public/assets/libs/chartist/dist/chartist.min.js')?>"></script>
    <script src="<?= base_url('public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')?>"></script>
    <!--c3 charts -->
    <script src="<?= base_url('public/assets/extra-libs/c3/d3.min.js')?>"></script>
    <script src="<?= base_url('public/assets/extra-libs/c3/c3.min.js')?>"></script>
    <!-- DataTables -->
    <script src="<?= base_url('public/assets/extra-libs/DataTables/datatables.min.js')?>"></script>
    <script src="<?= base_url('public/dist/js/pages/datatable/datatable-basic.init.js')?>"></script>

    <!--chartjs -->
    <!--<script src="<?= base_url('public/assets/libs/raphael/raphael.min.js')?>"></script>-->
    <!--<script src="<?= base_url('public/assets/libs/morris.js/morris.min.js')?>"></script>-->
    <!--<script src="<?= base_url('public/dist/js/pages/dashboards/dashboard1.js')?>"></script>-->

    <!--<script src="<?= base_url('public/dist/js/pages/dashboards/dashboard2.js')?>"></script>-->

    <!-- Custom Js -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4NcKjfbIxsPeUU-42gGEiRWz-EI8ASpc"></script>      -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1UN7cFiG_kqvrABPV1kbXBVbU8Awhot8"></script>     
    <script src="<?= base_url('public/assets/js/user.js')?>"></script>
    <script src="<?= base_url('public/assets/js/script.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/geolocation.js') ?>"></script>
</body>

</html>