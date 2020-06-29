<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"> Indeks
                            Kepuasan
                            Pegawai</h4>
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
                                <h4>Daftar Indeks
                                    Kepuasan
                                    Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-end mb-2">

                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#editUser" data-whatever="@mdo">Tambah
                                                Indeks
                                                Kepuasan
                                                Pegawai</button>

                                        </div>
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Jumlah Soal</th>
                                                    <th>Jumlah Respond</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>20-05-2020</td>
                                                    <td>10</td>
                                                    <td>10</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash mr-2"></i>Hapus</button>

                                                            <a href="v_edit_indeks_kepuasan.html"
                                                                class="btn btn-info"><i
                                                                    class="fas fa-edit mr-2"></i>Edit</a>
                                                            <a href="" class="btn btn-warning"><i
                                                                    class="fas fa-check-circle mr-2"></i>Ubah
                                                                Status</a>
                                                            <a href="v_hasil_indeks_kepuasan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-eye mr-2"></i>Hasil</a>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>20-05-2020</td>
                                                    <td>10</td>
                                                    <td>10</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash mr-2"></i>Hapus</button>

                                                            <a href="v_edit_indeks_kepuasan.html"
                                                                class="btn btn-info"><i
                                                                    class="fas fa-edit mr-2"></i>Edit</a>
                                                            <a href="" class="btn btn-warning"><i
                                                                    class="fas fa-check-circle mr-2"></i>Ubah
                                                                Status</a>
                                                            <a href="v_hasil_indeks_kepuasan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-eye mr-2"></i>Hasil</a>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>20-05-2020</td>
                                                    <td>10</td>
                                                    <td>10</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash mr-2"></i>Hapus</button>

                                                            <a href="v_edit_indeks_kepuasan.html"
                                                                class="btn btn-info"><i
                                                                    class="fas fa-edit mr-2"></i>Edit</a>
                                                            <a href="" class="btn btn-warning"><i
                                                                    class="fas fa-check-circle mr-2"></i>Ubah
                                                                Status</a>
                                                            <a href="v_hasil_indeks_kepuasan.html"
                                                                class="btn btn-primary"><i
                                                                    class="fas fa-eye mr-2"></i>Hasil</a>

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
            </div>
        <!-- ============================================================== -->
        <!-- Start Modeal -->
        <!-- ============================================================== -->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Indeks Kepuasan Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tanggal:</label>
                                <input type="date" class="form-control" id="message-text1">
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