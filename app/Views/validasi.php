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

                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h4>Validasi Tugas Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php if($presensi_bawahan == null) { ?>
                                    <div class="alert alert-warning text-center">Tidak ada saran</div>
                                <?php }else{ ?>
                                    <table id="tabel_validasi_logbook" class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Waktu Presensi</th>
                                                <th>Nama</th>
                                                <th>Jenis Pekerjaan</th>
                                                <th>Lokasi</th>
                                                <th>Permintaan Validasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($presensi_bawahan as $p) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= date('d-m-Y', strtotime($p['tanggal_presensi']))?></td>
                                                <?php if($p['waktu_presensi_keluar'] != null) {?>
                                                    <td><?= 'Masuk : '.$p['waktu_presensi_masuk'].'<br>Keluar : '. $p['waktu_presensi_keluar']?></td>
                                                <?php }else{?>
                                                    <td><?= 'Masuk : '.$p['waktu_presensi_masuk']?></td>
                                                <?php }?>
                                                <td><?= $p['nama']?></td>
                                                <?php if($p['status_tempat_kerja'] == 1) { ?>
                                                <td>WFH</td>
                                                <?php }else if($p['status_tempat_kerja'] == 2) { ?>
                                                <td>WFO</td>
                                                <?php }else{?>
                                                <td>WO</td>
                                                <?php }?>
                                                <td><?= $p['lokasi']?></td>
                                                <td><i class="fas fa-dot-circle mr-2 text-info"></i>
                                                    <span><?= $p['jumlah_tugas_validasi']?></span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('/supervisor/detailValidasi/'.$p['id_presensi']) ?>" type="button"
                                                        class="btn btn-info">Detail</a>
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

            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>