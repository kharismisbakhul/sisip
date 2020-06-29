<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Daftar Pengumuman</h4>
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
                                <h4>Daftar Pengumuman</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-end mb-2">
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#tambahPengumuman" data-whatever="@mdo">Tambah
                                                Pengumuman</button>

                                        </div>
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pengumuman</th>
                                                    <th>User</th>
                                                    <th>Tujuan</th>
                                                    <th>Aktif</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td>Ada rapat jam 13.00 di ruang meeting tanggal 20 Mei 2020</td>
                                                    <td>Aditya Yusril Fikri</td>
                                                    <td>Semua</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editPengumuman"
                                                                data-whatever="@mdo">Edit</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Ada rapat jam 13.00 di ruang meeting tanggal 20 Mei 2020</td>
                                                    <td>Aditya Yusril Fikri</td>
                                                    <td>Semua</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editPengumuman"
                                                                data-whatever="@mdo">Edit</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Ada rapat jam 13.00 di ruang meeting tanggal 20 Mei 2020</td>
                                                    <td>Aditya Yusril Fikri</td>
                                                    <td>Semua</td>
                                                    <td class="text-success">Aktif</td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="modal" data-target="#editPengumuman"
                                                                data-whatever="@mdo">Edit</button>
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
        <div class="modal fade" id="editPengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Pengumuman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pengumuman:</label>
                                <textarea class="form-control" id="message-text1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">User:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected="">Pilih User...</option>
                                    <option value="1">Aditya</option>
                                    <option value="2">Kharis</option>
                                    <option value="3">Iksan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tujuan:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected="">Pilih Tujuan...</option>
                                    <option value="1">Semua</option>
                                    <option value="2">Unit</option>
                                    <option value="3">SPV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Status:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
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

        <!-- Start Modeal -->
        <!-- ============================================================== -->
        <div class="modal fade" id="tambahPengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Pengumuman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pengumuman:</label>
                                <textarea class="form-control" id="message-text1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">User:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected="">Pilih User...</option>
                                    <option value="1">Aditya</option>
                                    <option value="2">Kharis</option>
                                    <option value="3">Iksan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tujuan:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option selected="">Pilih Tujuan...</option>
                                    <option value="1">Semua</option>
                                    <option value="2">Unit</option>
                                    <option value="3">SPV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Status:</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
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