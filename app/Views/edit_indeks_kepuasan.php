<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Indeks Kepuasan Pegawai</h4>
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
                                <h4>Daftar Pertanyaan </h4><span><i class="fas fa-fw fa-calendar-alt"></i>
                                    22-05-2020</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>

                                                <th style="width: 70%;">Tambah Soal</th>
                                                <th style="width: 25%;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <form action="">

                                                    <td><textarea style="width: 850px;" type="text"
                                                            class="form-control"></textarea>
                                                    </td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-success"><i
                                                                    class="fas fa-plus mr-2"></i>Tambah</button>

                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>


                                        </tbody>
                                    </table>


                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 70%;">Soal</th>
                                                <th style="width: 25%;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <form action="">
                                                    <td>1</td>
                                                    <td><textarea style="width: 800px;" type="text"
                                                            class="form-control">Bagaimana Persyaratan yang harus dipenuhi dalam pengurusan pelayanan, baik persyaratan teknis maupun administratif di PN Palangka Raya?</textarea>
                                                    </td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-info"><i
                                                                    class="fas fa-edit mr-2"></i>Simpan</button>
                                                            <a href="hapus"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash mr-2"></i>Hapus</a>

                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>
                                            <tr>
                                                <form action="">
                                                    <td>2</td>
                                                    <td><textarea style="width: 800px;" type="text"
                                                            class="form-control">Menurut Bpk/Ibu/Sdr bagaimana prosedur/tata cara pelayanan, termasuk pengaduan di PN Palangka Raya</textarea>
                                                    </td>
                                                    <td>
                                                        <div class="button-group">
                                                            <button type="button"
                                                                class="btn waves-effect waves-light btn-info"><i
                                                                    class="fas fa-edit mr-2"></i>Simpan</button>
                                                            <a href="hapus"
                                                                class="btn waves-effect waves-light btn-danger"><i
                                                                    class="fas fa-trash mr-2"></i>Hapus</a>

                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>

                                        </tbody>
                                    </table>

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
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer text-center">
                    Copyright &copy; UB Guest House 2020
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>

<?= $this->endSection() ?>