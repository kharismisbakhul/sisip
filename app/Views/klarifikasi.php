<?= $this->extend('template') ?>


<?= $this->section('content') ?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Klarifikasi</h4>
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
                                <h4>Daftar Klarifikasi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php if($tugas_revisi != null) { ?>
                                    <table class="table table-hover" id="tabel-klarifikasi">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 10%;">Tanggal</th>
                                                <th style="width: 30%;">Tugas</th>
                                                <th style="width: 10%;">Jenis Tugas</th>
                                                <th style="width: 5%;">Jumlah</th>
                                                <th style="width: 20%;">Status</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($tugas_revisi as $t) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= date('d-m-Y', strtotime($t['tanggal_tugas'])) ?></td>
                                            <td><?= $t['nama_tugas'] ?></td>
                                            <?php if($t['id_rancangan_tugas'] != 0) { ?>
                                                <td>Utama</td>
                                            <?php } else {?>
                                                <td>Tambahan</td>
                                            <?php }?>
                                            <td><?= $t['jumlah_tugas']?></td>
                                            <?php if($t['status_tugas'] == 2) {?>
                                                <td>
                                                    <i class="fas fa-dot-circle mr-2 text-warning"></i>
                                                    <button class="btn btn-sm btn-warning">Revisi</button>
                                                    <p><?= $t['catatan']?></p>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning klarifikasi_tugas" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-whatever="@mdo" data-id="<?= $t['id_tugas']?>">Klarifikasi</button>
                                                </td>
                                            <?php } else {?>
                                                <td>
                                                    <i class="fas fa-dot-circle mr-2 text-purple"></i>
                                                    Klarifikasi
                                                    <a href=""><i class="fas fa-file-alt"></i></a>
                                                    <p><?= $t['catatan']?></p>
                                                </td>
                                                <td></td>
                                            <?php }?>
                                        <?php endforeach?>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <div class="alert alert-warning text-center">Tidak ada tugas Revisi</div>
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Form Klarifikasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="<?= base_url('/staff/klarifikasiTugas')?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                                <input type="hidden" name="id_tugas" id="id_tugas_modal" value="">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Alasan:</label>
                                    <textarea class="form-control" id="message-text1" name="alasan-klarifikasi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Bukti:</label>
                                    <input type="file" class="form-control" id="recipient-name1" name="bukti-klarifikasi">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Modal -->
            <!-- ============================================================== -->
<?= $this->endSection() ?>