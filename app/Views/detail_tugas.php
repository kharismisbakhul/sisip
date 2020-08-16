<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Detail Tugas</h4>
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
                                        <img src="<?=base_url($user['foto_profil'])?>" alt="user" width="100"
                                            class="rounded-circle">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2><?= $user['nama']?>
                                            </h2>
                                            <h4><i class="fas fa-calendar-alt mr-2"></i><?= $presensi['tanggal_bahasa']?></h4>
                                            <div class="comment-footer mb-2">
                                                <?php if($presensi['waktu_presensi_keluar'] != null) { ?>
                                                    <span><i class="fas fa-map-marker-alt mr-2"></i>(Masuk) <?= $presensi['lokasi']?> - (Keluar) <?= $presensi['lokasi_keluar']?></span>
                                                <?php }else{ ?>
                                                    <span><i class="fas fa-map-marker-alt mr-2"></i>(Masuk) <?= $presensi['lokasi']?></span>
                                                <?php } ?>
                                            </div>
                                            <span class="label label-rounded label-primary">In :
                                                <?= $presensi['waktu_presensi_masuk']?></span>
                                            <?php if($presensi['waktu_presensi_keluar'] != null) { ?>
                                                <span class="label label-rounded label-success">Out :
                                                <?= $presensi['waktu_presensi_keluar']?></span>
                                            <?php } ?>
                                            
                                            <?php if($presensi['status_tempat_kerja'] == 1) { ?>
                                                <span class="label label-rounded label-warning">Work From Home</span>
                                            <?php } else if($presensi['status_tempat_kerja'] == 2) { ?>
                                                <span class="label label-rounded label-info">Work From Office</span>
                                            <?php }else{?>
                                                <span class="label label-rounded label-success">Work From Other</span>
                                            <?php }?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Daftar Tugas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php if($tugas == null) {?>
                                    <div class="col-lg-12 alert alert-warning text-center">Belum ada Tugas yang diselesaikan, Silahkan Mengisi Logbook!!</div>
                                <?php }else{?>
                                    <table class="table table-hover " id="klarifikasi-tugas-detail">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas</th>
                                                <th>Jenis Tugas</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['nama_tugas']?></td>
                                                <?php if($t['id_rancangan_tugas'] != 0) { ?>
                                                    <td>Utama</td>
                                                <?php } else {?>
                                                    <td>Tambahan</td>
                                                <?php }?>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <?php if($t['status_tugas'] == 1) { ?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-success"></i>
                                                    valid</td>
                                                <?php }else if($t['status_tugas'] == 2) {?>
                                                    <td>
                                                        <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                        <button class="btn btn-sm btn-warning">Revisi</button>
                                                        <p><?= $t['catatan']?></p>
                                                    </td>
                                                <?php }else if($t['status_tugas'] == 3) {?>
                                                    <td><i class="fas fa-dot-circle mr-2"></i> Belum valid</td>
                                                <?php }else if($t['status_tugas'] == 5) {?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-danger"></i> Tolak</td>
                                                <?php } else {?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a target="_blank" href="<?= base_url('/assets/images/bukti_klarifikasi/'.$t['bukti'])?>"><i class="fas fa-file-alt"></i></a>
                                                    <p><?= $t['catatan']?></p>
                                                    </td>
                                                <?php }?>
                                            </tr>
                                            <?php endforeach?>
                                        </tbody>
                                    </table>
                                <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                            <?php if(session('id_status_user') == 7){?>
                                <a href="<?= base_url('/staff/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }else if(session('id_status_user') == 6){?>
                                <a href="<?= base_url('/supervisor/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }else if(session('id_status_user') == 5){?>
                                <a href="<?= base_url('/manager/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }else if(session('id_status_user') == 4){?>
                                <a href="<?= base_url('/gm/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }else if(session('id_status_user') == 3){?>
                                <a href="<?= base_url('/direktur/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }?>
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