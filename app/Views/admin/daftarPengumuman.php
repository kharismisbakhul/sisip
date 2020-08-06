<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Daftar Pengumuman</h4>
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
                    <h4>Daftar Pengumuman</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end mb-2">

                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editUser" data-whatever="@mdo">Tambah
                                    Pengumuman</button>

                            </div>
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Pengumuman</th>
                                        <th>Pengumuman</th>
                                        <th>Publisher</th>
                                        <th>Status Pengumuman</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pengumuman as $in) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $in['tanggal_pengumuman'] ?></td>
                                            <td><?= $in['waktu_pengumuman'] ?></td>
                                            <td><?= $in['pengumuman'] ?></td>
                                            <td>
                                                <?= $in['nama']; ?>
                                            </td>
                                            <?php if ($in['status_pengumuman'] == 0) : ?>
                                                <td class="text"><span class="badge badge-danger">Tidak Aktif</span></td>
                                            <?php else : ?>
                                                <td class="text"><span class="badge badge-success">Aktif</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="button-group">
                                                    <form action="<?= base_url('/AdminController/hapusPengumuman')?>" method="post" class="d-inline">
                                                        <input type="hidden" value="<?= $in['id_pengumuman'] ?>" name="id_pengumuman">
                                                        <button type="submit" class="btn waves-effect waves-light btn-danger" onclick="return confirm('Apakah anda yakin ?')"><i class="fas fa-trash mr-2"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-info btn-edit-pengumuman" data-toggle="modal" data-target=".editPengumuman" data-id="<?= $in['id_pengumuman'] ?>" data-status="<?= $in['status_pengumuman'] ?>" data-pengumuman="<?= $in['pengumuman'] ?>" data-whatever="@mdo"><i class="fas fa-edit"></i></button>
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
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Pengumuman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/AdminController/tambahPengumuman')?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pengumuman:</label>
                                <textarea type="text" name="pengumuman" class="form-control" id="message-text1" required></textarea>
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


        <div class="modal fade editPengumuman" id="editPengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Pengumuman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?= base_url('/AdminController/editPengumuman')?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id_pengumuman" class="edit-id-pengumuman">
                                <label for="message-text" class="control-label">Pengumuman:</label>
                                <textarea type="text" name="pengumuman" class="form-control edit-pengumuman" id="message-text1" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Status Pengumuman:</label>
                                <select class="custom-select col-12 edit-status-pengumuman" id="status_pengumuman" name="status_pengumuman">

                                </select>
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
    </div>

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?= $this->endSection('content'); ?>