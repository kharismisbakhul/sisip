<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Validasi Izin</h4>
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
                                <h4>Validasi Izin Pegawai</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Range Tanggal</th>
                                                <th>Alasan</th>
                                                <th>Kategori Izin</th>
                                                <th>Status</th>
                                                <th>Bukti</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($perizinan_bawahan as $pb) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $pb['nama']?><br>
                                                    <span><?= $pb['no_induk']?></span>
                                                </td>
                                                <td><?= $pb['tanggal_mulai']?> s/d <?= $pb['tanggal_selesai']?></td>
                                                <td><?= $pb['alasan']?></td>
                                                <?php if($pb['kategori_izin'] == 1) {?>
                                                <td>Izin</td>
                                                <?php }else if($pb['kategori_izin'] == 2) {?>
                                                <td>Sakit</td>
                                                <?php }else{?>
                                                <td>Cuti</td>
                                                <?php }?>
                                                <?php if($pb['status_izin'] == 0) {?>
                                                <td class="text-info">Proses</td>
                                                <td><a target="_blank" href="<?= base_url('/assets/images/izin/'.$pb['bukti'])?>"><i class="fas fa-file-alt"></i></a></td>
                                                <td>
                                                    <a href="<?= base_url('/supervisor/terimaIzin/'.$pb['id_perizinan'])?>" type="button"
                                                        class="btn btn-success">Terima</a>
                                                    <a href="<?= base_url('/supervisor/tolakIzin/'.$pb['id_perizinan'])?>" type="button"
                                                        class="btn btn-danger">Tolak</a>
                                                </td>
                                                <?php }else if($pb['status_izin'] == 1) {?>
                                                <td class="text-success">Diterima</td>
                                                <td><a target="_blank" href="<?= base_url('/assets/images/izin/'.$pb['bukti'])?>"><i class="fas fa-file-alt"></i></a></td>
                                                <td></td>
                                                <?php }else{?>
                                                <td class="text-danger">Ditolak</td>
                                                <td><a target="_blank" href="<?= base_url('/assets/images/izin/'.$pb['bukti'])?>"><i class="fas fa-file-alt"></i></a></td>
                                                <td></td>
                                                <?php }?>
                                                
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

            <!-- ============================================================== -->
            <!-- Start Modeal -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->

<?= $this->endSection() ?>