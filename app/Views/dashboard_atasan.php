<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
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
                <!-- Info box -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_validasi ?></h2>
                                        <h6>Pekerjaan yang
                                            sudah divalidasi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-check-box"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_belum_validasi ?></h2>
                                        <h6>Pekerjaan yang
                                            belum divalidasi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-clipboard"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_revisi ?></h2>
                                        <h6>Pekerjaan yang direvisi</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-alert"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center">
                                    <div class="text-white">
                                        <h2><?= $jumlah_bawahan ?></h2>
                                        <h6>Jumlah pegawai bawahan</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-white display-6"><i class="ti-alert"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <div class="row">

                    <!-- Column -->
                    <div class="col-md-12 col-lg-12">
                    <div class="row">
                    
                                            <?php if($presensi == null){?>
                                            <div class="col-lg-12">
                                                <div class="card bg-light-info no-card-border">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="m-r-10">
                                                                <h4>Reminder</h4>
                                                                <span>Anda belum melakukan presensi <u>masuk</u> hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                                    Segera lakukan presensi<b></b>!</span>
                                                            </div>
                                                            <div class="ml-auto">
                                                                <i class="icon-Information" style="font-size: 50px;"></i>
                                                            </div>
                                                        </div>
                                                        <?php if(session('id_status_user') == 6) { ?>
                                                            <a href="<?= base_url('/supervisor/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                        <?php }else if(session('id_status_user') == 5) { ?>
                                                            <a href="<?= base_url('/manager/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                        <?php }else if(session('id_status_user') == 4) { ?>
                                                            <a href="<?= base_url('/gm/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                        <?php }else{ ?>
                                                            <a href="<?= base_url('/direktur/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }elseif(($presensi['waktu_presensi_keluar'] == null)){?>
                                                <div class="col-lg-12">
                                                    <div class="card bg-light-info no-card-border">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="m-r-10">
                                                                    <h4>Reminder</h4>
                                                                    <span>Anda belum melakukan presensi <u>keluar</u> hari ini tanggal <b><?= date('d-m-Y')?></b>.
                                                                        Segera lakukan presensi<b></b>!</span>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    <i class="icon-Information" style="font-size: 50px;"></i>
                                                                </div>
                                                            </div>
                                                            <?php if(session('id_status_user') == 6) { ?>
                                                                <a href="<?= base_url('/supervisor/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                            <?php }else if(session('id_status_user') == 5) { ?>
                                                                <a href="<?= base_url('/manager/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                            <?php }else if(session('id_status_user') == 4) { ?>
                                                                <a href="<?= base_url('/gm/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                            <?php }else{ ?>
                                                                <a href="<?= base_url('/direktur/presensi')?>" class="text-white btn btn-secondary mt-2">Klik disini untuk presensi !!</a>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <h4 class="card-title">Pengumuman</h4>
                                                            </div>
                    
                                                        </div>
                                                        <div>
                                                            <div class="table-responsive">
                                                                <?php if($pengumuman != null) { ?>
                                                                <table class="table v-middle">
                                                                    <tbody>
                                                                        <?php foreach($pengumuman as $p) :?>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="m-r-10">
                                                                                        <i class="fas fa-fw fa-bullhorn"
                                                                                            style="font-size: 40px;"></i>
                                                                                    </div>
                                                                                    <div class="">
                                                                                        <h4 class="m-b-0 font-16"><?= $p['pengumuman']?></h4>
                                                                                        <span class="mr-3"><i
                                                                                                class="fas fa-user mr-2"></i><?= $p['nama']?></span>
                                                                                        <span class="mr-3"><i
                                                                                                class="fas fa-calendar-plus mr-2"></i><?= $p['tanggal_pengumuman']?></span>
                                                                                        <span class="mr-3"><i
                                                                                                class="fas fa-clock mr-2"></i><?= $p['waktu_pengumuman']?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                                <?php }else{?>
                                                                        <p class="alert-warning p-3 text-center">Tidak ada pengumuman</p>
                                                                        <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                        </div>


                    </div>
                    <!-- Column -->


                    <!-- Column -->
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="card-title">Absensi Pegawai Hari Ini <?= date('d M Y')?></h4>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table v-middle">
                                                <tbody>
                                                <?php foreach ($staff_bawahan as $p) : ?>
                                                <?php if($p['presensi'] == null) {?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?= ($p['foto_profil']) ? base_url($p['foto_profil']) : base_url('/assets/images/users/default.jpg') ?>" alt="user" width="100" alt="user" width="60" class="rounded-circle">
                                                                <div class="comment-text w-100">
                                                                    <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama']?></span>
                                                                    <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= date('d-m-Y')?></span>
                                                                    
        
                                                                    <br>
        
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td align="right">
        
                                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-danger">Tidak Hadir</button>
        
        
                                                        </td>
                                                    </tr>
                                                <?php } else {?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?= ($p['foto_profil']) ? base_url($p['foto_profil']) : base_url('/assets/images/users/default.jpg') ?>" alt="user" width="100" alt="user" width="60" class="rounded-circle">
                                                                <div class="comment-text w-100">
                                                                    <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama']?></span>
                                                                    <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= date('d-m-Y')?></span>
                                                                    <span class="label label-rounded label-primary">In :
                                                                        <?= $p['presensi']['waktu_presensi_masuk']?></span>
                                                                    <?php if($p['presensi']['waktu_presensi_keluar'] != null) { ?>
                                                                    <span class="label label-rounded label-success">Out :
                                                                        <?= $p['presensi']['waktu_presensi_keluar']?></span>
                                                                    <?php } ?>
        
                                                                    <br>
                                                                    <span>
                                                                        <i class="fas fa-map-marker-alt mr-2"></i><?= $p['presensi']['lokasi']?>
                                                                    </span>
        
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td align="right">
        
                                                            <!-- <button type="button" class="btn btn-sm waves-effect waves-light btn-warning">WFH</button> -->
                                                            <?php if($p['presensi']['status_tempat_kerja'] == 1) {?>
                                                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-warning">WFH</button>
                                                                        <!-- <span class="label label-rounded label-warning">WFH</span> -->
                                                                    <?php } else if($p['presensi']['status_tempat_kerja'] == 2) {?>
                                                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-info">WFO</button>
                                                                        <!-- <span class="label label-rounded label-warning">WFO</span> -->
                                                                    <?php } else {?>
                                                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-success">WO</button>
                                                                        <!-- <span class="label label-rounded label-warning">WO</span> -->
                                                                    <?php }?>
        
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                    <?php endforeach ?>
        
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>