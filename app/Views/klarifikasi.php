<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Klarifikasi</h4>
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
                                <h4>Daftar Klarifikasi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 10%;">Tanggal</th>
                                                <th style="width: 30%;">Tugas</th>
                                                <th style="width: 10%;">Jenis Tugas</th>
                                                <th style="width: 5%;">Count</th>
                                                <th style="width: 20%;">Status</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>12-05-2020</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    revisi
                                                    <p>Jumlahnya tidak sesuai</p>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-whatever="@mdo">Klarifikasi</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>12-05-2020</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    revisi
                                                    <p>Jumlahnya tidak sesuai</p>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-whatever="@mdo">Klarifikasi</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>12-05-2020</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    revisi
                                                    <p>Jumlahnya tidak sesuai</p>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-whatever="@mdo">Klarifikasi</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>12-05-2020</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Tambahan</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a href=""><i class="fas fa-file-alt"></i></a>
                                                    <p>Sudah benar melakukan kerjaan seperti itu</p>
                                                </td>
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
                            <button type="button" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>