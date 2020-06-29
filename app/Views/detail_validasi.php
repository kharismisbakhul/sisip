<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Validasi</h4>
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
                        <div class="card  bg-light no-card-border">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-40">
                                        <img src="../../assets/images/users/1.jpg" alt="user" width="100"
                                            class="rounded-circle">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2>Ayu Salsabila
                                            </h2>
                                            <h4><i class="fas fa-calendar-alt mr-2"></i>Senin, 1 Mei 2020 </h4>
                                            <div class="comment-footer mb-2">
                                                <span><i class="fas fa-map-marker-alt mr-2"></i> Jl. Simpang Candi
                                                    Panggung
                                                    gang
                                                    3
                                                    no 2 Malang, Jawa Timur</span>
                                            </div>
                                            <span class="label label-rounded label-primary">In :
                                                07.30</span>
                                            <span class="label label-rounded label-success">Out :
                                                15.30</span>
                                            <span class="label label-rounded label-warning">Work From Home</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Detail Validasi Tugas Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end mb-2">

                                        <a href="" class="btn btn-success">Validasi Valid Semua Tugas</a>
                                    </div>
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 35%;">Tugas</th>
                                                <th style="width: 10%;">Jenis Tugas</th>
                                                <th style="width: 5%;">Count</th>
                                                <th style="width: 25%;">Status</th>
                                                <th style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-success"></i>
                                                    valid</td>
                                                <td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-info"></i>
                                                    Menunggu validasi</td>
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-success">Valid</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-danger">Tolak</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-warning">Revisi</button>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a href=""><i class="fas fa-file-alt"></i></a>
                                                    <p>Sudah benar melakukan kerjaan seperti itu</p>
                                                </td>
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-success">Valid</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-danger">Tolak</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-warning">Revisi</button>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Tambahan</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    revisi
                                                    <p>Jumlahnya tidak sesuai</p>
                                                </td>

                                                <td>
                                                    <div class="button-group">
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-success">Valid</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-danger">Tolak</button>
                                                        <button type="button"
                                                            class="btn waves-effect waves-light btn-warning">Revisi</button>

                                                    </div>

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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Form Klarifikasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Alasan:</label>
                                    <textarea class="form-control" id="message-text1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Bukti:</label>
                                    <input type="file" class="form-control" id="recipient-name1">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-success">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>