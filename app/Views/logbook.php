<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Logbook</h4>
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
                                <h4>Tugas Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body no-border">
                                                <h4 class="card-title">Belum Diselesaikan</h4>
                                                <div class="table-responsive">
                                                    <table class="table no-border">
                                                        <thead>
                                                            <th style="width: 5%">No</th>
                                                            <th style="width: 45%;">Tugas Utama</th>
                                                            <th style="width: 50%">Count</th>

                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1; foreach($rancangan_tugas as $rt) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $rt['nama_tugas']?></td>
                                                                <td>
                                                                    <form action="<?= base_url('/staff/logbook')?>" method="post">
                                                                        <div class="input-group">
                                                                            <input class="form-control" type="hidden"
                                                                                name="id_rancangan_tugas" value="<?= $rt['id_rancangan_tugas']?>">
                                                                            <input class="form-control" type="number"
                                                                                placeholder="Jumlah..." name="jumlah">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-info"
                                                                                    type="submit"><i
                                                                                        class="fas fa-send"></i>
                                                                                    Kirim
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach?>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <table class="table no-border">
                                                        <thead>
                                                            <th style="width: 60%">Tugas Tambahan</th>
                                                            <th style="width: 20%;">Count</th>
                                                            <th style="width: 20%">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <form action="" method="post">
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                name="tugas_tambahan"
                                                                                placeholder="tugas tambahan ...">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control"
                                                                                name="tugas_tambahan" placeholder="">

                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-info" type="button"><i
                                                                                class="fas fa-send"></i>
                                                                            Kirim
                                                                        </button>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body no-border">
                                                <h4 class="card-title">Sudah Diselesaikan</h4>
                                                <table class="table no-border">
                                                    <thead>
                                                        <th style="width: 5%">No</th>
                                                        <th style="width: 60%;">Tugas Utama</th>
                                                        <th style="width: 5%">Count</th>
                                                        <th style="width: 40%">Status</th>

                                                    </thead>
                                                    <tbody>
                                                        <!-- <tr>
                                                            <td>1</td>
                                                            <td>Memimpin UB Guest House dan
                                                                International Dormitory serta menjadi
                                                                motivator bagi karyawan</td>
                                                            <td>
                                                                2
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-dot-circle mr-2"></i> belum valid
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Memimpin UB Guest House dan
                                                                International Dormitory serta menjadi
                                                                motivator bagi karyawan</td>
                                                            <td>
                                                                2
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-dot-circle mr-2 text-success"></i>
                                                                valid
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Memimpin UB Guest House dan
                                                                International Dormitory serta menjadi
                                                                motivator bagi karyawan</td>
                                                            <td>
                                                                2
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                                <button class="btn btn-sm btn-warning">Revisi</button>
                                                                <p>Anda tidak mengerjakan ini!</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Memimpin UB Guest House dan
                                                                International Dormitory serta menjadi
                                                                motivator bagi karyawan</td>
                                                            <td>
                                                                2
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                                Klarifikasi
                                                                <a href=""><i class="fas fa-file-alt"></i></a>
                                                                <p>Sudah benar melakukan kerjaan seperti itu</p>
                                                            </td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                                <table class="table no-border">
                                                    <thead>
                                                        <th style="width: 5%">No</th>
                                                        <th style="width: 60%;">Tugas Tambahan</th>
                                                        <th style="width: 5%">Count</th>
                                                        <th style="width: 40%">Status</th>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Makan Makan</td>
                                                            <td>
                                                                2
                                                            </td>
                                                            <td>
                                                                <i class="fas fa-dot-circle mr-2"></i> belum valid
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Riwayat Presensi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Jenis Pekerjaan</th>
                                                <th>Tempat Pelaksanaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;
                                        foreach($semua_presensi as $p) :?>
                                            <tr>
                                                <td>
                                                    <?= $a++;?>
                                                </td>
                                                <td>
                                                    <?= $p['tanggal_bahasa']?>
                                                </td>
                                                <td>
                                                    <?= $p['waktu_presensi_masuk']?> s/d <?= $p['waktu_presensi_keluar']?>
                                                </td>
                                                <td>
                                                    <?php if($p['status_tempat_kerja'] == 1) { ?>
                                                        <span class="badge badge-pill badge-warning text-white font-bold">
                                                            Work From Home
                                                        </span>
                                                    <?php }else if($p['status_tempat_kerja'] == 2) { ?>
                                                        <span class="badge badge-pill badge-info text-white font-bold">
                                                            Work From Office
                                                        </span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-pill badge-success text-white font-bold">
                                                            Work From Other
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?= $p['lokasi']?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('/staff/detailTugas/'.$p['id_presensi'])?>" class="btn btn-info"> Detail Tugas</a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
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
<?= $this->endSection() ?>