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
                                <h4>Logbook Pegawai Hari Ini</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <?php if($presensi_hari_ini != null) {?>
                                    <div class="col-lg-6">
                                        <?php if($presensi_hari_ini['isi_logbook'] == 1) {?>
                                            <div class="alert alert-success">Anda sudah melakukan pengisian logbook</div>
                                        <?php }else{?>
                                        <div class="card">
                                            <div class="card-body no-border">
                                                <h4 class="card-title">Tugas Pegawai</h4>
                                                <div class="table-responsive">
                                                    <table class="table no-border" id="logbook-utama">
                                                        <thead>
                                                            <th style="width: 5%">No</th>
                                                            <th style="width: 45%;">Tugas Utama</th>
                                                            <th style="width: 50%">Jumlah</th>

                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1; foreach($rancangan_tugas as $rt) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $rt['nama_tugas']?></td>
                                                                <td>
                                                                        <div class="input-group">
                                                                            <input class="form-control" type="hidden"
                                                                                name="id_rancangan_tugas" value="<?= $rt['id_rancangan_tugas']?>">
                                                                            <input class="form-control" type="number"
                                                                                placeholder="Jumlah..." name="jumlah" id="jumlah<?= $rt['id_rancangan_tugas']?>">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-info submit-logbook" data-id="<?= $rt['id_rancangan_tugas']?>" data-no="<?= session('no_induk')?>"><i class="fas fa-send"></i>
                                                                                    Kirim
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach?>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <table class="table no-border" id="logbook-tambahan">
                                                        <thead>
                                                            <th style="width: 50%">Tugas Tambahan</th>
                                                            <th style="width: 25%;">Jumlah</th>
                                                            <th style="width: 25%;">Periode</th>
                                                            <th style="width: 10%">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                    <td colspan="4">
                                                                        <input class="form-control" type="hidden"
                                                                        name="id_rancangan_tugas" value="0">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" name="nama_tugas_tambahan" id="nama_tugas_tambahan">Tugas Tambahan</textarea>
                                                                        </div>
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control"
                                                                                name="jumlah" placeholder="Jumlah" id="jumlah0">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <select class="form-control" name="periode" id="periode">
                                                                                <option value="1">Harian</option>
                                                                                <option value="2">Periodik</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-info submit-logbook" data-id="0" data-no="<?= session('no_induk')?>"><i class="fas fa-send"></i>
                                                                            Kirim
                                                                        </button>
                                                                    </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <a href="<?= base_url('/staff/selesaiInput/'.$presensi_hari_ini['id_presensi'])?>" class="btn btn-success">Selesai Input</a> -->
                                        <?php }?>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body no-border">
                                                <h4 class="card-title">Sudah Diselesaikan Hari Ini</h4>
                                                <table class="table no-border" id="logbook-tugas-utama">
                                                    <thead>
                                                        <th style="width: 5%">No</th>
                                                        <th style="width: 50%;">Tugas Utama</th>
                                                        <th style="width: 5%">Jumlah</th>
                                                        <th style="width: 30%">Status</th>
                                                        <th style="width: 10%">Aksi</th>
                                                    </thead>
                                                    <tbody id="table-tugas-utama">
                                                        <?php $i = 1; foreach($tugas_hari_ini as $t) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $t['nama_tugas']?></td>
                                                                <td><?= $t['jumlah_tugas']?></td>
                                                                <?php if($t['status_tugas'] == 1) { ?>
                                                                    <td><i class="fas fa-dot-circle mr-2 text-success"></i> Valid</td>
                                                                <?php }else if($t['status_tugas'] == 2) {?>
                                                                    <td>
                                                                        <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                                        <button class="btn btn-sm btn-warning">Revisi</button>
                                                                        <p><?= $t['catatan']?></p>
                                                                    </td>
                                                                <?php }else if($t['status_tugas'] == 3){?>
                                                                    <td><i class="fas fa-dot-circle mr-2"></i> Belum valid</td>
                                                                    <td><a href="<?= base_url('/staff/hapusTugas/'.$t['id_tugas'])?>" class="btn btn-danger">Hapus</a></td>
                                                                <?php } else {?>
                                                                    <td>
                                                                        <i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                                        Klarifikasi
                                                                        <a target="_blank" href="<?= base_url('/assets/images/bukti_klarifikasi/'.$t['bukti'])?>"><i class="fas fa-file-alt"></i></a>
                                                                        <p><?= $t['catatan']?></p>
                                                                    </td>
                                                                <?php }?>
                                                            </tr>
                                                        <?php endforeach?>
                                                    </tbody>
                                                </table>
                                                <table class="table no-border" id="logbook-tugas-tambahan">
                                                    <thead>
                                                        <th style="width: 5%">No</th>
                                                        <th style="width: 50%;">Tugas Tambahan</th>
                                                        <th style="width: 5%">Jumlah</th>
                                                        <th style="width: 30%">Status</th>
                                                        <th style="width: 10%">Aksi</th>
                                                    </thead>
                                                    <tbody id="table-tugas-tambahan">
                                                    <?php $i = 1; foreach($tugas_tambahan_hari_ini as $tt) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $tt['nama_tugas']?></td>
                                                            <td><?= $tt['jumlah_tugas']?></td>
                                                            <?php if($tt['status_tugas'] == 1) { ?>
                                                                <td><i class="fas fa-dot-circle mr-2 text-success"></i> Valid</td>
                                                            <?php }else if($tt['status_tugas'] == 2) {?>
                                                                <td>
                                                                    <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                                    <button class="btn btn-sm btn-warning">Revisi</button>
                                                                    <p><?= $tt['catatan']?></p>
                                                                </td>
                                                            <?php }else if($tt['status_tugas'] == 3){?>
                                                                <td><i class="fas fa-dot-circle mr-2"></i> Belum valid</td>
                                                                <td><a href="<?= base_url('/staff/hapusTugas/'.$tt['id_tugas'])?>" class="btn btn-danger">Hapus</a></td>
                                                            <?php } else {?>
                                                                <td>
                                                                    <i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                                    Klarifikasi
                                                                    <a target="_blank" href="<?= base_url('/assets/images/bukti_klarifikasi/'.$tt['bukti'])?>"><i class="fas fa-file-alt"></i></a>
                                                                    <p><?= $tt['catatan']?></p>
                                                                </td>
                                                            <?php }?>
                                                        </tr>
                                                    <?php endforeach?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-12 alert alert-warning text-center">Silahkan Melakukan Presensi Terlebih Dahulu !!</div>
                                <?php } ?>
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
                                    <table id="tabel-riwayat-presensi" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Jenis Pekerjaan</th>
                                                <th>Tempat Kerja</th>
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