<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Laporan Evaluasi dan Monitoring</h4>
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
                                <h4>Evaluasi dan Monitoring Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="col-lg-5 mb-2">
                                        
                                    </div>
                                    <div class="col-lg-7">
                                        <a target="_blank" href="<?= base_url('/exportLaporanEvaluasi') ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table id="zero_config" class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="align-middle" rowspan="2">No</th>
                                        <th class="align-middle" rowspan="2">Unit</th>
                                        <th class="align-middle" rowspan="2">Jabatan</th>
                                        <th class="align-middle" rowspan="2">Nama</th>
                                        <th class="align-middle text-center" colspan="2">Deskripsi Tugas</th>
                                        <th class="align-middle text-center" colspan="3">Periode</th>
                                        <th class="align-middle" rowspan="2">Jumlah Tugas Dilakukan</th>
                                        <th class="align-middle" rowspan="2">Jumlah Target Tugas</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-center">Utama</th>
                                        <th class="align-middle text-center">Tambahan</th>
                                        <th class="align-middle text-center">Harian</th>
                                        <th class="align-middle text-center">Mingguan</th>
                                        <th class="align-middle text-center">Periodik</th>
                                    </tr>
        
                                </thead>
                                <tbody>
                                    <?php $index = 1; foreach($rancangan_tugas as $rt) :?>
                                    <tr>
                                        <?php if($index == 1) {?>
                                            <td><?= ($index++)?></td>
                                            <td><?= $unit_kerja['nama']?></td>
                                            <td><?= $user['nama_jabatan'].' '.$user['jabatan']['nama']?></td>
                                            <td><?= $user['nama']?></td>
                                        <?php }else{?>
                                                <td><?= ($index++)?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                        <?php }?>
                                            <td><?= $rt['nama_tugas']?></td>
                                            <td></td>
                                        <?php if($rt['periode'] == 1) {?>
                                            <td>V</td>
                                            <td></td>
                                            <td></td>
                                        <?php }else if($rt['periode'] == 3){?>
                                            <td></td>
                                            <td>V</td>
                                            <td></td>
                                        <?php }else{?>
                                            <td></td>
                                            <td></td>
                                            <td>V</td>
                                        <?php }?>
                                            <td><?= $rt['jumlah_tugas']?></td>
                                            <td><?= $rt['jumlah_total_tugas']?></td>
                                    </tr>
                                    <?php endforeach?>
                                    <?php foreach($tugas_tambahan as $tt) :?>
                                    <tr>
                                        <td><?= ($index++)?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?= $tt['nama_tugas']?></td>
                                        <?php if($tt['periode'] == 1) {?>
                                            <td>V</td>
                                            <td></td>
                                            <td></td>
                                        <?php }else if($tt['periode'] == 3){?>
                                            <td></td>
                                            <td>V</td>
                                            <td></td>
                                        <?php }else{?>
                                            <td></td>
                                            <td></td>
                                            <td>V</td>
                                        <?php }?>
                                        <td><?= $tt['jumlah_tugas']?></td>
                                        <td>0</td>
                                    </tr>
                                    <?php endforeach?>
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