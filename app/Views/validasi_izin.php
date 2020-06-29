<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Validasi Izin</h4>
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
                    <div class="col-lg-12 col-xlg-12 col-md-12">

                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Validasi Izin Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Pekerjaan</th>
                                                <th>Range Tanggal</th>
                                                <th>Alasan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>12-05-2020</td>
                                                <td>Aditya Yusril Fikri <br>
                                                    <span>3210398098</span>
                                                </td>
                                                <td>Kasir</td>
                                                <td>20-05-2020 s/d 22-05-2020</td>
                                                <td>Menikah</td>
                                                <td class="text-info">Proses</td>
                                                <td>
                                                    <a href="v_detail_validasi.html" type="button"
                                                        class="btn btn-success">Terima</a>
                                                    <a href="v_detail_validasi.html" type="button"
                                                        class="btn btn-danger">Tolak</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>12-05-2020</td>
                                                <td>Aditya Yusril Fikri <br>
                                                    <span>3210398098</span>
                                                </td>
                                                <td>Kasir</td>
                                                <td>20-05-2020 s/d 22-05-2020</td>
                                                <td>Menikah</td>
                                                <td class="text-success">Terima</td>
                                                <td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3 </td>
                                                <td>12-05-2020</td>
                                                <td>Aditya Yusril Fikri <br>
                                                    <span>3210398098</span>
                                                </td>
                                                <td>Kasir</td>
                                                <td>20-05-2020 s/d 22-05-2020</td>
                                                <td>Menikah</td>
                                                <td class="text-danger">Tolak</td>
                                                <td>

                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
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

            <!-- ============================================================== -->
            <!-- Start Modeal -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>