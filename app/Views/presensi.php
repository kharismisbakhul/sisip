<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Presensi</h4>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <h2 class="card-title m-t-10"><?= $user['nama']?></h2>
                                    <h4 class="card-title m-t-10">NIP : <?= $user['no_induk']?></h4>
                                    <h6 class="card-subtitle"><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></h6>
                                </center>
                                <hr>
                                
                                <div class="card bg-light-info no-card-border">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10">
                                            <?php if($presensi == null){?>
                                                <h4>Reminder</h4>
                                                <span>Anda belum melakukan presensi <u>masuk</u> hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                   <b> </b></span>
                                            <?php }else if($presensi['waktu_presensi_keluar'] == null){?>
                                                <h4>Reminder</h4>
                                                <span>Anda belum melakukan presensi <u>keluar</u> hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                   <b> </b></span>
                                            <?php }else{?>
                                                <h4>Reminder</h4>
                                                <span>Anda <u>sudah</u> melakukan presensi hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                   <b> </b></span>
                                            <?php }?>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="icon-Information" style="font-size: 50px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="row">
                                    <div class="col-5 font-bold">Waktu Presensi Masuk</div>
                                    <?php if($presensi != null) { ?>
                                        <div class="col-7"><?= $presensi['waktu_presensi_masuk']?></div>
                                    <?php } else { ?>
                                        <div class="col-7">Belum Melakukan Presensi</div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5  font-bold">Waktu Presensi Keluar</div>
                                    <?php if($presensi != null && $presensi['waktu_presensi_keluar'] != null) { ?>
                                        <div class="col-7"><?= $presensi['waktu_presensi_keluar']?></div>
                                    <?php } else { ?>
                                        <div class="col-7">Belum Melakukan Presensi</div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5 font-bold">Lokasi Masuk</div>
                                    <?php if($presensi != null) { ?>
                                        <div class="col-7"><?= $presensi['lokasi']?></div>
                                    <?php } else { ?>
                                        <div class="col-7">Belum Melakukan Presensi</div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5 font-bold">Lokasi Keluar</div>
                                    <?php if($presensi != null && $presensi['waktu_presensi_keluar'] != null) { ?>
                                        <div class="col-7"><?= $presensi['lokasi_keluar']?></div>
                                    <?php } else { ?>
                                        <div class="col-7">Belum Melakukan Presensi</div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <form action="<?= base_url('/staff/presensi')?>" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="user" value="<?= $user['id_riwayat_jabatan']?>" >
                                        <input type="hidden" name="no_induk" value="<?= $user['no_induk']?>" >
                                            <fieldset class="radio">
                                                <label for="radio1">
                                                    <input type="radio" id="radio1" name="status_kerja" value="1" checked> Work From
                                                    Home (WFH)
                                                </label>
                                            </fieldset>
                                            <fieldset class="radio">
                                                <label>
                                                    <input type="radio" id="radio2" name="status_kerja" value="2"> Work From Office
                                                    (WFO)
                                                </label>
                                            </fieldset>
                                            <fieldset class="radio">
                                                <label>
                                                    <input type="radio" id="radio3" name="status_kerja" value="3"> Work From Other
                                                    (WO)
                                                </label>
                                            </fieldset>
                                    </div>
                                </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                                <div class="input-group">
                                                <?php if($presensi == null) { ?>
                                                    <input class="form-control" type="text" placeholder="Lokasi..." id="lokasi"
                                                        name="lokasi" value="" readonly>
                                                <?php }else{ ?>
                                                    <input class="form-control" type="text" placeholder="Lokasi..." id="lokasi"
                                                        name="lokasi" value="<?= $presensi['lokasi']?>" value="" readonly>
                                                <?php } ?>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" type="button" onclick="getLocation()"><i
                                                                class="fas fa-map-marker-alt"></i> Deteksi
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div id="mapholder" style="width:300px;height:300px;" class="mt-2"></div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <button type="submit" class="btn waves-effect waves-light btn-block btn-success">Simpan Presensi
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Absensi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="riwayat-presensi">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php if($semua_presensi == null) {?>
                                    <tr>
                                        <h4 class="alert alert-warning text-center p-3">Belum ada presensi</h4>
                                    </tr>
                                    <?php } else {?>
                                    <?php foreach($semua_presensi as $p) :?>
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-row comment-row m-t-0">
                                                    <div class="p-2">
                                                        <div class="m-r-0">
                                                            <?php if($p['status_tempat_kerja'] == 1) { ?>
                                                                <a class="btn btn-xl btn-circle btn-warning text-white"><span
                                                                class="text-center font-18">WFH</span></a>
                                                            <?php } else if($p['status_tempat_kerja'] == 2) { ?>
                                                                <a class="btn btn-xl btn-circle btn-info text-white"><span
                                                                    class="text-center font-18">WFO</span></a>
                                                            <?php } else { ?>
                                                                <a class="btn btn-xl btn-circle btn-success text-white"><span
                                                                    class="text-center font-18">WO</span></a>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="comment-text w-100">
                                                        <h3 class="font-medium"><?= $p['tanggal_bahasa']?></h3>
                                                        <span class="m-b-15 d-block"><b>Lokasi Absen Masuk:</b> <?= $p['lokasi']?></span>
                                                        <?php if($p['lokasi_keluar'] != null) { ?>
                                                        <span class="m-b-15 d-block"><b>Lokasi Absen Keluar:</b> <?= $p['lokasi_keluar']?></span>
                                                        <?php } ?>
                                                        <div class="comment-footer">
                                                            <span class="label label-rounded label-primary">Waktu Masuk :
                                                                <?= $p['waktu_presensi_masuk']?></span>
                                                            <?php if($p['waktu_presensi_keluar'] != null) { ?>
                                                            <span class="label label-rounded label-success">Waktu Keluar :
                                                                <?= $p['waktu_presensi_keluar']?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                
                <!-- Presensi Bawahan -->
                <?php if(session('id_status_user') != 7){?>
                    <div class="row">
                    <div class="col-lg-12 col-xlg-12 col-md-12">

                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Riwayat Presensi Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php if($user_bawahan == null) { ?>
                                    <div class="alert alert-warning text-center">Tidak memiliki bawahan</div>
                                <?php }else{ ?>
                                    <table id="zero_config" class="table table-hover table-bordered tabel-presensi-riwayat">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($user_bawahan as $ub) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $ub['nama']?></td>
                                                <td><?= $ub['jabat']['nama_status_user'].' '. $ub['jabat']['nama']?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info button-detail-presensi-bawahan" data-toggle="modal" data-target="#detail_presensi_bawahan" data-id="<?= $ub['id_riwayat_jabatan']?>" data-nama="<?= $ub['nama'] ?>" data-jabatan="<?= $ub['jabat']['nama_status_user'].' '. $ub['jabat']['nama'] ?>">Detail</button>
                                                    <button class="btn btn-success tambah_presensi_pegawai_bawahan" data-toggle="modal" data-target="#tambah_presensi_bawahan" data-id="<?= $ub['id_riwayat_jabatan']?>">Tambah Presensi Pegawai</button>
                                                </td>
                                            </tr>
                                        <?php endforeach?>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php }?>
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


            <div class="modal fade" id="detail_presensi_bawahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Detail Presensi Bawahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <p>Nama Pegawai : <span id="nama-pegawai"></span></p>
                    <p>Jabatan : <span id="jabatan-pegawai"></span></p>
                        <table id="detail-presensi-bawahan" class="table table-hover table-bordered tabel-detail-presensi-bawahan">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Presensi Masuk</th>
                                    <th>Waktu Presensi Keluar</th>
                                    <th>Tempat Presensi Masuk</th>
                                    <th>Tempat Presensi Keluar</th>
                                    <th>Jenis Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody >
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detail_logbook_bawahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Detail Logbook Bawahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <p>Nama Pegawai : <span id="logbook-nama-pegawai"></span></p>
                    <p>Jabatan : <span id="logbook-jabatan-pegawai"></span></p>
                    <p>Tanggal : <span id="logbook-tanggal"></span></p>
                        <table id="detail-presensi-bawahan" class="table table-hover table-bordered tabel-detail-logbook-bawahan">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Tugas</th>
                                    <th>Jenis Tugas</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Waktu Pengisian</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="tambah_presensi_bawahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Presensi Bawahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/staff/presensi')?>" method="post">
                        <div class="modal-body">
                        <div class="card">
                                <div class="card-body">
                                    <center class="m-t-30">
                                        <h2 class="card-title m-t-10 nama-user"></h2>
                                        <h4 class="card-title m-t-10 nip-user">NIP : </h4>
                                        <h6 class="card-subtitle jabatan-user"></h6>
                                    </center>
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-5 font-bold">Tanggal Presensi</div>
                                        <div class="col-7"><input class="form-control" type="date" name="tanggal_presensi"></div>
                                    </div>
                                    <hr>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="user" value="<?= $user['id_riwayat_jabatan']?>" id="input_rj">
                                            <input type="hidden" name="no_induk" value="<?= $user['no_induk']?>" id="input_induk">
                                                <fieldset class="radio">
                                                    <label for="radio1">
                                                        <input type="radio" id="radio1" name="status_kerja" value="1" checked> Work From
                                                        Home (WFH)
                                                    </label>
                                                </fieldset>
                                                <fieldset class="radio">
                                                    <label>
                                                        <input type="radio" id="radio2" name="status_kerja" value="2"> Work From Office
                                                        (WFO)
                                                    </label>
                                                </fieldset>
                                                <fieldset class="radio">
                                                    <label>
                                                        <input type="radio" id="radio3" name="status_kerja" value="3"> Work From Other
                                                        (WO)
                                                    </label>
                                                </fieldset>
                                        </div>
                                    </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" placeholder="Lokasi..." id="lokasi"
                                                            name="lokasi" required>
                                                    </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn waves-effect waves-light btn-block btn-success">Simpan Presensi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?= $this->endSection() ?>