<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title"> Indeks
                Kepuasan
                Pegawai</h4>
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
                    <h4>Daftar Indeks
                        Kepuasan
                        Pegawai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end mb-2">

                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editUser" data-whatever="@mdo">Tambah
                                    Indeks
                                    Kepuasan
                                    Pegawai</button>

                            </div>
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Soal</th>
                                        <th>Jumlah Respond</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($indeks as $in) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $in['tanggal'] ?></td>
                                            <td><?= $jumlah[$in['id']] ?></td>
                                            <td>
                                                <?= $responden[$in['id']]; ?>


                                            </td>
                                            <?php if ($in['status'] == 0) : ?>
                                                <td class="text"><span class="badge badge-danger">Tidak Aktif</span></td>
                                            <?php else : ?>
                                                <td class="text"><span class="badge badge-success">Aktif</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="button-group">
                                                    <form action="/AdminController/hapusIndeksKepuasan" method="post" class="d-inline">
                                                        <input type="hidden" value="<?= $in['id'] ?>" name="id_indeks">
                                                        <button type="submit" class="btn waves-effect waves-light btn-danger" onclick="return confirm('Apakah anda yakin ?')"><i class="fas fa-trash mr-2"></i>Hapus</button>
                                                    </form>
                                                    <a href="/admin/editIndeksKepuasan/<?= $in['id'] ?>" class="btn btn-info"><i class="fas fa-edit mr-2"></i>Edit</a>
                                                    <a href="/AdminController/ubahStatusIndeks/<?= $in['id']  ?>" class="btn btn-warning"><i class="fas fa-check-circle mr-2"></i>Ubah
                                                        Status</a>
                                                    <a href="/admin/hasilIndeksKepuasan/<?= $in['id'] ?>" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>Hasil</a>

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
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Indeks Kepuasan Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="/admin/tambahIndeksKepuasan" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control" id="message-text1" required>
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