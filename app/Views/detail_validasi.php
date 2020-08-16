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
                                        <img src="<?=base_url($user_bawahan['foto_profil'])?>" alt="user" width="100"
                                            class="rounded-circle">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2><?= $user_bawahan['nama']?>
                                            </h2>
                                            <h4><i class="fas fa-calendar-alt mr-2"></i><?= $presensi['tanggal_bahasa']?></h4>
                                            <div class="comment-footer mb-2">
                                                <span><i class="fas fa-map-marker-alt mr-2"></i><?= $presensi['lokasi']?></span>
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
                                <h4>Detail Validasi Tugas Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-end mb-2">
                                        <a href="<?= base_url('/supervisor/validasiSemua/'.$presensi['id_presensi'])?>" class="btn btn-success">Validasi Valid Semua Tugas</a>
                                    </div>
                                    <?php if($tugas == null) {?>
                                        <div class="col-lg-12 alert alert-warning text-center">Belum ada Tugas yang diselesaikan, Silahkan Mengisi Logbook!!</div>
                                    <?php }else{?>
                                    <table class="table table-hover" id="validasi-tugas-detail">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 25%;">Tugas</th>
                                                <th style="width: 10%;">Waktu Pengisian</th>
                                                <th style="width: 10%;">Jenis Tugas</th>
                                                <th style="width: 5%;">Jumlah</th>
                                                <th style="width: 25%;">Status</th>
                                                <th style="width: 20%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['nama_tugas']?></td>
                                                <td><?= $t['waktu']?></td>
                                                <?php if($t['id_rancangan_tugas'] != 0) { ?>
                                                    <td>Utama</td>
                                                <?php } else {?>
                                                    <td>Tambahan</td>
                                                <?php }?>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <?php if($t['status_tugas'] == 1) { ?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-success"></i>
                                                    Valid</td>
                                                    <td></td>
                                                <?php }else if($t['status_tugas'] == 2) {?>
                                                    <td>
                                                        <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                        <button class="btn btn-sm btn-warning">Revisi</button>
                                                        <p><?= $t['catatan']?></p>
                                                    </td>
                                                    <td></td>
                                                <?php }else if($t['status_tugas'] == 5) {?>
                                                    <td>
                                                        <i class="fas fa-dot-circle mr-2 text-danger"></i>
                                                        <button class="btn btn-sm btn-danger">Tolak</button>
                                                    </td>
                                                    <td></td>
                                                <?php }else if($t['status_tugas'] == 3) {?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-info"></i> Menunggu Validasi</td>
                                                    <td>
                                                    <div class="button-group">
                                                        <a href="<?= base_url('/supervisor/valid/'.$t['id_tugas']).'/'.$presensi['id_presensi']?>"
                                                            class="btn waves-effect waves-light btn-success">Valid</a>
                                                        <a href="<?= base_url('/supervisor/tolak/'.$t['id_tugas']).'/'.$presensi['id_presensi']?>"
                                                            class="btn waves-effect waves-light btn-danger">Tolak</a>
                                                        <a href="#" data-toggle="modal"
                                                        data-target="#revisiTugas"
                                                        data-whatever="@mdo" data-id="<?= $t['id_tugas']?>" data-presensi="<?= $presensi['id_presensi']?>"
                                                            class="btn waves-effect waves-light btn-warning validasi-revisi">Revisi</a>
                                                    </div>
                                                    </td>
                                                <?php } else {?>
                                                    <td><i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a href="#" class="bukti-validasi-detail" data-id="<?= $t['bukti']?>"><i class="fas fa-file-alt"></i></a>
                                                    <p><?= $t['catatan']?></p>
                                                    </td>
                                                    <td>
                                                    <div class="button-group">
                                                        <a href="<?= base_url('/supervisor/valid/'.$t['id_tugas']).'/'.$presensi['id_presensi']?>"
                                                            class="btn waves-effect waves-light btn-success">Valid</a>
                                                    </div>
                                                    </td>
                                                <?php }?>
                                            </tr>
                                        <?php endforeach?>
                                        </tbody>
                                    </table>
                                    <?php }?>
                                </div>
                                <div class="row">
                                <div class="col-12">
                                <?php if(session('id_status_user') == 6){?>
                                   <a href="<?= base_url('/supervisor/validasi')?>" class="float-right btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 5){?>
                                    <a href="<?= base_url('/manager/validasi')?>" class="float-right btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 4){?>
                                    <a href="<?= base_url('/gm/validasi')?>" class="float-right btn btn-secondary">Kembali</a>
                                <?php }else if(session('id_status_user') == 3){?>
                                    <a href="<?= base_url('/direktur/validasi')?>" class="float-right btn btn-secondary">Kembali</a>
                            <?php }?>
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

            <!-- ============================================================== -->
            <!-- Start Modeal -->
            <!-- ============================================================== -->
            <div class="modal fade" id="revisiTugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Form Revisi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="<?= base_url('/supervisor/revisiTugas')?>" method="post">
                        <div class="modal-body">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id_tugas" id="id_tugas_validasi" value="">
                                <input type="hidden" name="id_presensi" id="id_presensi_validasi" value="">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Alasan:</label>
                                    <textarea class="form-control" id="message-text1" name="catatan"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning">Revisi</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>