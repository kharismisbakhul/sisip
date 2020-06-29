<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profil Pegawai</h4>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../../assets/images/users/1.jpg"
                                        class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">Ayu Salsabila</h4>
                                    <h5 class="card-title m-t-10">Pegawai</h5>
                                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>

                                </center>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> <small class="text-muted">Email </small>
                                <h6>hannagover@gmail.com</h6> <small class="text-muted p-t-30 db">Nomer Telepon</small>
                                <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Alamat</small>
                                <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-tupoksi-tab" data-toggle="pill"
                                        href="#last-month" role="tab" aria-controls="pills-tupoksi"
                                        aria-selected="false">Tupoksi</a>
                                </li>

                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="last-month" role="tabpanel"
                                    aria-labelledby="pills-tupoksi-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form class="m-b-25" action="" method="POST">
                                                <div class="form-group">
                                                    <select class="custom-select" id="inputGroupSelect04">
                                                        <option selected="">Periode Kerja...</option>
                                                        <option value="1">2018</option>
                                                        <option value="2">2019</option>
                                                        <option value="3">2020</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="custom-select" id="inputGroupSelect04">
                                                        <option selected="">Jenis Pekerjaan...</option>
                                                        <option value="1">Kasir</option>
                                                        <option value="2">Satpam</option>
                                                        <option value="3">Resepsionis</option>
                                                    </select>
                                                </div>
                                                <div class=" text-center justify-content-md-center">
                                                    <button type="button"
                                                        class="btn waves-effect waves-light btn-block btn-info">Simpan</button>
                                                </div>
                                            </form>
                                            <h4>Pekerjaan <b>Accoubts Manager Amix corp</b> Periode 2020</h4>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Nama Tugas</th>
                                                        <th scope="col">Jenis Tugas</th>
                                                        <th scope="col">Count</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Memimpin UB Guest House dan
                                                            International Dormitory serta menjadi
                                                            motivator bagi karyawan</td>
                                                        <td>Utama</td>
                                                        <td>100</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Memutuskan dan membuat kebijakan
                                                            UB Guest House</td>
                                                        <td>Utama</td>
                                                        <td>80</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Membuat prosedur standar UB Guest
                                                            House</td>
                                                        <td>Tambahan</td>
                                                        <td>90</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>