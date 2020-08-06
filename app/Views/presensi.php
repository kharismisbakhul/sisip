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
                                <?php if($presensi == null || $presensi['waktu_presensi_keluar'] == null){?>
                                <form action="<?= base_url('/staff/presensi')?>" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="user" value="<?= $user['id_riwayat_jabatan']?>" >
                                        <input type="hidden" name="no_induk" value="<?= $user['no_induk']?>" >
                                            <!-- <fieldset class="radio">
                                                <label for="radio1">
                                                    <?php if($presensi['status_tempat_kerja'] == 1) { ?>
                                                        <input type="radio" id="radio1" name="status_kerja" value="1" checked> Work From Home (WFH)
                                                    <?php } else if($presensi['status_tempat_kerja'] == 2) { ?>
                                                        <input type="radio" id="radio2" name="status_kerja" value="2" checked> Work From Office (WFO)
                                                    <?php } else { ?>
                                                        <input type="radio" id="radio3" name="status_kerja" value="3" checked> Work From Other (WO)
                                                    <?php }?>
                                                </label>
                                            </fieldset> -->
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
                                                        name="lokasi" onclick="initMap()">
                                                <?php }else{ ?>
                                                    <input class="form-control" type="text" placeholder="Lokasi..." id="lokasi"
                                                        name="lokasi" value="<?= $presensi['lokasi']?>" onclick="initMap()">
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
                                <?php } ?>
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
                                                            <span class="label label-rounded label-primary">In :
                                                                <?= $p['waktu_presensi_masuk']?></span>
                                                            <?php if($p['waktu_presensi_keluar'] != null) { ?>
                                                            <span class="label label-rounded label-success">Out :
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