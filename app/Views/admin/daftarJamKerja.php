<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title"> Jam Kerja Pegawai</h4>
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
                    <h4>Daftar Jam Kerja Pegawai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-end mb-2">

                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahJamKerja" data-whatever="@mdo">Tambah
                                    Jam Kerja Pegawai</button>

                            </div>
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status Jabatan</th>
                                        <th>Detail Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>Jam Kerja Masuk</th>
                                        <th>Jam Kerja Keluar</th>
                                        <th>Status Aktif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($jam_kerja as $jm) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $jm['nama_status_user'] ?></td>
                                            <td><?= $jm['nama'] ?></td>
                                            <td><?= $jm['unit_kerja']['nama'] ?></td>
                                            <td><?= $jm['jam_kerja_masuk'] ?></td>
                                            <td><?= $jm['jam_kerja_keluar'] ?></td>
                                            <?php if ($jm['status_aktif'] == 0) : ?>
                                                <td class="text"><span class="badge badge-danger">Tidak Aktif</span></td>
                                            <?php else : ?>
                                                <td class="text"><span class="badge badge-success">Aktif</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-info editJamKerja" data-toggle="modal" data-target="#editJamKerja" data-whatever="@mdo" data-id="<?= $jm['id_jam_kerja'] ?>" data-jammasuk="<?= $jm['jam_kerja_masuk'] ?>" data-jamkeluar="<?= $jm['jam_kerja_keluar'] ?>" data-statusaktif="<?= $jm['status_aktif'] ?>" data-statusjam="<?= $jm['status_jam_kerja'] ?>" data-jabatan="<?= $jm['nama_status_user'] ?>" data-bidang="<?= $jm['nama'] ?>">Edit</a>



                                                    <a onclick="confirm('Apakah anda yakin akan dihapus ?)" href="<?= base_url('AdminController/hapusJamKerja/' . $jm['id_jam_kerja']) ?>" class="btn btn-danger">Hapus</a>
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
        <div class="modal fade" id="tambahJamKerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Tambah Jam Kerja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="<?= base_url('/AdminController/tambahJamKerja') ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="riwayat_jabatan" class="control-label">Jabatan:</label>
                                <select class="custom-select mr-sm-2" id="riwayat_jabatan">
                                    <option value="0" selected="">Pilih jabatan...</option>
                                    <?php foreach ($status_user as $su) : ?>
                                        <option value="<?= $su['id_status_user'] ?>"><?= $su['nama_status_user'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="riwayat_bidang" class="control-label">Bidang:</label>
                                <select name="id_jabatan" required class="custom-select mr-sm-2" id="riwayat_bidang">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jam_kerja_masuk" class="control-label">Jam Kerja Masuk:</label>
                                <input required class="custom-select mr-sm-2" id="jam_kerja_masuk" name="jam_kerja_masuk" type="time">
                            </div>
                            <div class="form-group">
                                <label for="jam_kerja_keluar" class="control-label">Jam Kerja Keluar:</label>
                                <input required class="custom-select mr-sm-2" id="jam_kerja_keluar" name="jam_kerja_keluar" type="time">
                            </div>
                            <div class="form-group">
                                <label for="status_aktif" class="control-label">Status Aktif:</label>
                                <select class="form-control" name="status_aktif" id="status_aktif" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_jam_kerja" class="control-label">Status Jam Kerja:</label>
                                <select class="form-control" name="status_jam_kerja" id="status_jam_kerja" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal -->
        <!-- ============================================================== -->


        <div class="modal fade" id="editJamKerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Edit Jam Kerja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="<?= base_url('AdminController/editJamKerja') ?>">
                        <input type="hidden" name="id_jam_kerja" id="id_jam_kerja_edit" value="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="riwayat_jabatan" class="control-label">Jabatan:</label>
                                <input required class="form-control" id="riwayat_jabatan_edit" type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="riwayat_bidang_edit" class="control-label">Bidang:</label>
                                <input required class="form-control" id="riwayat_bidang_edit" type="text" readonly>
                            </div>
                            <div class="form-group">
                                <label for="jam_kerja_masuk_edit" class="control-label">Jam Kerja Masuk:</label>
                                <input required class="custom-select mr-sm-2" id="jam_kerja_masuk_edit" name="jam_kerja_masuk" type="time">
                            </div>
                            <div class="form-group">
                                <label for="jam_kerja_keluar_edit" class="control-label">Jam Kerja Keluar:</label>
                                <input required class="custom-select mr-sm-2" id="jam_kerja_keluar_edit" name="jam_kerja_keluar" type="time">
                            </div>
                            <div class="form-group">
                                <label for="status_aktif" class="control-label">Status Aktif:</label>
                                <select class="form-control" name="status_aktif" id="status_aktif_edit" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_jam_kerja" class="control-label">Status Jam Kerja:</label>
                                <select class="form-control" name="status_jam_kerja" id="status_jam_kerja_edit" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?= $this->endSection('content'); ?>