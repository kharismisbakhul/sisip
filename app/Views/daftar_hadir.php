<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/images/ub_icon.png')?>">
    <title>Daftar Hadir</title>
    <!-- This page plugin CSS -->
    <link href="<?= base_url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('public/assets/libs/chartist/dist/chartist.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/extra-libs/c3/c3.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/libs/morris.js/morris.css')?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('public/dist/css/style.min.css')?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Daftar Hadir Pegawai </h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->

                <!-- <div class="d-flex justify-content-end mb-2">

                    <form action="" method="">
                        <div class="input-group">
                            <input type="date" class="form-control">
                            <input type="text" class="form-control" placeholder="nama...">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div> -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="zero_config" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($pegawai as $p) : ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= ($p['foto_profil']) ? base_url('public/'.$p['foto_profil']) : base_url('public/assets/images/users/default.jpg') ?>" alt="user" width="100"
                                                        class="rounded-circle">
                                                </td>
                                                <td>
                                                    <h4><?= $p['nama']?></h4>
                                                    <p><?= $p['nama_jabatan'].' '.$p['jabatan']['nama']?></p>
                                                </td>
                                                <?php if($p['presensi'] == null) {?>
                                                    <td>
                                                        <div class="comment-text w-100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger">Tidak Hadir</span>
                                                    </td>
                                                <?php } else {?>
                                                    <?php if($p['presensi']['status_presensi'] != 0) {?>
                                                    <td>
                                                        <div class="comment-text w-100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-warning">Izin</span>
                                                    </td>
                                                    <?php }else{?>
                                                    <td>
                                                    <div class="comment-text w-100">
                                                        <span class="m-b-15 d-block"><?= $p['presensi']['lokasi']?></span>
                                                        <div class="comment-footer">
                                                            <span class="label label-rounded label-primary">In :
                                                                <?= $p['presensi']['waktu_presensi_masuk']?></span>
                                                            <span class="label label-rounded label-success">Out :
                                                                <?= $p['presensi']['waktu_presensi_keluar']?></span>
                                                            <?php if($p['presensi']['status_tempat_kerja'] == 1) {?>
                                                                <span class="label label-rounded label-warning">WFH</span>
                                                            <?php } else if($p['presensi']['status_tempat_kerja'] == 2) {?>
                                                                <span class="label label-rounded label-info">WFO</span>
                                                            <?php } else {?>
                                                                <span class="label label-rounded label-success">WO</span>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-success">Hadir</span>
                                                    </td>
                                                    <?php }?>
                                                <?php }?>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                    <a href="<?= base_url()?>" class="float-right btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
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
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url('public/assets/libs/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('public/assets/libs/popper.js/dist/umd/popper.min.js')?>"></script>
    <script src="<?= base_url('public/assets/libs/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!-- apps -->
    <script src="<?= base_url('public/dist/js/app.min.js')?>"></script>
    <script src="<?= base_url('public/dist/js/app.init.horizontal.js')?>"></script>
    <script src="<?= base_url('public/dist/js/app-style-switcher.horizontal.js')?>"></script>
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
    <!--chartjs -->
    <!-- <script src="<?= base_url('public/assets/libs/raphael/raphael.min.js')?>"></script>
    <script src="<?= base_url('public/assets/libs/morris.js/morris.min.js')?>"></script>

    <script src="<?= base_url('public/dist/js/pages/dashboards/dashboard1.js')?>"></script> -->
    <!--This page plugins -->
    <script src="<?= base_url('public/assets/extra-libs/DataTables/datatables.min.js')?>"></script>
    <script src="<?= base_url('public/dist/js/pages/datatable/datatable-basic.init.js')?>"></script>
</body>

</html>