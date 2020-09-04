<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Rancangan Tugas</h4>
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
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Daftar Rancangan Tugas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end mb-2">

                                <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editUser" data-whatever="@mdo">Tambah
                                    Rancangan Tugas</button> -->
                                            <div class="row">
                                            <div class="form-group">
                                                <label for="rancangan_tahun">List Tahun Rancangan Yang Tersedia</label>
                                                <select type="date" class="form-control" name="rancangan_tahun">
                                                    <?php if ($tahun != null) {
                                                        for ($i = intval($tahun['tahun_min']); $i <= intval($tahun['tahun_max']); $i++) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <label for="waktu_selesai"></label><br>
                                                    <button class="btn btn-info mt-2 mr-3 ml-2" data-toggle="modal" data-target="#tambah_tahun"><i
                                                            class="fas fa-plus"></i></button>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label for="waktu_selesai"></label><br>
                                                    <button class="btn btn-danger mt-2" data-toggle="modal" data-target="#hapus_tahun"><i
                                                            class="fas fa-trash"></i></button>
                                            </div>
                                            </div>

                            </div>
                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jabatan</th>
                                        <th>Detail Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th style="width: 40%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($jabatan as $in) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $in['nama_status_user'] ?></td>
                                            <td><?= $in['nama'] ?></td>
                                            <td><?= $in['unit_kerja']['nama'] ?></td>
                                            <td>
                                                <div class="button-group">
                                                    <a href="<?= base_url('/admin/lihatRancanganTugas/' . $in['id_jabatan']) ?>" class="btn btn-primary">Lihat Rancangan Tugas</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>


        <!-- ============================================================== -->
        <!-- Start Modeal -->
        <!-- ============================================================== -->
        <div class="modal fade" id="tambah_tahun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Tahun</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/AdminController/tambahTahun') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tahun:</label>
                                <input type="number" name="tahun" class="form-control" id="message-text1"></input>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapus_tahun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Hapus Tahun</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/AdminController/hapusTahun') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tahun:</label>
                                <select name="tahun" class="form-control" id="message-text1">
                                <option hidden selected>Pilih Tahun...</option>
                                <?php
                                    foreach ($semua_tahun as $s) {
                                        echo '<option value="' . $s['tahun'] . '">' . $s['tahun'] . '</option>';
                                    } 
                                ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->
    </div>

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?= $this->endSection('content'); ?>