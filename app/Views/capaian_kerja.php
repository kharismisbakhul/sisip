<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Capaian Kerja</h4>
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
                                <h4>Capaian Kerja Pegawai Tahun <?= $tahun; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                    <div class="d-flex col-lg-5 mb-2">
                                        <form action="<?= base_url('/staff/capaianKerja')?>" method="get">
                                            <div class="input-group">
                                                <select class="custom-select " id="inlineFormCustomSelect" name="tahun">
                                                    <option selected value="" hidden>Pilih Periode Kerja...</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="submit"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-7">
                                        <a target="_blank" href="<?= base_url('/exportCapaianKerja') ?>" class="btn btn-success float-right"><i class="fas fa-file-excel mr-2 "></i>Export to excel</a>
                                    </div>
                                    </div>

                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas</th>
                                                <th>Jenis Tugas</th>
                                                <th>Total Dicapai</th>
                                                <th>Total Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <?php if($t['id_rancangan_tugas'] != 0) { ?>
                                                    <td><?= $t['nama_tugas']?></td>
                                                    <td>Utama</td>
                                                <?php } else {?>
                                                    <td>Tugas Tambahan  <button class="btn btn-secondary" data-id="<?= $t['id_riwayat_jabatan']?>" data-toggle="modal" data-target="#detailTugasTambahan">Detail</button></td>
                                                    <td>Tambahan</td>
                                                <?php }?>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <td><?= $t['jumlah_total_tugas']?></td>
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


            <!-- Start Modal Detail Tugas Tambahan -->
        <!-- ============================================================== -->
        <div class="modal fade" id="detailTugasTambahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Detail Tugas Tambahan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                                    <table id="zero_config" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tugas Tambahan</th>
                                                <th>Total Dicapai</th>
                                                <th>Tanggal Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas_tambahan as $t) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['nama_tugas']?></td>
                                                <td><?= $t['jumlah_tugas']?></td>
                                                <td><?= $t['tanggal_tugas']?></td>
                                            </tr>
                                        <?php endforeach?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->

<?= $this->endSection() ?>