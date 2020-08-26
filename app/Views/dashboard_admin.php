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
                            <h2><?= $jumlah_validasi 
                                ?></h2>
                            <h6>Pekerjaan pegawai
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
                            <h2><?= $jumlah_belum_validasi 
                                ?></h2>
                            <h6>Pekerjaan pegawai
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
                            <h2><?= $jumlah_revisi 
                                ?></h2>
                            <h6>Pekerjaan pegawai direvisi</h6>
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
                            <h2><?= $jumlah_pegawai 
                                ?></h2>
                            <h6>Jumlah pegawai</h6>
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
                                    <?php if ($pengumuman != null) { 
                                    ?>
                                    <table class="table v-middle">
                                        <tbody>
                                            <?php foreach ($pengumuman as $p) : 
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="m-r-10">
                                                            <i class="fas fa-fw fa-bullhorn" style="font-size: 40px;"></i>
                                                        </div>
                                                        <div class="">
                                                            <h4 class="m-b-0 font-16"><?= $p['pengumuman'] 
                                                                                        ?></h4>
                                                            <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama'] 
                                                                                                                ?></span>
                                                            <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= $p['tanggal_pengumuman'] 
                                                                                                                        ?></span>
                                                            <span class="mr-3"><i class="fas fa-clock mr-2"></i><?= $p['waktu_pengumuman'] 
                                                                                                                ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                    <p class="alert-warning p-3 text-center">Tidak ada pengumuman</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- Column -->


        <!-- Column -->
        <div class="col-md-12 col-lg-8">
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
                                        <?php foreach ($pegawai as $p) : ?>
                                        <?php if($p['presensi'] == null) {?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= ($p['foto_profil']) ? base_url('public/'.$p['foto_profil']) : base_url('public/assets/images/users/default.jpg') ?>" alt="user" width="100" alt="user" width="60" class="rounded-circle">
                                                        <div class="comment-text w-100">
                                                            <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama'].' ('.$p['nama_jabatan'].' - '.$p['jabatan']['nama'].')'?></span><br>
                                                            <span class="mr-3"><i class="fas fa-user mr-2"></i><?= 'Unit Kerja - '.$p['unit_kerja']['nama']?></span><br>
                                                            <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= date('d-m-Y')?></span><br>
                                                            

                                                            <br>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td align="right">

                                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-danger">Tidak Hadir</button>


                                                </td>
                                            </tr>
                                            <?php }else if($p['presensi']['status_presensi'] != 0) {?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?= ($p['foto_profil']) ? base_url('public/'.$p['foto_profil']) : base_url('public/assets/images/users/default.jpg') ?>" alt="user" width="100" alt="user" width="60" class="rounded-circle">
                                                                <div class="comment-text w-100">
                                                                    <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama'].' ('.$p['nama_jabatan'].' - '.$p['jabatan']['nama'].')'?></span><br>
                                                                    <span class="mr-3"><i class="fas fa-user mr-2"></i><?= 'Unit Kerja - '.$p['unit_kerja']['nama']?></span><br>
                                                                    <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= date('d-m-Y')?></span><br>
                                                                    
        
                                                                    <br>
        
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td align="right">
        
                                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-warning">Izin</button>
                                                        </td>
                                                    </tr>
                                        <?php } else {?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= ($p['foto_profil']) ? base_url('public/'.$p['foto_profil']) : base_url('public/assets/images/users/default.jpg') ?>" alt="user" width="100" alt="user" width="60" class="rounded-circle">
                                                        <div class="comment-text w-100">
                                                            <span class="mr-3"><i class="fas fa-user mr-2"></i><?= $p['nama'].' ('.$p['nama_jabatan'].' - '.$p['jabatan']['nama'].')'?></span><br>
                                                            <span class="mr-3"><i class="fas fa-user mr-2"></i><?= 'Unit Kerja - '.$p['unit_kerja']['nama']?></span><br>
                                                            <span class="mr-3"><i class="fas fa-calendar-plus mr-2"></i><?= date('d-m-Y')?></span><br>
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
        <!-- Column -->
        <div class="col-md-12 col-lg-4">
            <div class="card ">
                <div class="card-body">
                    <h4 class="card-title">Data Tugas Pegawai</h4>
                    <div id="admin-chart" style="height:253px; width:100%;" class="m-t-20"></div>
                    <!-- row -->
                    <div class="row m-t-30 m-b-15">
                        <!-- column -->
                        <div class="col-4 birder-right text-left">
                            <h4 class="m-b-0"><?= $jumlah_validasi ?>
                                <small>
                                    <i class="fas fa-stop text-success"></i>
                                </small>
                            </h4>Valid
                        </div>
                        <!-- column -->
                        <div class="col-4 birder-right text-center">
                            <h4 class="m-b-0"><?= $jumlah_belum_validasi ?> 
                                <small>
                                    <i class="fas fa-stop text-info"></i>
                                </small>
                            </h4>Belum validasi
                        </div>
                        <!-- column -->
                        <div class="col-4 text-right">
                            <h4 class="m-b-0"> <?= $jumlah_revisi ?> 
                                <small>
                                    <i class="fas fa-stop text-warning"></i>
                                </small>
                            </h4>Revisi
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

<?= $this->endSection('content') ?>