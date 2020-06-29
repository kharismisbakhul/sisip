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
                                <h4>Daftar Tugas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas</th>
                                                <th>Jenis Tugas</th>
                                                <th>Count</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td> <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    <button class="btn btn-sm btn-warning">Revisi</button>
                                                    <p>Anda tidak mengerjakan ini!</p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a href=""><i class="fas fa-file-alt"></i></a>
                                                    <p>Sudah benar melakukan kerjaan seperti itu</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Utama</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-success"></i>
                                                    valid</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Memimpin UB Guest House dan International Dormitory serta menjadi
                                                    motivator bagi karyawan</td>
                                                <td>Tambahan</td>
                                                <td>1</td>
                                                <td><i class="fas fa-dot-circle mr-2 text-success"></i>
                                                    valid</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="<?= base_url('/staff/logbook')?>" class="float-right btn btn-secondary">Kembali</a>
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