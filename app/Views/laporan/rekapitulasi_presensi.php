<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Rekapitulasi Presensi</h4>
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
                            <h4>Laporan Rekapitulasi Presensi</h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                        <form action="<?= base_url('/admin/rekapitulasiPresensiDetail') ?>" method="post">
                                            <div class="input-group">
                                            <div class="row">
                                            <div class="form-group">
                                                <label for="pegawai">Nama Pegawai - Jabatan</label>
                                                <select name="pegawai" id="" class="form-control" required>
                                                    <option value="" hidden selected>Pilih Pegawai...</option>
                                                    <?php foreach($pegawai as $p) : ?>
                                                        <option value="<?= $p['no_induk']?>"><?= $p['nama'].' - '.$p['nama_jabatan'].' '.$p['jabatan']['nama']?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="form-group">
                                                <label for="waktu_mulai">Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="waktu_mulai" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="waktu_selesai">Tanggal Selesai</label>
                                                <input type="date" class="form-control" name="waktu_selesai" required>
                                            </div>
                                            <div class="form-group">
                                            <label for="waktu_selesai"></label><br>
                                                    <button class="btn btn-info mt-2" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                            </div>
                                            </div>
                                                
                                            </div>
                                        </form>
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